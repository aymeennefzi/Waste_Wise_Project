# FROM php:8.2

# RUN apt-get update -y && apt-get install -y \
#     openssl zip unzip git \
#     libonig-dev default-mysql-client

# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN docker-php-ext-install pdo_mysql mbstring

# WORKDIR /app

# COPY . /app

# RUN composer install --prefer-dist --no-suggest

# CMD php artisan serve --host=0.0.0.0 --port=5000

# EXPOSE 5000

# Utiliser l'image PHP comme base
FROM php:8.2-fpm

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier le fichier .env dans l'image
COPY .env .env

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y libzip-dev unzip \
    && docker-php-ext-install zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier le reste de l'application
COPY . .

# Installer les dépendances Composer
RUN composer install --prefer-dist --no-suggest

# Assurez-vous que les permissions sont correctes
RUN chmod -R 775 /var/www/html

# Nettoyer les caches avant de générer la clé
RUN php artisan config:clear
RUN php artisan cache:clear

# Générer la clé de l'application
RUN php artisan key:generate

# Optimiser le chargement de la configuration
RUN php artisan config:cache

# Exposer le port
EXPOSE 9000

# Commande par défaut
CMD ["php-fpm"]
