# Afazeres

## Próximo

- [ ] **Menu de contexto (botão direito) no card: Renomear e Excluir**
  O backend já existe e está sem uso: `Estrutura::renomear`, `Estrutura::excluir`,
  rotas `PUT /estrutura` e `DELETE /estrutura`. O `ModalPayLoad` já prevê `type: "update"`.
  - Antes de plugar: `update` e `destroy` no `EstruturaController` não têm try/catch
    como o `store`, então `RuntimeException` vira 500 em vez de mensagem na tela.
  - Excluir pasta usa `deleteDirectory` (recursivo) — exigir confirmação com o nome.

## Correções pendentes

- [ ] Fechar o dropdown ao escolher uma opção (`MenuLateral.vue`)
- [ ] Trocar `href="#"` por `<button type="button">` nos itens do menu
- [ ] `decodeURIComponent(page.url)` antes de montar o `path`
      (`MenuLateral.vue:65` e `Geral/Modal.vue:27`) — hoje pasta com espaço ou
      acento cria diretório literal `Minha%20Pasta` / `A%C3%A7%C3%A3o`
- [ ] Erro de upload inline em vez de `alert(error.message)`
- [ ] Barra de progresso e bloqueio de envio duplicado no upload
- [ ] Root do disco `c-drive` para `C:\Temp` em vez de `C:\`
      (hoje dá para gravar em qualquer lugar do disco, inclusive `public/`)
- [ ] `download()` sem `return` quando o arquivo não existe → 500 em vez de 404
- [ ] `catch(\exception $e)` → `\RuntimeException` (evita vazar erro interno)
- [ ] Regras `max:` e extensões permitidas no upload
- [ ] `defineProps` com sintaxe misturada em `MenuLateral.vue` e `ProgressoBarra.vue`
- [ ] Apagar código morto: `Components/DropDown.vue` e `Components/Modal.vue`

## Futuro

- [ ] **Conflito de nome no upload: substituir / manter os dois / cancelar**
  Hoje `File::criar` só lança erro quando o nome já existe. A mesma lógica vai
  reaparecer no renomear e no mover, então vale resolver junto.
- [ ] Seleção múltipla + ações em lote
- [ ] Mover arquivo por drag & drop (mesmo `Storage::move` do renomear)
- [ ] Busca e ordenação (nome, tipo, data) — hoje sem ordem nem paginação
- [ ] Tamanho e data de modificação no card (`Storage::size()`, `lastModified()`)
- [ ] Autenticação nas rotas antes de sair do localhost
