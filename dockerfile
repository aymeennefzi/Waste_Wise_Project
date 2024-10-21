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

FROM php:8.2

# Update and install necessary packages
RUN apt-get update -y && apt-get install -y \
    openssl zip unzip git \
    libonig-dev default-mysql-client \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    libzip-dev  # Added to ensure zip extension can be installed

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo_mysql mbstring gd zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /app
COPY . /app

# Clear Composer cache and install dependencies
RUN composer clear-cache && \
    composer update maatwebsite/excel phpoffice/phpspreadsheet --no-interaction --prefer-dist && \
    composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-req=ext-zip

# Command to run your application
CMD php artisan serve --host=0.0.0.0 --port=8000

# Expose the port for the application
EXPOSE 8000