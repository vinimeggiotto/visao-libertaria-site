# `.docker/router.php`

## Objetivo

Roteia o servidor embutido do PHP no Docker: estáticos no caminho pedido (incluindo `/public/...`) ou o front controller `index.php` da raiz do projeto.

## Dependências

Nenhuma biblioteca. Usa só `$_SERVER['REQUEST_URI']` e `$_SERVER['DOCUMENT_ROOT']`.

## Lógica central

Se o path da URL não for `/`, não contiver `..` e existir como arquivo sob a document root, devolve `false` para o PHP servir o arquivo. Caso contrário inclui o `index.php` da raiz (mesmo contrato do `.htaccess` de produção).

## Assinaturas

Não expõe funções. É o script passado a `php -S ... .docker/router.php`.
