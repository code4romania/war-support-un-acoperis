FROM php:7.4-apache as build

WORKDIR /var/www

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get -y update && \
    apt-get install -y --no-install-recommends libzip-dev libpng-dev libicu-dev libmagickwand-dev zlib1g-dev && \
    apt-get clean all


RUN pecl install imagick && \
    docker-php-ext-install -j$(nproc) opcache bcmath mysqli pdo pdo_mysql intl gd zip && \
    docker-php-ext-enable opcache bcmath mysqli pdo pdo_mysql intl gd zip imagick

COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --no-interaction --no-progress --no-dev

COPY ./.docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

COPY --chown=www-data:www-data . .

RUN composer dump-autoload --optimize

ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
    UPLOAD_LIMIT=10M

COPY ./.docker/php/opcache.ini "$PHP_INI_DIR/conf.d/opcache.ini"


##################################### assets_builder stage #############
## Build nodejs files ##
FROM node:16-alpine as assets_builder

COPY . /app
RUN cd app && \
    npm ci --no-audit --ignore-scripts --no-fund && \
    npm run production


###################################### prod stage ######################
FROM build as prod

EXPOSE 8080

# USER www-data

COPY --from=assets_builder /app/public/ /var/www/public/

RUN chmod 777 -R /var/www/storage/ && \
    echo "Listen 8080" >> /etc/apache2/ports.conf && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite && service apache2 restart