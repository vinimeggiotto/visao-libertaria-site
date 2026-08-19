<?php

declare(strict_types=1);

if (! function_exists('cria_url_placeholder')) {
	/**
	 * URL do placehold.co (WebP). Mesmas dimensões/cores = mesma URL = um request em cache.
	 */
	function cria_url_placeholder(int $largura = 480, int $altura = 270): string
	{
		$largura = max(10, min(4000, $largura));
		$altura = max(10, min(4000, $altura));

		return 'https://placehold.co/' . $largura . 'x' . $altura . '/222222/888888.webp';
	}
}

if (! function_exists('cria_url_placeholder_fallback')) {
	/** Catálogo landscape do placehold.net (não gera 480×270). */
	function cria_url_placeholder_fallback(): string
	{
		return 'https://placehold.net/600x400.png';
	}
}

if (! function_exists('attr_onerror_placeholder')) {
	function attr_onerror_placeholder(): string
	{
		return 'this.onerror=null;this.src=\'' . esc(cria_url_placeholder_fallback(), 'attr') . '\'';
	}
}

if (! function_exists('imagem_publica_eh_vazia')) {
	function imagem_publica_eh_vazia(?string $url): bool
	{
		$imagem = trim((string) $url);
		if ($imagem === '') {
			return true;
		}

		return str_contains($imagem, 'imagem-default.webp')
			|| str_contains($imagem, 'imagem-default.png')
			|| str_contains($imagem, 'via.placeholder.com');
	}
}
