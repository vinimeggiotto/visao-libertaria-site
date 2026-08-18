# Docker local

O ambiente local tem dois serviços: `vl-web` (PHP 8.2 + Composer + `spark serve` na porta 8080) e `vl-db` (MariaDB 10.6).

O `Dockerfile` instala só as extensões que o app usa (`mysqli`, `pdo_mysql`, `intl`, `gd`, `mbstring`) e o Composer. O código da pasta do projeto é montado no container; o `entrypoint` cria `.env` a partir de `env.docker` se faltar e roda `composer install`.

O `web` espera o healthcheck do `db` antes de subir. O `.env` precisa apontar o banco para o host `vl-db` (como no `env.docker`); se o arquivo já existir, o entrypoint não sobrescreve.

Depois: `docker compose exec web php spark migrate` e `docker compose exec web php spark db:seed Main`. O migrate usa `AppMigrationRunner` (`glob`) porque o `DirectoryIterator` do PHP, no volume do Docker no Windows, não lista todos os arquivos.
