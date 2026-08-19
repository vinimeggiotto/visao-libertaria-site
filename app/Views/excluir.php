<?= $this->extend('layouts/_main'); ?>

<?= $this->section('content'); ?>

<div class="vl-container" style="max-width: 560px; padding-top: 80px; padding-bottom: 80px; text-align: center;">
	<div class="vl-card" style="border-radius: 14px; padding: 36px;">
		<h1 style="font-family: var(--vl-font-title); font-size: 24px; font-weight: 700; margin: 0 0 16px;">Exclusão de conta</h1>
		<?php if (!empty($mensagem)): ?>
			<p style="color: var(--vl-muted); font-size: 14px; line-height: 1.6; margin: 0 0 24px;"><?= esc($mensagem); ?></p>
		<?php else: ?>
			<p style="color: var(--vl-muted); font-size: 14px; line-height: 1.6; margin: 0 0 24px;">Não foi possível concluir a exclusão. Faça login novamente ou solicite um novo e-mail de confirmação.</p>
		<?php endif; ?>
		<a class="btn btn-primary-color" href="<?= site_url('site'); ?>" style="font-weight: 700; font-size: 14px; padding: 12px 22px;">Voltar ao site</a>
	</div>
</div>

<?= $this->endSection(); ?>
