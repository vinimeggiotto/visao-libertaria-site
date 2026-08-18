# Schema de projetos e vídeos

`projetos` guarda os canais do site. Além de nome e descrição, `listar` (`S`/`N`) define se o bloco aparece na home e `canal_youtube_id` é o canal usado pelo cron da API do YouTube.

`projetos_videos` guarda os vídeos captados. A chave é `video_id` (ID do YouTube). Cada linha tem `titulo`, `projetos_id`, `publicado`, `thumbnail` e `short`. O cron insere essas colunas; a home e `/site/videos` leem as mesmas.

Não há seed no `Main`. Vídeos entram pelo cron (com `YOUTUBE_API_KEY`) ou por insert manual.
