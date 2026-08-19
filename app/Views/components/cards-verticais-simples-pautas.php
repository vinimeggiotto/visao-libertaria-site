<?php

use CodeIgniter\I18n\Time;

$imagemBruta = trim((string) ($dados['imagem'] ?? ''));
$ehVazia = imagem_publica_eh_vazia($imagemBruta);
$imagemSrc = $ehVazia ? cria_url_placeholder(480, 270) : $imagemBruta;
$hrefPauta = site_url('site/pauta/' . rawurlencode((string) ($dados['id'] ?? '')));
?>
<div class="card vl-card vl-card-h col-12">
	<a href="<?= esc($hrefPauta, 'attr'); ?>" class="text-decoration-none d-block">
		<div class="vl-card-media-4x3">
			<img src="<?= esc($imagemSrc, 'attr'); ?>" alt="<?= esc($dados['titulo'] ?? '', 'attr'); ?>" class="card-img-top" width="480" height="270" loading="lazy" style="width: 100%; height: 100%; object-fit: cover;"<?php if ($ehVazia): ?> onerror="<?= esc(attr_onerror_placeholder(), 'attr'); ?>"<?php endif; ?>>
		</div>
	</a>
	<div class="card-body p-0 d-flex flex-column min-w-0">
		<div class="d-flex flex-wrap align-items-center" style="gap: 10px; font-size: 12px; color: var(--vl-muted-2); margin-bottom: 6px;">
			<span><?= app_time($dados['criado'])->toLocalizedString('dd MMM yyyy'); ?></span>
		</div>
		<h5 class="card-title fw-bold mb-2" style="font-size: 16px; line-height: 1.35;">
			<?php if (($dados['pauta_antiga'] ?? '') == 'S'): ?>
				<i class="bi bi-exclamation-circle-fill" style="font-size: 16px; color: var(--vl-danger);" aria-hidden="true"></i>
			<?php endif; ?>
			<a href="<?= esc($hrefPauta, 'attr'); ?>" class="text-decoration-none" style="color: var(--vl-text);"><?= $dados['titulo']; ?></a>
		</h5>
		<p class="card-text mb-2" style="font-size: 14px; color: var(--vl-muted); display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3; line-clamp: 3; overflow: hidden;"><?= $dados['texto']; ?></p>
		<span style="font-size: 13px; color: var(--vl-muted-2);">sugerido por <a
				href="<?= site_url('site/colaborador/'); ?><?= urlencode($dados['apelido']); ?>"
				style="color: var(--vl-brand); font-weight: 600; text-decoration: none;"><?= $dados['apelido']; ?></a></span>
		<?php if (! empty($dados['link'])): ?>
			<a href="<?= esc($dados['link'], 'attr'); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline-success btn-sm mb-1 mt-2">Ler notícia original</a>
		<?php endif; ?>
		<div class="mt-2 d-flex flex-wrap gap-2">
			<?php if (isset($_SESSION['colaboradores']['id'])):
				$nComentarios = (int) ($dados['qtde_comentarios'] ?? 0);
				$comentariosAria = $nComentarios === 1
					? 'Comentários, 1 comentário'
					: 'Comentários, ' . $nComentarios . ' comentários';
				?>
				<a href="" data-bs-titulo="<?= $dados['titulo']; ?>" data-bs-texto="<?= $dados['texto']; ?>"
					data-bs-pautas-id="<?= $dados['id']; ?>" data-bs-imagem="<?= $dados['imagem']; ?>"
					class="btn btn-outline-info btn-sm mb-1" data-bs-toggle="modal"
					data-bs-target="#modalComentariosPauta"
					aria-label="<?= esc($comentariosAria, 'attr'); ?>">Comentários (<?= $nComentarios; ?>)</a>
				<a href="<?= site_url('colaboradores/artigos/cadastrar?pauta=' . $dados['id']); ?>"
					class="btn btn-outline-primary btn-sm mb-1">Escrever artigo</a>
			<?php endif; ?>
			<?php if (isset($_SESSION['colaboradores']['id']) && (int) ($dados['colaboradores_id'] ?? 0) === (int) $_SESSION['colaboradores']['id']): ?>
				<a href="<?= site_url('colaboradores/pautas/cadastrar/' . $dados['id']); ?>"
					data-bs-pautas-id="<?= $dados['id']; ?>" data-bs-toggle="modal" data-bs-target="#modalSugerirPauta"
					data-bs-titulo-modal="Alterar a pauta" class="btn btn-warning btn-sm mb-1">Editar</a>
			<?php endif; ?>
		</div>
	</div>
</div>
