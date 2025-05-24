FROM php:8.2-fpm

# Instalar dependências de sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \ 
    default-mysql-client

# Instalar extensões do PHP
RUN docker-php-ext-install \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Limpar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Copiar o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
