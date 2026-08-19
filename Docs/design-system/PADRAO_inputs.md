# Inputs

## Campo de formulário

Label acima do controle: `12px`–`13px`, cor `--vl-muted`, margem inferior `6px`.

Controle (texto, senha, e-mail, select, textarea):

- Fundo `--vl-bg` (`#171512`)
- Borda `1px solid rgba(255,255,255,0.12)`, raio `--vl-radius` (`8px`)
- Padding `11px 13px` (modal) ou `12px 14px` (página)
- Texto `--vl-text` `14px`, família Public Sans
- Placeholder e valor vazio visual: `--vl-muted-2`
- Textarea: `resize: vertical`, altura mínima ~`96px` no contato

Busca da listagem de notícias: o campo mora dentro de um recipiente `--vl-surface` (não `--vl-bg`), mesma borda e raio, ícone `bi-search` em `--vl-muted-2` à esquerda. Sem chips de categoria ao lado da busca (`PADRAO_layout.md`).

Foco: o anel/borda acompanha o ouro `--vl-brand` sem alterar o fundo dark.

hCaptcha: bloco no fluxo do form (cadastro, contato, esqueci senha, modal de login). Visual de reserva: recorte tracejado, raio `8px`, texto `--vl-muted-2` — o widget oficial ocupa esse espaço.

Submit: botão primário de largura do form (peso 700, padding `13px`–`14px`). Links auxiliares abaixo (esqueci senha / cadastre-se) no padrão de `PADRAO_layout.md`.

## Arquivo de avatar (perfil)

Campo `type="file"` no visual de campo acima, com `form-text` abaixo em `--vl-muted-2`.

- Aceitar: JPEG, PNG, WebP (`accept` e validação iguais)
- Texto de ajuda: a foto será recortada em quadrado e otimizada no envio
- Não aceitar HEIC
- Preview no círculo do perfil (110px) e do menu (30px) com `object-fit: cover`
- Erro de validação ou falha de processamento: toast de erro no visual de `PADRAO_feedback.md` (título `ATENÇÃO`, status perigo)
