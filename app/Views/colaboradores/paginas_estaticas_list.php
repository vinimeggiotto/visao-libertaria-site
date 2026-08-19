<?php

use CodeIgniter\I18n\Time;

?>
<?= $this->extend('layouts/administradores'); ?>

<?= $this->section('content'); ?>
<?= view('colaboradores/partials/vl-painel-styles'); ?>

<div class="vl-painel">
	<div class="row pb-4">
		<div class="col-12">
			<h1 class="vl-painel-title"><?= $titulo; ?></h1>
		</div>
	</div>
	<div class="d-flex mt-3 justify-content-center">
		<a class="btn btn-primary" href="<?= site_url('colaboradores/admin/estaticas/novo'); ?>"> Cadastrar páginas estáticas</a>
	</div>
	<div class="my-3 p-3 rounded box-shadow">

		<div class="vl-card mt-4">
			<div class="card-body p-3">
				<div class="estaticas-list"></div>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
	document.addEventListener('DOMContentLoaded', function () {
	$(document).ready(function () {
		$.ajax({
			url: "<?php echo base_url('colaboradores/admin/estaticasList'); ?>",
			type: 'get',
			dataType: 'html',
			data: {
				
			},
			beforeSend: function () { $('#modal-loading').show(); },
			complete: function () { $('#modal-loading').hide() },
			success: function (data) {
				$('.estaticas-list').html(data);
			}
		});
	});
	});
</script>
<?= $this->endSection(); ?>
