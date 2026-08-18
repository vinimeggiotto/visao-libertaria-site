# Feedback

## Toast de permissão

Use o `popMessage` já existente (Bootstrap Toaster). Não acrescentar Sonner nem outra lib.

Texto fixo: `Você não tem a permissão {nome} para acessar essa área.`

- Título: `ATENÇÃO`
- Status: `TOAST_STATUS.WARNING` (se a lib não tiver, `DANGER`)
- Duração: 5000 ms só neste aviso; os outros toasts seguem 3000 ms

O clique em `.js-requer-permissao` sem a atribuição em `data-permissoes` **não navega**. Quem cola a URL recebe o mesmo texto via flash `aviso_permissao` na página de chegada (`public/js/aviso-permissao.js`).
