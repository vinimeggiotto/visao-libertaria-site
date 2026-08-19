# DOC_backfill-thumbs-php

## Objetivo

Comando `php spark thumbs:backfill`: baixa thumbs de todos os `projetos_videos.video_id` e dos ids extraídos de `artigos.link_video_youtube`.

## Dependências

`ThumbYoutube`, helper `_formata_video`, banco `projetos_videos` e `artigos`.

## Lógica central

Une os ids, chama `baixar` em cada um, relata sucessos e falhas no CLI.

## Assinaturas

- `run(array $params): void`
