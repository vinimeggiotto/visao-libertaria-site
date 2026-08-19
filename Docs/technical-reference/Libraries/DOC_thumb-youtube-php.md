# DOC_thumb-youtube-php

## Objetivo

Baixa a thumb `hqdefault` do YouTube para `public/assets/thumbs/{id}.jpg`.

## Dependências

`file_get_contents` HTTP com timeout de 8s. Sem retry.

## Lógica central

Valida id de 11 caracteres. Se o arquivo já existe, não baixa de novo. Falha devolve `false` (a URL da view continua local e o img 404).

## Assinaturas

- `caminhoAbsoluto(string $idVideo): string`
- `existe(string $idVideo): bool`
- `baixar(string $idVideo): bool`
