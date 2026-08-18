(function () {
	function mensagemPermissao(nome) {
		return 'Você não tem a permissão ' + nome + ' para acessar essa área.';
	}

	function mostrarAviso(nome) {
		if (typeof popMessage !== 'function' || typeof TOAST_STATUS === 'undefined') {
			return;
		}
		var status = (typeof TOAST_STATUS.WARNING !== 'undefined') ? TOAST_STATUS.WARNING : TOAST_STATUS.DANGER;
		popMessage('ATENÇÃO', mensagemPermissao(nome || 'necessária'), status, 5000);
	}

	function temPermissao(precisa) {
		var atuais = window.VL_PERMISSOES || [];
		for (var i = 0; i < precisa.length; i++) {
			if (atuais.indexOf(precisa[i]) !== -1) {
				return true;
			}
		}
		return false;
	}

	function mostrarFlash() {
		if (window.VL_AVISO_PERMISSAO) {
			mostrarAviso(window.VL_AVISO_PERMISSAO);
		}
	}

	function iniciar() {
		if (typeof popMessage === 'function') {
			mostrarFlash();
		} else {
			setTimeout(mostrarFlash, 0);
		}

		document.addEventListener('click', function (evento) {
			var alvo = evento.target.closest('.js-requer-permissao');
			if (!alvo) {
				return;
			}
			var precisa = (alvo.getAttribute('data-permissoes') || '').split(',').filter(Boolean);
			if (precisa.length === 0 || temPermissao(precisa)) {
				return;
			}
			evento.preventDefault();
			mostrarAviso(alvo.getAttribute('data-permissao-nome'));
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', iniciar);
	} else {
		iniciar();
	}
})();
