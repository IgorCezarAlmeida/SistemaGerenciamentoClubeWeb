# ============ STAGE 1: Builder (Instala dependências) ============
FROM composer:2 as builder

WORKDIR /app

# Copia arquivos de dependência
COPY composer.json composer.lock ./

# Instala dependências sem dev, com cache limpo
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --no-progress \
    --no-scripts \
    --ignore-platform-reqs

# ============ STAGE 2: Runtime (Imagem final) ============
FROM php:8.2-apache

# Habilita módulos Apache
RUN a2enmod rewrite

# Instala extensões PHP e limpeza de cache em um RUN único
RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libzip-dev libxml2-dev && \
    docker-php-ext-install -j$(nproc) pdo_mysql zip dom && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Define workdir
WORKDIR /var/www/html

# Copia código-fonte do projeto
COPY . .

# Copia vendor pré-compilado do builder
COPY --from=builder /app/vendor ./vendor

# Permissões para Apache
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Porta
EXPOSE 80