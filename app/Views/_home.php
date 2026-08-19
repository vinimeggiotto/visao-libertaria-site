<?= $this->extend('layouts/_main'); ?>

<?= $this->section('head_assets') ?>
	<?php if (!empty($videos_destaque[0]['video_id'])): ?>
		<link rel="preload" as="image" href="<?= esc(cria_url_thumb($videos_destaque[0]['video_id']), 'attr'); ?>" fetchpriority="high">
	<?php endif; ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<?php
$videoHero = (isset($videos_destaque) && ! empty($videos_destaque)) ? $videos_destaque[0] : null;
$hrefHeroWatch = ($videoHero !== null && ! empty($videoHero['video_id']))
	? cria_link_watch($videoHero['video_id'])
	: site_url('site/videos');
?>

<section class="vl-hero">
	<div>
		<div class="vl-hero-kicker">Vídeos e artigos sobre liberdade individual</div>
		<h1>Ideias que desafiam o poder.</h1>
		<p>Visão Libertária é um projeto de vídeos e notícias sobre livre mercado, anarcocapitalismo e crítica ao estado — feito por uma comunidade de escritores e narradores voluntários.</p>
		<div class="vl-hero-actions">
			<a href="<?= esc($hrefHeroWatch, 'attr'); ?>" class="btn btn-primary-color" style="font-weight: 700; font-size: 15px; padding: 14px 24px;">Assistir ao último vídeo</a>
			<a href="<?= site_url('site/noticias'); ?>" class="btn" style="background: transparent; color: var(--vl-text); border: 1px solid rgba(255,255,255,0.18); font-weight: 600; font-size: 15px; padding: 14px 24px; border-radius: var(--vl-radius);">Ler notícias</a>
		</div>
	</div>
	<div class="vl-hero-media">
		<?php if ($videoHero !== null && ! empty($videoHero['video_id'])): ?>
			<img src="<?= esc(cria_url_thumb($videoHero['video_id']), 'attr'); ?>"
				alt="<?= esc($videoHero['titulo'] ?? $videoHero['nome'] ?? '', 'attr'); ?>"
				width="1280" height="720"
				style="width: 100%; height: 100%; object-fit: cover;"
				fetchpriority="high">
			<a href="<?= esc(cria_link_watch($videoHero['video_id']), 'attr'); ?>"
				class="stretched-link"
				style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; text-decoration: none;"
				aria-label="Assistir ao vídeo em destaque">
				<span style="width: 64px; height: 64px; border-radius: 50%; background: rgba(24,22,18,0.6); display: flex; align-items: center; justify-content: center;">
					<i class="bi bi-play-fill" aria-hidden="true" style="font-size: 28px; color: var(--vl-text); margin-left: 3px;"></i>
				</span>
			</a>
		<?php else: ?>
			<span class="vl-hero-kicker" style="position: absolute; top: 14px; left: 14px; margin: 0;">vídeo em destaque</span>
			<i class="bi bi-play-fill" aria-hidden="true" style="font-size: 32px; color: var(--vl-muted-2);"></i>
		<?php endif; ?>
	</div>
</section>

<section class="vl-container" style="padding-top: 32px; padding-bottom: 32px;">
	<?php if (! empty($videos_por_projeto)): ?>
		<div class="d-flex flex-wrap" style="gap: 8px; margin-bottom: 32px;">
			<?php foreach ($videos_por_projeto as $nomeProjeto => $_videosProjeto): ?>
				<a href="<?= site_url('site/videos/' . projeto_nome_para_url((string) $nomeProjeto)); ?>" class="vl-chip text-decoration-none"><?= esc((string) $nomeProjeto); ?></a>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<div class="d-flex align-items-baseline justify-content-between" style="margin-bottom: 20px; gap: 12px;">
		<h2 style="font-family: var(--vl-font-title); font-size: 24px; font-weight: 700; margin: 0;">Últimos vídeos</h2>
		<a href="<?= site_url('site/videos'); ?>" style="color: var(--vl-brand); font-size: 14px; font-weight: 600; text-decoration: none;">Ver todos →</a>
	</div>

	<?php if (! empty($videos_destaque)): ?>
		<div class="row g-4">
			<?php foreach ($videos_destaque as $videoHome): ?>
				<?php
				$ytHome = extrair_id_video_youtube($videoHome['video_id'] ?? null);
				$hrefHome = $ytHome !== null ? cria_link_watch($ytHome) : site_url('site/videos');
				?>
				<div class="col-12 col-sm-6 col-lg-3">
					<a href="<?= esc($hrefHome, 'attr'); ?>" class="text-decoration-none d-block">
						<div class="vl-card-media-16x9 position-relative mb-2">
							<?php if ($ytHome !== null): ?>
								<img src="<?= esc(cria_url_thumb($ytHome), 'attr'); ?>"
									alt="<?= esc($videoHome['titulo'] ?? '', 'attr'); ?>"
									width="480" height="270" loading="lazy"
									style="width: 100%; height: 100%; object-fit: cover;">
							<?php else: ?>
								<img src="<?= esc(cria_url_placeholder(), 'attr'); ?>"
									alt="" width="480" height="270" loading="lazy"
									style="width: 100%; height: 100%; object-fit: cover;"
									onerror="<?= esc(attr_onerror_placeholder(), 'attr'); ?>">
							<?php endif; ?>
							<span style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center;">
								<span style="width: 40px; height: 40px; border-radius: 50%; background: rgba(24,22,18,0.55); display: flex; align-items: center; justify-content: center;">
									<i class="bi bi-play-fill" aria-hidden="true" style="color: var(--vl-text); margin-left: 2px;"></i>
								</span>
							</span>
						</div>
						<?php if (! empty($videoHome['nome'])): ?>
							<div style="font-size: 12px; color: var(--vl-brand); font-weight: 600; margin-bottom: 4px;"><?= esc($videoHome['nome']); ?></div>
						<?php endif; ?>
						<div style="font-size: 15px; font-weight: 600; line-height: 1.35; color: var(--vl-text);"><?= esc($videoHome['titulo'] ?? ''); ?></div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</section>

<section class="vl-container" style="padding-top: 16px; padding-bottom: 56px;">
	<div class="vl-card" style="border-radius: 12px; border-left: 3px solid var(--vl-brand); padding: 36px; display: flex; align-items: center; justify-content: space-between; gap: 24px; flex-wrap: wrap;">
		<div>
			<h3 style="font-family: var(--vl-font-title); font-size: 22px; font-weight: 700; margin: 0 0 8px;">Escreva e ganhe satoshis</h3>
			<p style="color: var(--vl-muted); font-size: 15px; margin: 0; max-width: 520px;">Transforme uma pauta em artigo e ele pode virar vídeo no canal. Cada publicação paga em sats.</p>
		</div>
		<a href="<?= site_url('site/cadastre-se'); ?>" class="btn btn-primary-color" style="font-weight: 700; font-size: 14px; padding: 13px 22px; white-space: nowrap;">Cadastre-se agora</a>
	</div>
</section>

<?= $this->endSection(); ?>
