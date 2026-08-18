<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ColaboradoresAtribuicoes extends Seeder
{
	public function run()
	{
		$faker = Factory::create('pt_BR');
		$qtdFixos = count(ContasFixasDados::contas());

		foreach (ContasFixasDados::contas() as $indice => $conta) {
			$colaboradorId = $indice + 1;
			foreach (ContasFixasDados::atribuicoesDaConta($conta['atribuicao']) as $atribuicaoId) {
				$this->db->table('colaboradores_atribuicoes')->insert([
					'atribuicoes_id' => $atribuicaoId,
					'colaboradores_id' => $colaboradorId,
				]);
			}
		}

		$primeiroAleatorio = $qtdFixos + 1;
		$ultimoAleatorio = $qtdFixos + 1000;

		for ($i = $primeiroAleatorio; $i <= $ultimoAleatorio; $i++) {
			$rand = $faker->numberBetween(1, 100);

			$this->db->table('colaboradores_atribuicoes')->insert([
				'atribuicoes_id' => 1,
				'colaboradores_id' => $i,
			]);

			if ($rand <= 90) {
				$this->db->table('colaboradores_atribuicoes')->insert([
					'atribuicoes_id' => 2,
					'colaboradores_id' => $i,
				]);
			}

			if ($rand <= 10) {
				$this->db->table('colaboradores_atribuicoes')->insert([
					'atribuicoes_id' => 3,
					'colaboradores_id' => $i,
				]);
			}

			if ($rand <= 30) {
				$this->db->table('colaboradores_atribuicoes')->insert([
					'atribuicoes_id' => 4,
					'colaboradores_id' => $i,
				]);
			}

			if ($rand <= 30) {
				$this->db->table('colaboradores_atribuicoes')->insert([
					'atribuicoes_id' => 5,
					'colaboradores_id' => $i,
				]);
			}

			if ($rand <= 5) {
				$this->db->table('colaboradores_atribuicoes')->insert([
					'atribuicoes_id' => 6,
					'colaboradores_id' => $i,
				]);
			}

			if ($rand <= 5) {
				$this->db->table('colaboradores_atribuicoes')->insert([
					'atribuicoes_id' => 7,
					'colaboradores_id' => $i,
				]);
			}

			if ($rand <= 5) {
				$this->db->table('colaboradores_atribuicoes')->insert([
					'atribuicoes_id' => 8,
					'colaboradores_id' => $i,
				]);
			}
		}
	}
}
