# `app/Helpers/retorno_login_helper.php`

## Objetivo

Valida o destino pós-login e monta a URL da home com o modal aberto.

## Dependências

`service('request')` e `site_url()`. Sem banco e sem API.

## Lógica central

`caminho_retorno_login` só aceita path interno: começa com `/`, não começa com `//`, sem `://`, sem barra invertida e sem quebra de linha. `caminho_atual_retorno_login` lê path + query da requisição. `url_home_com_login` gera `/site?openLogin=1` e, se o path for válido, `&next=...`.

## Assinaturas

- `caminho_retorno_login(?string $candidato): ?string`
- `caminho_atual_retorno_login(): string`
- `url_home_com_login(?string $next = null): string`
