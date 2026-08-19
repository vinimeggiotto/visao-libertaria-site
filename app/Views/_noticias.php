<?= $this->extend('layouts/_main'); ?>

<?= $this->section('content'); ?>

<?php if (isset($_SESSION['colaboradores']['id'])): ?>
	<div class="modal vl-noticias-loading-overlay" style="z-index:7000;" id="modal-loading" tabindex="-1"
		aria-labelledby="modal-loadingLabel" aria-hidden="true">
		<div class="position-absolute w-100 h-100 d-flex flex-column align-items-center justify-content-center">
			<div class="spinner-border vl-noticias-spinner" role="status">
				<span class="visually-hidden">Carregando…</span>
			</div>
		</div>
	</div>
<?php endif; ?>

<div class="vl-container vl-site-noticias" style="padding-top: 40px; padding-bottom: 64px;">
	<nav style="font-size: 13px; color: var(--vl-muted-2); margin-bottom: 20px;" aria-label="Migalhas de navegação">
		<a href="<?= site_url('site'); ?>" style="color: var(--vl-muted-2); text-decoration: none;">Home</a>
		<span> / </span>
		<span style="color: var(--vl-text);">Notícias</span>
	</nav>

	<div class="row g-4">
		<div class="col-12 col-lg-8">
			<h1 style="font-family: var(--vl-font-title); font-size: 32px; font-weight: 700; margin: 0 0 8px;">Notícias</h1>
			<p style="color: var(--vl-muted); font-size: 15px; margin: 0 0 28px;">Pautas sugeridas pela comunidade e selecionadas pela equipe editorial.</p>

			<form method="get" id="formFiltroNoticias" action="<?= site_url('site/noticias'); ?>" class="mb-4">
				<div class="d-flex" style="gap: 10px;">
					<div class="flex-grow-1 d-flex align-items-center" style="gap: 8px; background: var(--vl-surface); border: 1px solid rgba(255,255,255,0.12); border-radius: var(--vl-radius); padding: 0 14px;">
						<i class="bi bi-search" aria-hidden="true" style="color: var(--vl-muted-2);"></i>
						<label for="pesquisa" class="visually-hidden">Buscar</label>
						<input type="text" class="form-control border-0 bg-transparent" id="pesquisa" name="pesquisa"
							placeholder="Buscar por título…"
							style="color: var(--vl-text); font-size: 14px; padding: 12px 0; box-shadow: none;"
							value="<?= isset($_GET['pesquisa']) ? esc($_GET['pesquisa']) : ''; ?>">
					</div>
					<button type="submit" class="btn vl-noticias-btn-filtro text-nowrap">Filtrar</button>
					<a href="<?= site_url('site/noticias'); ?>" id="vl-noticias-limpar" role="button" class="btn btn-outline-light text-nowrap">Limpar</a>
				</div>
			</form>

			<div id="vl-noticias-list-root">
				<?= view('template/templatePautasListSite', ['pautasList' => $pautasList]); ?>
			</div>

			<div class="page-load-status">
				<div class="infinite-scroll-request d-flex justify-content-center mt-5 mb-5">
					<div class="spinner-border vl-noticias-spinner" role="status">
						<span class="visually-hidden">Carregando mais notícias…</span>
					</div>
				</div>
				<p class="infinite-scroll-last h6" style="color: var(--vl-muted-2);" role="status">Fim da lista</p>
				<p class="infinite-scroll-error h6" style="color: var(--vl-danger);" role="alert">Não foi possível carregar mais páginas</p>
			</div>
		</div>

		<aside class="col-12 col-lg-4">
			<div class="vl-card mb-3" style="border-radius: 12px; padding: 20px;">
				<h2 style="font-family: var(--vl-font-title); font-size: 16px; font-weight: 700; margin: 0 0 8px;">Quer sugerir uma pauta?</h2>
				<p style="color: var(--vl-muted); font-size: 13px; line-height: 1.5; margin: 0 0 14px;">Sugestões de pauta são feitas por colaboradores cadastrados.</p>
				<?php if (isset($_SESSION['colaboradores']['id'])): ?>
					<?php
					$mensagemLimitePauta = $limiteDiario === true
						? 'Você atingiu o limite diário de pautas. Tente novamente amanhã.'
						: 'Você atingiu o limite semanal de pautas. Tente novamente outro dia.';
					?>
					<button type="button" class="btn vl-noticias-btn-filtro w-100" id="btn-sugerir-pauta"
						<?php if ($limiteDiario === false && $limiteSemanal === false): ?>
							data-bs-toggle="modal" data-bs-target="#modalSugerirPauta" data-bs-titulo-modal="Cadastre uma pauta"
						<?php else: ?>
							data-limite-pauta-msg="<?= esc($mensagemLimitePauta); ?>"
						<?php endif; ?>>
						Sugerir pauta
					</button>
				<?php else: ?>
					<a href="<?= site_url('site/cadastre-se'); ?>" class="btn btn-primary-color w-100" style="font-weight: 700; font-size: 14px; padding: 11px;">Cadastre-se para participar</a>
					<p class="mb-0 mt-3" style="font-size: 13px; color: var(--vl-muted-2);">
						Já tem conta?
						<a href="<?= esc(url_home_com_login(), 'attr'); ?>" class="vl-noticias-entrar-link">Entrar</a>
					</p>
				<?php endif; ?>
			</div>
			<div class="vl-card" style="border-radius: 12px; padding: 20px;">
				<h2 style="font-family: var(--vl-font-title); font-size: 16px; font-weight: 700; margin: 0 0 8px;">Como funciona</h2>
				<p style="color: var(--vl-muted); font-size: 13px; line-height: 1.6; margin: 0;">1. Colaboradores sugerem notícias e comentam nelas.<br>2. A equipe fecha as mais relevantes.<br>3. Escritores transformam em artigo e vídeo.</p>
			</div>
		</aside>
	</div>
</div>

<?php if (isset($_SESSION['colaboradores']['id'])):
	$pautaListPermissoes = $_SESSION['colaboradores']['permissoes'] ?? [];
	?>
	<div class="modal fade vl-noticias-pauta-modal" id="modalSugerirPauta" tabindex="-1" role="dialog" aria-labelledby="modalSugerirPautaTitulo"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable" role="document">
			<div class="modal-content border border-secondary shadow-lg" data-bs-theme="dark">
				<div class="modal-header border-secondary">
					<h5 class="modal-title text-white" id="modalSugerirPautaTitulo"></h5>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
				</div>
				<div class="modal-body">
					<form method="post" id="pautas_form" name="pautas_form" autocomplete="off">

						<div class="mb-3">
							<label for="link" class="form-label">Link da Notícia</label>
							<div class="input-group">
								<span class="input-group-text" aria-hidden="true"><i class="bi bi-link-45deg"></i></span>
								<input type="text" class="form-control" id="link" placeholder="Link da notícia para pauta"
									name="link" onblur="getInformationLink(this.value)"
									autocomplete="off" required>
							</div>
							<div class="form-text">Ao sair deste campo, os dados da URL são buscados automaticamente.</div>
						</div>

						<div class="mb-3">
							<label for="titulo" class="form-label">Título</label>
							<input type="hidden" id="pauta_antiga" name="pauta_antiga" value="N" />
							<input type="hidden" id="id_pauta" name="id_pauta" value="" />
							<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título da pauta"
								autocomplete="off" required>
						</div>

						<div class="mb-3">
							<label for="texto" class="form-label">Texto<?php if (! in_array('7', $pautaListPermissoes, false)): ?>
									<span class="text-muted"> Máx. <?= esc($config['pauta_tamanho_maximo']); ?> palavras. Mín. <?= esc($config['pauta_tamanho_minimo']); ?> palavras.</span><?php endif; ?>
									(<span class="text-muted" id="count_message"></span>)</label>
							<textarea class="form-control" name="texto" id="texto" autocomplete="off" required></textarea>
						</div>

						<div class="mb-3">
							<label for="imagem" class="form-label">Link da Imagem</label>
							<div class="input-group">
								<span class="input-group-text" aria-hidden="true"><i class="bi bi-link-45deg"></i></span>
								<input type="text" class="form-control" autocomplete="off" id="imagem" name="imagem"
									placeholder="Link da imagem da notícia" required>
							</div>
						</div>

						<div class="text-center preview_imagem_div mb-3 collapse">
							<img class="img-thumbnail img-preview-modal" src="" data-bs-toggle="tooltip" data-bs-placement="top"
								id="preview_imagem" alt="Pré-visualização da imagem da pauta" title="Pré-visualização da imagem da pauta" style="max-height: 200px;">
							<div class="vl-thumb-placeholder d-none" id="preview_imagem_placeholder" aria-hidden="true"></div>
						</div>
					</form>
				</div>
				<div class="modal-footer border-secondary d-flex flex-wrap gap-2 justify-content-between">
					<button type="button" class="me-auto btn btn-outline-danger btn-excluir">Excluir pauta</button>
					<div class="d-flex flex-wrap gap-2 ms-auto">
						<button type="button" class="btn btn-secondary" id="btn-reset-modal-pauta" data-bs-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-warning btn-enviar">Enviar</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade vl-noticias-pauta-modal" id="modalComentariosPauta" tabindex="-1" role="dialog" aria-labelledby="modalComentariosPautaTitulo"
		aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
			<div class="modal-content border border-secondary shadow-lg" data-bs-theme="dark">
				<div class="modal-header border-secondary">
					<h5 class="modal-title text-white" id="modalComentariosPautaTitulo">Comentários da Pauta</h5>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
				</div>
				<div class="modal-body">
					<div class="card mb-3 border-secondary bg-dark text-light">
						<img src="" class="card-img-top modalImagem" alt="Imagem de destaque da pauta">
						<div class="card-body">
							<h5 class="card-title modalTitulo"></h5>
							<p class="card-text modalTexto"></p>
						</div>
					</div>

					<div class="row">
						<div class="col-12 text-center">
							<button class="btn btn-primary mt-3 mb-3 col-md-6" id="btn-comentarios" type="button">Atualizar
								Comentários</button>
						</div>
						<div class="col-12 d-flex justify-content-center">

							<div class="col-12 div-comentarios">
								<div class="col-12">
									<div class="mb-3">
										<label for="comentario" class="form-label">Seu comentário</label>
										<input type="hidden" id="idPauta" name="idPauta" />
										<input type="hidden" id="id_comentario" name="id_comentario" />
										<textarea id="comentario" name="comentario" class="form-control" rows="5"
											placeholder="Digite seu comentário aqui"></textarea>
									</div>
									<div class="mb-3 text-center">
										<button class="btn btn-primary mt-3 col-md-6" id="enviar-comentario"
											type="button">Enviar comentário</button>
									</div>
								</div>
								<div class="card m-3 div-list-comentarios"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer border-secondary">
					<button type="button" class="btn btn-secondary" id="btn-fechar-modal-comentarios" data-bs-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script defer src="<?= asset_url('public/js/vendor/masonry.pkgd.min.js'); ?>"></script>
<script defer src="<?= asset_url('public/js/vendor/infinite-scroll.pkgd.min.js'); ?>"></script>
<?php if (isset($_SESSION['colaboradores']['id'])): ?>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		Toast.setTheme(TOAST_THEME.LIGHT);
	});
</script>
<?php endif; ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
(function () {
	var listUrl = <?= json_encode(site_url('site/noticias')); ?>;
	var debounceMs = 380;
	var debounceTimer = null;
	var listAbort = null;
	var lastFetchedTerm = null;

	function destroyNoticiasListWidgets($wrap) {
		var $grid = $wrap.find('.pautas-list');
		if (!$grid.length) {
			return;
		}
		var inf = $grid.data('infiniteScroll');
		if (inf && typeof inf.destroy === 'function') {
			inf.destroy();
			$grid.removeData('infiniteScroll');
		} else if (typeof $grid.infiniteScroll === 'function') {
			try {
				$grid.infiniteScroll('destroy');
			} catch (e) { /* ignore */ }
		}
		if ($grid.data('masonry') && typeof $grid.masonry === 'function') {
			try {
				$grid.masonry('destroy');
			} catch (e2) { /* ignore */ }
		}
	}

	function initTooltipsIn($root) {
		($root && $root.length ? $root : $(document)).find('[data-bs-toggle="tooltip"]').each(function () {
			var el = this;
			if (typeof bootstrap === 'undefined' || !bootstrap.Tooltip) {
				return;
			}
			var existing = bootstrap.Tooltip.getInstance(el);
			if (existing) {
				existing.dispose();
			}
			new bootstrap.Tooltip(el);
		});
	}

	function initNoticiasMasonryIn($wrap) {
		var $grid = $wrap.find('.pautas-list');
		if (!$grid.length || typeof $grid.masonry !== 'function') {
			return;
		}
		$grid.masonry({
			stagger: 100,
			itemSelector: '.card',
			horizontalOrder: true,
			gutter: 16,
			percentPosition: true
		});
		var msnry = $grid.data('masonry');
		if (msnry && typeof $grid.infiniteScroll === 'function') {
			$grid.infiniteScroll({
				path: '.next_page',
				append: '.card',
				history: false,
				outlayer: msnry,
				status: '.vl-site-noticias .page-load-status',
				scrollThreshold: 100
			});
		}
		initTooltipsIn($wrap);
	}

	function syncUrlPesquisa(term) {
		var u = new URL(window.location.href);
		if (term) {
			u.searchParams.set('pesquisa', term);
		} else {
			u.searchParams.delete('pesquisa');
		}
		u.searchParams.delete('page_noticias');
		u.searchParams.delete('partial');
		var qs = u.searchParams.toString();
		history.replaceState({}, '', u.pathname + (qs ? '?' + qs : ''));
	}

	function fetchNoticiasList(term, force) {
		var $root = $('#vl-noticias-list-root');
		if (!$root.length || typeof fetch !== 'function') {
			return;
		}
		var t = term == null ? '' : String(term).trim();
		if (!force && lastFetchedTerm !== null && lastFetchedTerm === t) {
			return;
		}
		if (listAbort) {
			listAbort.abort();
		}
		listAbort = new AbortController();
		var params = new URLSearchParams();
		if (t) {
			params.set('pesquisa', t);
		}
		params.set('partial', '1');
		var url = listUrl + (listUrl.indexOf('?') >= 0 ? '&' : '?') + params.toString();
		fetch(url, {
			method: 'GET',
			credentials: 'same-origin',
			signal: listAbort.signal,
			headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'text/html' }
		})
			.then(function (res) {
				if (!res.ok) {
					throw new Error(String(res.status));
				}
				return res.text();
			})
			.then(function (html) {
				listAbort = null;
				lastFetchedTerm = t;
				destroyNoticiasListWidgets($root);
				$root.html(html);
				initNoticiasMasonryIn($root);
				syncUrlPesquisa(t);
			})
			.catch(function (err) {
				if (err && err.name === 'AbortError') {
					return;
				}
				listAbort = null;
				console.error('Notícias:', err);
			});
	}

	function scheduleFetchFromInput(force) {
		var $inp = $('#pesquisa');
		if (!$inp.length) {
			return;
		}
		clearTimeout(debounceTimer);
		debounceTimer = setTimeout(function () {
			debounceTimer = null;
			fetchNoticiasList($inp.val(), force);
		}, force ? 0 : debounceMs);
	}

	$(document).ready(function () {
		var $root = $('#vl-noticias-list-root');
		if (!$root.length) {
			return;
		}
		initNoticiasMasonryIn($root);

		if (typeof fetch !== 'function') {
			return;
		}

		lastFetchedTerm = $('#pesquisa').val() != null ? String($('#pesquisa').val()).trim() : '';

		$('#pesquisa').on('keyup input', function () {
			scheduleFetchFromInput(false);
		});

		$('#formFiltroNoticias').on('submit', function (e) {
			e.preventDefault();
			clearTimeout(debounceTimer);
			debounceTimer = null;
			fetchNoticiasList($('#pesquisa').val(), true);
		});

		$('#vl-noticias-limpar').on('click', function (e) {
			e.preventDefault();
			$('#pesquisa').val('');
			clearTimeout(debounceTimer);
			debounceTimer = null;
			fetchNoticiasList('', true);
		});
	});

	window.VL_refreshNoticiasListaNoticias = function () {
		var $root = $('#vl-noticias-list-root');
		if (!$root.length || typeof fetch !== 'function') {
			return;
		}
		fetchNoticiasList($('#pesquisa').val() != null ? String($('#pesquisa').val()).trim() : '', true);
	};
})();
<?php if (isset($_SESSION['colaboradores']['id'])): ?>
<?php
$pautaListAdminPerm7Modal = in_array('7', $pautaListPermissoes, false);
$pautaListAplicaLimitesModal = ! $pautaListAdminPerm7Modal;
$pautaListMinPalavrasModal = $pautaListAplicaLimitesModal ? (int) $config['pauta_tamanho_minimo'] : null;
$pautaListMaxPalavrasModal = $pautaListAplicaLimitesModal ? (int) $config['pauta_tamanho_maximo'] : null;
?>
(function () {
	var vlImgDefaultPauta = <?= json_encode(base_url('public/assets/imagem-default.webp')); ?>;
	var vlImgPlaceholder = <?= json_encode(cria_url_placeholder()); ?>;
	var vlImgPlaceholderFallback = <?= json_encode(cria_url_placeholder_fallback()); ?>;

	function vlPautaPreviewEhDefault(src) {
		if (src == null || src === '') {
			return true;
		}
		var s = String(src);
		return s === vlImgDefaultPauta || s.indexOf('imagem-default.webp') !== -1 || s.indexOf('imagem-default.png') !== -1 || s.indexOf('via.placeholder.com') !== -1;
	}

	function vlSetPautaPreview(src) {
		var $img = $('#preview_imagem');
		var $ph = $('#preview_imagem_placeholder');
		$ph.addClass('d-none');
		$img.off('error.vlph');
		if (vlPautaPreviewEhDefault(src)) {
			$img.on('error.vlph', function () {
				$img.off('error.vlph');
				this.src = vlImgPlaceholderFallback;
			});
			$img.removeClass('d-none').attr('src', vlImgPlaceholder);
		} else {
			$img.removeClass('d-none').attr('src', src);
		}
	}

	function resetPautaFormUi() {
		$('#modalSugerirPauta #link').prop('disabled', false);
		var f = document.getElementById('pautas_form');
		if (f) {
			f.reset();
		}
		vlSetPautaPreview('');
		$('#modalSugerirPauta .preview_imagem_div').hide();
		$('#id_pauta').val('');
		if (window.VL_contagemPalavrasAtualizar) {
			window.VL_contagemPalavrasAtualizar();
		}
	}

	var exampleModal = document.getElementById('modalSugerirPauta');
	var modalComentarios = document.getElementById('modalComentariosPauta');

	if (exampleModal) {
		exampleModal.addEventListener('show.bs.modal', function (event) {
			var button = event.relatedTarget;
			var recipient = button ? button.getAttribute('data-bs-pautas-id') : null;
			var titulo = button ? button.getAttribute('data-bs-titulo-modal') : null;
			$('#modalSugerirPautaTitulo').html(titulo || 'Cadastre uma pauta');

			if (recipient != null && recipient !== '') {
				$('#modalSugerirPauta .btn-excluir').show();
				$.ajax({
					url: "<?= site_url('colaboradores/pautas/detalhe/'); ?>" + recipient,
					method: "POST",
					data: '',
					processData: false,
					contentType: false,
					cache: false,
					dataType: "json",
					beforeSend: function () { $('#modal-loading').show(); },
					complete: function () { $('#modal-loading').hide(); },
					success: function (retorno) {
						if (retorno.status) {
							$('#id_pauta').val(recipient);
							$('#titulo').val(retorno.titulo);
							$('#link').val(retorno.link);
							$('#link').prop('disabled', true);
							$('#texto').val(retorno.texto);
							$('#imagem').val(retorno.imagem);
							$('#pauta_antiga').val(retorno.pauta_antiga);
							$('#imagem').trigger('change');
							$('#texto').trigger('input');
						} else {
							popMessage('ATENÇÃO', retorno.mensagem, TOAST_STATUS.DANGER);
						}
					}
				});
			} else {
				resetPautaFormUi();
				$('#modalSugerirPauta .btn-excluir').hide();
			}
		});

		exampleModal.addEventListener('hide.bs.modal', function () {
			resetPautaFormUi();
		});
	}

	if (modalComentarios) {
		modalComentarios.addEventListener('show.bs.modal', function (event) {
			var button = event.relatedTarget;
			if (!button) {
				return;
			}
			$('.modalImagem').attr('src', button.getAttribute('data-bs-imagem') || '');
			$('.modalTexto').html(button.getAttribute('data-bs-texto') || '');
			$('.modalTitulo').html(button.getAttribute('data-bs-titulo') || '');
			$('#idPauta').val(button.getAttribute('data-bs-pautas-id') || '');
			if (typeof getComentarios === 'function') {
				getComentarios();
			}
		});
	}

	$('#modalSugerirPauta .btn-excluir').on('click', function () {
		var form = new FormData(document.getElementById('pautas_form'));
		var idPauta = $('#id_pauta').val();
		$.ajax({
			url: "<?= site_url('colaboradores/pautas/excluir/'); ?>" + idPauta,
			method: "POST",
			data: form,
			processData: false,
			contentType: false,
			cache: false,
			dataType: "json",
			beforeSend: function () { $('#modal-loading').show(); },
			complete: function () { $('#modal-loading').hide(); },
			success: function (retorno) {
				if (retorno.status) {
					popMessage('Sucesso!', retorno.mensagem, TOAST_STATUS.SUCCESS);
					var modalEl = document.getElementById('modalSugerirPauta');
					if (modalEl && typeof bootstrap !== 'undefined') {
						bootstrap.Modal.getOrCreateInstance(modalEl).hide();
					}
					if (typeof window.VL_refreshNoticiasListaNoticias === 'function') {
						window.VL_refreshNoticiasListaNoticias();
					}
				} else {
					popMessage('ATENÇÃO', retorno.mensagem, TOAST_STATUS.DANGER);
					if (typeof Toast !== 'undefined' && typeof toast !== 'undefined') {
						Toast.create(toast);
					}
				}
			}
		});
	});

	$('#btn-sugerir-pauta').on('click', function (e) {
		var mensagemLimite = $(this).attr('data-limite-pauta-msg');
		if (!mensagemLimite) {
			return;
		}
		e.preventDefault();
		popMessage('ATENÇÃO', mensagemLimite, TOAST_STATUS.WARNING);
	});

	$('#modalSugerirPauta #imagem').on('change', function () {
		$('#modalSugerirPauta .preview_imagem_div').show();
		var valImagem = $('#imagem').val();
		if (vlPautaPreviewEhDefault(valImagem)) {
			$('#imagem').val(vlImgDefaultPauta);
			vlSetPautaPreview(vlImgDefaultPauta);
			return;
		}
		var form = new FormData(document.getElementById('pautas_form'));
		$.ajax({
			url: "<?= site_url('colaboradores/pautas/verificaImagem'); ?>",
			method: "POST",
			data: form,
			processData: false,
			contentType: false,
			cache: false,
			dataType: "json",
			beforeSend: function () { $('#modal-loading').show(); },
			complete: function () { $('#modal-loading').hide(); },
			success: function (retorno) {
				if (retorno.status) {
					vlSetPautaPreview($('#imagem').val());
				} else {
					$('#imagem').val(vlImgDefaultPauta);
					vlSetPautaPreview(vlImgDefaultPauta);
					popMessage('ATENÇÃO', retorno.mensagem, TOAST_STATUS.DANGER);
				}
			}
		});
	});

	$('#modalSugerirPauta .btn-enviar').on('click', function () {
		var minPalavras = <?= json_encode($pautaListMinPalavrasModal); ?>;
		var maxPalavras = <?= json_encode($pautaListMaxPalavrasModal); ?>;
		if (minPalavras !== null || maxPalavras !== null) {
			var textoPauta = String($('#texto').val() || '').trim();
			var totalPalavras = textoPauta === '' ? 0 : textoPauta.split(/\s+/).length;
			if (minPalavras !== null && totalPalavras < minPalavras) {
				popMessage('ATENÇÃO', 'O texto precisa ter no mínimo ' + minPalavras + ' palavras.', TOAST_STATUS.WARNING);
				return;
			}
			if (maxPalavras !== null && totalPalavras > maxPalavras) {
				popMessage('ATENÇÃO', 'O texto pode ter no máximo ' + maxPalavras + ' palavras.', TOAST_STATUS.WARNING);
				return;
			}
		}

		var form = new FormData(document.getElementById('pautas_form'));
		var idPauta = '';
		if ($('#id_pauta').val() !== '') {
			idPauta = '/' + $('#id_pauta').val();
		}
		$.ajax({
			url: "<?= site_url('colaboradores/pautas/cadastrar'); ?>" + idPauta,
			method: "POST",
			data: form,
			processData: false,
			contentType: false,
			cache: false,
			dataType: "json",
			beforeSend: function () { $('#modal-loading').show(); },
			complete: function () { $('#modal-loading').hide(); },
			success: function (retorno) {
				if (retorno.status) {
					popMessage('Sucesso!', retorno.mensagem, TOAST_STATUS.SUCCESS);
					var modalEl = document.getElementById('modalSugerirPauta');
					if (modalEl && typeof bootstrap !== 'undefined') {
						bootstrap.Modal.getOrCreateInstance(modalEl).hide();
					}
					if (typeof window.VL_refreshNoticiasListaNoticias === 'function') {
						window.VL_refreshNoticiasListaNoticias();
					}
				} else {
					popMessage('ATENÇÃO', retorno.mensagem, TOAST_STATUS.DANGER);
				}
			}
		});
	});

	function vlClearPautaCamposDependentes() {
		var $m = $('#modalSugerirPauta');
		$m.find('#titulo, #texto').val('');
		$m.find('#imagem').val('');
		$m.find('#pauta_antiga').val('N');
		$m.find('.preview_imagem_div').hide();
		vlSetPautaPreview(vlImgDefaultPauta);
		if (window.VL_contagemPalavrasAtualizar) {
			window.VL_contagemPalavrasAtualizar();
		}
	}

	window.getInformationLink = function (link) {
		var $m = $('#modalSugerirPauta');
		var $linkInput = $m.find('#link');
		if ($linkInput.prop('disabled')) {
			return false;
		}

		vlClearPautaCamposDependentes();

		link = (link || '').trim().substring(0, 254);
		$linkInput.val(link);

		if (link === '') {
			return false;
		}

		var fd = new FormData();
		fd.append('link_pauta', link);
		var idP = $m.find('#id_pauta').val();
		if (idP) {
			fd.append('id_pauta', idP);
		}

		$.ajax({
			url: "<?= site_url('colaboradores/pautas/verificaPautaCadastrada'); ?>",
			method: "POST",
			data: fd,
			processData: false,
			contentType: false,
			cache: false,
			dataType: "json",
			beforeSend: function () { $('#modal-loading').show(); },
			complete: function () { $('#modal-loading').hide(); },
			success: function (retorno) {
				if (retorno.status) {
					$m.find('#titulo').val(retorno.titulo);
					$m.find('#texto').val(retorno.texto);
					var imgRet = retorno.imagem || '';
					if (vlPautaPreviewEhDefault(imgRet)) {
						$m.find('#imagem').val(vlImgDefaultPauta);
						vlSetPautaPreview(vlImgDefaultPauta);
					} else {
						$m.find('#imagem').val(imgRet);
						vlSetPautaPreview(imgRet);
					}
					$m.find('.preview_imagem_div').show();
					if (window.VL_contagemPalavrasAtualizar) {
						window.VL_contagemPalavrasAtualizar();
					}
					if (retorno.mensagem == null) {
						$m.find('#pauta_antiga').val('N');
					} else {
						$m.find('#pauta_antiga').val('S');
						popMessage('ATENÇÃO!', retorno.mensagem, TOAST_STATUS.INFO);
					}
				} else {
					vlClearPautaCamposDependentes();
					$m.find('#imagem').val(vlImgDefaultPauta);
					vlSetPautaPreview(vlImgDefaultPauta);
					popMessage('ATENÇÃO', retorno.mensagem, TOAST_STATUS.DANGER);
				}
			}
		});
	};
})();
<?php endif; ?>
});
</script>
<?php if (isset($_SESSION['colaboradores']['id'])): ?>
<?php
	$pautaListPermissoesRodape = $_SESSION['colaboradores']['permissoes'] ?? [];
	$pautaListAdminPerm7 = in_array('7', $pautaListPermissoesRodape, false);
	$pautaListAplicaLimites = ! $pautaListAdminPerm7;
	$contagemPalavrasListModal = [
		'endpoint'         => site_url('colaboradores/artigos/contarPalavrasTexto'),
		'textareaSelector' => '#texto',
		'outputSelector'   => '#count_message',
		'debounceMs'       => 200,
		'submitSelector'   => null,
		'minPalavras'      => $pautaListAplicaLimites ? (int) $config['pauta_tamanho_minimo'] : null,
		'maxPalavras'      => $pautaListAplicaLimites ? (int) $config['pauta_tamanho_maximo'] : null,
	];
	$jsonFlags = JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT;
?>
<script>
	window.VL_CONTAGEM_PALAVRAS = <?= json_encode($contagemPalavrasListModal, $jsonFlags); ?>;
	window.VL_COMENTARIOS = <?= json_encode([
		'endpointPrefix'   => base_url('colaboradores/pautas/comentarios/'),
		'entityIdSelector' => '#idPauta',
		'autoLoad'         => false,
	], $jsonFlags); ?>;
</script>
<script defer src="<?= site_url('public/js/colaboradores-contagem-palavras.js'); ?>"></script>
<script defer src="<?= site_url('public/js/colaboradores-comentarios.js'); ?>"></script>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		if (typeof window.VL_CONTAGEM_PALAVRAS_INIT === 'function') {
			window.VL_CONTAGEM_PALAVRAS_INIT();
		}
	});
</script>
<?php endif; ?>
<?= $this->endSection(); ?>
