# Use a imagem PHP 8.1
FROM php:8.1-apache

# Instale as extensões do PHP necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Ative o módulo de reescrita do Apache para suportar .htaccess
RUN a2enmod rewrite

# Copie a configuração personalizada do PHP
COPY ./config/php.ini /usr/local/etc/php/conf.d/php.ini

# Defina o diretório de trabalho para o Apache
WORKDIR /var/www/html

# Copie o código da aplicação para o contêiner
COPY ./src/ /var/www/html/

# Exponha a porta 80
EXPOSE 80