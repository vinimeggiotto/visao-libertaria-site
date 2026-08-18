# Logo quebrado e “Mais Vídeos” no header (home local)

## Sintoma

Na home Docker, o logo do header aparece como imagem quebrada. O botão “Mais Vídeos” invade a barra. Os cards de vídeo da faixa “Visão Libertária” saem cinza.

`main.js?attr=...` / `unload` é o Kaspersky, não o site.

## Causa raiz

1. **Logo:** `favicon.ico` e `rodape.png` são upload do admin, não vão no git. Sem arquivo, o layout usava uma URL `yt3.googleusercontent.com` morta ou bloqueada. Em produção o `file_exists` é verdadeiro e a URL local continua valendo.

2. **“Mais Vídeos” no header:** `header#gen-header.gen-header-style-1` é `position: absolute` para flutuar no banner `vh-100`. Sem linhas em `projetos_videos` não existe `.banner-section`, e a primeira seção (título + botão) começa sob o header.

3. **Cards cinza:** o seed de artigos não traz `link_video_youtube` válido. A view usa `imagem-default.png`. Em produção as thumbs vêm do YouTube (`cria_url_thumb`).

## Correção

- Fallback da marca: `site_url('public/assets/logo.jpg')` quando o upload não existe. Produção com `favicon.ico` / `rodape.png` não muda.
- Avatar sem foto: ícone Bootstrap `bi-person-circle` (`avatar_helper.php`). O PNG `avatar-default.png` não é mais usado como marca nem como foto.
- CSS: `body:not(:has(.banner-section))` torna o header `relative`. Com banner, o seletor não aplica.
