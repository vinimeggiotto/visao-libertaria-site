# Teste — Escritor (1 + 2)

Conta: `escritor@escritor.com`  
Senha: `12345678`  
Atribuições: **1** e **2**

Antes: saia de qualquer sessão. Abra `http://localhost:8080`. Entre com esta conta.

---

## Deve entrar

- [x] **Notícias** → **Sugerir pauta** abre o modal
- [x] Avatar → **Meu Perfil** abre
- [x] Header **Colaborar** abre o dashboard de artigos (sem toast)
- [x] **Artigos → Escrever novo** abre o formulário
- [x] **Artigos → Meus artigos** abre a lista

## Não deve aparecer

- [x] **Administrar** some do header
- [x] **Artigos → Colaborar com artigos** some
- [x] **Gerenciar todos os artigos**, Configurações, Financeiro, Pautas somem

## Toast no servidor (colar a URL)

- [x] `/colaboradores/artigos/artigosColaborar` → perfil + toast **Revisor, Narrador, Produtor ou Publicador**
- [x] `/colaboradores/admin/dashboard` → perfil + toast **Administrador**
