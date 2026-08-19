<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
	protected const NOTIFICACOES_CACHE_TTL = 60;
	protected const HOME_CACHE_TTL = 300;
	protected const LISTAGEM_CACHE_TTL = 300;

	/**
	 * Instance of the main Request object.
	 *
	 * @var CLIRequest|IncomingRequest
	 */
	protected $request;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Be sure to declare properties for any property fetch you initialized.
	 * The creation of dynamic property is deprecated in PHP 8.2.
	 */
	protected $session;

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->session = app_session();

		$versaoSiteConfig = $this->obterVersaoSiteConfig();
		$versaoSessao = $this->session->get('site_config_version');

		$deveRecarregarSiteConfig = ! $this->siteConfigCacheHabilitado()
			|| ! $this->session->has('site_config')
			|| $versaoSessao !== $versaoSiteConfig;

		if ($deveRecarregarSiteConfig) {
			$siteConfig = $this->obterSiteConfigDoCache($versaoSiteConfig);
			$this->session->set([
				'site_config' => $siteConfig,
				'site_config_version' => $versaoSiteConfig,
			]);
		}

		if (!($this->session->has('colaboradores'))) {
			$this->session->set([
				'colaboradores' => [
					'id' => null,
					'nome' => null,
					'email' => null,
					'avatar' => null,
					'notificacoes' => 0,
					'notificacoes_cache_em' => 0,
					'permissoes' => array()
				]
			]);
		}

		$this->atualizarContagemNotificacoesSeNecessario();
	}

	protected function siteConfigCacheHabilitado(): bool
	{
		return getenv('CI_ENVIRONMENT') === 'production';
	}

	protected function homeCacheHabilitado(): bool
	{
		return $this->siteConfigCacheHabilitado();
	}

	protected function usuarioAnonimo(): bool
	{
		if (! $this->session->has('colaboradores')) {
			return true;
		}

		return $this->session->get('colaboradores')['id'] === null;
	}

	protected function chaveCacheHomeAnonima(): string
	{
		return 'home_anon_' . $this->obterVersaoSiteConfig() . '_' . $this->obterVersaoCacheHome();
	}

	protected function chaveCacheListagem(string $pagina, string $extra = ''): string
	{
		$suffixo = $extra !== '' ? '_' . md5($extra) : '';

		return $pagina . '_anon_' . $this->obterVersaoSiteConfig() . '_' . $this->obterVersaoCacheHome() . $suffixo;
	}

	/**
	 * @param callable(): array $montador
	 * @return array<string, mixed>
	 */
	protected function obterDadosCacheAnonimo(string $chave, callable $montador): array
	{
		if ($this->homeCacheHabilitado() && $this->usuarioAnonimo()) {
			$cache = \Config\Services::cache();
			$dados = $cache->get($chave);
			if (is_array($dados)) {
				return $dados;
			}
		}

		$dados = $montador();

		if ($this->homeCacheHabilitado() && $this->usuarioAnonimo()) {
			\Config\Services::cache()->save($chave, $dados, self::LISTAGEM_CACHE_TTL);
		}

		return $dados;
	}

	protected function obterHtmlCacheAnonimo(string $chave, callable $montador): string
	{
		if ($this->homeCacheHabilitado() && $this->usuarioAnonimo()) {
			$cache = \Config\Services::cache();
			$html = $cache->get($chave);
			if (is_string($html) && $html !== '') {
				return $html;
			}
		}

		$html = $montador();

		if ($this->homeCacheHabilitado() && $this->usuarioAnonimo() && is_string($html) && $html !== '') {
			\Config\Services::cache()->save($chave, $html, self::LISTAGEM_CACHE_TTL);
		}

		return $html;
	}

	protected function obterVersaoCacheHome(): string
	{
		$arquivo = WRITEPATH . 'cache/home_version.txt';

		if (! is_file($arquivo)) {
			return '0';
		}

		$versao = trim((string) file_get_contents($arquivo));

		return $versao !== '' ? $versao : '0';
	}

	protected function invalidarCacheHome(): void
	{
		if (! $this->homeCacheHabilitado()) {
			return;
		}

		$arquivo = WRITEPATH . 'cache/home_version.txt';
		$diretorio = dirname($arquivo);

		if (! is_dir($diretorio)) {
			mkdir($diretorio, 0775, true);
		}

		$cache = \Config\Services::cache();
		$chaveAntiga = $this->chaveCacheHomeAnonima();

		file_put_contents($arquivo, (string) time());
		$cache->delete($chaveAntiga);
	}

	protected function obterVersaoSiteConfig(): string
	{
		$arquivo = WRITEPATH . 'cache/site_config_version.txt';

		if (! is_file($arquivo)) {
			return '0';
		}

		$versao = trim((string) file_get_contents($arquivo));

		return $versao !== '' ? $versao : '0';
	}

	/**
	 * @return array<string, mixed>
	 */
	protected function obterSiteConfigDoCache(string $versao): array
	{
		$chave = 'site_config_' . $versao;

		if ($this->siteConfigCacheHabilitado()) {
			$cache = \Config\Services::cache();
			$guardado = $cache->get($chave);
			if (is_array($guardado)) {
				return $guardado;
			}
		}

		$siteConfig = $this->montarSiteConfig();

		if ($this->siteConfigCacheHabilitado()) {
			\Config\Services::cache()->save($chave, $siteConfig, 86400);
		}

		return $siteConfig;
	}

	/**
	 * @return array<string, mixed>
	 */
	protected function montarSiteConfig(): array
	{
		$configuracaoModel = new \App\Models\ConfiguracaoModel();

		$site_nome = json_decode($configuracaoModel->find('site_nome')['config_valor'], true);
		$site_nome = (isset($site_nome[site_url()]) && $site_nome[site_url()] != '') ? ($site_nome[site_url()]) : ($site_nome['default']);

		$site_descricao = (array) json_decode($configuracaoModel->find('site_descricao')['config_valor']);
		$site_descricao = (isset($site_descricao[site_url()]) && $site_descricao[site_url()] != '') ? ($site_descricao[site_url()]) : ($site_descricao['default']);

		$paginasEstaticasModel = new \App\Models\PaginasEstaticasModel();

		$paginas_estaticas = array();
		$paginas = $paginasEstaticasModel->select('titulo, url_friendly, localizacao')
			->where('ativo', 'A')
			->orderBy('localizacao', 'ASC')
			->get()
			->getResultArray();
		foreach ($paginas as $pagina) {
			if (!isset($paginas_estaticas[$pagina['localizacao']])) {
				$paginas_estaticas[$pagina['localizacao']] = array();
			}
			$paginas_estaticas[$pagina['localizacao']][] = [
				'titulo' => $pagina['titulo'],
				'link' => $pagina['url_friendly'],
			];
		}

		$marca = $this->resolverUrlsMarca();

		return [
			'texto_rodape' => $site_descricao,
			'texto_nome' => $site_nome,
			'paginas' => $paginas_estaticas,
			'pauta_tamanho_minimo' => $configuracaoModel->find('pauta_tamanho_minimo')['config_valor'],
			'pauta_tamanho_maximo' => $configuracaoModel->find('pauta_tamanho_maximo')['config_valor'],
			'marca_favicon' => $marca['favicon'],
			'marca_rodape' => $marca['rodape'],
		];
	}

	/**
	 * @return array{favicon: string, rodape: string}
	 */
	protected function resolverUrlsMarca(): array
	{
		$favicon = is_file(ROOTPATH . 'public/assets/favicon.ico')
			? site_url('public/assets/favicon.ico')
			: site_url('public/assets/logo.webp');
		$rodape = is_file(ROOTPATH . 'public/assets/rodape.png')
			? site_url('public/assets/rodape.png')
			: site_url('public/assets/logo.webp');

		return [
			'favicon' => $favicon,
			'rodape' => $rodape,
		];
	}

	protected function invalidarSiteConfig(): void
	{
		$chave = 'site_config_' . $this->obterVersaoSiteConfig();

		if ($this->siteConfigCacheHabilitado()) {
			$arquivo = WRITEPATH . 'cache/site_config_version.txt';
			$diretorio = dirname($arquivo);

			if (! is_dir($diretorio)) {
				mkdir($diretorio, 0775, true);
			}

			file_put_contents($arquivo, (string) time());
			\Config\Services::cache()->delete($chave);
		}

		$this->session->remove('site_config');
		$this->session->remove('site_config_version');
	}

	protected function atualizarContagemNotificacoesSeNecessario(): void
	{
		if (! $this->session->has('colaboradores')) {
			return;
		}

		$colaboradores = $this->session->get('colaboradores');
		if ($colaboradores['id'] === null) {
			return;
		}

		$cacheEm = (int) ($colaboradores['notificacoes_cache_em'] ?? 0);
		if ($cacheEm > 0 && (time() - $cacheEm) < self::NOTIFICACOES_CACHE_TTL) {
			return;
		}

		$colaboradoresNotificacoesModel = new \App\Models\ColaboradoresNotificacoesModel();
		$quantidadeNotificacoes = $colaboradoresNotificacoesModel
			->where('colaboradores_id', $colaboradores['id'])
			->where('data_visualizado', null)
			->countAllResults();

		$colaboradores['notificacoes'] = $quantidadeNotificacoes;
		$colaboradores['notificacoes_cache_em'] = time();
		$this->session->set(['colaboradores' => $colaboradores]);
	}

	protected function invalidarCacheNotificacoes(): void
	{
		if (! $this->session->has('colaboradores')) {
			return;
		}

		$colaboradores = $this->session->get('colaboradores');
		if ($colaboradores['id'] === null) {
			return;
		}

		unset($colaboradores['notificacoes_cache_em']);
		$this->session->set(['colaboradores' => $colaboradores]);
	}
}
