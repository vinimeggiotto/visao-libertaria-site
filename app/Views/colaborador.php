<?= $this->extend('layouts/_main'); ?>

<?= $this->section('content'); ?>
<?php
$avatarBruto = isset($colaborador['avatar']) ? trim((string) $colaborador['avatar']) : '';
$urlListaColaborador = site_url('site/colaboradorList/' . rawurlencode($colaborador['apelido']));
?>

<div class="vl-container" style="max-width: 1000px; padding-top: 40px; padding-bottom: 64px;">
	<div class="vl-card mb-4" style="border-radius: 16px; padding: 36px; background: rgba(243,201,33,0.1); border: none;">
		<div class="d-flex flex-wrap align-items-center" style="gap: 24px;">
			<div>
				<?= avatar_html(
					$avatarBruto !== '' ? $avatarBruto : null,
					'Avatar de ' . $colaborador['apelido'],
					'rounded-circle',
					'width:96px;height:96px;object-fit:cover;'
				); ?>
			</div>
			<div>
				<div style="font-size: 12px; color: var(--vl-brand); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 6px;">Colaborador · <?= (int) $contador_pautas; ?> pauta<?= ($contador_pautas != 1) ? 's' : ''; ?></div>
				<h1 style="font-family: var(--vl-font-title); font-size: 26px; font-weight: 700; margin: 0 0 8px;"><?= esc($colaborador['apelido']); ?></h1>
				<p style="color: var(--vl-muted); font-size: 14px; line-height: 1.5; margin: 0;">Cadastrou-se no site há <?= esc($tempo); ?>.</p>
			</div>
			<?php if (! empty($conquistaDestaque)):
				$nomeConquistaCol = trim((string) ($conquistaDestaque['nome'] ?? ''));
				$tooltipConquistaCol = $nomeConquistaCol !== ''
					? ('Conquista de colaborador no site: ' . $nomeConquistaCol . '.')
					: 'Conquista de colaborador no site.';
				?>
				<div class="ms-md-auto text-md-end">
					<p style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--vl-muted-2); margin-bottom: 8px;">Conquista de colaborador</p>
					<img class="rounded-circle vl-conquista-destaque-img"
						src="<?= esc(site_url($conquistaDestaque['imagem']), 'attr'); ?>"
						alt="<?= esc($nomeConquistaCol !== '' ? $nomeConquistaCol : 'Conquista de colaborador', 'attr'); ?>"
						data-bs-toggle="tooltip"
						data-bs-placement="left"
						data-bs-title="<?= esc($tooltipConquistaCol, 'attr'); ?>"
						style="width: 64px; height: 64px; object-fit: cover;">
				</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="d-flex flex-wrap" style="gap: 8px; margin-bottom: 20px;">
		<?php foreach ($atribuicoes as $atribuicao):
			$corAtrib = esc($atribuicao['cor'], 'attr');
			$corBgSubtle = ($atribuicao['cor'] === 'white') ? 'light' : $corAtrib;
			?>
			<span class="badge rounded-pill fw-semibold text-dark bg-<?= $corBgSubtle; ?>-subtle border border-<?= $corAtrib; ?> border-opacity-50"><?= esc($atribuicao['nome']); ?></span>
		<?php endforeach; ?>
	</div>

	<div class="row g-3 mb-4">
		<div class="col-6 col-md-3">
			<div class="vl-card text-center" style="border-radius: 10px; padding: 14px;">
				<div style="font-size: 22px; font-weight: 700; font-family: var(--vl-font-title);"><?= esc(sprintf('%02d', (int) $resumo_pautas_periodo['cadastradas_semana'])); ?></div>
				<div style="font-size: 12px; color: var(--vl-muted-2);">cadastradas nesta semana</div>
			</div>
		</div>
		<div class="col-6 col-md-3">
			<div class="vl-card text-center" style="border-radius: 10px; padding: 14px;">
				<div style="font-size: 22px; font-weight: 700; font-family: var(--vl-font-title);"><?= esc(sprintf('%02d', (int) $resumo_pautas_periodo['usadas_semana'])); ?></div>
				<div style="font-size: 12px; color: var(--vl-muted-2);">usadas nesta semana</div>
			</div>
		</div>
		<div class="col-6 col-md-3">
			<div class="vl-card text-center" style="border-radius: 10px; padding: 14px;">
				<div style="font-size: 22px; font-weight: 700; font-family: var(--vl-font-title);"><?= esc(sprintf('%02d', (int) $resumo_pautas_periodo['usadas_mes'])); ?></div>
				<div style="font-size: 12px; color: var(--vl-muted-2);">usadas no mês</div>
			</div>
		</div>
		<div class="col-6 col-md-3">
			<div class="vl-card text-center" style="border-radius: 10px; padding: 14px;">
				<div style="font-size: 22px; font-weight: 700; font-family: var(--vl-font-title);"><?= esc(sprintf('%02d', (int) $resumo_pautas_periodo['usadas_ano'])); ?></div>
				<div style="font-size: 12px; color: var(--vl-muted-2);">usadas no ano</div>
			</div>
		</div>
	</div>

	<p style="font-size: 13px; color: var(--vl-muted); margin-bottom: 20px;">
		<i class="bi bi-clock-history me-1" aria-hidden="true"></i>
		<?php if ($ultima_pauta_cadastrada_formatada !== null): ?>
			Última pauta cadastrada: <span style="color: var(--vl-text); font-weight: 600;"><?= esc($ultima_pauta_cadastrada_formatada); ?></span>
		<?php else: ?>
			Ainda não há pautas cadastradas por este colaborador.
		<?php endif; ?>
	</p>

	<div class="d-flex flex-wrap gap-2 mb-4">
		<a href="<?= esc(site_url('site/noticias'), 'attr'); ?>" class="btn btn-sm" style="border: 1px solid rgba(255,255,255,0.18); color: var(--vl-text);">Notícias</a>
		<a href="<?= esc(site_url('site/escritor/' . rawurlencode($colaborador['apelido'])), 'attr'); ?>" class="btn btn-sm" style="border: 1px solid rgba(255,255,255,0.18); color: var(--vl-text);">Perfil de escritor</a>
	</div>

	<section>
		<h2 style="font-family: var(--vl-font-title); font-size: 20px; font-weight: 700; margin: 0 0 16px;" id="vlColaboradorPautasTitulo">Pautas reservadas de <?= esc($colaborador['apelido']); ?></h2>
		<div class="row <?= esc($classeListaCSS, 'attr'); ?>"></div>
	</section>
</div>

<div class="modal vl-noticias-loading-overlay" style="z-index:7000;" id="modal-loading" tabindex="-1" aria-hidden="true">
	<div class="position-absolute w-100 h-100 d-flex flex-column align-items-center justify-content-center">
		<div class="spinner-border" role="status">
			<span class="visually-hidden">Carregando…</span>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
			new bootstrap.Tooltip(el);
		});

	(function () {
		var urlLista = <?= json_encode($urlListaColaborador, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;

		$(document).ready(function () {
			$.ajax({
				url: urlLista,
				type: 'get',
				dataType: 'html',
				beforeSend: function () { $('#modal-loading').show(); },
				complete: function () { $('#modal-loading').hide(); },
				success: function (data) {
					$('.<?= esc($classeListaCSS, 'js'); ?>').html(data);
				}
			});
		});
	})();
	});
</script>
<?= $this->endSection(); ?>
