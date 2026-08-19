<?php

use CodeIgniter\I18n\Time;

?>

<?= $this->extend('layouts/_main'); ?>

<?= $this->section('content'); ?>

<div class="vl-container vl-site-videos" style="padding-top: 40px; padding-bottom: 64px;">
	<h1 style="font-family: var(--vl-font-title); font-size: 32px; font-weight: 700; margin: 0 0 8px;">Vídeos</h1>
	<p style="color: var(--vl-muted); font-size: 15px; margin: 0 0 24px;">Todos os vídeos publicados, organizados por projeto.</p>

	<div class="d-flex flex-wrap" style="gap: 8px; margin-bottom: 28px;">
		<a href="<?= site_url('site/videos'); ?>"
			class="vl-chip text-decoration-none <?= !isset($projeto_atual) ? 'is-active' : ''; ?>">
			Todos os projetos
		</a>
		<?php if (isset($projetos) && is_array($projetos)): ?>
			<?php foreach ($projetos as $proj): ?>
				<a href="<?= site_url('site/videos/' . projeto_nome_para_url($proj['nome'])); ?>"
					class="vl-chip text-decoration-none <?= (isset($projeto_atual) && $projeto_atual === $proj['nome']) ? 'is-active' : ''; ?>">
					<?= esc($proj['nome']); ?>
				</a>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>

	<div class="list-videos row">
		<?php if (isset($videosList['videos']) && is_array($videosList['videos'])): ?>
			<?php foreach ($videosList['videos'] as $video): ?>
				<div class="col-lg-3 col-md-4 col-sm-6 mb-4 video-item">
					<div class="card video-card h-100">
						<div class="video-thumbnail">
							<img src="<?= cria_url_thumb($video['video_id']); ?>" alt="<?= esc($video['titulo']); ?>"
								class="card-img-top" loading="lazy" width="480" height="270">
							<div class="play-overlay">
								<i class="bi bi-play-circle-fill play-icon" aria-hidden="true"></i>
								<a href="<?= cria_link_watch($video['video_id']); ?>"
									style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
									aria-label="Assistir <?= esc($video['titulo'], 'attr'); ?>"></a>
							</div>
							<?php if (!empty($video['short'])): ?>
								<span class="short-badge">Short</span>
							<?php endif; ?>
							<?php if (!isset($projeto_atual)): ?>
								<div class="project-badge">
									<?= esc($video['projeto_nome'] ?? 'Projeto'); ?>
								</div>
							<?php endif; ?>
						</div>
						<div class="card-body d-flex flex-column">
							<h2 class="card-title h6"><?= esc($video['titulo']); ?></h2>
							<p class="card-text text-muted small">
								<?= Time::parse($video['publicado'])->toLocalizedString('dd/MM/yyyy'); ?>
							</p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="col-12 text-center">
				<p style="color: var(--vl-muted-2);">Nenhum vídeo encontrado.</p>
			</div>
		<?php endif; ?>
	</div>

	<?php if (isset($videosList['pager'])): ?>
		<div class="d-none">
			<?= $videosList['pager']->links('videos', 'default_template') ?>
		</div>
	<?php endif; ?>

	<div class="page-load-status">
		<div class="infinite-scroll-request">
			<div class="spinner-border" role="status">
				<span class="visually-hidden">Carregando...</span>
			</div>
		</div>
		<p class="infinite-scroll-last">Fim do conteúdo</p>
		<p class="infinite-scroll-error">Erro ao carregar</p>
	</div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script defer src="<?= asset_url('public/js/vendor/masonry.pkgd.min.js'); ?>"></script>
<script defer src="<?= asset_url('public/js/vendor/infinite-scroll.pkgd.min.js'); ?>"></script>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		$(function () {
		var $grid = $('.list-videos').masonry({
			itemSelector: '.video-item'
		});

		$grid.infiniteScroll({
			path: '?page={{#}}',
			append: '.video-item',
			history: false,
			outlayer: $grid.data('masonry'),
			status: '.page-load-status',
			scrollThreshold: 100,
			fetchOptions: {
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				}
			}
		});

		});
	});
</script>
<?= $this->endSection(); ?>
