FROM citizennext/webserver:latest

# install Nginx
COPY config/nginx/default /etc/nginx/sites-available/default

# install Supervisord
COPY config/supervisor/supervisor.conf /etc/supervisor/conf.d/supervisor.conf
COPY config/nginx/nginx.conf /etc/nginx/nginx.conf

RUN mkdir /app
RUN chown -R www-data:www-data /app

EXPOSE 80

VOLUME ["/app"]

WORKDIR "/app"

RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" \
    && php /tmp/composer-setup.php --install-dir=/usr/bin --filename=composer \
    && php -r "unlink('/tmp/composer-setup.php');"

ENTRYPOINT ["/usr/bin/supervisord"]
