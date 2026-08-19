# DOC_asset-helper-php

## Objetivo

Gera URL de CSS/JS local com `?v=` igual ao `filemtime` do arquivo.

## Dependências

`FCPATH` / `ROOTPATH`, `site_url()`.

## Lógica central

Procura o arquivo em `FCPATH` e, se não achar, em `ROOTPATH`. Sem arquivo, devolve a URL sem query.

## Assinaturas

- `asset_url(string $caminhoRelativo): string`
