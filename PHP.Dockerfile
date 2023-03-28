FROM php:fpm

RUN docker-php-ext-install pdo pdo_mysql

# Latest Composer release
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
# RUN pecl install xdebug && docker-php-ext-enable xdebug
