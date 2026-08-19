<?php

/**
 * Init JS + listener de abertura do modal "Comentários da Pauta".
 * Incluir só na section scripts das views que usam o HTML do modal.
 *
 * @var array<string, mixed>|null $comentariosConfig Opcional: sobrescreve chaves do config (merge com defaults).
 */
$comentariosConfig = array_merge([
	'endpointPrefix'   => base_url('colaboradores/pautas/comentarios/'),
	'entityIdSelector' => '#idPauta',
	'autoLoad'         => false,
], $comentariosConfig ?? []);

?>
<?= view('template/colaboradores_comentarios_init', [
	'comentariosConfig' => $comentariosConfig,
]); ?>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		const modalComentarios = document.getElementById('modalComentariosPauta');
		if (modalComentarios) {
			modalComentarios.addEventListener('show.bs.modal', event => {
				const trigger = event.relatedTarget && event.relatedTarget.closest('[data-bs-pautas-id]');
				if (!trigger) {
					return;
				}

				$('.modalImagem').attr('src', trigger.getAttribute('data-bs-imagem'));
				$('.modalTexto').html(trigger.getAttribute('data-bs-texto'));
				$('.modalTitulo').html(trigger.getAttribute('data-bs-titulo'));
				$('#idPauta').val(trigger.getAttribute('data-bs-pautas-id'));
				getComentarios();
			});
		}
	});
</script>
