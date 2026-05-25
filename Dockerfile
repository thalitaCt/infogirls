FROM php:8.2-apache

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_pgsql zip

# Ativa mod_rewrite
RUN a2enmod rewrite

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia arquivos do projeto
COPY . /var/www/html/

# Define diretório de trabalho
WORKDIR /var/www/html

# Instala dependências PHP
RUN composer install --no-dev --optimize-autoloader

# Porta
EXPOSE 80
