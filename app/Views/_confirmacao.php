<?= $this->extend('layouts/_main'); ?>

<?= $this->section('content'); ?>

<div class="vl-container" style="max-width: 480px; padding-top: 80px; padding-bottom: 80px; text-align: center;">
	<div style="font-size: 48px; margin-bottom: 16px; color: #4ade80;" aria-hidden="true">
		<i class="bi bi-check-circle-fill"></i>
	</div>
	<h1 style="font-family: var(--vl-font-title); font-size: 24px; font-weight: 700; margin: 0 0 12px;">E-mail confirmado</h1>
	<p style="color: var(--vl-muted); font-size: 14px; line-height: 1.6; margin: 0 0 24px;">Sua conta está ativa. Você já pode acessar com seu e-mail e senha.</p>
	<button type="button" class="btn btn-primary-color" style="font-weight: 700; font-size: 14px; padding: 12px 22px;"
		data-bs-toggle="modal" data-bs-target="#header-login-modal">Acessar minha conta</button>
</div>

<?= $this->endSection(); ?>
