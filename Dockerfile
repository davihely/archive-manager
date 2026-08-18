# ---- Etapa 1: compilar os assets do front (Vue/Inertia) ----
FROM node:20-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# ---- Etapa 2: aplicação PHP ----
FROM php:8.3-cli

# Dependências do sistema e extensões do PHP
RUN apt-get update && apt-get install -y \
    git curl unzip libzip-dev libonig-dev libpng-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring zip bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copia o projeto e os assets já compilados da etapa 1
COPY . .
COPY --from=assets /app/public/build ./public/build

# Instala dependências PHP de produção
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Permissão de escrita nas pastas do Laravel
RUN chmod -R 775 storage bootstrap/cache

# Sobe o servidor na porta que o Render define (variável PORT)
CMD sh -c "php artisan config:clear && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"