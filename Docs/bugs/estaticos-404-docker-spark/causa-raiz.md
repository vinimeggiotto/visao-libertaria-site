# CSS/JS 404 no Docker (`spark serve`)

## Sintoma

Em `http://localhost:8080` o HTML pede `/public/css/style.css`, `/public/css/site-public-layout.css` e `/public/js/functions.js` e o servidor responde 404. A home também pede `/public/assets/imagem-default.png` e recebe 404.

`main.js?attr=...` e o aviso de `unload` não são do site (script injetado no Chrome).

## Causa raiz

As views geram URL com prefixo `public/` (`site_url('public/css/...')`). Em produção e no XAMPP a document root é a **raiz do repositório**, então `/public/css/style.css` acha o arquivo.

O `php spark serve` do container usa `public/` como document root. O browser pede `/public/css/style.css` e o PHP procura `public/public/css/style.css`.

`public/assets/imagem-default.png` estava no `.gitignore` e não existia no clone.

## Correção

O entrypoint do Docker sobe o servidor embutido do PHP com document root na raiz do projeto e o roteador `.docker/router.php` (arquivo existente → serve; senão → `index.php` da raiz). As URLs com `/public/` passam a coincidir com produção.

O PNG padrão passou a versionar em `public/assets/imagem-default.png`.
