# Layout

## Assets públicos

CSS do rosto do site: `site-theme.css` (tokens, Jost self-host, header/botões) + `site-public-layout.css`. Não carregar o StreamLab (`style.css`). URLs locais usam `asset_url()` (`?v=` + mtime).

Fonte **Jost** (400/600/700) em `public/fonts/`. Sem Google Fonts no layout público.

hCaptcha só junto do widget: modal de login (anônimo, body do `_main`, não no `<head>`), cadastro, contato e esqueci senha. Layouts internos não carregam hCaptcha.

Owl Carousel e Magnific Popup só na home. A listagem de vídeos abre o YouTube pelo link `cria_link_watch` (sem popup). AJAX desses forms usa `async: true`.

Ícones do site público e das telas internas: só Bootstrap Icons (`bi bi-*`).

Layouts internos (`colaboradores`, `administradores`, `main`) usam `defer` em jQuery, Bootstrap JS e demais scripts do `<head>`. JS de página que depende de `$` vai na section `scripts` da view (renderizada no fim do body, após o parse).

## Header público (`#gen-header.gen-header-style-1`)

No tema, o header é `position: absolute` para sobrepor o banner `vh-100` da home.

Quando a página **não** tem `.banner-section`, o header passa a `position: relative` (`site-public-layout.css`, seletor `body:not(:has(.banner-section))`). Assim o conteúdo não fica por baixo da barra. Com banner, o comportamento do tema não muda.

## Marca (logo / favicon / rodapé)

URLs de favicon e rodapé vêm de `site_config.marca_favicon` e `site_config.marca_rodape` (resolvidas uma vez no `BaseController`). Prioridade: arquivo enviado no admin (`public/assets/favicon.ico`, `public/assets/rodape.png`); senão `public/assets/logo.jpg`. Views não chamam `file_exists` para marca. Não usar URL externa do YouTube como marca.

## Avatar de colaborador

Ícones do site: Bootstrap Icons (`bi bi-*`), o mesmo conjunto de “Nossas redes sociais”.

Com foto: `<img>` da URL gravada (WebP em `public/assets/avatars/{id}.webp`). Sem foto (nulo, vazio ou o antigo `avatar-default.png`): `bi bi-person-circle` (`avatar_html` / `avatar_slot_html`). O ícone preenche o círculo (no perfil, ~5.5rem). Não usar `avatar-default.png` nem a logo do site como foto de pessoa. Upload e recorte: `PADRAO_inputs.md`. Clique no círculo do cartão do perfil: modal com a foto (`PADRAO_modals.md`).
