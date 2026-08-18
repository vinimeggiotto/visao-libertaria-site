# HTTP 500 no POST `/site/login` com “lembrar”

## Sintoma

Login AJAX responde 500. O `main.js?attr=...` / `unload` é o Kaspersky, não o site.

## Causa raiz

Com a caixa “lembrar” marcada, `Site::login` chama `secured_encrypt` para o cookie `hash`.

No `env.docker` / `.env` local:

- `METHOD = aria-256-ccm` — modo AEAD. O PHP exige o parâmetro `$tag` em `openssl_encrypt`. O código não passa. Fatal: `A tag should be provided when using AEAD mode`.
- `METHOD_HMAC = aria-128-ofb` — cifra, não algoritmo de `hash_hmac`. O próximo erro seria `ValueError` no HMAC.

A sessão já tinha sido montada; o 500 acontece na hora de gravar o cookie.

## Correção

No ambiente Docker: `METHOD = aes-256-cbc` e `METHOD_HMAC = sha256`, que o `secured_encrypt` atual já aceita. Produção não usa `env.docker`.
