<?php

if (! function_exists('caminho_retorno_login')) {
	/**
	 * Path interno seguro para voltar depois do login. Recusa URL absoluta e protocol-relative.
	 */
	function caminho_retorno_login(?string $candidato): ?string
	{
		if ($candidato === null) {
			return null;
		}

		$candidato = trim($candidato);
		if ($candidato === '' || $candidato === '/') {
			return null;
		}

		if (
			str_contains($candidato, "\0")
			|| str_contains($candidato, "\r")
			|| str_contains($candidato, "\n")
			|| str_contains($candidato, '\\')
			|| str_contains($candidato, '://')
		) {
			return null;
		}

		if (! str_starts_with($candidato, '/') || str_starts_with($candidato, '//')) {
			return null;
		}

		return $candidato;
	}
}

if (! function_exists('caminho_atual_retorno_login')) {
	/**
	 * Path + query da requisição atual (sem host).
	 */
	function caminho_atual_retorno_login(): string
	{
		$uri  = service('request')->getUri();
		$path = $uri->getPath();
		if ($path === '' || $path[0] !== '/') {
			$path = '/' . ltrim($path, '/');
		}

		$query = $uri->getQuery();
		if ($query !== '') {
			$path .= '?' . $query;
		}

		return $path;
	}
}

if (! function_exists('url_home_com_login')) {
	/**
	 * Home pública com modal de login e next opcional.
	 */
	function url_home_com_login(?string $next = null): string
	{
		$params = ['openLogin' => '1'];
		$seguro = caminho_retorno_login($next);
		if ($seguro !== null) {
			$params['next'] = $seguro;
		}

		return site_url('site') . '?' . http_build_query($params);
	}
}
