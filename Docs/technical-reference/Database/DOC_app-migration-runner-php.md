# AppMigrationRunner

## Objetivo

Localiza arquivos de migration do namespace informado e devolve a lista que o CodeIgniter executa.

## Dependências

- `CodeIgniter\Database\MigrationRunner` (`migrationFromFile`, propriedade `path`)
- Autoloader (`getNamespace`)

## Lógica central

Percorre os diretórios `Database/Migrations` do namespace (ou `$this->path`, se definido) e lista `*.php` com `glob()`, em vez de `get_filenames()` / `DirectoryIterator`.

## Assinaturas

- `findNamespaceMigrations(string $namespace): array` — lista de objetos de migration aceitos pelo runner.
