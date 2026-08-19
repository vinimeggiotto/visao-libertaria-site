<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

final class AdicionaIndicesERememberToken extends Migration
{
	public function up(): void
	{
		$this->db->query('ALTER TABLE colaboradores ADD COLUMN remember_token VARCHAR(64) NULL DEFAULT NULL');
		$this->db->query('CREATE INDEX idx_colaboradores_remember ON colaboradores (remember_token)');
		$this->db->query('CREATE INDEX idx_colaboradores_email ON colaboradores (email)');
		$this->db->query('CREATE INDEX idx_artigos_url_friendly ON artigos (url_friendly)');
		$this->db->query('CREATE INDEX idx_pautas_link ON pautas (link)');
		$this->db->query('CREATE FULLTEXT INDEX idx_pautas_titulo_texto ON pautas (titulo, texto)');
	}

	public function down(): void
	{
		$this->db->query('DROP INDEX idx_pautas_titulo_texto ON pautas');
		$this->db->query('DROP INDEX idx_pautas_link ON pautas');
		$this->db->query('DROP INDEX idx_artigos_url_friendly ON artigos');
		$this->db->query('DROP INDEX idx_colaboradores_email ON colaboradores');
		$this->db->query('DROP INDEX idx_colaboradores_remember ON colaboradores');
		$this->db->query('ALTER TABLE colaboradores DROP COLUMN remember_token');
	}
}
