# Navegação

## Nav pública

Itens fixos, nesta ordem: **Home**, **Notícias**, **Vídeos**, **Artigos**, **Contato**.

Desktop: pills ao lado da marca (`PADRAO_layout.md`). Item da seção atual (e o detalhe de pauta sob Notícias, detalhe de artigo sob Artigos) usa o estado ativo ouro.

Mobile: o hamburger (`bi-list`, `36×36`) abre a mesma lista em coluna, abaixo da barra, com borda superior de superfície. Fecha ao navegar ou ao repetir o clique.

A área logada (sidebar) não substitui essa nav nas páginas públicas.

## Menu da conta (site público)

Logado, à direita: avatar (`28px`–`30px`) + nome (oculto no mobile) + chevron. O gatilho abre um dropdown (`--vl-surface`, borda `rgba(255,255,255,0.12)`, raio `10px`, mínimo `180px`), alinhado à direita.

Itens, nesta ordem:

1. Meu perfil — `/colaboradores/perfil`
2. Meus artigos
3. Colaborar em artigos
4. Pautas
5. Administração (texto `--vl-muted-2`, `13px`; só se a conta enxerga a área admin)
6. Sair (texto `#e5787c`)

Separador (`1px`, `rgba(255,255,255,0.08)`) antes de Administração e antes de Sair.

Cada item é um link/botão de largura total, padding `10px 12px`, raio `6px`, texto `--vl-text` `14px`, família Public Sans. **Área do colaborador** (primeiro destino de perfil) aponta para `/colaboradores/perfil` (atribuição 1), não para o dashboard de artigos.

Anônimo: “Cadastre-se” (oculto no mobile) + “Acessar” (modal de login). Sem item de tema.

## Sidebar interna

Coluna de `200px` (`PADRAO_layout.md`). Itens reais do menu da sessão — colaborador (artigos, colaborar, pautas, perfil, etc.) e admin (dashboard, contatos, permissões **e** os demais pontos já existentes: configurações, financeiro, CMS, …). Estado ativo: o mesmo pill ouro da nav pública. Sem footer público na sidebar.

## Retorno ao login

Área logada sem sessão: redirect para `url_home_com_login($path)` (`/site?openLogin=1&next=/caminho`).

Não usar URL absoluta (`http://localhost:8080/...`) no query. O parâmetro é `next`, não `url`.

## Permissões no menu

Três comportamentos, nesta ordem:

1. **Ocultar** — o item não entra no HTML se a pessoa nunca usa aquela área (Configurações, Financeiro, fases 3–6, etc.).
2. **Toast no clique** — o item continua visível, mas exige outra atribuição (ex.: **Colaborar** sem Escritor). Classe `js-requer-permissao`; não navega; toast 5 s.
3. **Toast no servidor** — URL colada: `VerificaPermissao` grava flash e manda ao perfil; o toast aparece na chegada.

Lista por conta e por botão: `Docs/features/permissoes/o-que-cada-usuario-pode-clicar.md`.
