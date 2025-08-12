FROM php:8.3-cli

RUN apt-get update -y \
    && apt-get install -y unzip git default-mysql-client libonig-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . ./
COPY docker-entrypoint.sh /usr/local/bin/
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && cp .env.example .env \
    && sed -i 's/DB_HOST=127.0.0.1/# DB_HOST=127.0.0.1/' .env \
    && sed -i 's/DB_PORT=3306/# DB_PORT=3306/' .env \
    && sed -i 's/DB_USERNAME=root/# DB_USERNAME=root/' .env \
    && sed -i 's/DB_PASSWORD=/# DB_PASSWORD=/' .env \
    && php artisan key:generate \
    && php artisan storage:link \
    && chmod -R 775 storage/ \
    && chmod -R 775 public/uploads/ \
    && chmod -R 775 database/ \
    && chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 8000
CMD ["docker-entrypoint.sh"]
