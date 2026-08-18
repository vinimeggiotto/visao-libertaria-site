# Site Visão Libertária

[![CI](https://github.com/KoreaComK/visao-libertaria-site/actions/workflows/ci.yml/badge.svg?event=pull_request)](https://github.com/KoreaComK/visao-libertaria-site/actions/workflows/ci.yml)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white)](https://www.php.net/releases/8.2/en.php)
[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.7-EF4223?logo=codeigniter&logoColor=white)](https://codeigniter.com/)
[![MariaDB](https://img.shields.io/badge/MariaDB-10.6-003545?logo=mariadb&logoColor=white)](https://mariadb.org/)
[![Docker](https://img.shields.io/badge/Docker-ready-2496ED?logo=docker&logoColor=white)](https://www.docker.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

Aplicação [CodeIgniter 4](https://codeigniter.com/) (PHP 8.2+).

Duas formas de rodar localmente — **escolha uma**:

| | XAMPP | Docker |
|---|---|---|
| Precisa na máquina | XAMPP (PHP 8.2 + Apache + MariaDB) e Composer | Só [Docker Desktop](https://www.docker.com/products/docker-desktop/) |
| URL | http://localhost/visao-libertaria-site/ | http://localhost:8080 |
| Host do banco no `.env` | `localhost` | `vl-db` |
| Nome do banco | `visaolibertaria_teste` (você cria) | `visao_libertaria` (o compose cria) |

Não use os dois ao mesmo tempo na porta 3306.

Login após o seed: `admin@admin.com` / `12345678`.

---

## Opção A — XAMPP (PHP 8.2 + MariaDB na máquina)

### 1. Instalar o XAMPP

1. Baixe o instalador **Windows com PHP 8.2** em https://www.apachefriends.org/download.html
   (não use 8.0/8.1 — o projeto exige `^8.2`.)
2. Instale no padrão: `C:\xampp`.
3. No **XAMPP Control Panel**, inicie **Apache** e **MySQL** (é MariaDB).

### 2. Colocar o PHP no PATH

1. Edite as variáveis de ambiente do Windows e acrescente `C:\xampp\php` ao `PATH`.
2. Feche e reabra o terminal. Confira:

```bat
php -v
```

Deve aparecer PHP 8.2.x.

### 3. Extensões do PHP

No `C:\xampp\php\php.ini`, deixe ativas (sem `;` na frente) e reinicie o Apache:

- `extension=intl` (obrigatória no CodeIgniter 4)
- `extension=mysqli`
- `extension=gd`
- `extension=mbstring`
- `extension=curl`

Confira com `php -m`.

### 4. Instalar o Composer

1. https://getcomposer.org/download/ — instalador Windows.
2. Aponte para `C:\xampp\php\php.exe` se o instalador perguntar.
3. Confira: `composer -V`.

### 5. Colocar o projeto no lugar certo

O `baseURL` padrão é `http://localhost/visao-libertaria-site/`.

Clone (ou copie) o repositório para:

```text
C:\xampp\htdocs\visao-libertaria-site
```

No Control Panel do XAMPP, o Apache precisa estar rodando. O front controller é o `index.php` da **raiz** do projeto (não só `public/`).

Se o repositório ficar em outro caminho (ex.: `C:\Github\...`), ou você configura um Alias/VirtualHost no Apache apontando para essa pasta, ou usa `php spark serve` e ajusta o `app_baseURL` no `.env` para `http://localhost:8080/`.

### 6. Criar o banco

1. Abra http://localhost/phpmyadmin
2. Crie um banco vazio, charset `utf8`, collation `utf8_general_ci`.
3. Nome sugerido (bate com `app/Config/Database.php`): **`visaolibertaria_teste`**.

O migrate **não** cria o banco — só as tabelas.

Usuário padrão do XAMPP: `root` sem senha.

### 7. Arquivo `.env`

Na raiz do projeto:

```bat
copy env .env
```

Abra o `.env` e **descomente/ajuste** pelo menos:

```ini
CI_ENVIRONMENT = development

app_baseURL = 'http://localhost/visao-libertaria-site/'

database.default.hostname = localhost
database.default.database = visaolibertaria_teste
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

Não use o arquivo `env.docker` neste modo: o host `vl-db` só existe na rede do Compose.

`FIRSTKEY` / `SECONDKEY` / `HCAPTCHA_*` já vêm no `env`. Em `development` o hCaptcha é ignorado. YouTube (`YOUTUBE_*`) só é necessário para o cron de vídeos.

### 8. Dependências, tabelas e dados

No PowerShell, **na raiz do projeto**:

```bat
composer install
php spark migrate
php spark db:seed Main
```

O seed cria ~1000 colaboradores de teste e pode demorar alguns minutos.

### 9. E-mail (opcional para só navegar)

`app/Config/Email.php` **não vai no Git**. Sem ele, cadastro, “esqueci senha” e contato não enviam mensagem.

Copie o stub do framework (`vendor/codeigniter4/framework/app/Config/Email.php`) para `app/Config/Email.php` e preencha SMTP (`protocol`, `SMTPHost`, `SMTPUser`, `SMTPPass`, `SMTPPort`).

### 10. Acessar

http://localhost/visao-libertaria-site/

---

## Opção B — Docker

Não precisa de XAMPP, PHP nem Composer na máquina.

### 1. Pré-requisitos

1. Instale e **abra** o [Docker Desktop](https://www.docker.com/products/docker-desktop/). Espere ficar “Engine running”.
2. No Windows, **pare o MySQL do XAMPP** (porta 3306). Sem isso o `vl-db` não sobe.

### 2. Subir

Na pasta do projeto:

```bat
docker compose up -d --build
```

O primeiro build instala extensões PHP e pode levar vários minutos.

O que sobe:

- **vl-web** — PHP 8.2 + Composer; o código da pasta é montado no container; o entrypoint roda `composer install` e o servidor embutido do PHP (raiz do projeto + `.docker/router.php`).
- **vl-db** — MariaDB 10.6.16; banco `visao_libertaria`; root sem senha; dados em `./.db`.

Se **não existir** `.env`, o entrypoint cria um a partir de `env.docker` (host `vl-db`, URL `http://localhost:8080`).

**Se você já tem `.env` do XAMPP**, o entrypoint **não mexe**. Ajuste para o Docker **antes** de subir (ou apague o `.env` e deixe o entrypoint recriar):

```ini
CI_ENVIRONMENT = development
app_baseURL = 'http://localhost:8080'

database.default.hostname = vl-db
database.default.database = visao_libertaria
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

### 3. Tabelas e dados

```bat
docker compose exec web php spark migrate
docker compose exec web php spark db:seed Main
```

### 4. Acessar

http://localhost:8080

### Comandos úteis

| Ação | Docker Compose | Make (Git Bash / Linux / macOS) |
|---|---|---|
| Subir (sem rebuild) | `docker compose up -d` | `make up` |
| Subir rebuildando a imagem | `docker compose up -d --build` | `make build` e depois `make up` |
| Parar | `docker compose down` | — |
| Parar e remover volumes nomeados | `docker compose down -v` | `make down` |
| Migrar | `docker compose exec web php spark migrate` | `make migrate` |
| Seed | `docker compose exec web php spark db:seed Main` | `make seed` |
| Testes | `docker compose exec web ./vendor/bin/phpunit` | `make test` |
| Shell do PHP | `docker compose exec -it web bash` | `make bash-web` |
| Shell do banco | `docker compose exec -it db bash` | `make bash-db` |

`make up` **não** passa `--build`. Depois de mudar o `Dockerfile`, use `docker compose up -d --build`.

### Resetar o banco do Docker

Scripts de init (`MARIADB_DATABASE`, `.docker/db_test.sql`) só rodam quando `./.db` é criado pela primeira vez.

```bat
docker compose down
```

Apague a pasta `.db` na raiz do projeto e suba de novo. Depois rode migrate e seed outra vez.

### Trocar XAMPP ↔ Docker

O `.env` **não é o mesmo**:

- XAMPP: host `localhost`, banco `visaolibertaria_teste`, URL com `/visao-libertaria-site/`
- Docker: host `vl-db`, banco `visao_libertaria`, URL `http://localhost:8080`

---

## Problemas comuns

| Sintoma | Causa provável |
|---|---|
| `php` não é reconhecido | `C:\xampp\php` fora do PATH; terminal antigo |
| Erro de classe / autoload | Faltou `composer install` |
| `Unknown database` | Banco não criado no phpMyAdmin, ou nome diferente do `.env` |
| Home quebra com tabela inexistente | Faltou `php spark migrate` |
| Login admin não entra | Faltou `db:seed Main` |
| Docker: conexão recusada no banco | `.env` com `hostname = localhost` em vez de `vl-db` |
| `Bind for 0.0.0.0:3306 failed` | MySQL do XAMPP ainda está no ar |
| Site no Docker não abre na 8080 | Docker Desktop fechado, ou build ainda rodando |
| E-mail não sai | Falta `app/Config/Email.php` local com SMTP |

Detalhes do ambiente Docker: `Docs/arch/docker-local.md`.
