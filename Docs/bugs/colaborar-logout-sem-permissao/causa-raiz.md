# Clique em Colaborar desloga

## Sintoma

Usuário logado (ex.: `admin@admin.com`) clica em Colaborar e volta à home com o modal de login, como se a sessão tivesse sumido. A URL fica `/site?next=/colaboradores/artigos/dashboard`.

## Causa raiz

`Colaborar` aponta para `colaboradores/artigos/dashboard`, que chama `PermiteAcesso('2')` (Escritor).

O seed dá ao admin só a atribuição `1` (Colaborador) — Escritor é aleatório (90%). Sem a `2`, `VerificaPermissao` redirecionava para `site/logout`. A sessão era apagada de propósito, não “perdida”.

O `next` só reabria o modal depois do logout.

## Correção

Sem permissão, o redirect padrão é `colaboradores/perfil` (atribuição `1`). A sessão permanece.
