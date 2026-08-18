# Teste — Recrutador (1 + 9)

Conta: `recrutador@recrutador.com`  
Senha: `12345678`  
Atribuições: **1** e **9**

Antes: saia de qualquer sessão. Abra `http://localhost:8080`. Entre com esta conta.

---

## Deve entrar

- [ ] Avatar → **Meu Perfil** abre
- [ ] Colar `/colaboradores/admin/permissoes` abre a lista de colaboradores (sem toast)
- [ ] Abrir a ficha de um colaborador nessa lista funciona

## Toast no clique (não navega)

- [ ] Header **Colaborar** → toast **Escritor**
- [ ] Header **Administrar** → toast **Administrador**; não abre o dashboard

## Não deve aparecer

- [ ] Menu **Colaboradores** some (só aparece com 8) — por isso a lista é pela URL
- [ ] **Configurações**, **Financeiro**, **Pautas** somem
- [ ] **Artigos → Colaborar com artigos** some

## Toast no servidor (colar a URL)

- [ ] `/colaboradores/admin/dashboard` → perfil + toast **Administrador**
- [ ] `/colaboradores/admin/financeiro` → perfil + toast **Pagador**
- [ ] `/colaboradores/admin/contatos` → perfil + toast **Administrador**
- [ ] `/colaboradores/artigos/dashboard` → perfil + toast **Escritor**
