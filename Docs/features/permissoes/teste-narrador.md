# Teste — Narrador (1 + 4)

Conta: `narrador@narrador.com`  
Senha: `12345678`  
Atribuições: **1** e **4**

Antes: saia de qualquer sessão. Abra `http://localhost:8080`. Entre com esta conta.

Toast de Escritor (5 s, sem navegar):  
`Você não tem a permissão Escritor para acessar essa área.`

---

## Deve entrar

- [x] Avatar → **Meu Perfil** abre
- [ ] No perfil: **Artigos → Colaborar com artigos** aparece
- [ ] Nessa tela, a fase **Narrar** aparece e funciona
- [x] **Notícias** → **Sugerir pauta** abre

## Toast no clique (não navega)

- [x] Header **Colaborar** → toast **Escritor**
- [x] No perfil: **Dashboard** → toast **Escritor**
- [x] **Artigos → Escrever novo** → toast **Escritor**
- [x] **Artigos → Meus artigos** → toast **Escritor**

## Não deve aparecer

- [x] **Administrar** some do header
- [x] Fases **Revisar**, **Produzir**, **Publicar** somem
- [x] **Gerenciar todos os artigos**, Configurações, Financeiro, Pautas somem

## Toast no servidor (colar a URL)

- [x] `/colaboradores/artigos/dashboard` → perfil + toast **Escritor**
- [x] `/colaboradores/admin/dashboard` → perfil + toast **Administrador**
