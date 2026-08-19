# ADR: fallback do placeholder de card

## 1. Visão macro

Papel: se o [placehold.co](https://placehold.co/) não entregar a thumb vazia, o `<img>` troca uma vez para [placehold.net](https://placehold.net/) (`600x400.png`, tamanho de catálogo mais próximo de 480×270).

Impacto: o card continua com uma imagem. Sem isso, o `src` quebrado fica vazio (ícone de imagem morta).

Trade-off: um request extra **só na falha**. Consistência visual menor (foto de catálogo vs bloco cinza gerado). Disponibilidade acima de pixel-perfect.

## 2. Detalhe técnico

- Gatilho: evento `error` do `<img>` cujo `src` é o placehold.co.
- Padrão: **Graceful Degradation** (fonte secundária no cliente). Não é Retry with Backoff nem Circuit Breaker: um hop, sem espera, sem PHP, sem fila.
- `onerror=null` (ou handler de uma vez) para não loop se o .net também falhar.
- O .net não gera 480×270; usa `https://placehold.net/600x400.png` (HTTP 200 conferido).
- Só nos `<img>` que já são placeholder. URL real de notícia não entra nesse hop.

Recovery: o próximo page load tenta o .co de novo (não há estado).

## 3. Observabilidade

O hop não é logado no servidor (ocorre no browser). Sem alerta. Se os dois hosts caírem, o card fica sem thumb.
