<?php

namespace App\Database\Seeds;

/**
 * Contas de teste com e-mail fixo. Inseridas no seed antes dos colaboradores aleatórios.
 */
class ContasFixasDados
{
	public const SENHA = '12345678';

	/**
	 * Uma conta por atribuição, na ordem dos IDs de `atribuicoes`.
	 * Todas recebem também a atribuição 1 (Colaborador), exceto a própria conta 1.
	 *
	 * @return list<array{apelido: string, email: string, atribuicao: int}>
	 */
	public static function contas(): array
	{
		return [
			['apelido' => 'Colaborador', 'email' => 'colaborador@colaborador.com', 'atribuicao' => 1],
			['apelido' => 'Escritor', 'email' => 'escritor@escritor.com', 'atribuicao' => 2],
			['apelido' => 'Revisor', 'email' => 'revisor@revisor.com', 'atribuicao' => 3],
			['apelido' => 'Narrador', 'email' => 'narrador@narrador.com', 'atribuicao' => 4],
			['apelido' => 'Produtor', 'email' => 'produtor@produtor.com', 'atribuicao' => 5],
			['apelido' => 'Publicador', 'email' => 'publicador@publicador.com', 'atribuicao' => 6],
			['apelido' => 'Administrador', 'email' => 'admin@admin.com', 'atribuicao' => 7],
			['apelido' => 'Pagador', 'email' => 'pagador@pagador.com', 'atribuicao' => 8],
			['apelido' => 'Recrutador', 'email' => 'recrutador@recrutador.com', 'atribuicao' => 9],
			['apelido' => 'Pautador', 'email' => 'pautador@pautador.com', 'atribuicao' => 10],
			['apelido' => 'Redator', 'email' => 'redator@redator.com', 'atribuicao' => 11],
		];
	}

	public static function senhaHash(): string
	{
		return hash('sha256', self::SENHA);
	}

	/**
	 * @return list<int>
	 */
	public static function atribuicoesDaConta(int $atribuicao): array
	{
		if ($atribuicao === 1) {
			return [1];
		}

		return [1, $atribuicao];
	}
}
