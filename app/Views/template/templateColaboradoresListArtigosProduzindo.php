<?php

$temLinhas = $artigos !== null && !empty($artigos);
?>
<?= view('template/vl-ajax-skin'); ?>
<div class="vl-ajax table-responsive rounded border">
	<table class="table table-sm align-middle mb-0 table-hover table-shrink">
		<thead class="listagem-site-thead">
			<tr>
				<th scope="col">Título</th>
				<th scope="col">Status</th>
			</tr>
		</thead>
		<tbody class="border-top-0">
			<?php if ($temLinhas): ?>
				<?php foreach ($artigos as $artigo): ?>
					<?php
					$hrefTitulo = site_url('colaboradores/artigos/detalhamento/' . $artigo['id']);
					if ($artigo['fase_producao_id'] == '1' && $admin !== true) {
						$hrefTitulo = $artigo['link'] ?? $hrefTitulo;
					}
					?>
					<tr>
						<td>
							<a class="fw-semibold small text-decoration-none" href="<?= esc($hrefTitulo, 'attr'); ?>"
								target="_blank" rel="noopener noreferrer"><?= esc($artigo['titulo']); ?></a>
						</td>
						<td>
							<span class="badge bg-<?= $artigo['cor']; ?> bg-opacity-10 text-<?= $artigo['cor']; ?>">
								<?= esc($artigo['nome']); ?>
							</span>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="2" class="p-0">
						<div class="vl-ajax-empty">
							<i class="bi bi-folder2-open fs-2 text-muted mb-2 d-block" aria-hidden="true"></i>
							<p class="fw-semibold text-body mb-1">Nenhum artigo encontrado</p>
							<p class="small text-muted mb-0">Não há artigos nesta fase no momento</p>
						</div>
					</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>
