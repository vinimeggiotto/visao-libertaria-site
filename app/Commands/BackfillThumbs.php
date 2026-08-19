<?php

namespace App\Commands;

use App\Libraries\ThumbYoutube;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class BackfillThumbs extends BaseCommand
{
	protected $group = 'Performance';
	protected $name = 'thumbs:backfill';
	protected $description = 'Baixa thumbs hqdefault do YouTube para public/assets/thumbs.';

	public function run(array $params)
	{
		helper('_formata_video');

		$thumbs = new ThumbYoutube();
		$ids = [];

		$videos = db_connect()->table('projetos_videos')->select('video_id')->get()->getResultArray();
		foreach ($videos as $video) {
			if (! empty($video['video_id'])) {
				$ids[] = $video['video_id'];
			}
		}

		$artigos = db_connect()->table('artigos')->select('link_video_youtube')->get()->getResultArray();
		foreach ($artigos as $artigo) {
			$id = extrair_id_video_youtube($artigo['link_video_youtube'] ?? null);
			if ($id !== null) {
				$ids[] = $id;
			}
		}

		$ids = array_values(array_unique($ids));
		$ok = 0;
		$falha = 0;

		foreach ($ids as $id) {
			if ($thumbs->baixar($id)) {
				$ok++;
			} else {
				$falha++;
				CLI::write('Falha: ' . $id, 'red');
			}
		}

		CLI::write("Thumbs gravadas: {$ok}. Falhas: {$falha}.", $falha > 0 ? 'yellow' : 'green');
	}
}
