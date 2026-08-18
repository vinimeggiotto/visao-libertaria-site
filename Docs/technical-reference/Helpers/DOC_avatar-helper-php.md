# `app/Helpers/avatar_helper.php`

## Objetivo

Decide se o colaborador tem foto e renderiza `<img>` ou o ícone Bootstrap `bi-person-circle` no mesmo tamanho.

## Dependências

`esc()` do CodeIgniter. A folha Bootstrap Icons já carregada nos layouts. Não chama API nem banco.

## Lógica central

`avatar_tem_foto` é falso quando o valor é nulo, vazio ou contém `avatar-default.png` (placeholder antigo). `avatar_html` devolve a foto ou um `<span class="vl-avatar-placeholder">` com `bi bi-person-circle`. `avatar_slot_html` envolve isso num `#id` para o preview JS do perfil trocar só o HTML interno.

## Assinaturas

- `avatar_tem_foto(?string $avatar): bool`
- `avatar_html(?string $avatar, string $alt = '', string $imgClass = 'rounded-circle', string $sizeCss = 'width:2.75rem;height:2.75rem;object-fit:cover;', array $imgAttrs = []): string`
- `avatar_slot_html(string $id, ?string $avatar, string $alt = '', string $imgClass = 'rounded-circle', string $sizeCss = 'width:2.75rem;height:2.75rem;object-fit:cover;'): string`
