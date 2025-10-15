# Usar a imagem oficial do PHP 8.2 com FPM
FROM php:8.4-fpm

# Instalar dependências do sistema e extensões do PHP
RUN apt-get update && apt-get install -y \
    nginx \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libonig-dev \
    libssl-dev \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql pdo_pgsql zip mbstring xml curl bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copiar os arquivos do projeto para o container
COPY . /var/www/html

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar a configuração customizada do PHP
COPY docker/config/php/custom_php.ini /usr/local/etc/php/conf.d/99-custom.ini

# Instalar dependências do Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Expor a porta 9000 para o PHP-FPM
EXPOSE 9000

# Comando de inicialização
CMD ["php-fpm"]
