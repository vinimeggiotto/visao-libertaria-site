# DOC_base-controller-php

## Objetivo

Garante a sessão do request, monta a config do site (cache global + sessão) e expõe cache anônimo da home e das listagens públicas.

## Dependências

`app_session()`, `Services::cache()`, `ConfiguracaoModel`, `PaginasEstaticasModel`, `ColaboradoresNotificacoesModel`.

## Lógica central

`initController` obtém a sessão via `app_session()` (único ponto que chama `start()`, e só se `session_status()` ainda não for `PHP_SESSION_ACTIVE`). Em produção, `montarSiteConfig()` grava em `site_config_{versao}`. Listagens anônimas usam HTML em cache (TTL 300s) com chave que inclui a versão da home. `invalidarCacheHome` / `invalidarSiteConfig` sobem o arquivo de versão e apagam a chave antiga.

## Assinaturas

- `initController(RequestInterface, ResponseInterface, LoggerInterface): void`
- `obterDadosCacheAnonimo(string $chave, callable $montador): array`
- `obterHtmlCacheAnonimo(string $chave, callable $montador): string`
- `chaveCacheListagem(string $pagina, string $extra = ''): string`
- `invalidarCacheHome(): void`
- `invalidarSiteConfig(): void`
