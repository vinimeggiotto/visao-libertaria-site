# DOC_auth-cookie-filter-php

## Objetivo

Restaura a sessão a partir do cookie `hash` (lembrar-me) ou redireciona para o login. O filtro `before` roda antes de `BaseController::initController`.

## Dependências

Cookie helper, `app_session()`, `ColaboradoresModel::buscarPorRememberToken`, `ColaboradoresAtribuicoesModel`, `ColaboradoresHistoricos`, variáveis `FIRSTKEY`, `SECONDKEY`, `METHOD`, `METHOD_HMAC`.

## Lógica central

Usa `app_session()` para obter a sessão já iniciada (ou iniciá-la se o request ainda não tiver sessão ativa). O cookie cifra um token opaco. O lookup é `SHA-256(token)` em `colaboradores.remember_token`. Argumento `optional` não redireciona se não houver sessão nem cookie válido.

## Assinaturas

- `before(RequestInterface $request, $arguments = null): ResponseInterface|void`
- `after(RequestInterface $request, ResponseInterface $response, $arguments = null): void`
