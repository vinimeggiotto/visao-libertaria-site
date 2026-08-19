<?php
use CodeIgniter\I18n\Time;
/*
Variáveis:
dados = {
imagem,
url,
titulo,
publicacao
?class?
?class-img?
?class-div?
}
*/
$atributosLink = '';
if (!empty($dados['abrir_nova_aba'])) {
    $atributosLink = ' target="_blank" rel="noopener noreferrer"';
}

$tipoH = $dados['tipo_conteudo'] ?? '';
$faseH = isset($dados['fase_producao_id']) ? (int) $dados['fase_producao_id'] : null;
if ($tipoH === 'artigo') {
    $hrefH = ($faseH === 6 || $faseH === 7)
        ? site_url('site/artigo/' . ($dados['id'] ?? ''))
        : site_url('colaboradores/artigos/detalhamento/' . ($dados['id'] ?? ''));
} elseif ($tipoH === 'pauta') {
    $hrefH = site_url('site/pauta/' . ($dados['id'] ?? ''));
} else {
    $hrefH = '#';
}
?>

<?php $semImagemH = isset($dados['class-img']) && $dados['class-img'] === 'd-none'; ?>
<div class="vl-card <?= $semImagemH ? '' : 'vl-card-h'; ?> col-12 <?= (isset($dados['class'])) ? ($dados['class']) : (''); ?> mb-2"<?= $semImagemH ? ' style="padding: 14px;"' : ''; ?>>
    <div class="<?= (isset($dados['class-img'])) ? ($dados['class-img']) : (''); ?>">
        <?php if (! $semImagemH): ?>
        <div class="vl-card-media-4x3">
        <?php if (isset($dados['link_video_youtube'])): ?>
            <?php $ytIdCard = extrair_id_video_youtube($dados['link_video_youtube']); ?>
            <?php if ($ytIdCard !== null): ?>
            <img style="width: 100%; height: 100%; object-fit: cover;" src="<?= cria_url_thumb($ytIdCard); ?>" alt="<?= esc($dados['titulo']); ?>" width="480" height="270" loading="lazy">
            <?php else: ?>
            <img style="width: 100%; height: 100%; object-fit: cover;" src="<?= esc(cria_url_placeholder(), 'attr'); ?>" alt="" width="480" height="270" loading="lazy" onerror="<?= esc(attr_onerror_placeholder(), 'attr'); ?>">
            <?php endif; ?>
        <?php else: ?>
            <?php
            $imagemBrutaH = trim((string) ($dados['imagem'] ?? ''));
            $ehVaziaH = imagem_publica_eh_vazia($imagemBrutaH);
            $imagemSrcH = $ehVaziaH ? cria_url_placeholder() : $imagemBrutaH;
            ?>
            <img style="width: 100%; height: 100%; object-fit: cover;" src="<?= esc($imagemSrcH, 'attr'); ?>" alt="<?= esc($dados['titulo']); ?>" width="480" height="270" loading="lazy"<?php if ($ehVaziaH): ?> onerror="<?= esc(attr_onerror_placeholder(), 'attr'); ?>"<?php endif; ?>>
        <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="<?= (isset($dados['class-div'])) ? ($dados['class-div']) : (''); ?>">
            <h6 class="m-0">
                <a href="<?= esc($hrefH, 'attr'); ?>"
                    class="stretched-link text-decoration-none" style="color: var(--vl-text); font-weight: 700;"<?= $atributosLink; ?>>
                    <?= $dados['titulo'] ?></a>
            </h6>
            <ul class="nav nav-divider align-items-center align-middle mt-1 small">
                <li class="nav-item" style="color: var(--vl-muted-2);">
                    <?php if ($dados['publicacao'] != NULL): ?>
                        <?= app_time($dados['publicacao'])->toLocalizedString('dd MMM yyyy'); ?>
                    <?php else: ?>
                        Não publicado
                    <?php endif; ?>
                </li>
            </ul>
    </div>
</div>
