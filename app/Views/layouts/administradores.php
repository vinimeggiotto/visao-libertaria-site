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
	<link rel="stylesheet" href="<?= asset_url('public/css/site-public-layout.css'); ?>">

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

<?php
$vlNomeSite = $_SESSION['site_config']['texto_nome'];
$vlLogoHeader = esc($_SESSION['site_config']['marca_favicon'] ?? site_url('public/assets/logo.webp'), 'attr');
$vlCaminho = trim((string) uri_string(), '/');
$vlLinkAtivo = static function (string $path) use ($vlCaminho): bool {
	$path = trim($path, '/');
	return $vlCaminho === $path || str_starts_with($vlCaminho, $path . '/');
};
$vlPodeAdmin = in_array('7', $_SESSION['colaboradores']['permissoes'])
	|| in_array('8', $_SESSION['colaboradores']['permissoes'])
	|| in_array('9', $_SESSION['colaboradores']['permissoes'])
	|| in_array('10', $_SESSION['colaboradores']['permissoes']);
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

	<header class="vl-header">
		<div class="vl-header-inner">
			<a class="navbar-brand js-requer-permissao" href="<?= site_url('colaboradores/artigos/dashboard'); ?>"
				data-permissoes="2" data-permissao-nome="<?= esc(nome_atribuicao('2'), 'attr'); ?>"
				style="gap: 10px; margin: 0;">
				<img class="img-fluid logo"
					src="<?= $vlLogoHeader; ?>"
					alt="<?= esc($vlNomeSite, 'attr'); ?>"
					width="30" height="30">
				<span style="font-family: var(--vl-font-title); font-weight: 700; font-size: 15px; letter-spacing: 0.03em; color: var(--vl-text); white-space: nowrap;">
					<?= $vlNomeSite; ?>
				</span>
			</a>
			<div class="d-flex align-items-center" style="gap: 8px;">
				<?php if (isset($_SESSION) && $_SESSION['colaboradores']['id'] !== null): ?>
					<?php $temRecados = isset($_SESSION['colaboradores']['notificacoes']) && (int) $_SESSION['colaboradores']['notificacoes'] > 0; ?>
					<div class="dropdown">
						<a class="nav-link dropdown-toggle d-inline-flex align-items-center" href="<?= site_url('colaboradores/perfil'); ?>" id="navbarDropdownMenuLink" role="button"
							data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
							style="gap: 8px; color: var(--vl-text);">
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
							<span class="apelido_colaborador d-none d-md-inline">
								<?= $_SESSION['colaboradores']['nome']; ?>
							</span>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background: var(--vl-surface); border: 1px solid rgba(255,255,255,0.12); border-radius: 10px; min-width: 180px;">
							<a class="dropdown-item" href="<?= site_url('colaboradores/perfil'); ?>">Meu
								Perfil</a>
							<a class="dropdown-item" href="<?= site_url('site/logout'); ?>" style="color: #e5787c;">Sair</a>
						</div>
					</div>
				<?php endif; ?>
				<button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
					data-bs-target="#menuPrincipal" aria-controls="menuPrincipal"
					aria-expanded="false" aria-label="Abrir menu"
					style="width: 36px; height: 36px; border: 1px solid rgba(255,255,255,0.14); border-radius: var(--vl-radius); background: none; color: var(--vl-text); padding: 0;">
					<i class="bi bi-list" aria-hidden="true"></i>
				</button>
			</div>
		</div>
	</header>

	<div class="vl-container d-flex flex-column flex-lg-row" style="gap: 32px;">
		<aside class="vl-sidebar collapse d-lg-flex" id="menuPrincipal" aria-label="Menu da administração">
			<?php if (isset($_SESSION) && $_SESSION['colaboradores']['id'] !== null): ?>
				<a class="vl-sidebar-link<?= $vlLinkAtivo('colaboradores/perfil') ? ' is-active' : ''; ?>" href="<?= site_url('colaboradores/perfil'); ?>">Área do colaborador</a>
			<?php endif; ?>
			<?php if ($vlPodeAdmin): ?>
				<a class="vl-sidebar-link" href="<?= site_url('site'); ?>">Voltar ao site</a>
			<?php endif; ?>

			<a class="vl-sidebar-link js-requer-permissao<?= $vlLinkAtivo('colaboradores/admin/dashboard') ? ' is-active' : ''; ?>"
				href="<?= site_url('colaboradores/admin/dashboard'); ?>"
				data-permissoes="7" data-permissao-nome="<?= esc(nome_atribuicao('7'), 'attr'); ?>">
				<i class="bi bi-globe" aria-hidden="true"></i> Dashboard
			</a>

			<?php if (isset($_SESSION) && $_SESSION['colaboradores']['id'] != null): ?>
				<?php if (in_array('10', $_SESSION['colaboradores']['permissoes'])): ?>
					<span style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--vl-muted-2); padding: 12px 12px 4px;">Pautas</span>
					<a class="vl-sidebar-link<?= $vlLinkAtivo('colaboradores/pautas/fechar') ? ' is-active' : ''; ?>"
						href="<?= site_url('colaboradores/pautas/fechar'); ?>">Fechar pautas</a>
					<a class="vl-sidebar-link<?= $vlLinkAtivo('colaboradores/pautas/fechadas') ? ' is-active' : ''; ?>"
						href="<?= site_url('colaboradores/pautas/fechadas'); ?>">Pautas fechadas</a>
				<?php endif; ?>
				<?php if (in_array('7', $_SESSION['colaboradores']['permissoes'])): ?>
					<span style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--vl-muted-2); padding: 12px 12px 4px;">Configurações</span>
					<a class="vl-sidebar-link<?= $vlLinkAtivo('colaboradores/admin/configuracoes') ? ' is-active' : ''; ?>"
						href="<?= site_url('colaboradores/admin/configuracoes'); ?>">Configurações gerais</a>
					<a class="vl-sidebar-link<?= $vlLinkAtivo('colaboradores/admin/layout') ? ' is-active' : ''; ?>"
						href="<?= site_url('colaboradores/admin/layout'); ?>">Layout e configuração dos sites</a>
					<a class="vl-sidebar-link<?= $vlLinkAtivo('colaboradores/admin/regras') ? ' is-active' : ''; ?>"
						href="<?= site_url('colaboradores/admin/regras'); ?>">Regras para colaborar</a>
					<a class="vl-sidebar-link<?= $vlLinkAtivo('colaboradores/admin/estaticas') ? ' is-active' : ''; ?>"
						href="<?= site_url('colaboradores/admin/estaticas'); ?>">Páginas estáticas</a>
				<?php endif; ?>
				<?php if (in_array('8', $_SESSION['colaboradores']['permissoes'])): ?>
					<a class="vl-sidebar-link<?= $vlLinkAtivo('colaboradores/admin/financeiro') ? ' is-active' : ''; ?>"
						href="<?= site_url('colaboradores/admin/financeiro'); ?>">
						<i class="bi bi-currency-bitcoin" aria-hidden="true"></i> Financeiro
					</a>
				<?php endif; ?>
				<?php if (in_array('8', $_SESSION['colaboradores']['permissoes'])): ?>
					<span style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--vl-muted-2); padding: 12px 12px 4px;">Colaboradores</span>
					<a class="vl-sidebar-link js-requer-permissao<?= $vlLinkAtivo('colaboradores/admin/permissoes') ? ' is-active' : ''; ?>"
						href="<?= site_url('colaboradores/admin/permissoes'); ?>"
						data-permissoes="9" data-permissao-nome="<?= esc(nome_atribuicao('9'), 'attr'); ?>">Colaboradores</a>
					<a class="vl-sidebar-link js-requer-permissao<?= $vlLinkAtivo('colaboradores/admin/contatos') ? ' is-active' : ''; ?>"
						href="<?= site_url('colaboradores/admin/contatos'); ?>"
						data-permissoes="7" data-permissao-nome="<?= esc(nome_atribuicao('7'), 'attr'); ?>">Mensagens de contato</a>
				<?php endif; ?>
			<?php endif; ?>

			<?php if (isset($_SESSION) && isset($_SESSION['site_config']['paginas']['menu_administrador'])): ?>
				<span style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--vl-muted-2); padding: 12px 12px 4px;">Páginas</span>
				<?php foreach ($_SESSION['site_config']['paginas']['menu_administrador'] as $pagina): ?>
					<a class="vl-sidebar-link" href="<?= site_url('site/pagina/' . $pagina['link']); ?>"><?= $pagina['titulo']; ?></a>
				<?php endforeach; ?>
			<?php endif; ?>
		</aside>
		<div style="flex: 1; min-width: 0;">
			<?= $this->renderSection('content'); ?>
		</div>
	</div>

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
