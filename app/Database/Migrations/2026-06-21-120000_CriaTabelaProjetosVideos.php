<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

final class CriaTabelaProjetosVideos extends Migration
{
	public function up(): void
	{
		$this->forge->addField([
			'video_id' => [
				'type'       => 'VARCHAR',
				'constraint' => 32,
			],
			'titulo' => [
				'type'       => 'VARCHAR',
				'constraint' => 255,
			],
			'projetos_id' => [
				'type'       => 'INT',
				'constraint' => 11,
				'unsigned'   => true,
			],
			'publicado' => [
				'type' => 'DATETIME',
			],
			'thumbnail' => [
				'type'       => 'VARCHAR',
				'constraint' => 512,
				'null'       => true,
			],
		]);

		$this->forge->addPrimaryKey('video_id');
		$this->forge->createTable('projetos_videos', true);
	}

	public function down(): void
	{
		$this->forge->dropTable('projetos_videos', true);
	}
}
