<?php

if (! function_exists('asset_url')) {
	/**
	 * URL de CSS/JS local com fingerprint de mtime para cache de 1 mês no deploy.
	 */
	function asset_url(string $caminhoRelativo): string
	{
		$caminhoRelativo = ltrim($caminhoRelativo, '/');
		$absoluto = FCPATH . $caminhoRelativo;
		if (! is_file($absoluto)) {
			$absoluto = ROOTPATH . $caminhoRelativo;
		}

		$url = site_url($caminhoRelativo);
		if (! is_file($absoluto)) {
			return $url;
		}

		return $url . '?v=' . filemtime($absoluto);
	}
}
