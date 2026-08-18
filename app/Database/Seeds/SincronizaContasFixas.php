<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Grava as contas fixas num banco que já foi populado (não substitui o Main).
 */
class SincronizaContasFixas extends Seeder
{
	public function run()
	{
		$agora = date('Y-m-d H:i:s');

		foreach (ContasFixasDados::contas() as $conta) {
			$existente = $this->db->table('colaboradores')->where('email', $conta['email'])->get()->getRowArray();

			if ($existente === null) {
				$this->db->table('colaboradores')->insert([
					'apelido' => $conta['apelido'],
					'avatar' => null,
					'email' => $conta['email'],
					'carteira' => null,
					'senha' => ContasFixasDados::senhaHash(),
					'strike_data' => null,
					'pontuacao_total' => 0,
					'pontuacao_mensal' => 0,
					'confirmacao_hash' => hash('sha256', $conta['email'] . 'fixo'),
					'criado' => $agora,
					'atualizado' => $agora,
					'confirmado_data' => $agora,
					'excluido' => null,
					'bloqueado' => 'N',
					'shadowban' => 'N',
				]);
				$colaboradorId = (int) $this->db->insertID();
			} else {
				$colaboradorId = (int) $existente['id'];
				$this->db->table('colaboradores')->where('id', $colaboradorId)->update([
					'apelido' => $conta['apelido'],
					'senha' => ContasFixasDados::senhaHash(),
					'atualizado' => $agora,
					'confirmado_data' => $existente['confirmado_data'] ?? $agora,
					'excluido' => null,
					'bloqueado' => 'N',
				]);
			}

			$this->db->table('colaboradores_atribuicoes')->where('colaboradores_id', $colaboradorId)->delete();
			foreach (ContasFixasDados::atribuicoesDaConta($conta['atribuicao']) as $atribuicaoId) {
				$this->db->table('colaboradores_atribuicoes')->insert([
					'colaboradores_id' => $colaboradorId,
					'atribuicoes_id' => $atribuicaoId,
				]);
			}
		}
	}
}
