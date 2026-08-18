# Teste — Administrador (1 + 7)

Conta: `admin@admin.com`  
Senha: `12345678`  
Atribuições: **1** e **7**

Antes: saia de qualquer sessão. Abra `http://localhost:8080`. Entre com esta conta.

Toast de Escritor (5 s, sem navegar):  
`Você não tem a permissão Escritor para acessar essa área.`

---

## Deve entrar

- [x] Header **Administrar** abre o dashboard admin (sem toast)
- [x] **Configurações → Configurações gerais** abre
- [x] **Configurações → Layout e configuração dos sites** abre
- [x] **Configurações → Regras para colaborar** abre
- [x] **Configurações → Páginas estáticas** abre
- [ ] Avatar → **Meu Perfil** abre
- [ ] No perfil: **Artigos → Gerenciar todos os artigos** abre
- [ ] Colar `/colaboradores/admin/contatos` abre as mensagens (menu desse item só existe com 8)

## Toast no clique (não navega)

- [x] Header **Colaborar** → toast **Escritor**
- [ ] No perfil: **Dashboard** → toast **Escritor**
- [ ] **Artigos → Escrever novo** → toast **Escritor**
- [ ] **Artigos → Meus artigos** → toast **Escritor**

## Não deve aparecer

- [ ] **Financeiro** some
- [ ] Menu **Colaboradores** (lista + contato) some
- [ ] **Pautas** some
- [ ] **Artigos → Colaborar com artigos** some

## Toast no servidor (colar a URL)

- [ ] `/colaboradores/artigos/dashboard` → perfil + toast **Escritor**
- [ ] `/colaboradores/admin/financeiro` → perfil + toast **Pagador**
- [ ] `/colaboradores/admin/permissoes` → perfil + toast **Recrutador**
- [ ] `/colaboradores/pautas/fechar` → perfil + toast **Pautador**
