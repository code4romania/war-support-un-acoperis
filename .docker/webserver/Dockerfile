FROM ubuntu:focal

MAINTAINER Andrei Susanu <andrei.susanu@gmail.com>

ENV DEBIAN_FRONTEND noninteractive
ENV LC_ALL C.UTF-8

RUN apt-get update

# install PHP 7.4
RUN apt-get install --no-install-recommends -y apt-utils wget ca-certificates vim php7.4-cli php7.4-fpm php7.4-common php7.4-json php7.4-opcache php7.4-mbstring php7.4-mysql php7.4-gd php7.4-zip php7.4-xml

# install Nginx
RUN apt-get install --no-install-recommends -y nginx
RUN echo "daemon off;" >> /etc/nginx/nginx.conf
COPY config/nginx/default /etc/nginx/sites-available/default

# install Supervisord
RUN apt-get install --no-install-recommends -y supervisor
COPY config/supervisor/supervisor.conf /etc/supervisor/conf.d/supervisor.conf

RUN mkdir /app
RUN chown -R www-data:www-data /app

# configure PHP-FPM
RUN sed -i -e "s/;clear_env\s*=\s*no/clear_env = no/g" /etc/php/7.4/fpm/pool.d/www.conf
RUN echo "php_admin_value[memory_limit] = 1024M" >> /etc/php/7.4/fpm/pool.d/www.conf
RUN sed -i -e "s/upload_max_filesize\s=\s2M/upload_max_filesize = 128M/g" /etc/php/7.4/fpm/php.ini
RUN sed -i -e "s/post_max_size\s=\s8M/post_max_size = 128M/g" /etc/php/7.4/fpm/php.ini
RUN sed -i -e "s/max_execution_time\s=\s30/max_execution_time = 300/g" /etc/php/7.4/fpm/php.ini

EXPOSE 80

VOLUME ["/app"]

# start supervisor
CMD ["/usr/bin/supervisord"]
