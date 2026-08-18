# Teste — Publicador (1 + 6)

Conta: `publicador@publicador.com`  
Senha: `12345678`  
Atribuições: **1** e **6**

Antes: saia de qualquer sessão. Abra `http://localhost:8080`. Entre com esta conta.

Toast de Escritor (5 s, sem navegar):  
`Você não tem a permissão Escritor para acessar essa área.`

---

## Deve entrar

- [ ] Avatar → **Meu Perfil** abre
- [ ] No perfil: **Artigos → Colaborar com artigos** aparece
- [ ] Nessa tela, a fase **Publicar** aparece e funciona
- [ ] **Notícias** → **Sugerir pauta** abre

## Toast no clique (não navega)

- [ ] Header **Colaborar** → toast **Escritor**
- [ ] No perfil: **Dashboard** → toast **Escritor**
- [ ] **Artigos → Escrever novo** → toast **Escritor**
- [ ] **Artigos → Meus artigos** → toast **Escritor**

## Não deve aparecer

- [ ] **Administrar** some do header
- [ ] Fases **Revisar**, **Narrar**, **Produzir** somem
- [ ] **Gerenciar todos os artigos**, Configurações, Financeiro, Pautas somem

## Toast no servidor (colar a URL)

- [ ] `/colaboradores/artigos/dashboard` → perfil + toast **Escritor**
- [ ] `/colaboradores/admin/dashboard` → perfil + toast **Administrador**
