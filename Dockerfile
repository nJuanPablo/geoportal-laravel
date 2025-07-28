# Usa la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev unzip \
    && docker-php-ext-install mysqli zip pdo pdo_mysql \
    && a2enmod rewrite

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos del proyecto al contenedor
COPY . /var/www/html

# Crear los directorios si no existen antes de cambiar permisos
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache

# Aplicar permisos correctos
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
RUN chown -R www-data:www-data /var/www/html

# Instala dependencias de Laravel
RUN composer install

# Expone el puerto 80
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]