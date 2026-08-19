<?= $this->extend('layouts/_main', ['meta' => $meta]); ?>

<?= $this->section('content'); ?>

<?php
$ytArtigo = extrair_id_video_youtube($artigo['link_video_youtube'] ?? null);
$dataPublicacao = '';
if (! empty($artigo['publicado'])) {
	try {
		$dataPublicacao = app_time($artigo['publicado'])->toLocalizedString('dd MMM yyyy');
	} catch (\Throwable) {
		$dataPublicacao = '';
	}
}
$autor = (string) ($artigo['autor'] ?? '');
$hrefAutor = site_url('site/escritor/' . rawurlencode($autor));
?>

<div class="vl-container" style="max-width: 760px; padding-top: 40px; padding-bottom: 64px;">
	<nav style="font-size: 13px; color: var(--vl-muted-2); margin-bottom: 20px;" aria-label="Migalhas de navegação">
		<a href="<?= site_url('site'); ?>" style="color: var(--vl-muted-2); text-decoration: none;">Home</a>
		<span> / </span>
		<a href="<?= site_url('site/artigos'); ?>" style="color: var(--vl-muted-2); text-decoration: none;">Artigos</a>
	</nav>

	<h1 style="font-family: var(--vl-font-title); font-size: 32px; font-weight: 700; margin: 0 0 16px; line-height: 1.25;"><?= esc($artigo['titulo'] ?? ''); ?></h1>

	<div class="d-flex align-items-center" style="gap: 10px; margin-bottom: 24px;">
		<?= avatar_html(
			! empty($artigo['autor_avatar']) ? $artigo['autor_avatar'] : null,
			'Avatar de ' . $autor,
			'rounded-circle',
			'width:36px;height:36px;object-fit:cover;'
		); ?>
		<div>
			<a href="<?= esc($hrefAutor, 'attr'); ?>" style="font-size: 14px; font-weight: 600; color: var(--vl-text); text-decoration: none;"><?= esc($autor); ?></a>
			<div style="font-size: 12px; color: var(--vl-muted-2);">
				<?php if ($dataPublicacao !== ''): ?>
					<?= esc($dataPublicacao); ?> ·
				<?php endif; ?>
				escritor
			</div>
		</div>
	</div>

	<?php if ($ytArtigo !== null): ?>
		<div class="vl-card-media-16x9 position-relative mb-4" style="border-radius: 12px;">
			<iframe
				src="https://www.youtube.com/embed/<?= esc($ytArtigo, 'attr'); ?>"
				title="<?= esc($artigo['titulo'] ?? 'Vídeo do artigo', 'attr'); ?>"
				allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
				allowfullscreen
				loading="lazy"
				style="position: absolute; inset: 0; width: 100%; height: 100%; border: 0;"></iframe>
		</div>
	<?php endif; ?>

	<?php if (! empty($artigo['gancho'])): ?>
		<p style="font-size: 17px; line-height: 1.75; color: #d8d4cc; margin: 0 0 18px;"><?= esc($artigo['gancho']); ?></p>
	<?php endif; ?>

	<div style="font-size: 17px; line-height: 1.75; color: #d8d4cc;">
		<?= $artigo['texto'] ?? ''; ?>
	</div>

	<?php if (! empty($artigo['referencias'])): ?>
		<div style="margin-top: 28px; padding-top: 20px; border-top: 1px solid var(--vl-border);">
			<h2 style="font-family: var(--vl-font-title); font-size: 18px; font-weight: 700; margin: 0 0 12px;">Referências</h2>
			<div style="font-size: 15px; line-height: 1.7; color: var(--vl-muted);">
				<?= $artigo['referencias']; ?>
			</div>
		</div>
	<?php endif; ?>
</div>

<?= $this->endSection(); ?>
