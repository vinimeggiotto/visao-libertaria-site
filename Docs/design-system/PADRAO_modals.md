# Modals

## Login

Overlay fixo (`inset: 0`, `z-index: 100`), fundo `rgba(10,9,7,0.7)`, conteúdo centralizado com padding `20px`.

Cartão: `--vl-surface`, borda `1px solid rgba(255,255,255,0.1)`, raio `14px`, padding `32px`, largura máxima `380px`.

- Fechar: `bi-x` no canto (`top/right: 16px`), cor `--vl-muted-2`
- Título: Space Grotesk 700, `20px` — “Acessar minha conta”
- Campos e-mail e senha no padrão de `PADRAO_inputs.md`
- Primário “Entrar” em largura total
- Linha inferior: “Esqueci a senha” (muted + sublinhado) e “Cadastre-se” (ouro, peso 600)
- hCaptcha no body do `_main` quando o visitante é anônimo — não no `<head>`

Abertura: botão “Acessar” do header, ou `openLogin=1` na home (`PADRAO_navigation.md`).

## Foto de perfil

No cartão do perfil, o clique no círculo grande abre um modal Bootstrap (`#modal-avatar-perfil`) com a foto em tamanho maior. Sem foto, o modal mostra o ícone `bi-person-circle` e o texto “Nenhuma foto enviada”. Não usar o clique para trocar de aba.

O chrome do modal segue o mesmo dark: superfície `--vl-surface`, texto `--vl-text`, fechar em `--vl-muted-2`.
