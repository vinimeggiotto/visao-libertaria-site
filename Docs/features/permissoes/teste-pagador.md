# Teste — Pagador (1 + 8)

Conta: `pagador@pagador.com`  
Senha: `12345678`  
Atribuições: **1** e **8**

Antes: saia de qualquer sessão. Abra `http://localhost:8080`. Entre com esta conta.

---

## Deve entrar

- [ ] Avatar → **Meu Perfil** abre
- [ ] Colar `/colaboradores/admin/financeiro` abre o Financeiro (sem toast)
- [ ] Nessa tela, o item **Financeiro** do menu aparece
- [ ] Nessa tela, o grupo **Colaboradores** aparece no menu

## Toast no clique (não navega)

- [ ] Header **Colaborar** → toast **Escritor**
- [ ] Header **Administrar** → toast **Administrador**; não abre o dashboard
- [ ] Depois de entrar no Financeiro: **Dashboard** (admin) → toast **Administrador**
- [ ] **Colaboradores → Colaboradores** → toast **Recrutador**
- [ ] **Colaboradores → Mensagens de contato** → toast **Administrador**
- [ ] **Área do colaborador** → toast **Escritor**

## Não deve aparecer

- [ ] **Configurações** some
- [ ] **Pautas** some
- [ ] **Artigos → Colaborar com artigos** some (se chegar no perfil)

## Toast no servidor (colar a URL)

- [ ] `/colaboradores/admin/dashboard` → perfil + toast **Administrador**
- [ ] `/colaboradores/admin/permissoes` → perfil + toast **Recrutador**
- [ ] `/colaboradores/admin/contatos` → perfil + toast **Administrador**
- [ ] `/colaboradores/artigos/dashboard` → perfil + toast **Escritor**
