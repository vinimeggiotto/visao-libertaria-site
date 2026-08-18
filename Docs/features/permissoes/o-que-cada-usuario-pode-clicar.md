# O que cada conta fixa pode clicar

Senha de todas: `12345678`. As especializadas (2–11) também têm a atribuição **1 (Colaborador)**, para o perfil funcionar.

A lista é o que a **interface mostra hoje** e o que o **servidor aceita**. Onde os dois diferem, está marcado.

Itens comuns a **qualquer logado** no site público:

- Home, Vídeos, Notícias
- **Sugerir pauta** (Notícias)
- **Colaborar** (header)
- Avatar: **Meu Perfil**, **Sair**

**Administrar** só entra no HTML se a sessão tiver 7, 8, 9 ou 10.

---

## Colaborador — `colaborador@colaborador.com` (só 1)

**Pode clicar e o servidor aceita**

- Home, Vídeos, Notícias
- **Sugerir pauta**
- Avatar → **Meu Perfil** (dados, senha, recados)
- Avatar → **Sair**
- Detalhe de artigo (qualquer papel 1–11)

**Vê o botão, o servidor recusa (cai no perfil)**

- **Colaborar**
- Se entrar na área logada: **Dashboard**, **Artigos → Escrever novo**, **Artigos → Meus artigos**

**Não vê**

- **Administrar**
- **Artigos → Colaborar com artigos**
- **Gerenciar todos os artigos**, Configurações, Financeiro, Colaboradores, Fechar pautas

---

## Escritor — `escritor@escritor.com` (1 + 2)

**Pode clicar e o servidor aceita**

- Tudo do Colaborador que o servidor aceita
- **Colaborar** → dashboard de artigos
- **Dashboard**
- **Artigos → Escrever novo**
- **Artigos → Meus artigos**
- Detalhe de artigo

**Não vê**

- **Artigos → Colaborar com artigos** (3–6)
- **Administrar** e o restante do painel admin

---

## Revisor — `revisor@revisor.com` (1 + 3)

**Pode clicar e o servidor aceita**

- Perfil, Notícias (**Sugerir pauta**), Sair
- **Artigos → Colaborar com artigos** → botão de fase **Revisar**

**Vê o botão, o servidor recusa (exige 2)**

- **Colaborar** no header
- **Dashboard**, **Escrever novo**, **Meus artigos**

**Não vê**

- **Administrar**, financeiro, fechar pautas, gerenciar todos os artigos
- Fases **Narrar**, **Produzir**, **Publicar**

---

## Narrador — `narrador@narrador.com` (1 + 4)

Igual ao Revisor: **Colaborar com artigos** → fase **Narrar**. Sem Revisar / Produzir / Publicar.

---

## Produtor — `produtor@produtor.com` (1 + 5)

Igual ao Revisor: **Colaborar com artigos** → fase **Produzir**. Sem Revisar / Narrar / Publicar.

---

## Publicador — `publicador@publicador.com` (1 + 6)

Igual ao Revisor: **Colaborar com artigos** → fase **Publicar**. Sem Revisar / Narrar / Produzir.

---

## Administrador — `admin@admin.com` (1 + 7)

**Pode clicar e o servidor aceita**

- **Administrar** → dashboard admin
- **Configurações → Configurações gerais**
- **Configurações → Layout e configuração dos sites**
- **Configurações → Regras para colaborar**
- **Configurações → Páginas estáticas**
- **Artigos → Gerenciar todos os artigos** (área do colaborador)
- Perfil, Notícias (**Sugerir pauta**), Sair
- Detalhe de artigo

**Vê o botão, o servidor recusa**

- **Colaborar** (dashboard de escritor exige 2)
- **Dashboard / Escrever novo / Meus artigos** na área do colaborador (exigem 2)

**Não vê (e não é)**

- **Financeiro** (8)
- Menu **Colaboradores** / **Mensagens de contato** (o menu aparece só com 8)
- **Pautas → Fechar pautas / Pautas fechadas** (10)
- **Colaborar com artigos** (3–6)

---

## Pagador — `pagador@pagador.com` (1 + 8)

**Pode clicar e o servidor aceita**

- **Financeiro**
- Perfil, Notícias, Sair

**Vê o botão, o servidor recusa**

- **Administrar** / **Dashboard** admin (exigem 7)
- Menu **Colaboradores → Colaboradores** (rota exige 9)
- Menu **Colaboradores → Mensagens de contato** (várias actions exigem 7)
- **Colaborar** (exige 2)

**Não vê**

- **Configurações** (7)
- **Pautas** (10)
- Fases 3–6, **Escrever novo**

---

## Recrutador — `recrutador@recrutador.com` (1 + 9)

**Pode clicar e o servidor aceita** (se chegar na URL)

- `/colaboradores/admin/permissoes` — lista e ficha: atribuições, bloqueio, shadowban
- Histórico de colaborador
- Perfil, Notícias, Sair

**Vê o botão, o servidor recusa**

- **Administrar** / **Dashboard** admin (exigem 7)
- **Colaborar** (exige 2)

**Não vê o botão, embora a rota seja dele**

- Menu **Colaboradores** (só aparece com 8)

**Não vê**

- Configurações, financeiro, fechar pautas, escrever artigo, fases 3–6

---

## Pautador — `pautador@pautador.com` (1 + 10)

**Pode clicar e o servidor aceita**

- **Pautas → Fechar pautas**
- **Pautas → Pautas fechadas**
- Perfil, Notícias, Sair

**Vê o botão, o servidor recusa**

- **Administrar** / **Dashboard** admin (exigem 7)
- **Colaborar** (exige 2)

**Não vê**

- Configurações, financeiro, lista de colaboradores, escrever artigo, fases 3–6

---

## Redator — `redator@redator.com` (1 + 11)

**Pode clicar e o servidor aceita**

- Mesmo que o Colaborador: perfil, notícias (**Sugerir pauta**), sair
- Detalhe de artigo

**Não há botão exclusivo** da atribuição 11 no menu.

**Vê o botão, o servidor recusa**

- **Colaborar** (exige 2)

**Não vê**

- **Administrar**, escrever artigo, fases 3–6

---

## Avisos (UI ≠ servidor)

1. **Colaborar** no site público não olha a atribuição 2.
2. **Administrar** aparece para 7 ou 8 ou 9 ou 10; o dashboard exige só 7.
3. Menu **Colaboradores** (lista) aparece com 8; a rota exige 9.
4. Depois de mudar atribuição no banco, saia e entre de novo — a sessão guarda as permissões do login.
