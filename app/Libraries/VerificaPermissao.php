<?php

namespace App\Libraries;

class VerificaPermissao
{
	public const NOMES = [
		'1' => 'Colaborador',
		'2' => 'Escritor',
		'3' => 'Revisor',
		'4' => 'Narrador',
		'5' => 'Produtor',
		'6' => 'Publicador',
		'7' => 'Administrador',
		'8' => 'Pagador',
		'9' => 'Recrutador',
		'10' => 'Pautador',
		'11' => 'Redator',
	];

	/**
	 * @param string|int|list<string|int>|null $codigoPermissao
	 */
	public static function nomePermissaoExigida($codigoPermissao): string
	{
		if ($codigoPermissao === null) {
			return 'necessária';
		}

		$codigos = is_array($codigoPermissao) ? $codigoPermissao : [$codigoPermissao];
		$nomes = [];
		foreach ($codigos as $codigo) {
			$chave = (string) $codigo;
			$nomes[] = self::NOMES[$chave] ?? $chave;
		}

		$nomes = array_values(array_unique($nomes));
		if ($nomes === []) {
			return 'necessária';
		}
		if (count($nomes) === 1) {
			return $nomes[0];
		}

		$ultimo = array_pop($nomes);

		return implode(', ', $nomes) . ' ou ' . $ultimo;
	}

	/**
	 * @param string|int|list<string|int>|null $codigoPermissao
	 */
	public function recusarAcesso($codigoPermissao = null, $url = null): void
	{
		$url = ($url === null)
			? site_url('colaboradores/perfil')
			: ($url);

		$session = \Config\Services::session();
		$session->start();
		if ($codigoPermissao !== null) {
			$session->setFlashdata('aviso_permissao', self::nomePermissaoExigida($codigoPermissao));
		}
		$session->close();

		header('Location: ' . $url);
		exit;
	}

	/**
	 * @param string|int|list<string|int>|null $codigoPermissao
	 * @return bool|void
	 */
	public function PermiteAcesso($codigoPermissao = null, $url = null, $isValidar = false)
	{
		$url = ($url === null)
			? site_url('colaboradores/perfil')
			: ($url);
		if ($codigoPermissao == null) {
			header("location: " . $url);
		}
		$session = \Config\Services::session();
		$session->start();
		if ($session->has('colaboradores')) {
			$permissoes = $session->get('colaboradores');
			$permissoes = $permissoes['permissoes'];
			if (is_array($codigoPermissao))
			{
				foreach($codigoPermissao as $codPer){
					if (in_array((string) $codPer, $permissoes)) {
						return true;
					}
				}
			}else {
				if (in_array((string) $codigoPermissao, $permissoes)) {
					return true;
				}
			}
			if($isValidar) {
				return false;
			}
			$this->recusarAcesso($codigoPermissao, $url);
		}
		$this->recusarAcesso($codigoPermissao, $url);
	}

}
