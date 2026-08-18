# Docker local

O ambiente local tem dois serviços: `vl-web` (PHP 8.2 + Composer + servidor embutido na porta 8080) e `vl-db` (MariaDB 10.6).

A document root do `vl-web` é a raiz do repositório (igual XAMPP/produção), não a pasta `public/`. O roteador é `.docker/router.php`. Assim `/public/css/...` e `/public/js/...` resolvem.

O `Dockerfile` instala só as extensões que o app usa (`mysqli`, `pdo_mysql`, `intl`, `gd`, `mbstring`, `exif`) e o Composer. Os limites de upload (`8M` / `12M`) e `memory_limit=256M` vêm de `.docker/php-uploads.ini` copiado para o PHP do container. Mudança nessa ini ou nas extensões exige rebuild da imagem (`docker compose build web`). O código da pasta do projeto é montado no container; o `entrypoint` cria `.env` a partir de `env.docker` se faltar e roda `composer install`.

O `web` espera o healthcheck do `db` antes de subir. O `.env` precisa apontar o banco para o host `vl-db` (como no `env.docker`); se o arquivo já existir, o entrypoint não sobrescreve.

`METHOD` no Docker local tem de ser cifra **sem** AEAD (ex.: `aes-256-cbc`) e `METHOD_HMAC` um algoritmo de hash do `hash_hmac` (ex.: `sha256`). `aria-256-ccm` exige tag no `openssl_encrypt`; `aria-128-ofb` não é hash. Com “lembrar-me” isso vira HTTP 500 em `/site/login`.

Depois: `docker compose exec web php spark migrate` e `docker compose exec web php spark db:seed Main`. O migrate usa `AppMigrationRunner` (`glob`) porque o `DirectoryIterator` do PHP, no volume do Docker no Windows, não lista todos os arquivos.

O `Main` grava as 11 contas fixas (senha `12345678`) antes dos colaboradores aleatórios. Num banco já populado, use `docker compose exec web php spark db:seed SincronizaContasFixas`. Credenciais: README.
