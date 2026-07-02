# Usa a imagem oficial do PHP 8.2 com servidor Apache
FROM php:8.2-apache

# Habilita o mod_rewrite do Apache (Obrigatório para o seu .htaccess e Fast-Route funcionarem)
RUN a2enmod rewrite

# Instala bibliotecas do sistema e extensões PHP exigidas pelas dependências
RUN apt-get update && apt-get install -y git unzip libzip-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip dom

# Copia o Composer direto da imagem oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define a pasta raiz do seu projeto no servidor
WORKDIR /var/www/html

# Copia os arquivos do seu repositório local para dentro do servidor
COPY . .

# Instala as dependências do Composer (sem dependências de desenvolvimento)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-progress

# Dá permissão ao Apache para ler os arquivos e gerenciar caches (útil pro Doctrine/Symfony Cache)
RUN chown -R www-data:www-data /var/www/html

# Abre a porta 80 do container
EXPOSE 80