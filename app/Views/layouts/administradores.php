<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?= asset_url('public/css/vendor/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?= asset_url('public/css/vendor/bootstrap-icons.min.css'); ?>">

	<script defer src="<?= asset_url('public/js/vendor/jquery-3.7.1.min.js'); ?>"></script>
	<script defer src="<?= asset_url('public/js/vendor/bootstrap.bundle.min.js'); ?>"></script>
	<script defer src="<?= asset_url('public/js/vendor/bs-custom-file-input.min.js'); ?>"></script>


	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= current_url(true); ?>" />
	<meta name="theme-color" content="#F3C921">

	<meta name="twitter:card" content="summary_large_image">
	<meta property="twitter:domain" content="<?= site_url(); ?>">
	<meta property="twitter:url" content="<?= current_url(true); ?>">
	<meta name="twitter:title" content="<?= $_SESSION['site_config']['texto_nome']; ?>">
	<meta name="twitter:description" content="<?= $_SESSION['site_config']['texto_rodape']; ?>">
	<meta name="twitter:image"
		content="<?= esc($_SESSION['site_config']['marca_favicon'] ?? site_url('public/assets/logo.webp'), 'attr'); ?>">
	<meta property="og:title" content="<?= $_SESSION['site_config']['texto_nome']; ?>" />
	<meta property="og:image"
		content="<?= esc($_SESSION['site_config']['marca_favicon'] ?? site_url('public/assets/logo.webp'), 'attr'); ?>" />
	<meta property="og:description" content="<?= $_SESSION['site_config']['texto_rodape']; ?>" />

	<link rel="stylesheet" href="<?= asset_url('public/css/vendor/mdb.min.css'); ?>">
	<link rel="stylesheet" href="<?= asset_url('public/css/theme-tokens.css'); ?>">
	<link rel="stylesheet" href="<?= asset_url('public/css/theme-dark.css'); ?>">
	<link rel="stylesheet" href="<?= asset_url('public/css/layout-shared.css'); ?>">

	<style type="text/css">
		/* Modal de comentários da pauta (template/modal_comentarios_pauta) */
		#modalComentariosPauta .modal-comentarios-pauta-thumb {
			width: 112px;
			height: 84px;
			object-fit: cover;
			flex-shrink: 0;
		}

		#modalComentariosPauta .modal-comentarios-pauta-texto {
			max-height: 6.5rem;
			overflow-y: auto;
			font-size: 0.875rem;
		}

		#modalComentariosPauta .div-list-comentarios {
			max-height: min(42vh, 400px);
		}

		#modalComentariosPauta #btn-comentarios {
			color: var(--vl-brand-text);
			background-color: transparent;
			border: 2px solid var(--vl-brand-bg);
		}

		#modalComentariosPauta #btn-comentarios:hover,
		#modalComentariosPauta #btn-comentarios:focus-visible {
			background-color: var(--vl-brand-bg);
			border-color: var(--vl-brand-bg);
			color: var(--vl-brand-text);
		}

		#modalComentariosPauta #btn-comentarios:active {
			background-color: var(--vl-brand-bg-dark);
			border-color: var(--vl-brand-bg-dark);
			color: var(--vl-brand-text);
		}
	</style>
	<?php
	if (file_exists('public/assets/estilos.css')):
		?>
		<link rel="stylesheet" href="<?= site_url('public/assets/estilos.css'); ?>" crossorigin="anonymous">
		<?php
	endif;
	?>
	<title>
		<?= $_SESSION['site_config']['texto_nome']; ?>
	</title>
	<link rel="icon" type="image/x-icon"
		href="<?= esc($_SESSION['site_config']['marca_favicon'] ?? site_url('public/assets/logo.webp'), 'attr'); ?>">


	<link rel="stylesheet" href="<?= asset_url('public/css/vendor/bootstrap-toaster.min.css'); ?>">

</head>

<body>
	<script defer src="<?= asset_url('public/js/vendor/bootstrap-toaster.min.js'); ?>"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
		let toast = {
			title: "",
			message: "",
			status: TOAST_STATUS.SUCCESS,
			timeout: 3000
		}
		Toast.setTheme(TOAST_THEME.LIGHT);
		Toast.enableTimers(TOAST_TIMERS.DISABLED);
		Toast.setMaxCount(10);
		Toast.enableQueue(true);
		window.popMessage = function (titulo, mensagem, status, timeoutMs) {
			toast.message = mensagem;
			toast.title = titulo;
			toast.status = status;
			toast.timeout = timeoutMs || 3000;
			Toast.create(toast);
		};
		});
	</script>

	<div class="modal bg-light" style="opacity: 0.4; z-index:7000;" id="modal-loading" tabindex="-1"
		aria-labelledby="modal-loadingLabel" aria-hidden="true">
		<div class="position-absolute w-100 h-100 d-flex flex-column align-items-center justify-content-center">
			<div class="spinner-border" role="status">
				<span class="visually-hidden">Loading...</span>
			</div>
		</div>
	</div>

	<header>
		<div class="navbar-top d-lg-block navbar-expand-lg small">
			<div class="container">
				<div class="d-flex justify-content-between align-items-center my-2">
					<!-- Top bar left -->
					<ul class="nav">
						<?php if (isset($_SESSION) && $_SESSION['colaboradores']['id'] !== null): ?>
							<li class="nav-item">
								<a class="nav-link ps-0" href="<?= site_url('colaboradores/perfil'); ?>">Área do
									colaborador</a>
							</li>
						<?php endif; ?>
						<?php if (in_array('7', $_SESSION['colaboradores']['permissoes']) || in_array('8', $_SESSION['colaboradores']['permissoes']) || in_array('9', $_SESSION['colaboradores']['permissoes']) || in_array('10', $_SESSION['colaboradores']['permissoes'])): ?>
							<li class="nav-item">
								<a class="nav-link ps-0" href="<?= site_url('site'); ?>">Voltar ao site</a>
							</li>
						<?php endif; ?>
					</ul>
					<!-- Top bar right -->
					<div class="d-flex align-items-center">
						<!-- Dark mode options START -->
						<div class="nav-item dropdown mx-2">
							<!-- Switch button -->
							<span class="modeswitch dark-button btn-tertiary" aria-expanded="false"
								data-bs-toggle="dropdown" data-bs-display="static">
								<i class="bi bi-moon-fill fs-2"></i>
							</span>
							<span class="modeswitch light-button btn-tertiary" aria-expanded="false"
								data-bs-toggle="dropdown" data-bs-display="static">
								<i class="bi bi-moon fs-2"></i>
							</span>
						</div>
						<!-- Dark mode options END -->
					</div>
				</div>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg shadow-0 bg-primary">
			<div class="container">
				<div>
					<a class="navbar-brand mt-2 mt-lg-0 js-requer-permissao" href="<?= site_url('colaboradores/artigos/dashboard'); ?>"
						data-permissoes="2" data-permissao-nome="<?= esc(nome_atribuicao('2'), 'attr'); ?>">
						<img class="img-thumbnail rounded-circle mr-3" style="max-width: 3rem;"
							src="<?= esc($_SESSION['site_config']['marca_rodape'] ?? site_url('public/assets/logo.webp'), 'attr'); ?>"
							loading="lazy">
						<span class="lead fw-bold"><?= $_SESSION['site_config']['texto_nome']; ?></span>
					</a>
				</div>
				<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-bs-toggle="collapse"
					data-bs-target="#menuPrincipal" data-target="#menuPrincipal" aria-controls="menuPrincipal"
					aria-expanded="false" aria-label="Toggle navigation">
					<i class="bi bi-list"></i>
				</button>

				<div class="collapse navbar-collapse" id="menuPrincipal">
					<ul class="navbar-nav d-flex justify-content-center">
						<li class="nav-item active">
							<a class="nav-link js-requer-permissao" href="<?= site_url('colaboradores/admin/dashboard'); ?>"
								data-permissoes="7" data-permissao-nome="<?= esc(nome_atribuicao('7'), 'attr'); ?>"><i
									class="bi bi-globe"></i> Dashboard</a>
						</li>
						<?php if (isset($_SESSION) && $_SESSION['colaboradores']['id'] != null): ?>
							<?php if (in_array('10', $_SESSION['colaboradores']['permissoes'])): ?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="menuPautasColaboradores"><i
											class="bi bi-megaphone"></i> Pautas</a>
									<ul class="dropdown-menu bg-primary" aria-labelledby="menuPautasColaboradores">
										<li> <a class="dropdown-item"
												href="<?= site_url('colaboradores/pautas/fechar'); ?>">Fechar pautas</a> </li>
										<li> <a class="dropdown-item"
												href="<?= site_url('colaboradores/pautas/fechadas'); ?>">Pautas fechadas</a>
										</li>
									</ul>
								</li>
							<?php endif; ?>
							<?php if (in_array('7', $_SESSION['colaboradores']['permissoes'])): ?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" id="menuAdministracaoConfiguracao"><i
											class="bi bi-wrench"></i> Configurações</a>
									<ul class="dropdown-menu bg-primary" aria-labelledby="menuAdministracaoConfiguracao">
										<li> <a class="dropdown-item"
												href="<?= site_url('colaboradores/admin/configuracoes'); ?>">Configurações gerais</a> </li>
										<li> <a class="dropdown-item"
												href="<?= site_url('colaboradores/admin/layout'); ?>">Layout e configuração dos sites</a>
										</li>
										<li> <a class="dropdown-item"
												href="<?= site_url('colaboradores/admin/regras'); ?>">Regras para colaborar</a>
										</li>
										<li> <a class="dropdown-item"
												href="<?= site_url('colaboradores/admin/estaticas'); ?>">Páginas estáticas</a>
										</li>
									</ul>
								</li>
							<?php endif; ?>
							<?php if (in_array('8', $_SESSION['colaboradores']['permissoes'])): ?>
								<li class="nav-item">
									<a class="nav-link" href="<?= site_url('colaboradores/admin/financeiro'); ?>"><i
											class="bi bi-currency-bitcoin"></i>
										Financeiro</a>
								</li>
							<?php endif; ?>
							<?php if (in_array('8', $_SESSION['colaboradores']['permissoes'])): ?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" id="menuAdministracaoConfiguracao"><i
										class="bi bi-people"></i> Colaboradores</a>
									<ul class="dropdown-menu bg-primary" aria-labelledby="menuAdministracaoConfiguracao">
										<li> <a class="dropdown-item js-requer-permissao"
												href="<?= site_url('colaboradores/admin/permissoes'); ?>"
												data-permissoes="9" data-permissao-nome="<?= esc(nome_atribuicao('9'), 'attr'); ?>">Colaboradores</a> </li>
										<li> <a class="dropdown-item js-requer-permissao"
												href="<?= site_url('colaboradores/admin/contatos'); ?>"
												data-permissoes="7" data-permissao-nome="<?= esc(nome_atribuicao('7'), 'attr'); ?>">Mensagens de contato</a>
										</li>
									</ul>
								</li>
							<?php endif; ?>
						<?php endif; ?>
						<?php if (isset($_SESSION) && isset($_SESSION['site_config']['paginas']['menu_administrador'])): ?>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#"><i class="bi bi-file-text"></i> 
									Páginas</a>
								<ul class="dropdown-menu bg-primary" aria-labelledby="menuArtigosColaboradores">
									<?php foreach ($_SESSION['site_config']['paginas']['menu_administrador'] as $pagina): ?>
										<li> <a class="dropdown-item"
												href="<?= site_url('site/pagina/' . $pagina['link']); ?>"><?= $pagina['titulo']; ?></a>
										</li>
									<?php endforeach; ?>
								</ul>
							</li>
						<?php endif; ?>
					</ul>
					<div class="navbar-nav align-items-center ms-auto menu-direita">
						<?php if (isset($_SESSION) && $_SESSION['colaboradores']['id'] !== null): ?>
							<?php $temRecados = isset($_SESSION['colaboradores']['notificacoes']) && (int) $_SESSION['colaboradores']['notificacoes'] > 0; ?>
							<ul class="navbar-nav">
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="<?= site_url('colaboradores/perfil'); ?>" id="navbarDropdownMenuLink" role="button"
										data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<span class="position-relative d-inline-block">
											<?= avatar_slot_html(
												'avatar_menu',
												$_SESSION['colaboradores']['avatar'] ?? null,
												'Avatar',
												'rounded-circle',
												'width:30px;height:30px;object-fit:cover;'
											); ?>
											<span class="avatar-recados-indicator position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle<?= $temRecados ? '' : ' d-none'; ?>">
												<span class="visually-hidden">Novos recados</span>
											</span>
										</span>
										<span class="apelido_colaborador">
											<?= $_SESSION['colaboradores']['nome']; ?>
										</span>
									</a>
									<div class="dropdown-menu bg-primary" aria-labelledby="navbarDropdownMenuLink">
										<a class="dropdown-item rounded-top"
											href="<?= site_url('colaboradores/perfil'); ?>">Meu
											Perfil</a>
										<a class="dropdown-item rounded-bottom"
											href="<?= site_url('site/logout'); ?>">Sair</a>
									</div>
								</li>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</nav>
	</header>

	<?= $this->renderSection('content'); ?>

	<footer class="mb-3 mt-5">
		<div class="container">
			<div class="text-center">Desenvolvido e mantido por <a class="text-reset btn-link font-light"
					href="https://github.com/KoreaComK/">KoreacomK</a> e a
				comunidade.
			</div>
		</div>
	</footer>

	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
		id="mi-modal">
		<div class="modal-dialog modal-md modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">ATENÇÃO!</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p class="conteudo-modal"></p>
				</div>
				<div class="modal-footer d-flex justify-content-between">
					<button type="button" class="btn btn-default" data-bs-dismiss="modal" id="modal-btn-no">Não</button>
					<button type="button" class="btn btn-primary" id="modal-btn-si">Sim</button>
				</div>
			</div>
		</div>
	</div>
	<?= view('components/_aviso_permissao'); ?>
	<?= $this->renderSection('scripts'); ?>
	<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function () {

	$(document).ready(function () {
		bsCustomFileInput.init()
	})

	$(function () {
		$('.btn-tooltip').tooltip();
	});

	var darkMode;
	if (localStorage.getItem('dark-mode')) {
		darkMode = localStorage.getItem('dark-mode');
	} else {
		darkMode = 'light';
	}

	localStorage.setItem('dark-mode', darkMode);

	if (localStorage.getItem('dark-mode') == 'dark') {
		$('body').attr('data-mdb-theme', 'dark');
		$('.dark-button').hide();
		$('.light-button').show();
	} else {
		$('.dark-button').show();
		$('.light-button').hide();
	}

	// Toggle dark UI
	$('.dark-button').on('click', function () {
		$('.dark-button').hide();
		$('.light-button').show();
		$('body').attr('data-mdb-theme', 'dark');
		localStorage.setItem('dark-mode', 'dark');
	});

	$('.light-button').on('click', function () {
		$('.light-button').hide();
		$('.dark-button').show();
		$('body').attr('data-mdb-theme', '');
		localStorage.setItem('dark-mode', 'light');
	});
	});
	</script>
</body>

</html>