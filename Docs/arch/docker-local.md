# Docker local

O ambiente local tem quatro serviços: `vl-nginx` (nginx 1.27 na porta 8080), `vl-web` (PHP 8.2-FPM + Composer), `vl-db` (MariaDB 10.6) e `vl-redis` (Redis 7).

A document root do nginx é a raiz do repositório (igual XAMPP/produção), não a pasta `public/`. Assim `/public/css/...` e `/public/js/...` resolvem. Pedidos a `/favicon.ico` são servidos de `public/assets/favicon.ico` (o Chrome sempre pede o ícone na raiz). O PHP chega ao FPM em `web:9000`. O `vl-web` não publica porta no host.

O `Dockerfile` é `php:8.2-fpm-alpine` e instala as extensões que o app usa (`mysqli`, `pdo_mysql`, `intl`, `gd`, `mbstring`, `exif`, `opcache`, `redis`) e o Composer. O CLI do PHP permanece na imagem: `docker compose exec web php spark …`. Upload e memória vêm de `.docker/php-uploads.ini`. OPcache local: `.docker/php-opcache.ini` (`validate_timestamps=1`). Mudança nessas ini, nas extensões ou no `Dockerfile` exige rebuild (`docker compose build web`).

O `entrypoint` cria `.env` a partir de `env.docker` se faltar, roda `composer install` e sobe `php-fpm`. `.env` já existente não é sobrescrito: para usar Redis, inclua `REDIS_HOST=vl-redis` (como no `env.docker`). Sem essa variável o cache e a sessão continuam em arquivo. Sem Redis no Plesk, não defina `REDIS_HOST` em produção.

O arquivo `.docker/router.php` existe no repo, mas não é o runtime HTTP. Estáticos, gzip e `expires` estão em `.docker/nginx.conf` (css/js 1 mês; imagens e fontes 1 ano; HTML sem `Cache-Control` longo). Não reativar `.docker/apache2.conf`.

Depois do migrate de performance: `docker compose exec web php spark thumbs:backfill` (thumbs locais). Detalhes de servidor: `performance-servidor.md`.

O `web` espera o healthcheck do `db` e o Redis antes de subir. O `nginx` depende do `web`. O banco no `.env` aponta para `vl-db`.

`METHOD` no Docker local tem de ser cifra **sem** AEAD (ex.: `aes-256-cbc`) e `METHOD_HMAC` um algoritmo de hash do `hash_hmac` (ex.: `sha256`). `aria-256-ccm` exige tag no `openssl_encrypt`; `aria-128-ofb` não é hash. Com “lembrar-me” isso vira HTTP 500 em `/site/login`.

Depois: `docker compose exec web php spark migrate` e `docker compose exec web php spark db:seed Main`. O migrate usa `AppMigrationRunner` (`glob`) porque o `DirectoryIterator` do PHP, no volume do Docker no Windows, não lista todos os arquivos.

O `Main` grava as 11 contas fixas (senha `12345678`) antes dos colaboradores aleatórios. Num banco já populado, use `docker compose exec web php spark db:seed SincronizaContasFixas`. Credenciais: README.
