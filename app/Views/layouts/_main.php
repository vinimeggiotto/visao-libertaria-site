<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?= $_SESSION['site_config']['texto_nome']; ?></title>
	<link rel="icon" type="image/x-icon"
		href="<?= esc($_SESSION['site_config']['marca_favicon'] ?? site_url('public/assets/logo.webp'), 'attr'); ?>">
	<link rel="stylesheet" href="<?= asset_url('public/css/vendor/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?= asset_url('public/css/vendor/bootstrap-icons.min.css'); ?>">
	<?= $this->renderSection('head_assets') ?>
	<link rel="stylesheet" href="<?= asset_url('public/css/site-theme.css'); ?>">
	<link rel="stylesheet" href="<?= asset_url('public/css/site-public-layout.css'); ?>">
	<link rel="stylesheet" href="<?= asset_url('public/css/vendor/bootstrap-toaster.min.css'); ?>">

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

<body>
	<?= view('components/_loader'); ?>

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
			<div class="gen-header-info-box d-flex align-items-center" style="gap: 8px; margin: 0;">
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
							<span class="d-none d-md-inline"><?= esc($_SESSION['colaboradores']['nome']); ?></span>
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

	<button type="button" id="back-to-top-btn" aria-label="Voltar ao topo" title="Voltar ao topo">
		<i class="bi bi-arrow-up" aria-hidden="true"></i>
	</button>

	<script defer src="<?= asset_url('public/js/vendor/jquery-3.7.1.min.js'); ?>"></script>
	<script defer src="<?= asset_url('public/js/vendor/bootstrap.bundle.min.js'); ?>"></script>
	<?= $this->renderSection('body_scripts') ?>
	<script defer src="<?= asset_url('public/js/functions.js'); ?>"></script>
	<script defer src="<?= asset_url('public/js/vendor/bootstrap-toaster.min.js'); ?>"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			var toast = {
				title: '',
				message: '',
				status: TOAST_STATUS.SUCCESS,
				timeout: 3500
			};
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

			// Fecha o menu mobile ao abrir o login
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
			// --- Fim do script do menu de usuário ---

			// Fixar navbar ao rolar 300px
			$(window).on('scroll', function () {
				if ($(window).scrollTop() > 300) {
					$('#gen-header').addClass('fixed-navbar');
				} else {
					$('#gen-header').removeClass('fixed-navbar');
				}
			});

			// Back to Top Button
			var backToTopBtn = document.getElementById('back-to-top-btn');
			if (backToTopBtn) {
				var toggleBackToTop = function () {
					if (window.scrollY > 300 || document.documentElement.scrollTop > 300) {
						backToTopBtn.classList.add('show');
					} else {
						backToTopBtn.classList.remove('show');
					}
				};
				window.addEventListener('scroll', toggleBackToTop, { passive: true });
				toggleBackToTop();

				backToTopBtn.addEventListener('click', function (e) {
					e.preventDefault();
					e.stopPropagation();
					// window.scrollTo é mais confiável no mobile do que jQuery.animate(scrollTop)
					var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
					if (!prefersReduced && 'scrollBehavior' in document.documentElement.style) {
						window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
						return;
					}
					window.scrollTo(0, 0);
					document.documentElement.scrollTop = 0;
					document.body.scrollTop = 0;
				});
			}
			});
		});
	</script>
	<?= $this->renderSection('scripts') ?>
	<?= view('components/_aviso_permissao'); ?>
</body>

</html>
