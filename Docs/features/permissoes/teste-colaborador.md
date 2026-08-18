# Teste — Colaborador (1)

Conta: `colaborador@colaborador.com`  
Senha: `12345678`  
Atribuições: só **1**

Antes: saia de qualquer sessão. Abra `http://localhost:8080`. Entre com esta conta.

Toast esperado (5 s, sem mudar de página no clique):  
`Você não tem a permissão Escritor para acessar essa área.`

---

## Deve entrar

- [ ] **Home**, **Vídeos**, **Notícias** abrem
- [ ] **Notícias** → **Sugerir pauta** abre o modal
- [ ] Avatar → **Meu Perfil** abre o perfil
- [ ] Avatar → **Sair** desloga

## Toast no clique (não navega)

- [ ] Header **Colaborar** → toast **Escritor**; URL continua no site

## Não deve aparecer

- [ ] **Administrar** some do header
- [ ] No perfil: **Artigos → Colaborar com artigos** some
- [ ] **Gerenciar todos os artigos**, Configurações, Financeiro, Pautas somem

## Toast no servidor (colar a URL)

Depois de cada URL, deve cair no **perfil** com toast 5 s.

- [ ] `/colaboradores/artigos/dashboard` → toast **Escritor**
- [ ] `/colaboradores/artigos/cadastrar` → toast **Escritor**
- [ ] `/colaboradores/admin/dashboard` → toast **Administrador**
