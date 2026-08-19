<?php

use CodeIgniter\I18n\Time;

?>

<?= $this->extend('layouts/_main'); ?>

<?= $this->section('content'); ?>

<style>
	.page-load-status {
		display: none;
	}
</style>

<div class="vl-container" style="padding-top: 40px; padding-bottom: 64px;">
	<nav style="font-size: 13px; color: var(--vl-muted-2); margin-bottom: 20px;" aria-label="Migalhas de navegação">
		<a href="<?= site_url(); ?>" style="color: var(--vl-muted-2); text-decoration: none;">Home</a>
		<span> / </span>
		<span style="color: var(--vl-text);">Artigos</span>
	</nav>

	<h1 style="font-family: var(--vl-font-title); font-size: 32px; font-weight: 700; margin: 0 0 8px;">Artigos</h1>
	<p style="color: var(--vl-muted); font-size: 15px; margin: 0 0 28px;">Textos publicados pelos escritores da comunidade.</p>

	<div class="row list-artigos">
		<?php foreach ($artigosList['artigos'] as $artigo): ?>
			<?= view_cell('\App\Libraries\Cards::cardsVerticaisSimples', $artigo, 300, 'card_artigo_' . ($artigo['id'] ?? '')); ?>
		<?php endforeach; ?>
	</div>

	<div class="d-none">
		<?php if ($artigosList['pager']): ?>
			<?= $artigosList['pager']->simpleLinks('artigos', 'default_template') ?>
		<?php endif; ?>
	</div>

	<div class="page-load-status">
		<div class="infinite-scroll-request d-flex justify-content-center mt-5 mb-5">
			<div class="spinner-border" role="status">
				<span class="visually-hidden">Carregando...</span>
			</div>
		</div>
		<p class="infinite-scroll-last">Fim do conteúdo</p>
		<p class="infinite-scroll-error">Todo o conteúdo foi carregado.</p>
	</div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script defer src="<?= asset_url('public/js/vendor/masonry.pkgd.min.js'); ?>"></script>
<script defer src="<?= asset_url('public/js/vendor/infinite-scroll.pkgd.min.js'); ?>"></script>
<script>
	document.addEventListener('DOMContentLoaded', function () {
	$(document).ready(function () {
		var $grid = $('.list-artigos').masonry({
			itemSelector: '.vl-card-vertical-col',
			columnWidth: '.vl-card-vertical-col',
			percentPosition: true,
			gutter: 0,
			horizontalOrder: true
		});

		var msnry = $grid.data('masonry');

		$grid.infiniteScroll({
			path: '.next_page',
			append: '.vl-card-vertical-col',
			history: false,
			outlayer: msnry,
			status: '.page-load-status'
		});
	});
	});
</script>
<?= $this->endSection(); ?>
