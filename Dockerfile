# Usa la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala dependencias necesarias para Laravel
RUN apt-get update && apt-get install -y \
    unzip libzip-dev libpng-dev libjpeg-dev libonig-dev libxml2-dev git curl \
    && docker-php-ext-install mysqli zip pdo pdo_mysql gd mbstring \
    && a2enmod rewrite \
    && sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos del proyecto al contenedor
COPY . /var/www/html

# Crea carpetas necesarias y aplica permisos
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html

# Instala dependencias de Laravel
RUN composer install

# Expone el puerto 80
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]
