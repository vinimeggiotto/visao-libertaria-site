# Inputs

## Arquivo de avatar (perfil)

Campo `type="file"` Bootstrap `form-control`, com `form-text` abaixo.

- Aceitar: JPEG, PNG, WebP (`accept` e validação iguais)
- Texto de ajuda: a foto será recortada em quadrado e otimizada no envio
- Não aceitar HEIC
- Preview no círculo do perfil (110px) e do menu (30px) com `object-fit: cover`
- Erro de validação ou falha de processamento: toast `ATENÇÃO` + `TOAST_STATUS.DANGER` (`PADRAO_feedback.md`)
