# Migrations incompletas no Docker no Windows

## Sintoma

`php spark migrate` no container cria só o histórico das migrations de 2026. A home quebra com `Table 'visao_libertaria.configuracao' doesn't exist`.

## Causa raiz

O CodeIgniter descobre migrations com `get_filenames()`, que usa `RecursiveDirectoryIterator`. No volume montado pelo Docker Desktop no Windows, `DirectoryIterator`/`readdir` lista só parte dos arquivos (aqui, 8 de 2026). `glob()` e `ls` veem os 36.

As migrations de 2024 que criam `configuracao` e o restante do schema nunca entram na fila. A de 2026 que insere em `configuracao` roda primeiro e falha.

Não é `.env`. A conexão com o MariaDB funciona.

## Correção

`App\Database\AppMigrationRunner` lista os `.php` com `glob()`. O serviço `migrations` em `Config\Services` usa esse runner.

## Schema de vídeos

`projetos_videos` e as colunas `listar` / `canal_youtube_id` de `projetos` estão nas migrations `2026-06-21-*`. Ver `Docs/features/projetos-videos/schema.md`.
