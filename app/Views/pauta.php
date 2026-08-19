<?php
use CodeIgniter\I18n\Time;
?>

<?= $this->extend('layouts/_main', ['meta' => $meta]); ?>

<?= $this->section('content'); ?>

<?php
$imagemBrutaPauta = trim((string) ($pauta['imagem'] ?? ''));
$ehVaziaPauta = imagem_publica_eh_vazia($imagemBrutaPauta);
$imagemSrcPauta = $ehVaziaPauta ? cria_url_placeholder() : $imagemBrutaPauta;
$apelidoPauta = (string) ($pauta['colaborador']['apelido'] ?? '');
?>

<div class="vl-container" style="max-width: 860px; padding-top: 40px; padding-bottom: 64px;">
	<nav style="font-size: 13px; color: var(--vl-muted-2); margin-bottom: 20px;" aria-label="Migalhas de navegação">
		<a href="<?= site_url('site'); ?>" style="color: var(--vl-muted-2); text-decoration: none;">Home</a>
		<span> / </span>
		<a href="<?= site_url('site/noticias'); ?>" style="color: var(--vl-muted-2); text-decoration: none;">Notícias</a>
		<span> / </span>
		<span style="color: var(--vl-text);"><?= esc($pauta['titulo']); ?></span>
	</nav>

	<div class="vl-card-media-16x9 mb-4" style="border-radius: 12px;">
		<img src="<?= esc($imagemSrcPauta, 'attr'); ?>" alt="<?= esc($pauta['titulo'], 'attr'); ?>"
			style="width: 100%; height: 100%; object-fit: cover;"
			width="860" height="484"<?php if ($ehVaziaPauta): ?> onerror="<?= esc(attr_onerror_placeholder(), 'attr'); ?>"<?php endif; ?>>
	</div>

	<div class="d-flex flex-wrap align-items-center" style="gap: 10px; font-size: 13px; color: var(--vl-muted-2); margin-bottom: 12px;">
		<span><?= app_time($pauta['criado'])->toLocalizedString('dd MMMM yyyy'); ?></span>
		<span>·</span>
		<span>sugerido por <a href="<?= site_url('site/colaborador/' . rawurlencode($apelidoPauta)); ?>" style="color: var(--vl-brand); font-weight: 600; text-decoration: none;"><?= esc($apelidoPauta); ?></a></span>
	</div>

	<h1 style="font-family: var(--vl-font-title); font-size: 30px; font-weight: 700; margin: 0 0 20px; line-height: 1.25;"><?= esc($pauta['titulo']); ?></h1>
	<p style="font-size: 16px; line-height: 1.7; color: #d8d4cc; margin: 0 0 24px;"><?= str_replace("\n", '<br/>', esc($pauta['texto'])); ?></p>
	<?php if (! empty($pauta['link'])): ?>
		<a href="<?= esc($pauta['link'], 'attr'); ?>" target="_blank" rel="noopener noreferrer"
			style="font-size: 14px; font-weight: 600; border: 1px solid rgba(255,255,255,0.18); padding: 10px 18px; border-radius: var(--vl-radius); display: inline-block; color: var(--vl-text); text-decoration: none;">Ler notícia original ↗</a>
	<?php endif; ?>
</div>

<?= $this->endSection(); ?>
