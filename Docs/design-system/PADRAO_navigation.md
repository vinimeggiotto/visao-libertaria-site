# Navegação

## Retorno ao login

Área logada sem sessão: redirect para `url_home_com_login($path)` (`/site?openLogin=1&next=/caminho`).

Não usar URL absoluta (`http://localhost:8080/...`) no query. O parâmetro é `next`, não `url`.

## Permissões no menu

O que cada conta fixa deve ver (e o que o servidor aceita) está em `Docs/features/permissoes/o-que-cada-usuario-pode-clicar.md`.
