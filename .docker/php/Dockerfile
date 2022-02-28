FROM php:7.4-fpm-alpine as dev_stage

ENV APP_ENV=local

RUN apk update && apk upgrade && \
    apk add --no-cache git zip openssh autoconf g++ make openssl-dev icu-dev libpng-dev zlib-dev libzip-dev bash

# avoid using home of the user for composer cache, may cause permission issues
ENV COMPOSER_HOME=/tmp/composer
ENV COMPOSER_MEMORY_LIMIT=-1

# install composer
RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" \
    && php /tmp/composer-setup.php --install-dir=/usr/bin --filename=composer \
    && php -r "unlink('/tmp/composer-setup.php');"

RUN pecl -q install xdebug && \
    docker-php-ext-install -j$(nproc) opcache bcmath mysqli pdo pdo_mysql intl gd zip && \
    docker-php-ext-enable opcache bcmath mysqli pdo pdo_mysql intl gd zip

RUN set -ex \
    && apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS imagemagick-dev libtool \
    && export CFLAGS="$PHP_CFLAGS" CPPFLAGS="$PHP_CPPFLAGS" LDFLAGS="$PHP_LDFLAGS" \
    && pecl install imagick-3.4.3 \
    && docker-php-ext-enable imagick \
    && apk add --no-cache --virtual .imagick-runtime-deps imagemagick \
    && apk del .phpize-deps

COPY .docker/php/zz-custom.ini /usr/local/etc/php/conf.d/zz-custom.ini
COPY .docker/php/docker-entrypoint.sh /docker-entrypoint.sh
COPY .docker/php/zzz-docker.conf /usr/local/etc/php-fpm.d/zzz-docker.conf

WORKDIR /var/www/html

CMD ["php-fpm", "-F"]


##################################### assets_builder stage #############
## Build nodejs files ##
FROM node:16-alpine as assets_builder

COPY . /app
RUN cd app && \
    npm ci && \
    npm run production


###################################### prod stage ######################
## install app and prepare for production ##
FROM dev_stage as prod

#make sure www-data is able to write files to /var/www/html dir
RUN mkdir -p /var/www/html && chown www-data:www-data /var/www/html
## make sure www-data is able to copy public files here, if needed
RUN mkdir -p /mnt/public && chown www-data:www-data /mnt/public

USER www-data

ENV APP_ENV=production

COPY --chown=www-data:www-data composer.json composer.lock ./

RUN set -uex; umask 0002; \
	composer install --no-scripts --no-autoloader --no-interaction --no-progress --no-suggest --no-dev && \
	rm -rf /tmp/composer/cache

COPY --chown=www-data:www-data . .
COPY --chown=www-data:www-data --from=assets_builder /app/public ./

RUN set -uex; umask 0002; \
	composer dump-autoload --optimize && \
#    php artisan route:cache && \
    php artisan view:cache && \
    php artisan event:cache
