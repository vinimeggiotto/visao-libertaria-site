# Navegação

## Retorno ao login

Área logada sem sessão: redirect para `url_home_com_login($path)` (`/site?openLogin=1&next=/caminho`).

Não usar URL absoluta (`http://localhost:8080/...`) no query. O parâmetro é `next`, não `url`.
