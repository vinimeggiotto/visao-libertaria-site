# Layout

## Header público (`#gen-header.gen-header-style-1`)

No tema, o header é `position: absolute` para sobrepor o banner `vh-100` da home.

Quando a página **não** tem `.banner-section`, o header passa a `position: relative` (`site-public-layout.css`, seletor `body:not(:has(.banner-section))`). Assim o conteúdo não fica por baixo da barra. Com banner, o comportamento do tema não muda.

## Marca (logo / favicon / rodapé)

Arquivos enviados no admin (`public/assets/favicon.ico`, `public/assets/rodape.png`) têm prioridade via `file_exists`. Se o arquivo não estiver no disco, a URL é `public/assets/logo.jpg`. Não usar URL externa do YouTube como marca.

## Avatar de colaborador

Ícones do site: Bootstrap Icons (`bi bi-*`), o mesmo conjunto de “Nossas redes sociais”.

Com foto: `<img>` da URL gravada (WebP em `public/assets/avatars/{id}.webp`). Sem foto (nulo, vazio ou o antigo `avatar-default.png`): `bi bi-person-circle` (`avatar_html` / `avatar_slot_html`). O ícone preenche o círculo (no perfil, ~5.5rem). Não usar `avatar-default.png` nem a logo do site como foto de pessoa. Upload e recorte: `PADRAO_inputs.md`. Clique no círculo do cartão do perfil: modal com a foto (`PADRAO_modals.md`).
