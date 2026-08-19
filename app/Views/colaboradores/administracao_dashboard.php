<?php

use CodeIgniter\I18n\Time;

?>
<?= $this->extend('layouts/administradores'); ?>

<?= $this->section('content'); ?>
<?= view('colaboradores/partials/vl-painel-styles'); ?>

<div class="vl-painel">
		<h1 class="vl-painel-title mb-4">Administração</h1>
		<div class="row g-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px;">
			<div class="vl-stat">
				<div class="vl-stat-value"><?= (($artigos['escritos'] < 10) ? ('0') : ('')) . (number_format($artigos['escritos'], 0, ',', '.')); ?></div>
				<div class="vl-stat-label">Artigos escritos · 30 dias</div>
			</div>
			<div class="vl-stat">
				<div class="vl-stat-value"><?= (($artigos['descartados'] < 10) ? ('0') : ('')) . (number_format($artigos['descartados'], 0, ',', '.')); ?></div>
				<div class="vl-stat-label">Artigos descartados · 30 dias</div>
			</div>
			<div class="vl-stat">
				<div class="vl-stat-value"><?= (($artigos['produzidos'] < 10) ? ('0') : ('')) . (number_format($artigos['produzidos'], 0, ',', '.')); ?></div>
				<div class="vl-stat-label">Artigos produzidos · 30 dias</div>
			</div>
			<div class="vl-stat">
				<div class="vl-stat-value"><?= (($artigos['publicar'] < 10) ? ('0') : ('')) . (number_format($artigos['publicar'], 0, ',', '.')); ?></div>
				<div class="vl-stat-label">Artigos a publicar · 30 dias</div>
			</div>
		</div>
</div>

<?= $this->endSection(); ?>
