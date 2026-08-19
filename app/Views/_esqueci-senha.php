<?= $this->extend('layouts/_main'); ?>

<?= $this->section('content'); ?>
<?php $hcSiteKey = config('Hcaptcha')->siteKey ?? ''; ?>

<div class="vl-container" style="max-width: 480px; padding-top: 56px; padding-bottom: 64px;">
	<h1 style="font-family: var(--vl-font-title); font-size: 24px; font-weight: 700; text-align: center; margin: 0 0 24px;">Recuperação de conta</h1>
	<form class="vl-card" style="border-radius: 14px; padding: 28px;" id="esqueci" method="post">
		<?php if ($formulario == 'email'): ?>
			<div class="mb-3">
				<label for="email" class="form-label" style="font-size: 13px; color: var(--vl-muted); margin-bottom: 6px;">E-mail cadastrado na plataforma</label>
				<input type="email" id="email" name="email" class="form-control"
					placeholder="voce@email.com" required autofocus />
			</div>
		<?php elseif ($formulario == 'senha'): ?>
			<p style="font-size: 13px; color: var(--vl-muted); margin: 0 0 16px;">Link de recuperação confirmado. Defina sua nova senha.</p>
			<div class="mb-3">
				<label for="senha" class="form-label" style="font-size: 13px; color: var(--vl-muted); margin-bottom: 6px;">Nova senha</label>
				<input type="password" id="senha" name="senha" class="form-control"
					placeholder="••••••••" required autofocus />
			</div>
			<div class="mb-3">
				<label for="senhaconfirmacao" class="form-label" style="font-size: 13px; color: var(--vl-muted); margin-bottom: 6px;">Confirme a nova senha</label>
				<input type="password" id="senhaconfirmacao" name="senhaconfirmacao"
					class="form-control"
					placeholder="••••••••" required />
			</div>
		<?php endif; ?>

		<?php if (getenv('CI_ENVIRONMENT') !== 'development' && $hcSiteKey !== ''): ?>
			<script src="https://js.hcaptcha.com/1/api.js" async defer></script>
			<div class="d-flex justify-content-center my-3">
				<div class="h-captcha" data-sitekey="<?= esc($hcSiteKey, 'attr'); ?>"></div>
			</div>
		<?php endif; ?>

		<div class="d-grid mt-2">
			<button class="btn btn-primary-color btn-submeter" type="button" style="font-weight: 700; font-size: 15px; padding: 14px;"><?= ($formulario == 'senha') ? 'Salvar nova senha' : 'Enviar'; ?></button>
		</div>
	</form>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function () {
	$('#esqueci').on('submit', function (e) {
		e.preventDefault();
	});

	$('.btn-submeter').on('click', function () {
		$.ajax({
			type: 'POST',
			async: true,
			url: window.location.href,
			data: $('#esqueci').serialize(),
			dataType: 'json',
			beforeSend: function () { $('#modal-loading').show(); },
			complete: function () { $('#modal-loading').hide(); },
			success: function (retorno) {
				if (retorno.status == true) {
					popMessage('Sucesso!', retorno.mensagem, TOAST_STATUS.SUCCESS);
					<?php if ($formulario == 'senha'): ?>
						$('#esqueci').hide();
						setTimeout(function () {
							document.location.href = <?= json_encode(url_home_com_login()); ?>;
						}, 5000);
					<?php endif; ?>
				} else {
					popMessage('ATENCAO', retorno.mensagem, TOAST_STATUS.DANGER);
				}
			}
		});
	});
	});
</script>
<?= $this->endSection(); ?>
