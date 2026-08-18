<?php

namespace App\Database;

use CodeIgniter\Database\MigrationRunner;

class AppMigrationRunner extends MigrationRunner
{
	public function findNamespaceMigrations(string $namespace): array
	{
		$migrations = [];
		$diretorios = $this->listarDiretoriosDeMigrations($namespace);

		foreach ($diretorios as $diretorio) {
			$arquivos = glob($diretorio . '/*.php');
			if ($arquivos === false) {
				continue;
			}

			foreach ($arquivos as $arquivo) {
				$migration = $this->migrationFromFile($arquivo, $namespace);
				if ($migration !== false) {
					$migrations[] = $migration;
				}
			}
		}

		return $migrations;
	}

	/**
	 * @return list<string>
	 */
	private function listarDiretoriosDeMigrations(string $namespace): array
	{
		if (!empty($this->path)) {
			$diretorio = rtrim($this->path, '\\/');
			return is_dir($diretorio) ? [$diretorio] : [];
		}

		$diretorios = [];
		foreach (service('autoloader')->getNamespace($namespace) as $caminhoNamespace) {
			$diretorio = rtrim($caminhoNamespace, '\\/') . '/Database/Migrations';
			if (is_dir($diretorio)) {
				$diretorios[] = $diretorio;
			}
		}

		return $diretorios;
	}
}
