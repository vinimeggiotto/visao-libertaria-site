# Teste — Redator (1 + 11)

Conta: `redator@redator.com`  
Senha: `12345678`  
Atribuições: **1** e **11**

Antes: saia de qualquer sessão. Abra `http://localhost:8080`. Entre com esta conta.

Não existe botão exclusivo da atribuição 11. O comportamento é o do Colaborador.

Toast de Escritor (5 s, sem navegar):  
`Você não tem a permissão Escritor para acessar essa área.`

---

## Deve entrar

- [ ] **Home**, **Vídeos**, **Notícias** abrem
- [ ] **Notícias** → **Sugerir pauta** abre o modal
- [ ] Avatar → **Meu Perfil** abre
- [ ] Avatar → **Sair** desloga

## Toast no clique (não navega)

- [ ] Header **Colaborar** → toast **Escritor**; URL continua no site

## Não deve aparecer

- [ ] **Administrar** some do header
- [ ] **Artigos → Colaborar com artigos** some
- [ ] **Gerenciar todos os artigos**, Configurações, Financeiro, Pautas somem

## Toast no servidor (colar a URL)

- [ ] `/colaboradores/artigos/dashboard` → perfil + toast **Escritor**
- [ ] `/colaboradores/admin/dashboard` → perfil + toast **Administrador**
- [ ] `/colaboradores/artigos/artigosColaborar` → perfil + toast **Revisor, Narrador, Produtor ou Publicador**
