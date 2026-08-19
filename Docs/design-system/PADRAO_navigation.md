# Navegação

## Retorno ao login

Área logada sem sessão: redirect para `url_home_com_login($path)` (`/site?openLogin=1&next=/caminho`).

Não usar URL absoluta (`http://localhost:8080/...`) no query. O parâmetro é `next`, não `url`.

## Permissões no menu

Três comportamentos, nesta ordem:

1. **Ocultar** — o item não entra no HTML se a pessoa nunca usa aquela área (Configurações, Financeiro, fases 3–6, etc.).
2. **Toast no clique** — o item continua visível, mas exige outra atribuição (ex.: **Colaborar** sem Escritor). Classe `js-requer-permissao`; não navega; toast 5 s.
3. **Toast no servidor** — URL colada: `VerificaPermissao` grava flash e manda ao perfil; o toast aparece na chegada.

Lista por conta e por botão: `Docs/features/permissoes/o-que-cada-usuario-pode-clicar.md`.

## Menu do avatar (site público)

O círculo do avatar é um `<a href>` para `/colaboradores/perfil`. Funciona sem JavaScript (localhost e produção). O menu **Meu Perfil / Sair** abre no hover ou `:focus-within`. Não interceptar o clique do avatar com `preventDefault`.

**Área do colaborador** (barra admin) aponta para `/colaboradores/perfil` (atribuição 1), não para o dashboard de artigos.
