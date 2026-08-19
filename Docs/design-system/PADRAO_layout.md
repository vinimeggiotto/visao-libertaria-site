# Layout

## Tema e tokens

O site é **dark-only**. A UI não expõe toggle de tema claro.

Contrato visual único (público e interno), via variáveis em `public/css/theme-tokens.css` e `public/css/site-theme.css`:

| Token | Valor | Uso |
| --- | --- | --- |
| `--vl-bg` | `#171512` | Fundo da página |
| `--vl-surface` | `#211f1b` | Header, cards, sidebar, toast, modal |
| `--vl-text` | `#f2f0ee` | Texto principal |
| `--vl-muted` | `#ada89f` | Texto secundário, labels, links de rodapé |
| `--vl-muted-2` | `#847e72` | Texto terciário, placeholders, títulos de coluna |
| `--vl-brand` | `#f3c921` | Ouro: links, ênfase, pill ativa, CTA |
| `--vl-brand-text` | `#181818` | Texto sobre fundo ouro |
| `--vl-danger` | `#e5484d` | Perigo, exclusão, badge de alerta |
| `--vl-radius` | `8px` | Botões, campos, hamburger |
| `--vl-font-body` | Public Sans | Corpo, UI, botões |
| `--vl-font-title` | Space Grotesk | Títulos e wordmark |

Links: cor `--vl-brand`; hover `#ffd94d`. Borda padrão de superfície: `1px solid rgba(255,255,255,0.08)`. Borda de campo: `1px solid rgba(255,255,255,0.12)`.

Cards e painéis usam `--vl-surface`, borda de superfície e raio `10px`–`14px` (card de listagem `10px`; formulário/modal `14px`; faixa CTA `12px`). Thumb de vídeo `16:9`; thumb de notícia/pauta `4:3`.

## Tipografia

Fontes **locais** em `public/fonts/` (`woff2`). Sem Google Fonts.

- **Space Grotesk** 600/700 — títulos, wordmark, números de estatística.
- **Public Sans** 400/500/600/700 — corpo, navegação, formulários, botões.

Não carregar Jost no chrome. Não usar CDN de fonte.

Escala:

- Hero H1: `clamp(32px, 5vw, 52px)`, peso 700, line-height `1.08`
- Página H1: `30px`–`32px`, peso 700
- Painel H1: `22px`–`24px`, peso 700
- H2 de seção: `20px`–`24px`, peso 700
- Corpo: `14px`–`17px` (lead da home `17px`, line-height `1.6`, cor `--vl-muted`)
- Label de campo: `12px`–`13px`, cor `--vl-muted`
- Eyebrow (selo acima do hero): `12px`, uppercase, letter-spacing `0.08em`, cor `--vl-brand`, família monoespaçada do sistema

## Botões

Três variantes no mesmo raio (`--vl-radius`) e família `--vl-font-body`:

- **Primário** — fundo `--vl-brand`, texto `--vl-brand-text`, peso 700. Padding típico `9px 18px` (header) ou `13px 22px` / `14px 24px` (CTA de página).
- **Secundário** — fundo transparente, borda `1px solid rgba(255,255,255,0.18)`, texto `--vl-text`, peso 600.
- **Texto / link** — sem fundo nem borda; ouro (`--vl-brand`, peso 600) ou muted (`--vl-muted`). “Esqueci a senha” usa `--vl-muted` + sublinhado.
- **Perigo** — fundo transparente, borda e texto `--vl-danger`, peso 600.

Nav pública (pills): fundo transparente, texto `--vl-muted`, peso 500, padding `9px 14px`, raio `8px`. Item ativo: fundo `rgba(243,201,33,0.14)`, texto `--vl-brand`, peso 700.

Ícones de ação: Bootstrap Icons (`bi bi-*`), com `aria-hidden` quando o texto ao lado já descreve o controle.

## Container

Largura máxima `1280px`, centralizado, padding horizontal `24px`. Formulários estreitos (contato/cadastro) podem usar `1080px`; leitura longa (página estática), `760px`.

## Assets públicos

Layouts públicos (`_main`) e internos (`colaboradores`, `administradores`, `main`) usam os mesmos vendors locais em `public/css/vendor/` e `public/js/vendor/` (Bootstrap, ícones, jQuery, toaster, MDB, masonry, infinite-scroll, bs-custom-file-input) via `asset_url()` (`?v=` + mtime). Quill e ApexCharts ficam no CDN, só nas telas que já os carregam. Não carregar o StreamLab (`style.css`). Sem Google Fonts, sem Unsplash. Sem CDN no layout público nem nos layouts internos, exceto Quill/Apex.

hCaptcha só junto do widget: modal de login (anônimo, body do `_main`, não no `<head>`), cadastro, contato e esqueci senha. Layouts internos não carregam hCaptcha.

A home é um hero estático de duas colunas (texto + vídeo em destaque) e uma grade de últimos vídeos. Chips da home/vídeos são **projetos** (nomes de canal/série), não categorias de notícia. A listagem de vídeos abre o YouTube pelo link `cria_link_watch` (sem popup). Embed de YouTube só no detalhe público do artigo, se houver `link_video_youtube`. AJAX dos forms públicos usa `async: true`.

Ícones do site público e das telas internas: só Bootstrap Icons (`bi bi-*`).

Layouts internos (`colaboradores`, `administradores`, `main`) usam `defer` em jQuery, Bootstrap JS e demais scripts do `<head>`. JS de página que depende de `$` vai na section `scripts` da view (renderizada no fim do body, após o parse).

## Header público

Header sticky (`top: 0`, `z-index: 50`), fundo `--vl-surface`, borda inferior `1px solid rgba(255,255,255,0.08)`.

Faixa interna no container (`1280px` / `24px`): marca à esquerda, pills de navegação, ações à direita.

Marca: `marca_favicon` / `logo.webp` (ver seção Marca) + wordmark “VISÃO LIBERTÁRIA” em Space Grotesk 700, `15px`, letter-spacing `0.03em`. Sem círculo ouro no lugar da marca real.

Anônimo: link “Cadastre-se” (texto muted, oculto no mobile) + botão primário “Acessar” (abre o modal de login). Logado: avatar + nome + menu — `PADRAO_navigation.md`.

Hamburger (`36×36`, borda `rgba(255,255,255,0.14)`, ícone `bi-list`): no viewport estreito, abre a mesma nav em coluna abaixo da barra.

Sem toggle de tema na barra.

## Footer público

Só nas páginas públicas (layouts internos não repetem o rodapé do site).

Quatro colunas no container, padding superior `48px`, borda superior de superfície:

1. Marca + texto muted: “Vídeos e notícias sobre livre mercado e crítica ao estado, feitos pela comunidade.”
2. **Navegação** — Artigos, Contato, FAQ, Todos os projetos, Calculadoras.
3. **Ancapsu** — links de redes (YouTube, Instagram, X).
4. **Visão Libertária** — links de redes (YouTube, X).

Faixa inferior centralizada, `12px`, `--vl-muted-2`: “Desenvolvido e mantido pela comunidade.”

Títulos de coluna: `13px`, uppercase, letter-spacing `0.05em`, cor `--vl-muted-2`. Links: `--vl-muted`, `14px`.

## Shell interno

Painel colaborador e admin: grid `200px` + `1fr`, gap `32px`, mesmo container. Sidebar com os **itens reais** do menu da conta (não reduzir o admin a um recorte ilustrativo). Sem footer público. Sem toggle de tema.

## Notícias e cards

Listagem de notícias: busca + lista + aside. **Não** há chips de categoria Economia / Política / Mundo (nem equivalentes). Metadado do card pode mostrar projeto, data e autor; não inventar taxonomia de editoria.

Card de pauta navega para `site/pauta/{id}`. Card de artigo publicado navega para a rota pública de leitura (`site/artigo/{id}`).

## Marca (logo / favicon / rodapé)

URLs de favicon e rodapé vêm de `site_config.marca_favicon` e `site_config.marca_rodape` (resolvidas uma vez no `BaseController`). Prioridade: arquivo enviado no admin (`public/assets/favicon.ico`, `public/assets/rodape.png`); senão `public/assets/logo.webp`. Sem thumb/YouTube (ou se a URL for `imagem-default` / `via.placeholder.com`), o card usa `<img>` do **placehold.co** via `cria_url_placeholder()` (`480×270`, fundo `#222222`, texto `#888888`, WebP). Se o `.co` falhar, `onerror` troca uma vez para `https://placehold.net/600x400.png` (ADR em `Docs/arch/placeholder-fallback.md`). A mesma URL primária em todos os cards vazios para o browser cachear um arquivo. Preview de pauta usa o mesmo par. Não usar `via.placeholder.com` nem Unsplash. Views não chamam `file_exists` para marca. Não usar URL externa do YouTube.

## Avatar de colaborador

Ícones do site: Bootstrap Icons (`bi bi-*`), o mesmo conjunto de “Nossas redes sociais”.

Com foto: `<img>` da URL gravada (WebP em `public/assets/avatars/{id}.webp`). Sem foto (nulo, vazio ou o antigo `avatar-default.png`): `bi bi-person-circle` (`avatar_html` / `avatar_slot_html`). O ícone preenche o círculo (no perfil, ~5.5rem). Não usar `avatar-default.png` nem a logo do site como foto de pessoa. Upload e recorte: `PADRAO_inputs.md`. Clique no círculo do cartão do perfil: modal com a foto (`PADRAO_modals.md`).
