<?= $this->extend('layouts/_main'); ?>

<?= $this->section('content'); ?>
<?php
$avatarBruto = isset($colaborador['avatar']) ? trim((string) $colaborador['avatar']) : '';
?>

<div class="vl-container" style="max-width: 1000px; padding-top: 40px; padding-bottom: 64px;">
	<div class="vl-card mb-4" style="border-radius: 16px; padding: 36px; background: rgba(243,201,33,0.1); border: none;">
		<div class="d-flex flex-wrap align-items-center" style="gap: 24px;">
			<div class="position-relative">
				<?= avatar_html(
					$avatarBruto !== '' ? $avatarBruto : null,
					'Avatar de ' . $colaborador['apelido'],
					'rounded-circle',
					'width:96px;height:96px;object-fit:cover;'
				); ?>
			</div>
			<div>
				<div style="font-size: 12px; color: var(--vl-brand); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 6px;">Escritor · <?= (int) $contador_artigos; ?> artigo<?= ($contador_artigos != 1) ? 's' : ''; ?></div>
				<h1 style="font-family: var(--vl-font-title); font-size: 26px; font-weight: 700; margin: 0 0 8px;"><?= esc($colaborador['apelido']); ?></h1>
				<p style="color: var(--vl-muted); font-size: 14px; line-height: 1.5; margin: 0;">Cadastrou-se no site há <?= esc($tempo); ?>.</p>
			</div>
			<?php if (! empty($conquistaDestaque)): ?>
				<div class="ms-md-auto text-md-end">
					<p style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--vl-muted-2); margin-bottom: 8px;">Maior conquista</p>
					<img class="rounded-circle vl-conquista-destaque-img"
						src="<?= esc(site_url($conquistaDestaque['imagem']), 'attr'); ?>"
						alt="<?= esc($conquistaDestaque['nome'] ?? 'Conquista', 'attr'); ?>"
						data-bs-toggle="tooltip"
						data-bs-placement="left"
						data-bs-title="<?= esc('Recebida após publicar ' . (int) $conquistaDestaque['pontuacao'] . ' artigo' . ((int) $conquistaDestaque['pontuacao'] > 1 ? 's' : '') . ' como escritor.', 'attr'); ?>"
						style="width: 64px; height: 64px; object-fit: cover;">
				</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="d-flex flex-wrap" style="gap: 8px; margin-bottom: 12px;">
		<?php foreach ($atribuicoes as $atribuicao):
			$corAtrib = esc($atribuicao['cor'], 'attr');
			$corBgSubtle = ($atribuicao['cor'] === 'white') ? 'light' : $corAtrib;
			?>
			<span class="badge rounded-pill fw-semibold text-dark bg-<?= $corBgSubtle; ?>-subtle border border-<?= $corAtrib; ?> border-opacity-50"><?= esc($atribuicao['nome']); ?></span>
		<?php endforeach; ?>
	</div>
	<p style="color: var(--vl-muted-2); font-size: 13px; margin: 0 0 24px;">
		<?= esc(sprintf('%02d', (int) $contagem_papeis['escrito'])); ?> como escritor ·
		<?= esc(sprintf('%02d', (int) $contagem_papeis['revisado'])); ?> como revisor ·
		<?= esc(sprintf('%02d', (int) $contagem_papeis['narrado'])); ?> como narrador ·
		<?= esc(sprintf('%02d', (int) $contagem_papeis['produzido'])); ?> como produtor
	</p>

	<div class="vl-card mb-4" style="border-radius: 12px; padding: 20px;">
		<div class="row g-3 align-items-start">
			<div class="col-lg-7">
				<p class="mb-0" style="font-size: 13px; color: var(--vl-muted);">
					<i class="bi bi-clock-history me-1" aria-hidden="true"></i>
					<?php if ($ultima_publicacao_participacao_formatada !== null): ?>
						Última publicação em que participou: <span style="color: var(--vl-text); font-weight: 600;"><?= esc($ultima_publicacao_participacao_formatada); ?></span>
					<?php else: ?>
						Ainda não há artigos publicados com a participação deste colaborador.
					<?php endif; ?>
				</p>
			</div>
			<div class="col-lg-5">
				<div class="d-flex flex-wrap gap-2">
					<a href="<?= esc(site_url('site/artigos'), 'attr'); ?>" class="btn btn-sm" style="border: 1px solid rgba(255,255,255,0.18); color: var(--vl-text);">Todos os artigos</a>
					<a href="<?= esc(site_url('site/colaborador/' . rawurlencode($colaborador['apelido'])), 'attr'); ?>" class="btn btn-sm" style="border: 1px solid rgba(255,255,255,0.18); color: var(--vl-text);">Perfil de colaborador</a>
				</div>
			</div>
		</div>
	</div>

	<?php
	$apelEsc = esc($colaborador['apelido']);
	$legendasJs = [
		'todos' => 'Artigos publicados em que <span style="color: var(--vl-text); font-weight: 600;">' . $apelEsc . '</span> participou como <span style="color: var(--vl-text); font-weight: 600;">escritor, revisor, narrador ou produtor</span>.',
		'escrito' => 'Artigos publicados em que <span style="color: var(--vl-text); font-weight: 600;">' . $apelEsc . '</span> foi o <span style="color: var(--vl-text); font-weight: 600;">escritor</span>.',
		'revisado' => 'Artigos publicados em que <span style="color: var(--vl-text); font-weight: 600;">' . $apelEsc . '</span> foi o <span style="color: var(--vl-text); font-weight: 600;">revisor</span>.',
		'narrado' => 'Artigos publicados em que <span style="color: var(--vl-text); font-weight: 600;">' . $apelEsc . '</span> foi o <span style="color: var(--vl-text); font-weight: 600;">narrador</span>.',
		'produzido' => 'Artigos publicados em que <span style="color: var(--vl-text); font-weight: 600;">' . $apelEsc . '</span> foi o <span style="color: var(--vl-text); font-weight: 600;">produtor</span>.',
	];
	$urlListaEscritor = site_url('site/escritorList/' . rawurlencode($colaborador['apelido']));
	?>
	<section>
		<div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; margin-bottom: 16px;">
			<h2 style="font-family: var(--vl-font-title); font-size: 20px; font-weight: 700; margin: 0;" id="vlEscritorListaTitulo">Participação em artigos</h2>
			<div class="d-flex flex-row flex-nowrap align-items-center gap-2">
				<label for="vlEscritorPapelFiltro" class="mb-0 text-nowrap" style="font-size: 13px; color: var(--vl-muted);">Participou como</label>
				<select id="vlEscritorPapelFiltro" class="form-select form-select-sm" style="min-width: 10rem;" autocomplete="off">
					<option value="todos">Todos os papéis</option>
					<option value="escrito" selected>Escritor</option>
					<option value="revisado">Revisor</option>
					<option value="narrado">Narrador</option>
					<option value="produzido">Produtor</option>
				</select>
			</div>
		</div>
		<p class="mb-4" style="font-size: 13px; color: var(--vl-muted-2);" id="vlEscritorListaSub"><?= $legendasJs['escrito']; ?></p>
		<div class="row listagem-escritor" id="vlEscritorListaRow" data-vl-papel="escrito"></div>
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
		var baseLista = <?= json_encode($urlListaEscritor, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;
		var legendasSub = <?= json_encode($legendasJs, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE); ?>;

		function vlEscritorCarregarLista(papel) {
			papel = papel || 'escrito';
			$('#vlEscritorListaRow').attr('data-vl-papel', papel);
			var sub = legendasSub[papel] || legendasSub.escrito;
			$('#vlEscritorListaSub').html(sub);
			$.ajax({
				url: baseLista,
				type: 'get',
				dataType: 'html',
				data: { papel: papel },
				beforeSend: function () { $('#modal-loading').show(); },
				complete: function () { $('#modal-loading').hide(); },
				success: function (data) {
					$('.listagem-escritor').html(data);
				}
			});
		}

		$(document).off('click.vlEscritorPager', '.listagem-escritor .page-link').on('click.vlEscritorPager', '.listagem-escritor .page-link', function (e) {
			e.preventDefault();
			e.stopImmediatePropagation();
			var papel = $('#vlEscritorPapelFiltro').val() || 'escrito';
			var u;
			try {
				u = new URL(this.href, window.location.href);
			} catch (err) {
				return;
			}
			u.searchParams.set('papel', papel);
			$.ajax({
				url: u.toString(),
				type: 'get',
				dataType: 'html',
				beforeSend: function () { $('#modal-loading').show(); },
				complete: function () { $('#modal-loading').hide(); },
				success: function (data) {
					$('.listagem-escritor').html(data);
				}
			});
		});

		$(document).ready(function () {
			vlEscritorCarregarLista($('#vlEscritorPapelFiltro').val());
			$('#vlEscritorPapelFiltro').on('change', function () {
				vlEscritorCarregarLista($(this).val());
			});
		});
	})();
	});
</script>
<?= $this->endSection(); ?>
