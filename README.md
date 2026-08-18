# Gerenciador de Arquivos

Gerenciador de arquivos via navegador: navega, cria, faz upload e visualiza arquivos e pastas direto do disco do servidor, sem passar por um banco de dados. Construído com Laravel no backend e Vue 3 + Inertia no frontend, numa única aplicação sem API REST separada.

## Demonstração

![Tela principal](docs/screenshot.png)

**[Ver demo ao vivo](https://archive-manager-q82m.onrender.com)**

> A demo roda em modo somente-leitura, apontando para uma pasta de exemplo em vez do disco inteiro. Está hospedada em tier gratuito, então o primeiro acesso pode levar cerca de um minuto até o servidor iniciar.

## Funcionalidades

- Navegação pelos diretórios do disco a partir da própria URL (`/{caminho}`), com breadcrumb clicável e uma árvore de pastas na barra lateral.
- Listagem de arquivos e pastas em grade, com ícone específico por extensão (PDF, Word, Excel, imagem, áudio, vídeo, código, compactado etc).
- Criação de arquivo ou pasta na pasta atual, com validação de nome duplicado antes de gravar no disco.
- Upload de arquivo para a pasta atual, com barra de progresso e mensagem de erro inline quando já existe um arquivo com o mesmo nome.
- Visualização de arquivo sem precisar baixar: texto, imagem, PDF, vídeo e áudio abrem direto num modal; para os demais tipos o modal avisa que não há pré-visualização disponível.
- Download de qualquer arquivo do diretório atual.
- Espaço livre e total do disco exibido na barra lateral.
- Alternância entre tema claro e escuro.
- Modo somente-leitura por configuração, que bloqueia escrita no backend e esconde as ações de escrita na interface.

## Decisões técnicas

**O disco é a fonte da verdade, não o banco.** Arquivos e pastas são lidos e gravados direto via Laravel Filesystem. Manter um espelho em banco criaria um problema de sincronização (qualquer alteração feita fora da aplicação deixaria os dados defasados) sem trazer ganho real para o caso de uso. O SQLite entra só para sessão, cache e fila do próprio Laravel.

**Inertia no lugar de uma API REST separada.** Os controllers devolvem props direto para os componentes Vue, o que evita manter uma camada de serialização e autenticação duplicada para uma aplicação que só tem um cliente.

**O caminho vive na URL.** Como a navegação é refletida em `/{caminho}`, o botão voltar do navegador funciona e qualquer pasta pode ser compartilhada por link, sem estado escondido no frontend.

**Raiz e modo de escrita configuráveis por ambiente.** Isso permite publicar uma demo pública apontada para uma pasta isolada e sem permissão de escrita, usando o mesmo código que roda localmente com acesso completo ao disco.

## Tecnologias

**Backend**

- PHP 8.3+
- Laravel 13
- Inertia.js (adapter `inertiajs/inertia-laravel` 3.1)
- Ziggy 2.6 — expõe as rotas nomeadas do Laravel para o JS
- SQLite — usado só para sessão, cache e fila do próprio Laravel

**Frontend**

- Vue 3.5 (`<script setup>`, TypeScript)
- Inertia.js para Vue 3
- Vite 8
- PrimeVue 4.5 (Dialog, Breadcrumb, ContextMenu)
- Bootstrap 5.3 + Bootstrap Icons — base da interface
- Tailwind CSS 4 (via `@tailwindcss/vite`)
- VueUse 14.3
- Axios

**Infraestrutura**

- Docker (multi-stage: build dos assets em Node, execução em PHP)
- Deploy no Render

## Como rodar localmente

```bash
# 1. Clonar o repositório
git clone https://github.com/davihely/archive-manager.git
cd archive-manager

# 2. Instalar dependências PHP
composer install

# 3. Configurar o ambiente
cp .env.example .env
php artisan key:generate

# 4. Criar o banco SQLite (usado só por sessão/cache/fila)
touch database/database.sqlite
php artisan migrate

# 5. Instalar dependências JS
npm install

# 6. Subir o projeto (servidor, fila, logs e Vite juntos)
composer run dev
```

A aplicação fica disponível em `http://localhost:8000`.

### Configuração dos caminhos

Três variáveis controlam o que a aplicação enxerga. Sem elas, o padrão é o comportamento original: raiz em `C:\` e abertura em `Temp`.

| Variável | Padrão | O que faz |
|---|---|---|
| `FILE_ROOT` | `C:\` | Diretório raiz que a aplicação pode acessar |
| `FILE_START_PATH` | `Temp` | Pasta aberta ao entrar na aplicação, relativa à raiz |
| `APP_READ_ONLY` | `false` | Quando `true`, bloqueia upload, criação e exclusão |

`FILE_START_PATH` precisa ser uma pasta existente **dentro** de `FILE_ROOT`, e não a própria raiz.

Em Linux ou macOS, aponte para um caminho local:

```dotenv
FILE_ROOT=/home/seu-usuario/arquivos
FILE_START_PATH=documentos
APP_READ_ONLY=false
```

No Windows, o padrão já funciona — basta existir a pasta `C:\Temp`.

## Deploy

O projeto inclui um `Dockerfile` multi-stage que compila os assets do Vite em Node e roda a aplicação em PHP, o que permite publicar em qualquer plataforma com suporte a Docker.

Para uma demo pública, o recomendado é apontar a raiz para uma pasta isolada e ativar o modo somente-leitura:

```dotenv
APP_ENV=production
APP_DEBUG=false
APP_READ_ONLY=true
FILE_ROOT=/app/storage/app
FILE_START_PATH=demo
```

Aplicações Laravel atrás de proxy (como o do Render) precisam confiar no proxy para gerar URLs em HTTPS corretamente — isso já está configurado em `bootstrap/app.php`.

## Autor

**Davi Hely**

- [LinkedIn](https://www.linkedin.com/in/davihely/)
- [Portfólio](https://davihely.github.io/profile-page/)
