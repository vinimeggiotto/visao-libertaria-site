# Performance do servidor

PHP 8.2+ / CodeIgniter 4.7. Produção: nginx + Plesk (host canônico em `host-canonico.md`). Local: XAMPP (Apache) ou Docker (`php -S` + OPcache). Sem CDN e sem load balancer.

## OPcache

O Docker local copia `.docker/php-opcache.ini` (`validate_timestamps=1` por causa do volume). Rebuild da imagem após mudar essa ini: `docker compose build web`.

Em produção (Plesk → PHP Settings ou `php.ini` do domínio):

```ini
opcache.enable=1
opcache.enable_cli=0
opcache.memory_consumption=128
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=10000
opcache.validate_timestamps=0
opcache.save_comments=1
opcache.preload=/caminho/absoluto/do/repo/preload.php
opcache.preload_user=o-usuario-do-php-fpm
```

`validate_timestamps=0` exige reload do PHP-FPM depois de cada deploy. `preload.php` na raiz do repo já lista o framework; ajuste o caminho absoluto no Plesk. Sem `preload_user` o preload não sobe.

## `php spark optimize`

Não commitar `configCacheEnabled=true` em `app/Config/Optimize.php` (quebra o Docker local).

No deploy de produção, depois de puxar o código:

```bash
php spark optimize
```

No local, depois de alterar arquivos em `app/Config/`:

```bash
php spark optimize:clear
```

## Compressão e cache de estáticos

### XAMPP (Apache)

`public/.htaccess` já aplica `mod_deflate` e `mod_expires` quando o host é de produção ou existe `.vl-production`. Confira no `httpd.conf` do XAMPP:

- `LoadModule deflate_module`
- `LoadModule expires_module`
- `LoadModule headers_module`

### Produção (nginx + Plesk)

O `.htaccess` não vale. No vhost (Apache & nginx Settings do Plesk → Additional nginx directives), conferir:

- HTTP/2 ligado no IP/domínio
- gzip e/ou brotli para `text/css`, `application/javascript`, `application/json`, `text/html`, `image/svg+xml`, `font/woff2`
- `expires` / `Cache-Control` para css/js (1 mês), imagens e fontes (1 ano), alinhado ao fingerprint `?v=` dos assets locais
- Não cachear HTML dinâmico com `Cache-Control` longo (o header muda se o visitante logar)

## Redis

No Docker, `REDIS_HOST=vl-redis` liga cache e sessão no Redis (config por ambiente). Em produção só defina `REDIS_HOST` depois do Redis existir no Plesk. Sem a variável, o handler continua `file`. Sem retry se o Redis cair.

## Docker local

Continua `php -S` + `.docker/router.php` (document root = raiz do repo). O ganho local é o OPcache, não nginx+FPM. Redis: `docker-local.md`.

## Observabilidade

No MariaDB/Plesk, ligar por um período de diagnóstico:

```sql
SET GLOBAL slow_query_log = 1;
SET GLOBAL long_query_time = 1;
```

Medir Lighthouse (LCP, INP, CLS) depois do deploy de frontend. Sem APM pago neste projeto. Este checklist é o que falta medir — não há resultado de Lighthouse versionado no repo.

Checklist (ainda sem medição registrada):

- Lighthouse desktop e mobile: home, `/site/noticias`, `/site/artigos`, `/site/videos`
- Login no modal + “lembrar-me” (cookie antigo deixa de valer; precisa logar de novo)
- QA visual do purge CSS (header, banner, cards, botões `gen-*`) em desktop e mobile — sem o StreamLab completo
- `docker compose` sobe `vl-web`, `vl-db` e `vl-redis`; `php spark migrate`; `php spark thumbs:backfill`
