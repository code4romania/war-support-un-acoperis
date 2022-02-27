FROM php:7.4-fpm-alpine as dev_stage

#USER :33 # www-data user and group
ENV APP_ENV=local

RUN apk update && apk upgrade && \
    apk add --no-cache git zip openssh autoconf g++ make openssl-dev icu-dev libpng-dev zlib-dev libzip-dev

# avoid using home of the user for composer cache, may cause permission issues
ENV COMPOSER_HOME=/tmp/composer
ENV COMPOSER_MEMORY_LIMIT=-1

# install composer
RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" \
    && php /tmp/composer-setup.php --install-dir=/usr/bin --filename=composer \
    && php -r "unlink('/tmp/composer-setup.php');"

RUN pecl -q install xdebug && \
    docker-php-ext-install -j$(nproc) opcache bcmath mysqli intl gd zip && \
    docker-php-ext-enable opcache bcmath mysqli intl gd zip

COPY .docker/php/zz-custom.ini /usr/local/etc/php/conf.d/zz-custom.ini
COPY .docker/php/docker-entrypoint.sh /docker-entrypoint.sh
COPY .docker/php/zzz-docker.conf /usr/local/etc/php-fpm.d/zzz-docker.conf

WORKDIR /app

CMD ["php-fpm", "-F"]

## @todo nodejs stage to build npm files

FROM dev_stage as prod

ENV APP_ENV=prod

COPY composer.json composer.lock ./

## @todo set permission for laravel cache/log dir if any
RUN set -uex; umask 0002; \
	composer install --no-scripts --no-autoloader --no-interaction --no-progress --no-suggest --no-dev && \
	rm -rf /tmp/composer/cache

COPY . .

RUN set -uex; umask 0002; \
	composer dump-autoload --optimize

## @todo check if laravel have some kind of cache:warmup equivalent
