<?= $this->extend('layouts/_main'); ?>

<?= $this->section('content'); ?>
<?php $hcSiteKey = config('Hcaptcha')->siteKey ?? ''; ?>

<div class="vl-container" style="max-width: 1080px; padding-top: 56px; padding-bottom: 64px;">
	<div class="row g-5 align-items-start">
		<div class="col-12 col-lg-6">
			<h1 style="font-family: var(--vl-font-title); font-size: 30px; font-weight: 700; margin: 0 0 16px;">Cadastre-se como colaborador</h1>
			<p style="color: var(--vl-muted); font-size: 15px; line-height: 1.6; margin: 0 0 24px;">Use um nome público como preferir ser chamado — ele vai aparecer em artigos e vídeos. Seu e-mail fica visível só para a equipe interna e será confirmado na próxima etapa.</p>
			<div class="d-flex flex-column" style="gap: 16px;">
				<div class="d-flex" style="gap: 12px; align-items: flex-start;">
					<i class="bi bi-check-lg" aria-hidden="true" style="color: var(--vl-brand); font-size: 18px;"></i>
					<span style="font-size: 14px; color: var(--vl-text);">Sugira pautas e comente nas notícias</span>
				</div>
				<div class="d-flex" style="gap: 12px; align-items: flex-start;">
					<i class="bi bi-check-lg" aria-hidden="true" style="color: var(--vl-brand); font-size: 18px;"></i>
					<span style="font-size: 14px; color: var(--vl-text);">Escreva artigos e ganhe satoshis por cada publicação</span>
				</div>
			</div>
		</div>

		<div class="col-12 col-lg-6">
			<div class="vl-card" style="border-radius: 14px; padding: 28px;">
				<form name="cadastrarColaborador" id="cadastrarColaboradorForm">
					<div class="mb-3">
						<label for="apelido" class="form-label" style="font-size: 13px; color: var(--vl-muted); margin-bottom: 6px;">Nome público (apelido)</label>
						<input type="text" class="form-control" id="apelido"
							placeholder="Como quer ser chamado" name="apelido" required
							data-validation-required-message="Por favor digite o seu apelido no site">
					</div>
					<div class="mb-3">
						<label for="email" class="form-label" style="font-size: 13px; color: var(--vl-muted); margin-bottom: 6px;">E-mail</label>
						<input type="email" class="form-control" id="email" placeholder="voce@email.com"
							required name="email" data-validation-required-message="Por favor digite o seu e-mail">
					</div>
					<div class="mb-3">
						<label for="senha" class="form-label" style="font-size: 13px; color: var(--vl-muted); margin-bottom: 6px;">Senha</label>
						<input type="password" class="form-control" id="senha" name="senha"
							placeholder="••••••••" required data-validation-required-message="Por favor digite sua senha">
					</div>
					<div class="mb-3">
						<label for="senhaconfirmacao" class="form-label" style="font-size: 13px; color: var(--vl-muted); margin-bottom: 6px;">Confirme a senha</label>
						<input type="password" class="form-control" name="senhaconfirmacao"
							id="senhaconfirmacao" placeholder="••••••••" required
							data-validation-required-message="Por favor confirme sua senha">
					</div>

					<?php if (getenv('CI_ENVIRONMENT') !== 'development' && $hcSiteKey !== ''): ?>
						<script src="https://js.hcaptcha.com/1/api.js" async defer></script>
						<div class="d-flex justify-content-center my-3">
							<div class="h-captcha" data-sitekey="<?= esc($hcSiteKey, 'attr'); ?>"></div>
						</div>
					<?php endif; ?>

					<div class="d-grid mt-3">
						<button class="btn btn-primary-color btn-submeter" type="button" style="font-weight: 700; font-size: 15px; padding: 14px;">Cadastrar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
	document.addEventListener('DOMContentLoaded', function () {
	$('.btn-submeter').on('click', function () {
		$.ajax({
			type: 'POST',
			async: true,
			url: '<?= base_url() . 'site/cadastre-se'; ?>',
			data: $('#cadastrarColaboradorForm').serialize(),
			dataType: 'json',
			beforeSend: function () { $('#modal-loading').show(); },
			complete: function () { $('#modal-loading').hide(); },
			success: function (retorno) {
				if (retorno.status == true) {
					popMessage('Sucesso!', retorno.mensagem, TOAST_STATUS.SUCCESS);
				} else {
					popMessage('ATENCAO', retorno.mensagem, TOAST_STATUS.DANGER);
				}
			}
		});
	});
	});
</script>
<?= $this->endSection(); ?>
