O que fazer em seguida
Menu de botão direito no card, com Renomear e Excluir.

O backend já está pronto e sem uso: Estrutura::renomear, Estrutura::excluir, as rotas PUT e DELETE /estrutura — nada no frontend chama isso. Seu ModalPayLoad já prevê type: "update". É a maior falta do sistema e a que exige menos código novo.

Antes de plugar: update e destroy no EstruturaController não têm try/catch como o store, então erro vira 500. E excluir pasta é recursivo — precisa de confirmação.

Depois, nessa ordem:

Trocar o root do disco pra C:\Temp (5 min, mata o risco de RCE)
Seleção múltipla + ações em lote
Mover arquivo por drag & drop (é o mesmo Storage::move do renomear)
Busca e ordenação — hoje não tem ordem nem paginação
Tamanho e data no card (Storage::size() e lastModified())