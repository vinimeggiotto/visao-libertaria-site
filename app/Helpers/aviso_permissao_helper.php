<?php

use App\Libraries\VerificaPermissao;

/**
 * @param string|int|list<string|int> $codigo
 */
function nome_atribuicao($codigo): string
{
	return VerificaPermissao::nomePermissaoExigida($codigo);
}
