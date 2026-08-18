<?php

if (! function_exists('avatar_tem_foto')) {
	/**
	 * Foto real do colaborador (não vazio e não o PNG-placeholder antigo).
	 */
	function avatar_tem_foto(?string $avatar): bool
	{
		if ($avatar === null) {
			return false;
		}

		$avatar = trim($avatar);

		return $avatar !== '' && ! str_contains($avatar, 'avatar-default.png');
	}
}

if (! function_exists('avatar_html')) {
	/**
	 * <img> da foto ou o ícone Bootstrap `bi-person-circle` no mesmo tamanho.
	 *
	 * @param array<string, string> $imgAttrs
	 */
	function avatar_html(
		?string $avatar,
		string $alt = '',
		string $imgClass = 'rounded-circle',
		string $sizeCss = 'width:2.75rem;height:2.75rem;object-fit:cover;',
		array $imgAttrs = []
	): string {
		$extra = '';
		foreach ($imgAttrs as $nome => $valor) {
			$extra .= ' ' . $nome . '="' . esc((string) $valor, 'attr') . '"';
		}

		if (avatar_tem_foto($avatar)) {
			return '<img src="' . esc($avatar, 'attr') . '" alt="' . esc($alt, 'attr') . '" class="' . esc($imgClass, 'attr') . '" style="' . esc($sizeCss, 'attr') . '"' . $extra . '>';
		}

		$rotulo = $alt !== '' ? $alt : 'Avatar';

		return '<span class="vl-avatar-placeholder ' . esc($imgClass, 'attr') . '" style="' . esc($sizeCss, 'attr') . '" role="img" aria-label="' . esc($rotulo, 'attr') . '"' . $extra . '><i class="bi bi-person-circle" aria-hidden="true"></i></span>';
	}
}

if (! function_exists('avatar_slot_html')) {
	/**
	 * Slot com id estável (preview JS no perfil troca o conteúdo interno).
	 */
	function avatar_slot_html(
		string $id,
		?string $avatar,
		string $alt = '',
		string $imgClass = 'rounded-circle',
		string $sizeCss = 'width:2.75rem;height:2.75rem;object-fit:cover;'
	): string {
		return '<span id="' . esc($id, 'attr') . '" class="vl-avatar-slot">'
			. avatar_html($avatar, $alt, $imgClass, $sizeCss)
			. '</span>';
	}
}
