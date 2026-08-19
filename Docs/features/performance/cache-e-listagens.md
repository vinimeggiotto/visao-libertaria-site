# Cache, listagens e thumbs

Vale em produção (`CI_ENVIRONMENT=production`). No local o cache de página não grava (igual à home anônima já existente).

## O que é cacheado

TTL 300s, só visitante anônimo. A versão sobe em `writable/cache/home_version.txt` (`invalidarCacheHome`).

- Home (`home_anon_{siteConfig}_{homeVersion}`)
- HTML de `/site/noticias`, `/site/artigos`, `/site/videos` (página inicial, não o AJAX de infinite scroll)
- HTML de `/site/pagina/{url}`
- `view_cell` dos cards públicos (TTL 300s, chave por id)
- `view_cell` de `Listas::listasVerticaisSimples` no site público (TTL 300s, chave estável por colaborador/papel/página)
- cards internos dessa lista (`lista_card_{tipo}_{id}`, TTL 300s)

Config do site: chave `site_config_{versao}` no handler de cache (arquivo ou Redis). A sessão só guarda a cópia já montada. `invalidarSiteConfig` apaga a chave e a sessão.

Sem `Cache-Control` longo no HTML (o header muda se a pessoa logar). Se o cache miss, a página é gerada de novo.

## Thumbs do YouTube

`cria_url_thumb` aponta só para `public/assets/thumbs/{id}.webp`. O cron baixa `hqdefault` e grava WebP. Backfill: `php spark thumbs:backfill`.

Thumb que falhar no download fica 404 — não volta para `img.youtube.com`.

## Lembrar-me

Cookie `hash` guarda um token opaco (cifrado). O banco tem `colaboradores.remember_token` (SHA-256 do token). Cookies antigos (MD5 do e-mail+senha) deixam de valer no deploy.

## UUID e agora

`app_uuid()` e `app_now()` no PHP. Os models não fazem mais `SELECT uuid()` / `SELECT now()`.
