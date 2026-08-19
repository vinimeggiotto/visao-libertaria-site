<?php use CodeIgniter\I18n\Time; ?>

<?php if(in_array($estatica['localizacao'],array('menu_site','rodape_site'))): ?>
	<?= $this->extend('layouts/_main'); ?>
<?php elseif(in_array($estatica['localizacao'],array('menu_colaborador'))): ?>
	<?= $this->extend('layouts/colaboradores'); ?>
<?php elseif(in_array($estatica['localizacao'],array('menu_administrador'))): ?>
	<?= $this->extend('layouts/administradores'); ?>
<?php endif; ?>

<?= $this->section('content'); ?>

<div class="vl-container" style="max-width: 760px; padding-top: 56px; padding-bottom: 64px;">
	<h1 style="font-family: var(--vl-font-title); font-size: 30px; font-weight: 700; margin: 0 0 20px;"><?= $estatica['titulo']; ?></h1>
	<div style="font-size: 16px; line-height: 1.7; color: #d8d4cc;">
		<?= str_replace("\n", '<br/>', $estatica['conteudo']); ?>
	</div>
</div>
<?= $this->endSection(); ?>
