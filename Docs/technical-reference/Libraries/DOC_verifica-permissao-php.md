# `app/Libraries/VerificaPermissao.php`

## Objetivo

Confere se a sessão do colaborador tem a atribuição pedida. Sem acesso, grava o nome da permissão em flash e redireciona; não encerra a sessão.

## Dependências

Sessão `colaboradores.permissoes`. `site_url()` no destino padrão. Flash `aviso_permissao` lido em `app/Views/components/_aviso_permissao.php`.

## Lógica central

Compara o código (string) com o array `permissoes`. Vários códigos: basta um. `$isValidar === true` só devolve boolean. Destino padrão sem `$url`: `colaboradores/perfil`. O nome exibido no toast vem de `NOMES` (IDs 1–11). Vários códigos viram lista com “ou”.

## Assinaturas

- `nomePermissaoExigida($codigoPermissao): string`
- `recusarAcesso($codigoPermissao = null, $url = null): void`
- `PermiteAcesso($codigoPermissao = null, $url = null, $isValidar = false): bool|void`
