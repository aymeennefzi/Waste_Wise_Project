FROM php:8.2

RUN apt-get update -y && apt-get install -y \
    openssl zip unzip git \
    libonig-dev default-mysql-client

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo_mysql mbstring

WORKDIR /app

COPY /home/runner/work/Waste_Wise_Project/Waste_Wise_Project/artifact/app-build.tar.gz .

RUN tar -xzf app-build.tar.gz && rm app-build.tar.gz

RUN composer install --prefer-dist --no-suggest

CMD php artisan serve --host=0.0.0.0 --port=8000

EXPOSE 8000
