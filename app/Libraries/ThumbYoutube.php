<?php

namespace App\Libraries;

/**
 * Grava a thumb hqdefault do YouTube em public/assets/thumbs/{id}.webp.
 */
class ThumbYoutube
{
	public const PASTA = 'public/assets/thumbs';

	public function caminhoAbsoluto(string $idVideo): string
	{
		return ROOTPATH . self::PASTA . DIRECTORY_SEPARATOR . $idVideo . '.webp';
	}

	public function existe(string $idVideo): bool
	{
		return is_file($this->caminhoAbsoluto($idVideo));
	}

	public function baixar(string $idVideo): bool
	{
		if ($idVideo === '' || ! preg_match('/^[a-zA-Z0-9_-]{11}$/', $idVideo)) {
			return false;
		}

		if ($this->existe($idVideo)) {
			return true;
		}

		$pasta = dirname($this->caminhoAbsoluto($idVideo));
		if (! is_dir($pasta)) {
			mkdir($pasta, 0775, true);
		}

		$destino = $this->caminhoAbsoluto($idVideo);
		$jpgLocal = ROOTPATH . self::PASTA . DIRECTORY_SEPARATOR . $idVideo . '.jpg';
		if (is_file($jpgLocal)) {
			return $this->gravarWebpDeBinario((string) file_get_contents($jpgLocal), $destino);
		}

		$url = 'https://img.youtube.com/vi/' . $idVideo . '/hqdefault.jpg';
		$contexto = stream_context_create([
			'http' => ['timeout' => 8, 'follow_location' => 1],
			'https' => ['timeout' => 8, 'follow_location' => 1],
		]);
		$binario = @file_get_contents($url, false, $contexto);
		if ($binario === false || $binario === '') {
			return false;
		}

		return $this->gravarWebpDeBinario($binario, $destino);
	}

	private function gravarWebpDeBinario(string $binario, string $destino): bool
	{
		$imagem = @imagecreatefromstring($binario);
		if ($imagem === false) {
			return false;
		}

		$ok = imagewebp($imagem, $destino, 80);
		imagedestroy($imagem);

		return $ok !== false;
	}
}
