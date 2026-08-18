# Teste — Escritor (1 + 2)

Conta: `escritor@escritor.com`  
Senha: `12345678`  
Atribuições: **1** e **2**

Antes: saia de qualquer sessão. Abra `http://localhost:8080`. Entre com esta conta.

---

## Deve entrar

- [ ] **Notícias** → **Sugerir pauta** abre o modal
- [ ] Avatar → **Meu Perfil** abre
- [ ] Header **Colaborar** abre o dashboard de artigos (sem toast)
- [ ] **Artigos → Escrever novo** abre o formulário
- [ ] **Artigos → Meus artigos** abre a lista

## Não deve aparecer

- [ ] **Administrar** some do header
- [ ] **Artigos → Colaborar com artigos** some
- [ ] **Gerenciar todos os artigos**, Configurações, Financeiro, Pautas somem

## Toast no servidor (colar a URL)

- [ ] `/colaboradores/artigos/artigosColaborar` → perfil + toast **Revisor, Narrador, Produtor ou Publicador**
- [ ] `/colaboradores/admin/dashboard` → perfil + toast **Administrador**
