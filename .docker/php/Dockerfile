FROM php:7.4-apache as build

WORKDIR /var/www

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get -y update && \
    apt-get install -y --no-install-recommends libzip-dev libpng-dev libicu-dev libmagickwand-dev zlib1g-dev && \
    apt-get clean all


RUN pecl install imagick && \
    docker-php-ext-install -j$(nproc) opcache bcmath mysqli pdo pdo_mysql intl gd zip && \
    docker-php-ext-enable opcache bcmath mysqli pdo pdo_mysql intl gd zip imagick

ENV PHP_OPCACHE_ENABLE=1

COPY ./.docker/php/opcache.ini "$PHP_INI_DIR/conf.d/opcache.ini"
COPY .docker/php/zz-custom.ini "$PHP_INI_DIR/conf.d/zz-custom.ini"
COPY ./.docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 8080

RUN echo "Listen 8080" >> /etc/apache2/ports.conf && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite && service apache2 restart

##################################### assets_builder stage #############
## Build nodejs files ##
FROM node:16-alpine as assets_builder

COPY . /app
RUN cd app && \
    npm ci --no-audit --ignore-scripts --no-fund && \
    npm run production


###################################### prod stage ######################
FROM build as prod

# USER www-data

COPY --chown=www-data:www-data composer.json composer.lock ./

RUN composer install --no-scripts --no-autoloader --no-interaction --no-progress --no-suggest --no-dev && \
    rm -rf /tmp/composer/cache

COPY --chown=www-data:www-data . .
COPY --chown=www-data:www-data --from=assets_builder /app/public/ ./public/

RUN chmod 777 -R /var/www/storage/ && \
    composer dump-autoload --optimize && \
    #php artisan route:cache && \
    php artisan view:cache && \
    php artisan event:cache

