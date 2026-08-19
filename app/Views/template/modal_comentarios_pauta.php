<?php

/**
 * Modal "Comentários da Pauta" (apenas HTML).
 * O JS fica em template/modal_comentarios_pauta_scripts.php, na section scripts.
 */
?>
<?= view('template/vl-ajax-skin'); ?>
<div class="modal fade" id="modalComentariosPauta" tabindex="-1" aria-labelledby="modalComentariosPautaLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content vl-card">
			<div class="modal-header">
				<h3 class="modal-title fs-5" id="modalComentariosPautaLabel">Comentários da Pauta</h3>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
			</div>
			<div class="modal-body">
				<div class="vl-card card border-0 mb-3">
					<div class="card-body py-2 px-3">
						<div class="d-flex gap-3 align-items-start">
							<img src="" class="rounded border modalImagem modal-comentarios-pauta-thumb" alt="">
							<div class="min-w-0 flex-grow-1">
								<div class="modalTitulo fw-semibold small mb-1 lh-sm"></div>
								<div class="modalTexto text-body-secondary modal-comentarios-pauta-texto"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="div-comentarios">
					<div class="text-center mb-2">
						<button class="btn btn-sm px-3" id="btn-comentarios" type="button">Atualizar comentários</button>
					</div>
					<div class="mb-3">
						<input type="hidden" id="idPauta" name="idPauta" />
						<input type="hidden" id="id_comentario" name="id_comentario" />
						<label for="comentario" class="form-label small mb-1">Novo comentário</label>
						<textarea id="comentario" name="comentario" class="form-control form-control-sm" rows="4"
							placeholder="Digite seu comentário aqui"></textarea>
					</div>
					<div class="text-center mb-2">
						<button class="btn btn-primary btn-sm px-4" id="enviar-comentario" type="button">Enviar comentário</button>
					</div>
					<div class="vl-card border rounded-2 p-2 div-list-comentarios overflow-auto small"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-reset" data-bs-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>
