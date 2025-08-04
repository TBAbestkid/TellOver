FROM php:8.3-fpm

# Instalar dependências essenciais do Laravel e PHP
RUN apt-get update && apt-get install -y \
    build-essential \
    libzip-dev \
    zip unzip \
    libonig-dev \
    libpq-dev \
    git \
    curl \
    && docker-php-ext-install pdo_mysql zip

# Instalar o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos da aplicação
COPY . .

# Instalar dependências do Laravel
RUN composer install --no-interaction

# Permissões corretas para o Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Comando padrão
CMD ["php-fpm"]
