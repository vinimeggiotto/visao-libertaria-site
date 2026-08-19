# Teste — Pautador (1 + 10)

Conta: `pautador@pautador.com`  
Senha: `12345678`  
Atribuições: **1** e **10**

Antes: saia de qualquer sessão. Abra `http://localhost:8080`. Entre com esta conta.

---

## Deve entrar

- [ ] Avatar → **Meu Perfil** abre
- [ ] Colar `/colaboradores/pautas/fechar` abre **Fechar pautas** (sem toast)
- [ ] Depois disso, o menu **Pautas → Fechar pautas** funciona
- [ ] **Pautas → Pautas fechadas** abre

## Toast no clique (não navega)

- [ ] Header **Colaborar** → toast **Escritor**
- [ ] Header **Administrar** → toast **Administrador**; não abre o dashboard
- [ ] Depois de entrar em Fechar pautas: **Dashboard** (admin) → toast **Administrador**
- [ ] **Área do colaborador** abre o perfil (sem toast)

## Não deve aparecer

- [ ] **Configurações**, **Financeiro**, menu **Colaboradores** somem
- [ ] **Artigos → Colaborar com artigos** some

## Toast no servidor (colar a URL)

- [ ] `/colaboradores/admin/dashboard` → perfil + toast **Administrador**
- [ ] `/colaboradores/admin/financeiro` → perfil + toast **Pagador**
- [ ] `/colaboradores/admin/permissoes` → perfil + toast **Recrutador**
- [ ] `/colaboradores/artigos/dashboard` → perfil + toast **Escritor**
