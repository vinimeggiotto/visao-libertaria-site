<?= $this->extend('layouts/_main'); ?>

<?= $this->section('content'); ?>
<?php
$hcSiteKey = config('Hcaptcha')->siteKey ?? '';
?>

<div class="vl-container" style="max-width: 1080px; padding-top: 56px; padding-bottom: 64px;">
	<div class="row g-4 align-items-start">
		<div class="col-12 col-lg-5">
			<div class="vl-card" style="border-radius: 14px; padding: 24px;">
				<h2 style="font-family: var(--vl-font-title); font-size: 16px; font-weight: 700; margin: 0 0 10px;">
					<i class="bi bi-exclamation-triangle-fill pe-1" aria-hidden="true" style="color: var(--vl-brand);"></i>Atenção
				</h2>
				<p style="color: var(--vl-muted); font-size: 13px; line-height: 1.6; margin: 0 0 10px;">
					Este não é um local para sugerir pautas. Para isso,
					<a href="<?= site_url('site/cadastre-se'); ?>" style="color: var(--vl-brand);">cadastre-se na plataforma</a>
					ou
					<button type="button"
						class="btn btn-link p-0 align-baseline border-0 shadow-none vl-contato-login-link"
						style="color: var(--vl-brand); text-decoration: underline; font-size: 13px;"
						data-bs-toggle="modal" data-bs-target="#header-login-modal">acesse a sua conta</button>.
				</p>
				<p style="color: var(--vl-muted); font-size: 13px; line-height: 1.6; margin: 0;">
					Contatos com esse fim não serão considerados e podem entrar em uma blacklist.
				</p>
			</div>
		</div>

		<div class="col-12 col-lg-7">
			<div class="vl-card" style="border-radius: 14px; padding: 28px;">
				<h2 style="font-family: var(--vl-font-title); font-size: 18px; font-weight: 700; margin: 0 0 18px;">Entre em contato conosco</h2>
				<form id="contato" method="post" action="<?= base_url('site/contato'); ?>">
					<div class="mb-3">
						<label class="form-label" style="font-size: 13px; color: var(--vl-muted); margin-bottom: 6px;" for="email">E-mail</label>
						<input type="email" id="email" name="email"
							class="form-control"
							value="<?= esc($email ?? ''); ?>" placeholder="Seu e-mail" autocomplete="email" required
							autofocus />
					</div>
					<div class="mb-3">
						<label class="form-label" style="font-size: 13px; color: var(--vl-muted); margin-bottom: 6px;" for="select-assunto">Assunto</label>
						<select class="form-select" id="select-assunto"
							name="select-assunto" required>
							<option value="" data-description="" selected disabled>Selecione um assunto</option>
							<?php foreach ($assuntos as $assunto): ?>
								<option value="<?= esc($assunto['id']); ?>"
									data-description="<?= esc($assunto['descricao'] ?? '', 'attr'); ?>"><?= esc($assunto['assunto']); ?></option>
							<?php endforeach; ?>
						</select>
						<small class="descricao d-block mt-1" style="color: var(--vl-muted-2);" role="status" aria-live="polite"></small>
					</div>
					<div class="mb-3">
						<label class="form-label d-none" style="font-size: 13px; color: var(--vl-muted); margin-bottom: 6px;" for="redesocial">Rede social</label>
						<input type="text" id="redesocial" name="redesocial"
							class="form-control d-none"
							placeholder="Rede social que sofreu bloqueio" />
					</div>
					<div class="mb-3">
						<label class="form-label d-none" style="font-size: 13px; color: var(--vl-muted); margin-bottom: 6px;" for="perfil">Perfil</label>
						<input type="text" id="perfil" name="perfil"
							class="form-control d-none"
							placeholder="Nome do perfil que foi bloqueado" />
					</div>
					<div class="vl-contato-msg-wrap mb-3">
						<label class="form-label" style="font-size: 13px; color: var(--vl-muted); margin-bottom: 6px;" for="mensagem">Mensagem</label>
						<textarea id="mensagem" name="mensagem"
							class="form-control" rows="5"
							placeholder="Digite sua mensagem aqui." maxlength="1000" required
							style="resize: vertical; min-height: 96px;"></textarea>
					</div>

					<?php if (getenv('CI_ENVIRONMENT') !== 'development' && $hcSiteKey !== ''): ?>
						<script src="https://js.hcaptcha.com/1/api.js" async defer></script>
						<div class="d-flex justify-content-center vl-contato-captcha-wrap my-3">
							<div class="h-captcha" data-sitekey="<?= esc($hcSiteKey, 'attr'); ?>"></div>
						</div>
					<?php endif; ?>

					<div class="d-grid vl-contato-acoes-envio">
						<button class="btn btn-primary-color btn-submeter" type="submit" style="font-weight: 700; font-size: 15px; padding: 14px;">Enviar mensagem</button>
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
	(function () {
		var $form = $('#contato');
		var $btn = $form.find('.btn-submeter');
		var labelEnviar = 'Enviar mensagem';
		var labelEnviando = 'Enviando...';

		$form.on('submit', function (e) {
			e.preventDefault();
			if ($btn.prop('disabled')) {
				return;
			}
			var redirecionar = false;
			$btn.prop('disabled', true).text(labelEnviando);
			$.ajax({
				type: 'POST',
				url: $form.attr('action'),
				data: $form.serialize(),
				dataType: 'json',
				beforeSend: function () { $('#modal-loading').show(); },
				complete: function () {
					$('#modal-loading').hide();
					if (!redirecionar) {
						$btn.prop('disabled', false).text(labelEnviar);
					}
				},
				success: function (retorno) {
					if (retorno && retorno.status === true) {
						redirecionar = true;
						popMessage('Sucesso!', retorno.mensagem, TOAST_STATUS.SUCCESS);
						setTimeout(function () {
							window.location.href = '<?= site_url('site'); ?>';
						}, 3000);
					} else {
						var msg = (retorno && retorno.mensagem) ? retorno.mensagem : 'Não foi possível enviar. Verifique os dados e tente de novo.';
						popMessage('ATENÇÃO', msg, TOAST_STATUS.DANGER);
					}
				},
				error: function (xhr) {
					var msg = 'Erro de comunicação com o servidor. Tente novamente em instantes.';
					if (xhr.responseJSON && xhr.responseJSON.mensagem) {
						msg = xhr.responseJSON.mensagem;
					}
					popMessage('ATENÇÃO', msg, TOAST_STATUS.DANGER);
				}
			});
		});
	})();

	$('#select-assunto').on('change', function () {
		var selectedOption = $(this).find('option:selected');
		var description = selectedOption[0].dataset.description || '';
		$('.descricao').text(description);

		if ($(this).val() === '2') {
			$('#perfil, #redesocial').removeClass('d-none');
			$('label[for="perfil"], label[for="redesocial"]').removeClass('d-none');
		} else {
			$('#perfil, #redesocial').addClass('d-none').val('');
			$('label[for="perfil"], label[for="redesocial"]').addClass('d-none');
		}
	});
	});
</script>

<?= $this->endSection(); ?>
