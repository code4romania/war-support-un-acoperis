FROM php:7.4-fpm as build

WORKDIR /var/www

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /tmp
ENV COMPOSER_CACHE_DIR /dev/null


COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get -y update && \
    apt-get install -y --no-install-recommends libzip-dev libpng-dev libicu-dev libmagickwand-dev zlib1g-dev nginx && \
    apt-get clean all


RUN pecl install imagick && \
    docker-php-ext-install -j$(nproc) opcache bcmath mysqli pdo pdo_mysql intl gd zip && \
    docker-php-ext-enable opcache bcmath mysqli pdo pdo_mysql intl gd zip imagick

ENV PHP_OPCACHE_ENABLE=1

COPY --chown=www-data:www-data . /var/www

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN composer install \
    --optimize-autoloader \
    --no-interaction \
    --no-plugins \
    --no-dev \
    --prefer-dist

EXPOSE 8080
##################################### assets_builder stage #############
## Build nodejs files ##
FROM node:16-alpine as assets_builder

COPY . /app
RUN cd app && \
    npm ci --no-audit --ignore-scripts --no-fund && \
    npm run production


###################################### prod stage ######################
FROM build as prod

ARG S6_OVERLAY_VERSION=3.1.2.1

ADD https://github.com/just-containers/s6-overlay/releases/download/v${S6_OVERLAY_VERSION}/s6-overlay-noarch.tar.xz /tmp
RUN tar -C / -Jxpf /tmp/s6-overlay-noarch.tar.xz
ADD https://github.com/just-containers/s6-overlay/releases/download/v${S6_OVERLAY_VERSION}/s6-overlay-x86_64.tar.xz /tmp
RUN tar -C / -Jxpf /tmp/s6-overlay-x86_64.tar.xz

ENTRYPOINT ["/init"]

COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/php/php.ini /usr/local/etc/php/php.ini
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/zz-docker.conf
COPY docker/s6-rc.d /etc/s6-overlay/s6-rc.d

COPY --chown=www-data:www-data --from=assets_builder /app/public/ ./public/


ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

ENV S6_CMD_WAIT_FOR_SERVICES_MAXTIME 0

EXPOSE 80

