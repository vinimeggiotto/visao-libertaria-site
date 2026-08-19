# DOC_thumb-youtube-php

## Objetivo

Baixa a thumb `hqdefault` do YouTube e grava `public/assets/thumbs/{id}.webp`.

## Dependências

`file_get_contents` HTTP com timeout de 8s. GD (`imagecreatefromstring` + `imagewebp`). Sem retry.

## Lógica central

Valida id de 11 caracteres. Se o `.webp` já existe, não baixa de novo. Se só existir `.jpg` antigo, converte sem baixar. Falha devolve `false` (a URL da view continua local e o img 404).

## Assinaturas

- `caminhoAbsoluto(string $idVideo): string`
- `existe(string $idVideo): bool`
- `baixar(string $idVideo): bool`
