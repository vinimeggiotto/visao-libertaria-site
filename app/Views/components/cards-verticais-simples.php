<?php

declare(strict_types=1);

use CodeIgniter\I18n\Time;

/*
Variáveis:
dados = {
id, imagem, url, titulo, autor, revisor, narrador, produtor (artigo),
publicacao, texticulo, link_video_youtube, tipo_conteudo
}
*/

helper('_formata_video');

$tipo = $dados['tipo_conteudo'] ?? 'artigo';
$href = $tipo === 'artigo'
	? site_url('site/artigo/' . rawurlencode((string) ($dados['id'] ?? '')))
	: site_url('site/pauta/' . rawurlencode((string) ($dados['id'] ?? '')));

$imagemBruta = trim((string) ($dados['imagem'] ?? ''));
$imagemSrc = null;

if ($tipo === 'artigo') {
	$ytIdLista = extrair_id_video_youtube($dados['link_video_youtube'] ?? null);
	if ($ytIdLista !== null) {
		$imagemSrc = cria_url_thumb($ytIdLista);
	}
}

if ($imagemSrc === null && ! imagem_publica_eh_vazia($imagemBruta)) {
	$imagemSrc = $imagemBruta;
}

$usouPlaceholder = false;
if ($imagemSrc === null) {
	$imagemSrc = cria_url_placeholder();
	$usouPlaceholder = true;
}

$dataPublicacao = '';
try {
	if (! empty($dados['publicacao'])) {
		$dataPublicacao = app_time($dados['publicacao'])->toLocalizedString('dd MMM yyyy');
	}
} catch (\Throwable) {
	$dataPublicacao = '';
}

$titulo = $dados['titulo'] ?? '';
$autor = $dados['autor'] ?? '';
$resumo = $dados['texticulo'] ?? '';
$hrefAutor = site_url('site/escritor/' . urlencode($autor));

$papeisArtigo = [];
if ($tipo === 'artigo') {
	foreach (
		[
			'Escritor' => $autor,
			'Revisor' => $dados['revisor'] ?? '',
			'Narrador' => $dados['narrador'] ?? '',
			'Produtor' => $dados['produtor'] ?? '',
		] as $rotuloPapel => $nomePapel
	) {
		$n = trim((string) $nomePapel);
		if ($n !== '') {
			$papeisArtigo[] = [
				'rotulo' => $rotuloPapel,
				'nome' => $n,
				'href' => site_url('site/escritor/' . urlencode($n)),
			];
		}
	}
}
?>

<div class="vl-card-vertical-col col-sm-6 col-lg-3">
	<div class="vl-card vl-card-vertical h-100 overflow-hidden w-100" style="border-radius: 12px;">
		<div class="vl-card-media-16x9">
			<a href="<?= esc($href, 'attr'); ?>"
				class="vl-card-vertical-thumb-link text-decoration-none d-block h-100">
				<img class="vl-card-vertical-thumb-img" src="<?= esc($imagemSrc, 'attr'); ?>"
					alt="<?= esc($titulo, 'attr'); ?>"
					style="width: 100%; height: 100%; object-fit: cover;"
					loading="lazy" width="480" height="270"<?php if ($usouPlaceholder): ?> onerror="<?= esc(attr_onerror_placeholder(), 'attr'); ?>"<?php endif; ?>>
			</a>
		</div>
		<div class="d-flex flex-column p-3">
			<?php if ($dataPublicacao !== ''): ?>
				<div style="font-size: 12px; color: var(--vl-muted-2); margin-bottom: 6px;"><?= esc($dataPublicacao); ?></div>
			<?php endif; ?>
			<h2 class="h6 mb-2" style="line-height: 1.35;">
				<a href="<?= esc($href, 'attr'); ?>" class="text-decoration-none fw-bold" style="color: var(--vl-text);"><?= esc($titulo); ?></a>
			</h2>
			<?php if ($resumo !== ''): ?>
			<p class="mb-3 flex-grow-1"
				style="font-size: 13px; color: var(--vl-muted); display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3; line-clamp: 3; overflow: hidden;">
				<?= esc($resumo); ?></p>
			<?php endif; ?>
			<div class="mt-auto pt-2" style="border-top: 1px solid var(--vl-border); font-size: 13px; color: var(--vl-muted);">
				<?php if ($tipo === 'artigo' && $papeisArtigo !== []): ?>
					<?php foreach (array_chunk($papeisArtigo, 2) as $parPapeis): ?>
						<div class="row g-2 mb-1">
							<?php foreach ($parPapeis as $papel): ?>
								<div class="col-6">
									<div class="min-w-0">
										<div class="text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.03em; color: var(--vl-muted-2);"><?= esc($papel['rotulo']); ?></div>
										<a href="<?= esc($papel['href'], 'attr'); ?>" class="text-truncate d-block small fw-semibold" style="color: var(--vl-muted); text-decoration: none;"><?= esc($papel['nome']); ?></a>
									</div>
								</div>
							<?php endforeach; ?>
							<?php if (count($parPapeis) === 1): ?>
								<div class="col-6"></div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="d-flex flex-wrap align-items-center column-gap-2 row-gap-1">
						<span class="text-nowrap">
							<i class="bi bi-person me-1" aria-hidden="true"></i>
							<a href="<?= esc($hrefAutor, 'attr'); ?>" style="color: var(--vl-muted);"><?= esc($autor); ?></a>
						</span>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
