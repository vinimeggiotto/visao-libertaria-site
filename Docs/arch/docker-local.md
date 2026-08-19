# Docker local

O ambiente local tem três serviços: `vl-web` (PHP 8.2 + Composer + servidor embutido na porta 8080), `vl-db` (MariaDB 10.6) e `vl-redis` (Redis 7).

A document root do `vl-web` é a raiz do repositório (igual XAMPP/produção), não a pasta `public/`. O roteador é `.docker/router.php`. Assim `/public/css/...` e `/public/js/...` resolvem.

O `Dockerfile` instala as extensões que o app usa (`mysqli`, `pdo_mysql`, `intl`, `gd`, `mbstring`, `exif`, `opcache`, `redis`) e o Composer. Upload e memória vêm de `.docker/php-uploads.ini`. OPcache local: `.docker/php-opcache.ini` (`validate_timestamps=1`). Mudança nessas ini ou nas extensões exige rebuild (`docker compose build web`).

O `entrypoint` cria `.env` a partir de `env.docker` se faltar. `.env` já existente não é sobrescrito: para usar Redis, inclua `REDIS_HOST=vl-redis` (como no `env.docker`). Sem essa variável o cache e a sessão continuam em arquivo. Sem Redis no Plesk, não defina `REDIS_HOST` em produção.

Depois do migrate de performance: `docker compose exec web php spark thumbs:backfill` (thumbs locais). Detalhes de servidor: `performance-servidor.md`.

O `web` espera o healthcheck do `db` e o Redis antes de subir. O banco no `.env` aponta para `vl-db`.

`METHOD` no Docker local tem de ser cifra **sem** AEAD (ex.: `aes-256-cbc`) e `METHOD_HMAC` um algoritmo de hash do `hash_hmac` (ex.: `sha256`). `aria-256-ccm` exige tag no `openssl_encrypt`; `aria-128-ofb` não é hash. Com “lembrar-me” isso vira HTTP 500 em `/site/login`.

Depois: `docker compose exec web php spark migrate` e `docker compose exec web php spark db:seed Main`. O migrate usa `AppMigrationRunner` (`glob`) porque o `DirectoryIterator` do PHP, no volume do Docker no Windows, não lista todos os arquivos.

O `Main` grava as 11 contas fixas (senha `12345678`) antes dos colaboradores aleatórios. Num banco já populado, use `docker compose exec web php spark db:seed SincronizaContasFixas`. Credenciais: README.
