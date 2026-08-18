<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

final class AdicionaColunasProjetosListarECanal extends Migration
{
	public function up(): void
	{
		$this->forge->addColumn('projetos', [
			'listar' => [
				'type'       => 'CHAR',
				'constraint' => 1,
				'null'       => false,
				'default'    => 'N',
				'after'      => 'descricao',
			],
			'canal_youtube_id' => [
				'type'       => 'VARCHAR',
				'constraint' => 64,
				'null'       => true,
				'default'    => null,
				'after'      => 'listar',
			],
		]);
	}

	public function down(): void
	{
		$this->forge->dropColumn('projetos', ['listar', 'canal_youtube_id']);
	}
}
