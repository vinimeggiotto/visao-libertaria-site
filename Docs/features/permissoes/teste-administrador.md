# Teste — Administrador (1 + 7)

Conta: `admin@admin.com`  
Senha: `12345678`  
Atribuições: **1** e **7**

Antes: saia de qualquer sessão. Abra `http://localhost:8080`. Entre com esta conta.

Toast de Escritor (5 s, sem mudar de página):  
`Você não tem a permissão Escritor para acessar essa área.`

---

## Deve entrar

- [x] Header **Administrar** abre o dashboard admin (sem toast)
- [x] **Configurações → Configurações gerais** abre
- [x] **Configurações → Layout e configuração dos sites** abre
- [x] **Configurações → Regras para colaborar** abre
- [x] **Configurações → Páginas estáticas** abre
- [x] Clique no **círculo do avatar** (Home) abre o perfil — não precisa abrir menu
- [x] **Área do colaborador** abre o perfil (passo a passo abaixo)
- [x] **Artigos → Gerenciar todos os artigos** abre
- [x] `/colaboradores/admin/contatos` abre as mensagens e a lista

---

## Como testar o avatar (item 1)

Se a URL já é `/colaboradores/perfil` e você vê Recados / “Colaborador desde…”, **o item 1 passou**. O círculo grande do cartão é a foto do perfil, não o atalho do header.

Para repetir o atalho do header:

1. Clique em **Home** na barra amarela (ou no logo).
2. No canto **direito do header**, clique no **círculo pequeno** (não no cartão da página).
3. Volta para `/colaboradores/perfil`. Sem toast.

---

## Como testar Área do colaborador (item 2)

O perfil **não** tem os botões Dashboard / Escrever novo / Meus artigos. Esses ficam na área de artigos (barra amarela).

### 2a. Área do colaborador → perfil

1. Clique em **Administrar** (já funciona). Você está no dashboard admin, barra amarela, menu **Dashboard** e **Configurações**.
2. Olhe a **faixa preta bem no topo**, à esquerda.
3. O primeiro link é **Área do colaborador**.
4. Clique nele.
5. Esperado: vai para o **perfil** (mesma página do avatar). **Sem toast de Escritor.**

### 2b. Toasts de Escritor (Dashboard / Escrever / Meus artigos)

Esses três só existem depois que você entra numa tela da área de artigos. Caminho que você já usou:

1. Clique em **Administrar**.
2. Avatar (nome **Administrador**, à direita da barra amarela) → **Meu Perfil**, **ou** faça o 2a acima, **ou** abra **Gerenciar todos os artigos** (você já confirmou que abre).
3. Se estiver no perfil: clique **Gerenciar todos os artigos** em **Artigos** — se esse item não aparecer no perfil, volte em **Administrar** e use a URL `/colaboradores/admin/artigos`.
4. Agora a barra amarela tem **Dashboard** e **Artigos**.
5. Clique em **Dashboard** (globo) → toast **Escritor**; a página **não** muda para o dashboard de escritor.
6. Clique em **Artigos** → **Escrever novo** → toast **Escritor**; não abre o formulário.
7. Clique em **Artigos** → **Meus artigos** → toast **Escritor**; não abre a lista.

## Toast no clique (não navega)

- [x] Header **Colaborar** (site público) → toast **Escritor**
- [x] Na barra amarela da área de artigos: **Dashboard** → toast **Escritor**
- [x] **Artigos → Escrever novo** → toast **Escritor**
- [x] **Artigos → Meus artigos** → toast **Escritor**

## Não deve aparecer

- [x] **Financeiro** some
- [x] Menu **Colaboradores** (lista + contato) some
- [x] **Pautas** some
- [x] **Artigos → Colaborar com artigos** some

## Toast no servidor (colar a URL)

- [x] `/colaboradores/artigos/dashboard` → perfil + toast **Escritor**
- [x] `/colaboradores/admin/financeiro` → perfil + toast **Pagador**
- [x] `/colaboradores/admin/permissoes` → perfil + toast **Recrutador**
- [x] `/colaboradores/pautas/fechar` → perfil + toast **Pautador**
