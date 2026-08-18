# `app/Libraries/VerificaPermissao.php`

## Objetivo

Confere se a sessão do colaborador tem a atribuição pedida. Sem acesso, redireciona; não encerra a sessão.

## Dependências

Sessão `colaboradores.permissoes`. `site_url()` no destino padrão.

## Lógica central

Compara o código (string) com o array `permissoes`. Vários códigos: basta um. `$isValidar === true` só devolve boolean. Destino padrão sem `$url`: `colaboradores/perfil`.

## Assinaturas

- `PermiteAcesso($codigoPermissao = null, $url = null, $isValidar = false): bool|void`
