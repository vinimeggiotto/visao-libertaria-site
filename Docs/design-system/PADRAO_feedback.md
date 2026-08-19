# Feedback

## Toast

Use o `popMessage` já existente (Bootstrap Toaster). Não acrescentar Sonner nem outra lib.

Peça visual única, canto inferior direito (`bottom: 24px`, `right: 24px`, `z-index: 200`):

- Fundo `--vl-surface`, borda `1px solid rgba(255,255,255,0.14)`, raio `10px`
- Padding `16px 20px`, largura máxima `320px`, sombra `0 12px 24px rgba(0,0,0,0.4)`
- Barra esquerda de `3px` (o estado):
  - **Sucesso** — `#4ade80` (cadastro confirmado, mensagem enviada, artigo criado, senha alterada)
  - **Erro / perigo** — `--vl-danger` (`#e5484d`)
  - **Aviso** — `--vl-brand` (`#f3c921`)
  - **Loading** — `--vl-muted-2` (`#847e72`), mesmo cartão; o texto descreve o progresso (sem spinner de outra lib)
- Título: peso 700, `14px`, `--vl-text`
- Mensagem: `13px`, `--vl-muted`

Duração padrão do toast de sucesso do chrome: `3500` ms. Demais toasts de formulário: `3000` ms, exceto o aviso de permissão abaixo.

## Toast de permissão

Texto fixo: `Você não tem a permissão {nome} para acessar essa área.`

- Título: `ATENÇÃO`
- Status: aviso (barra ouro). Se a lib só expuser `TOAST_STATUS.WARNING` ou `DANGER`, use o que existir — o cartão continua no visual acima
- Duração: `5000` ms só neste aviso

O clique em `.js-requer-permissao` sem a atribuição em `data-permissoes` **não navega**. Quem cola a URL recebe o mesmo texto via flash `aviso_permissao` na página de chegada (`public/js/aviso-permissao.js`).
