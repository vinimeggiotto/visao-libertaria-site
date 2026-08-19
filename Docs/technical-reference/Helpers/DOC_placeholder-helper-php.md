# `app/Helpers/placeholder_helper.php`

## Objetivo

Monta a URL do placeholder público e decide se uma URL de imagem de card/pauta conta como vazia.

## Dependências

Nenhuma lib. Serviço externo: `https://placehold.co/` (sem chave). Não chama o YouTube.

## Lógica central

`cria_url_placeholder` devolve `https://placehold.co/{L}x{A}/222222/888888.webp` (L e A entre 10 e 4000). Cores fixas para todos os cards vazios compartilharem o mesmo cache do browser.

Se o `.co` falhar, `attr_onerror_placeholder` troca o `src` uma vez para `https://placehold.net/600x400.png`. Sem loop. Sem retry no PHP.

`imagem_publica_eh_vazia` é verdadeiro se a URL for vazia, `imagem-default.webp`/`imagem-default.png` ou `via.placeholder.com`. URL real de notícia e URLs do `placehold.co` / `placehold.net` não são vazias.

## Assinaturas

- `cria_url_placeholder(int $largura = 480, int $altura = 270): string`
- `cria_url_placeholder_fallback(): string`
- `attr_onerror_placeholder(): string`
- `imagem_publica_eh_vazia(?string $url): bool`
