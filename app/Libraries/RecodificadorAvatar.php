<?php

namespace App\Libraries;

use CodeIgniter\HTTP\Files\UploadedFile;
use Config\Services;

class RecodificadorAvatar
{
	public const LADO_PX = 512;
	public const QUALIDADE = 80;
	public const MAX_KB = 8192;
	public const MAX_DIM = 8000;
	public const EXTENSOES = 'jpg,png,jpeg,webp';

	public function recodificarEGravar(UploadedFile $arquivo, string $idColaborador): string
	{
		if (! function_exists('imagewebp')) {
			throw new \RuntimeException('GD sem suporte a WebP.');
		}

		$id = preg_replace('/[^0-9]/', '', $idColaborador);
		if ($id === '') {
			throw new \RuntimeException('ID do colaborador inválido.');
		}

		$pasta = FCPATH . 'public' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'avatars';
		if (! is_dir($pasta) && ! mkdir($pasta, 0755, true) && ! is_dir($pasta)) {
			throw new \RuntimeException('Não foi possível criar a pasta de avatares.');
		}

		$origem = $arquivo->getTempName();
		if ($origem === '' || ! is_file($origem)) {
			$origem = $arquivo->getRealPath();
		}
		if ($origem === false || $origem === '' || ! is_file($origem)) {
			throw new \RuntimeException('Arquivo temporário do avatar não encontrado.');
		}

		$destino = $pasta . DIRECTORY_SEPARATOR . $id . '.webp';
		$imagem = Services::image()->withFile($origem);
		$imagem->reorient();

		$arquivoImagem = $imagem->getFile();
		$arquivoImagem->origWidth = $imagem->getWidth();
		$arquivoImagem->origHeight = $imagem->getHeight();

		$lado = min(self::LADO_PX, (int) $arquivoImagem->origWidth, (int) $arquivoImagem->origHeight);
		if ($lado < 1) {
			throw new \RuntimeException('Imagem sem dimensões válidas.');
		}

		$imagem->fit($lado, $lado, 'center')
			->convert(IMAGETYPE_WEBP)
			->save($destino, self::QUALIDADE);

		return base_url('public/assets/avatars/' . $id . '.webp?t=' . time());
	}
}
