# `app/Libraries/RecodificadorAvatar.php`

## Objetivo

Normaliza o arquivo de avatar do perfil: corrige orientação EXIF, recorta o centro em quadrado, redimensiona e grava WebP.

## Dependências

`Config\Services::image()` (handler GD). Funções `imagewebp` e `exif_read_data`. Pasta `public/assets/avatars`. `base_url()`.

## Lógica central

Lê o temporário do upload. `reorient()` alinha foto de celular. Atualiza `origWidth`/`origHeight` do recurso (depois da rotação o `fit` usa esses valores). `fit` no menor lado, no máximo 512 px, posição `center`. Converte para `IMAGETYPE_WEBP` qualidade 80. A URL devolvida inclui `?t=` com o unix time da gravação.

## Assinaturas

- Constantes: `LADO_PX` (512), `QUALIDADE` (80), `MAX_KB` (8192), `MAX_DIM` (8000), `EXTENSOES` (`jpg,png,jpeg,webp`)
- `recodificarEGravar(UploadedFile $arquivo, string $idColaborador): string` — URL pública do WebP
