# Retorno após o login

Quem acessa rota protegida sem sessão vai para a home (`/site`) com o modal de login. O destino de volta é o query `next` com **path interno** (ex.: `/colaboradores/artigos/dashboard`), nunca a URL absoluta.

Validação: começa com `/`, não é protocol-relative (`//`), não contém `://`. Quem não passa em `caminho_retorno_login` é ignorado; depois do login o padrão é `/colaboradores/perfil`.

O filtro `authCookie`, o GET de `/site/login`, o logout com retorno e o `VerificaPermissao` usam o mesmo helper. O JS da home lê `next` da query.
