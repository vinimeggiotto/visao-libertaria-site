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

	<?php if (isset($meta) && is_array($meta)): ?>

		<meta name="twitter:title" content="<?= $meta['title']; ?>">
		<meta name="twitter:image" content="<?= $meta['image']; ?>">
		<meta name="twitter:description" content="<?= $meta['description']; ?>">

		<meta property="og:title" content="<?= $meta['title']; ?>" />
		<meta property="og:image" content="<?= $meta['image']; ?>" />
		<meta property="og:description" content="<?= $meta['description']; ?>" />

	<?php else: ?>
		<meta name="twitter:title" content="<?= $_SESSION['site_config']['texto_nome']; ?>">
		<meta name="twitter:description" content="<?= $_SESSION['site_config']['texto_rodape']; ?>">
		<meta name="twitter:image"
			content="<?= esc($_SESSION['site_config']['marca_favicon'] ?? site_url('public/assets/logo.webp'), 'attr'); ?>">

		<meta property="og:title" content="<?= $_SESSION['site_config']['texto_nome']; ?>" />
		<meta property="og:image"
			content="<?= esc($_SESSION['site_config']['marca_favicon'] ?? site_url('public/assets/logo.webp'), 'attr'); ?>" />
		<meta property="og:description" content="<?= $_SESSION['site_config']['texto_rodape']; ?>" />
	<?php endif; ?>

	<link rel="stylesheet" href="<?= asset_url('public/css/vendor/mdb.min.css'); ?>">
	<link rel="stylesheet" href="<?= asset_url('public/css/theme-tokens.css'); ?>">
	<link rel="stylesheet" href="<?= asset_url('public/css/theme-dark.css'); ?>">
	<link rel="stylesheet" href="<?= asset_url('public/css/layout-shared.css'); ?>">
	<link rel="stylesheet" href="<?= asset_url('public/css/site-public-layout.css'); ?>">

	<style type="text/css">
		/* Cards verticais: thumb 16:9 (padrão YouTube) + zoom no hover */
		.vl-card-vertical .vl-card-vertical-thumb {
			background-color: var(--bs-secondary-bg);
		}

		.vl-card-vertical .vl-card-vertical-thumb-link {
			display: block;
			line-height: 0;
			width: 100%;
			aspect-ratio: 16 / 9;
			overflow: hidden;
		}

		.vl-card-vertical .vl-card-vertical-thumb-img {
			display: block;
			width: 100%;
			height: 100%;
			object-fit: cover;
			object-position: center center;
			transition: transform 0.45s cubic-bezier(0.33, 1, 0.68, 1);
		}

		.vl-card-vertical .vl-card-vertical-thumb-link .vl-thumb-placeholder {
			width: 100%;
			height: 100%;
		}

		.vl-card-vertical .vl-card-vertical-thumb-link:hover .vl-card-vertical-thumb-img,
		.vl-card-vertical .vl-card-vertical-thumb-link:focus-visible .vl-card-vertical-thumb-img {
			transform: scale(1.08);
		}

		@media (prefers-reduced-motion: reduce) {

			.vl-card-vertical .vl-card-vertical-thumb-img {
				transition: none;
			}

			.vl-card-vertical .vl-card-vertical-thumb-link:hover .vl-card-vertical-thumb-img,
			.vl-card-vertical .vl-card-vertical-thumb-link:focus-visible .vl-card-vertical-thumb-img {
				transform: none;
			}
		}

		/* Espaçamento lateral entre cards (gutter da row costuma ser neutralizado pelo MDB/Masonry) */
		.row.listagem-escritor,
		.row.list-artigos,
		.row.listagem-colaborador {
			margin-left: 0 !important;
			margin-right: 0 !important;
			--bs-gutter-x: 0;
			--bs-gutter-y: 0;
		}

		.row.listagem-escritor>.vl-card-vertical-col,
		.row.list-artigos>.vl-card-vertical-col,
		.row.listagem-colaborador>.vl-card-vertical-col {
			padding-left: 0.875rem;
			padding-right: 0.875rem;
			margin-bottom: 1.25rem;
		}

		@media (min-width: 768px) {

			.row.listagem-escritor>.vl-card-vertical-col,
			.row.list-artigos>.vl-card-vertical-col,
			.row.listagem-colaborador>.vl-card-vertical-col {
				padding-left: 1.125rem;
				padding-right: 1.125rem;
			}
		}

		/* Fundo suave do cartão de perfil (escritor, colaborador, etc.) — #f3c921 da marca */
		.vl-perfil-hero {
			background-color: rgba(var(--vl-brand-rgb), 0.18);
		}

		[data-mdb-theme=dark] .vl-perfil-hero {
			background-color: rgba(var(--vl-brand-rgb), 0.12);
		}

		.vl-conquista-destaque-img {
			width: 8.25rem;
			height: 8.25rem;
			object-fit: cover;
		}

		@media (min-width: 992px) {
			.vl-conquista-destaque-img {
				width: 9.25rem;
				height: 9.25rem;
			}
		}

		.scrolled-down {
			transform: translateY(-100%);
			transition: all 0.6s ease-in-out;
		}

		.scrolled-up {
			transform: translateY(0);
			transition: all 0.6s ease-in-out;
		}

		.button {
			position: fixed;
			bottom: 0.5rem;
			right: 0.5rem;
			padding: 1rem;
			left: 0.1rem;
			right: auto;
			top: 50%;
			bottom: auto;
			z-index: 999;
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

<?php
$vlLogado = isset($_SESSION['colaboradores']) && $_SESSION['colaboradores']['id'] !== null;
$vlPermissoes = $vlLogado ? ($_SESSION['colaboradores']['permissoes'] ?? []) : [];
$vlPodeAdmin = $vlLogado && (
	in_array('7', $vlPermissoes) || in_array('8', $vlPermissoes) || in_array('9', $vlPermissoes) || in_array('10', $vlPermissoes)
);
$vlUri = trim((string) uri_string(), '/');
$vlActive = $active_menu ?? '';
if ($vlActive === '') {
	if ($vlUri === '' || $vlUri === 'site') {
		$vlActive = 'home';
	} elseif (str_starts_with($vlUri, 'site/noticias') || str_starts_with($vlUri, 'site/pauta')) {
		$vlActive = 'noticias';
	} elseif (str_starts_with($vlUri, 'site/videos')) {
		$vlActive = 'videos';
	} elseif (str_starts_with($vlUri, 'site/artigos') || str_starts_with($vlUri, 'site/artigo')) {
		$vlActive = 'artigos';
	} elseif (str_starts_with($vlUri, 'site/contato')) {
		$vlActive = 'contato';
	}
}
$vlNomeSite = $_SESSION['site_config']['texto_nome'];
$vlLogoHeader = esc($_SESSION['site_config']['marca_favicon'] ?? site_url('public/assets/logo.webp'), 'attr');
$vlLogoRodape = esc($_SESSION['site_config']['marca_rodape'] ?? site_url('public/assets/logo.webp'), 'attr');
?>

<body data-mdb-theme="dark">
	<script defer src="<?= asset_url('public/js/vendor/bootstrap-toaster.min.js'); ?>"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
		let toast = {
			title: "",
			message: "",
			status: TOAST_STATUS.SUCCESS,
			timeout: 3500
		}
		Toast.setTheme(TOAST_THEME.DARK);
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

	<header id="gen-header" class="vl-header gen-header-style-1 gen-has-sticky">
		<div class="vl-header-inner gen-bottom-header">
			<div class="d-flex align-items-center" style="gap: 20px; min-width: 0;">
				<a class="navbar-brand" href="<?= site_url('site'); ?>" style="gap: 10px; margin: 0;">
					<img class="img-fluid logo"
						src="<?= $vlLogoHeader; ?>"
						alt="<?= esc($vlNomeSite, 'attr'); ?>"
						width="30" height="30">
					<span style="font-family: var(--vl-font-title); font-weight: 700; font-size: 15px; letter-spacing: 0.03em; color: var(--vl-text); white-space: nowrap;">
						<?= $vlNomeSite; ?>
					</span>
				</a>
				<nav class="vl-nav-pills d-none d-lg-flex" aria-label="Navegação principal">
					<a class="vl-nav-pill<?= $vlActive === 'home' ? ' is-active' : ''; ?>" href="<?= site_url('/'); ?>">Home</a>
					<a class="vl-nav-pill<?= $vlActive === 'noticias' ? ' is-active' : ''; ?>" href="<?= site_url('site/noticias'); ?>">Notícias</a>
					<a class="vl-nav-pill<?= $vlActive === 'videos' ? ' is-active' : ''; ?>" href="<?= site_url('site/videos'); ?>">Vídeos</a>
					<a class="vl-nav-pill<?= $vlActive === 'artigos' ? ' is-active' : ''; ?>" href="<?= site_url('site/artigos'); ?>">Artigos</a>
					<a class="vl-nav-pill<?= $vlActive === 'contato' ? ' is-active' : ''; ?>" href="<?= site_url('site/contato'); ?>">Contato</a>
				</nav>
			</div>
			<div class="d-flex align-items-center" style="gap: 8px; margin: 0;">
				<?php if (!$vlLogado): ?>
					<a href="<?= site_url('site/cadastre-se'); ?>" class="d-none d-md-inline-block"
						style="background: none; border: none; color: var(--vl-muted); font-weight: 600; font-size: 14px; padding: 8px 10px; text-decoration: none; font-family: var(--vl-font-body);">Cadastre-se</a>
					<a href="javascript:void(0)" id="gen-user-btn-login" data-bs-toggle="modal"
						data-bs-target="#header-login-modal"
						style="background: var(--vl-brand); color: var(--vl-brand-text); border: none; font-weight: 700; font-size: 14px; padding: 9px 18px; border-radius: var(--vl-radius); text-decoration: none; font-family: var(--vl-font-body);">Acessar</a>
				<?php else: ?>
					<?php $temRecados = isset($_SESSION['colaboradores']['notificacoes']) && (int) $_SESSION['colaboradores']['notificacoes'] > 0; ?>
					<div class="gen-account-holder">
						<a href="<?= site_url('colaboradores/perfil'); ?>" id="gen-user-btn" class="d-inline-flex align-items-center"
							title="Meu perfil"
							style="gap: 8px; background: none; border: none; color: var(--vl-text); font-size: 14px; font-weight: 600; padding: 6px 8px; border-radius: var(--vl-radius); text-decoration: none; height: auto; width: auto;">
							<span class="position-relative d-inline-block">
								<?= avatar_slot_html(
									'avatar_menu',
									$_SESSION['colaboradores']['avatar'] ?? null,
									'Meu perfil',
									'rounded-circle',
									'width:30px;height:30px;object-fit:cover;'
								); ?>
								<span class="avatar-recados-indicator position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle<?= $temRecados ? '' : ' d-none'; ?>">
									<span class="visually-hidden">Novos recados</span>
								</span>
							</span>
							<span class="d-none d-md-inline apelido_colaborador"><?= esc($_SESSION['colaboradores']['nome']); ?></span>
							<i class="bi bi-chevron-down" aria-hidden="true" style="font-size: 10px; color: var(--vl-muted-2);"></i>
						</a>
						<div class="gen-account-menu">
							<ul>
								<li>
									<a href="<?= site_url('colaboradores/perfil'); ?>">Meu perfil</a>
								</li>
								<li>
									<a class="js-requer-permissao" href="<?= site_url('colaboradores/artigos/meusArtigos'); ?>"
										data-permissoes="2" data-permissao-nome="<?= esc(nome_atribuicao('2'), 'attr'); ?>">Meus artigos</a>
								</li>
								<li>
									<a class="js-requer-permissao" href="<?= site_url('colaboradores/artigos/artigosColaborar'); ?>"
										data-permissoes="3,4,5,6" data-permissao-nome="<?= esc(nome_atribuicao(['3', '4', '5', '6']), 'attr'); ?>">Colaborar</a>
								</li>
								<li>
									<a class="js-requer-permissao" href="<?= site_url('colaboradores/pautas/fechar'); ?>"
										data-permissoes="10" data-permissao-nome="<?= esc(nome_atribuicao('10'), 'attr'); ?>">Pautas</a>
								</li>
								<?php if ($vlPodeAdmin): ?>
									<li aria-hidden="true" style="height: 1px; background: rgba(255,255,255,0.08); margin: 4px 0; padding: 0;"></li>
									<li>
										<a class="js-requer-permissao" href="<?= site_url('colaboradores/admin/dashboard'); ?>"
											data-permissoes="7" data-permissao-nome="<?= esc(nome_atribuicao('7'), 'attr'); ?>"
											style="color: var(--vl-muted-2); font-size: 13px;">Administração</a>
									</li>
								<?php endif; ?>
								<li aria-hidden="true" style="height: 1px; background: rgba(255,255,255,0.08); margin: 4px 0; padding: 0;"></li>
								<li>
									<a href="<?= site_url('site/logout'); ?>" style="color: #e5787c;">Sair</a>
								</li>
							</ul>
						</div>
					</div>
				<?php endif; ?>
				<button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					aria-expanded="false" aria-label="Abrir menu"
					style="width: 36px; height: 36px; border: 1px solid rgba(255,255,255,0.14); border-radius: var(--vl-radius); background: none; color: var(--vl-text); padding: 0;">
					<i class="bi bi-list" aria-hidden="true"></i>
				</button>
			</div>
		</div>
		<div class="collapse d-lg-none" id="navbarSupportedContent" style="border-top: 1px solid var(--vl-border);">
			<ul id="gen-main-menu" class="vl-nav-pills flex-column" style="padding: 8px 16px 16px; gap: 2px;">
				<li class="menu-item<?= $vlActive === 'home' ? ' active' : ''; ?>">
					<a class="vl-nav-pill<?= $vlActive === 'home' ? ' is-active' : ''; ?>" href="<?= site_url('/'); ?>">Home</a>
				</li>
				<li class="menu-item<?= $vlActive === 'noticias' ? ' active' : ''; ?>">
					<a class="vl-nav-pill<?= $vlActive === 'noticias' ? ' is-active' : ''; ?>" href="<?= site_url('site/noticias'); ?>">Notícias</a>
				</li>
				<li class="menu-item<?= $vlActive === 'videos' ? ' active' : ''; ?>">
					<a class="vl-nav-pill<?= $vlActive === 'videos' ? ' is-active' : ''; ?>" href="<?= site_url('site/videos'); ?>">Vídeos</a>
				</li>
				<li class="menu-item<?= $vlActive === 'artigos' ? ' active' : ''; ?>">
					<a class="vl-nav-pill<?= $vlActive === 'artigos' ? ' is-active' : ''; ?>" href="<?= site_url('site/artigos'); ?>">Artigos</a>
				</li>
				<li class="menu-item<?= $vlActive === 'contato' ? ' active' : ''; ?>">
					<a class="vl-nav-pill<?= $vlActive === 'contato' ? ' is-active' : ''; ?>" href="<?= site_url('site/contato'); ?>">Contato</a>
				</li>
				<?php if (!$vlLogado): ?>
					<li class="menu-item menu-item-mobile-auth">
						<a class="vl-nav-pill" href="javascript:void(0)" data-bs-toggle="modal"
							data-bs-target="#header-login-modal">Acessar</a>
					</li>
					<li class="menu-item menu-item-mobile-auth">
						<a class="vl-nav-pill" href="<?= site_url('site/cadastre-se'); ?>">Cadastre-se</a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</header>

	<?= $this->renderSection('content'); ?>

	<?php if (!$vlLogado): ?>
		<div class="modal fade" id="header-login-modal" tabindex="-1" aria-labelledby="header-login-modal-label" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header border-0 pb-0">
						<h5 class="modal-title" id="header-login-modal-label" style="font-family: var(--vl-font-title); font-weight: 700; font-size: 20px;">Acessar minha conta</h5>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
					</div>
					<div class="modal-body">
						<form id="header-login-form" method="post" autocomplete="on">
							<div>
								<label for="header-login-email" style="display: block; font-size: 12px; color: var(--vl-muted); margin-bottom: 6px;">E-mail</label>
								<input type="email" id="header-login-email" name="email" class="form-control" placeholder="E-mail" required>
							</div>
							<div>
								<label for="header-login-senha" style="display: block; font-size: 12px; color: var(--vl-muted); margin-bottom: 6px;">Senha</label>
								<input type="password" id="header-login-senha" name="senha" class="form-control" placeholder="Senha" required>
							</div>
							<?php
							$hcSiteKey = config('Hcaptcha')->siteKey ?? '';
							if (getenv('CI_ENVIRONMENT') !== 'development' && $hcSiteKey !== ''): ?>
								<script src="https://js.hcaptcha.com/1/api.js" async defer></script>
								<div class="d-flex justify-content-center">
									<div class="h-captcha" data-sitekey="<?= esc($hcSiteKey, 'attr'); ?>"></div>
								</div>
							<?php endif; ?>
							<div class="form-check">
								<input type="checkbox" id="header-login-lembrar" name="lembrar" class="form-check-input" value="lembrar">
								<label class="form-check-label" for="header-login-lembrar">Lembre-se de mim</label>
							</div>
							<div class="d-grid">
								<button class="btn btn-primary" type="submit">Entrar</button>
							</div>
							<div class="d-flex justify-content-between gen-login-links" style="margin-top: 4px;">
								<a href="<?= site_url('site/esqueci-senha'); ?>" style="color: var(--vl-muted); text-decoration: underline; font-size: 13px;">Esqueci a senha</a>
								<a href="<?= site_url('site/cadastre-se'); ?>" style="color: var(--vl-brand); font-weight: 600; font-size: 13px;">Cadastre-se</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<footer class="vl-footer">
		<div class="vl-footer-grid">
			<div>
				<div class="d-flex align-items-center" style="gap: 10px; margin-bottom: 10px;">
					<img src="<?= $vlLogoRodape; ?>" alt="" width="24" height="24" style="object-fit: contain;">
					<span style="font-family: var(--vl-font-title); font-weight: 700; font-size: 14px; color: var(--vl-text);"><?= $vlNomeSite; ?></span>
				</div>
				<p><?= $_SESSION['site_config']['texto_rodape']; ?></p>
			</div>
			<div>
				<h5>Navegação</h5>
				<div class="d-flex flex-column" style="gap: 8px;">
					<a href="<?= site_url('site/artigos'); ?>">Artigos</a>
					<a href="<?= site_url('site/contato'); ?>">Contato</a>
					<a href="<?= site_url('site/pagina/faq'); ?>">FAQ</a>
					<a href="<?= site_url('links'); ?>">Todos os projetos</a>
					<a href="<?= site_url('site/calculadoras'); ?>">Calculadoras</a>
					<?php if (isset($_SESSION['site_config']['paginas']['rodape_site'])): ?>
						<?php foreach ($_SESSION['site_config']['paginas']['rodape_site'] as $pagina): ?>
							<a href="<?= site_url('site/pagina/' . $pagina['link']); ?>"><?= $pagina['titulo']; ?></a>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
			<div>
				<h5>Ancapsu</h5>
				<div class="d-flex flex-column" style="gap: 8px;">
					<a href="https://www.youtube.com/@ancap_su"><i class="bi bi-youtube me-2" aria-hidden="true"></i>YouTube</a>
					<a href="https://www.instagram.com/ancap.su"><i class="bi bi-instagram me-2" aria-hidden="true"></i>Instagram</a>
					<a href="https://twitter.com/ancapsu"><i class="bi bi-twitter-x me-2" aria-hidden="true"></i>X (Twitter)</a>
				</div>
			</div>
			<div>
				<h5>Visão Libertária</h5>
				<div class="d-flex flex-column" style="gap: 8px;">
					<a href="https://www.youtube.com/@Visao_Libertaria"><i class="bi bi-youtube me-2" aria-hidden="true"></i>YouTube</a>
					<a href="https://twitter.com/visaolibertaria"><i class="bi bi-twitter-x me-2" aria-hidden="true"></i>X (Twitter)</a>
				</div>
			</div>
		</div>
		<div class="vl-footer-legal">
			<p class="m-0">Desenvolvido e mantido pela comunidade.</p>
		</div>
	</footer>
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
		darkMode = 'dark';
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

	$(function () {
			var qs = new URLSearchParams(window.location.search);
			var deveAbrirLogin = qs.get('openLogin') === '1' || qs.has('next');
			if (deveAbrirLogin) {
				var loginModalEl = document.getElementById('header-login-modal');
				if (loginModalEl && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
					bootstrap.Modal.getOrCreateInstance(loginModalEl).show();
				}

				if (qs.has('openLogin')) {
					qs.delete('openLogin');
					var novaQuery = qs.toString();
					var novaUrl = window.location.pathname + (novaQuery ? ('?' + novaQuery) : '') + window.location.hash;
					window.history.replaceState({}, '', novaUrl);
				}
			}

			$(document).on('click', '#gen-main-menu .menu-item-mobile-auth a, #gen-user-btn-login', function () {
				var navCollapse = document.getElementById('navbarSupportedContent');
				if (navCollapse && navCollapse.classList.contains('show') && typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
					bootstrap.Collapse.getOrCreateInstance(navCollapse).hide();
				}
			});

			$(document).on('submit', '#header-login-form', function (e) {
				e.preventDefault();
				$.ajax({
					type: 'POST',
					async: true,
					url: '<?= base_url() . 'site/login'; ?>',
					data: $(this).serialize(),
					dataType: 'json',
					success: function (retorno) {
						if (retorno.status === true) {
							popMessage('Sucesso!', retorno.mensagem, TOAST_STATUS.SUCCESS);
							setTimeout(function () {
								var next = qs.get('next');
								if (next && next.charAt(0) === '/' && next.charAt(1) !== '/') {
									window.location.href = next;
									return;
								}
								window.location.href = '<?= base_url('colaboradores/perfil'); ?>';
							}, 1000);
						} else {
							popMessage('ATENCAO', retorno.mensagem, TOAST_STATUS.DANGER);
						}
					}
				});
			});
	});

	});
	</script>
</body>

</html>
