# Layout

## Assets públicos

Layouts públicos (`_main`) e internos (`colaboradores`, `administradores`, `main`) usam os mesmos vendors locais em `public/css/vendor/` e `public/js/vendor/` (Bootstrap, ícones, jQuery, toaster, MDB, masonry, infinite-scroll, bs-custom-file-input) via `asset_url()` (`?v=` + mtime). Quill e ApexCharts ficam no CDN, só nas telas que já os carregam. Owl+Magnific só na home (`vendor-home.css` / `vendor-home.js`). Não carregar o StreamLab (`style.css`). Sem Google Fonts, sem Unsplash. Sem CDN no layout público nem nos layouts internos, exceto Quill/Apex.

Fonte **Jost** (400/600/700) em `public/fonts/`. Sem Google Fonts no layout público.

hCaptcha só junto do widget: modal de login (anônimo, body do `_main`, não no `<head>`), cadastro, contato e esqueci senha. Layouts internos não carregam hCaptcha.

Owl Carousel e Magnific Popup só na home. Notícias, vídeos e artigos não carregam Owl/Magnific. A listagem de vídeos abre o YouTube pelo link `cria_link_watch` (sem popup). AJAX desses forms usa `async: true`.

Ícones do site público e das telas internas: só Bootstrap Icons (`bi bi-*`).

Layouts internos (`colaboradores`, `administradores`, `main`) usam `defer` em jQuery, Bootstrap JS e demais scripts do `<head>`. JS de página que depende de `$` vai na section `scripts` da view (renderizada no fim do body, após o parse).

## Header público (`#gen-header.gen-header-style-1`)

No tema, o header é `position: absolute` para sobrepor o banner `vh-100` da home.

Quando a página **não** tem `.banner-section`, o header passa a `position: relative` (`site-public-layout.css`, seletor `body:not(:has(.banner-section))`). Assim o conteúdo não fica por baixo da barra. Com banner, o comportamento do tema não muda.

## Marca (logo / favicon / rodapé)

URLs de favicon e rodapé vêm de `site_config.marca_favicon` e `site_config.marca_rodape` (resolvidas uma vez no `BaseController`). Prioridade: arquivo enviado no admin (`public/assets/favicon.ico`, `public/assets/rodape.png`); senão `public/assets/logo.webp`. Sem thumb/YouTube (ou se a URL for `imagem-default` / `via.placeholder.com`), o card usa `<img>` do **placehold.co** via `cria_url_placeholder()` (`480×270`, fundo `#222222`, texto `#888888`, WebP). Se o `.co` falhar, `onerror` troca uma vez para `https://placehold.net/600x400.png` (ADR em `Docs/arch/placeholder-fallback.md`). A mesma URL primária em todos os cards vazios para o browser cachear um arquivo. Preview de pauta usa o mesmo par. Não usar `via.placeholder.com` nem Unsplash. Views não chamam `file_exists` para marca. Não usar URL externa do YouTube.

## Avatar de colaborador

Ícones do site: Bootstrap Icons (`bi bi-*`), o mesmo conjunto de “Nossas redes sociais”.

Com foto: `<img>` da URL gravada (WebP em `public/assets/avatars/{id}.webp`). Sem foto (nulo, vazio ou o antigo `avatar-default.png`): `bi bi-person-circle` (`avatar_html` / `avatar_slot_html`). O ícone preenche o círculo (no perfil, ~5.5rem). Não usar `avatar-default.png` nem a logo do site como foto de pessoa. Upload e recorte: `PADRAO_inputs.md`. Clique no círculo do cartão do perfil: modal com a foto (`PADRAO_modals.md`).
