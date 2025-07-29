# Usa la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Define argumento de entorno para el build
ARG APP_ENV=production
ENV APP_ENV=${APP_ENV}

# Instala dependencias necesarias para Laravel
RUN apt-get update && apt-get install -y \
    unzip libzip-dev libpng-dev libjpeg-dev libonig-dev libxml2-dev git curl \
    && docker-php-ext-install mysqli zip pdo pdo_mysql gd mbstring \
    && a2enmod rewrite \
    && sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Instala Composer desde la imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establece directorio de trabajo
WORKDIR /var/www/html

# Copia archivos si no montas volumen (útil en producción)
COPY . /var/www/html

# Crea carpetas necesarias y aplica permisos
RUN mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data /var/www/html

# Instala dependencias y ejecuta comandos automáticos en producción
RUN composer install --no-dev --optimize-autoloader \
    && if [ "$APP_ENV" = "production" ]; then \
         php artisan key:generate && \
         php artisan config:cache && \
         php artisan route:cache && \
         php artisan migrate --force ; \
       fi

# Expone el puerto 80
EXPOSE 80

# Inicia Apache
CMD ["apache2-foreground"]
