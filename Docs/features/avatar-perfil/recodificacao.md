# Recodificação do avatar

O colaborador envia JPEG, PNG ou WebP (até 8 MB, até 8000×8000). O servidor recorta o centro em quadrado, redimensiona no máximo a 512×512, grava WebP qualidade 80 em `public/assets/avatars/{id}.webp` e guarda a URL com `?t=` para o cache não servir a foto antiga.

O navegador tenta recortar e converter para WebP antes do POST. Se não conseguir, envia o arquivo original; o servidor recodifica do mesmo jeito.

HEIC (foto original do iPhone) não entra. Sem WebP no GD ou sem EXIF no PHP, o processamento falha e o perfil não atualiza a foto.

Limite de entrada no PHP: `upload_max_filesize=8M` e `post_max_size=12M` (Docker: `.docker/php-uploads.ini`; XAMPP: `php.ini`).
