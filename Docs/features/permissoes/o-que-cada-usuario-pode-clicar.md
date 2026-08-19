# O que cada permissão acessa

Senha das contas fixas: `12345678`. As especializadas (2–11) também têm a atribuição **1**.

Três comportamentos de botão:

1. **Ocultar** — o item não aparece.
2. **Toast no clique** — o item aparece; o clique não navega; toast 5 s: `Você não tem a permissão {nome} para acessar essa área.`
3. **Toast no servidor** — quem cola a URL cai no perfil com o mesmo toast.

Roteiros de teste (um arquivo por permissão): `teste-colaborador.md`, `teste-escritor.md`, `teste-revisor.md`, `teste-narrador.md`, `teste-produtor.md`, `teste-publicador.md`, `teste-administrador.md`, `teste-pagador.md`, `teste-recrutador.md`, `teste-pautador.md`, `teste-redator.md`.

Abaixo, em cada perfil: só o que **acessa de verdade** e o caminho depois de logado. Em seguida, a tabela de botões.

---

## Base de todas (atribuição 1)

- **Meu Perfil** — avatar → **Meu Perfil**
- **Sugerir pauta** — **Notícias** → **Sugerir pauta**
- **Sair** — avatar → **Sair**

---

## 1 — Colaborador (`colaborador@colaborador.com`)

Só a base acima.

---

## 1 + 2 — Escritor (`escritor@escritor.com`)

- **Dashboard de artigos** — header **Colaborar**
- **Escrever novo** — **Colaborar** → **Artigos** → **Escrever novo**
- **Meus artigos** — **Colaborar** → **Artigos** → **Meus artigos**

---

## 1 + 3 — Revisor (`revisor@revisor.com`)

- **Revisar artigos** — avatar → **Meu Perfil** → **Artigos** → **Colaborar com artigos** → **Revisar**

---

## 1 + 4 — Narrador (`narrador@narrador.com`)

- **Narrar artigos** — avatar → **Meu Perfil** → **Artigos** → **Colaborar com artigos** → **Narrar**

---

## 1 + 5 — Produtor (`produtor@produtor.com`)

- **Produzir artigos** — avatar → **Meu Perfil** → **Artigos** → **Colaborar com artigos** → **Produzir**

---

## 1 + 6 — Publicador (`publicador@publicador.com`)

- **Publicar artigos** — avatar → **Meu Perfil** → **Artigos** → **Colaborar com artigos** → **Publicar**

---

## 1 + 7 — Administrador (`admin@admin.com`)

- **Dashboard admin** — header **Administrar**
- **Configurações gerais / Layout / Regras / Páginas estáticas** — **Administrar** → **Configurações**
- **Gerenciar todos os artigos** — avatar → **Meu Perfil** → **Artigos** → **Gerenciar todos os artigos**
- **Mensagens de contato** — URL `/colaboradores/admin/contatos` (o menu desse item só aparece com 8)

---

## 1 + 8 — Pagador (`pagador@pagador.com`)

- **Financeiro** — URL `/colaboradores/admin/financeiro` (**Administrar** no header exige 7 e dispara toast)

---

## 1 + 9 — Recrutador (`recrutador@recrutador.com`)

- **Lista / ficha de colaboradores** — URL `/colaboradores/admin/permissoes`

---

## 1 + 10 — Pautador (`pautador@pautador.com`)

- **Fechar pautas / Pautas fechadas** — URL `/colaboradores/pautas/fechar` (depois o menu **Pautas** aparece)

---

## 1 + 11 — Redator (`redator@redator.com`)

Só a base do Colaborador. Sem tela exclusiva.

---

## Comportamento de cada botão

| Botão | Quem vê | Quem entra | Comportamento |
|---|---|---|---|
| Home, Vídeos, Notícias | todos | todos | entra |
| Sugerir pauta | logado (1) | 1 | entra |
| Meu Perfil / Sair | logado (1) | 1 | entra |
| **Colaborar** (header) | qualquer logado | 2 | **toast no clique** se não for 2; URL → **toast no servidor** (Escritor) |
| **Administrar** (header) | 7, 8, 9 ou 10 | 7 | **toast no clique** se não for 7; URL do dashboard → **toast no servidor** (Administrador) |
| Dashboard / logo da área colaborador | quem está nessa área | 2 | **toast no clique** se não for 2 |
| Artigos → Escrever novo | quem está na área colaborador | 2 | **toast no clique** se não for 2 |
| Artigos → Meus artigos | quem está na área colaborador | 2 | **toast no clique** se não for 2 |
| Artigos → Colaborar com artigos | 3, 4, 5 ou 6 | 3–6 (fase da pessoa) | **ocultar** para os outros; URL sem 3–6 → **toast no servidor** |
| Fase Revisar / Narrar / Produzir / Publicar | só a fase da atribuição | 3 / 4 / 5 / 6 | **ocultar** as outras fases |
| Artigos → Gerenciar todos os artigos | 7 | 7 | **ocultar** para os outros; URL → **toast no servidor** |
| Configurações (4 itens) | 7 | 7 | **ocultar** para os outros; URL → **toast no servidor** |
| Financeiro | 8 | 8 | **ocultar** para os outros; URL → **toast no servidor** |
| Menu Colaboradores (grupo) | 8 | — | **ocultar** se não for 8 |
| Colaboradores (lista / ficha) | 8 (dentro do grupo) | 9 | **toast no clique** se for 8 sem 9; URL → **toast no servidor** (Recrutador) |
| Mensagens de contato | 8 no menu; URL para 7 | 7 | **toast no clique** se for 8 sem 7; URL sem 7 → **toast no servidor** |
| Pautas → Fechar / Fechadas | 10 | 10 | **ocultar** para os outros; URL → **toast no servidor** |
| Área do colaborador (layout admin) | quem está no admin | 1 | entra no perfil |
| Dashboard admin (layout admin) | quem está no admin | 7 | **toast no clique** se não for 7 |

Quem tem a atribuição certa no botão **entra** — não há toast.
