# `.docker/router.php`

## Objetivo

Roteia o servidor embutido do PHP (`php -S`): estáticos no caminho pedido (incluindo `/public/...`) ou o front controller `index.php` da raiz do projeto. No Docker local o HTTP é nginx + PHP-FPM; este arquivo não é o processo que atende a porta 8080.

## Dependências

Nenhuma biblioteca. Usa só `$_SERVER['REQUEST_URI']` e `$_SERVER['DOCUMENT_ROOT']`.

## Lógica central

Se o path for `/favicon.ico` e o arquivo `public/assets/favicon.ico` existir, envia esse ícone. Se o path da URL não for `/`, não contiver `..` e existir como arquivo sob a document root, devolve `false` para o PHP servir o arquivo. Caso contrário inclui o `index.php` da raiz (mesmo contrato do `.htaccess` de produção).

## Assinaturas

Não expõe funções. Pode ser passado a `php -S ... .docker/router.php`. O entrypoint do Docker não o invoca.
