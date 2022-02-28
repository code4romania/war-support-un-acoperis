FROM citizennext/webserver:latest

# install Nginx
COPY .docker/dev/webserver/config/nginx/default /etc/nginx/sites-available/default

# install Supervisord
COPY .docker/dev/webserver/config/supervisor/supervisor.conf /etc/supervisor/conf.d/supervisor.conf
COPY .docker/dev/webserver/config/nginx/nginx.conf /etc/nginx/nginx.conf

# setup entrypoint
COPY .docker/dev/webserver/config/entrypoint.sh /usr/bin/entrypoint.sh
RUN chmod 755 /usr/bin/entrypoint.sh

# install composer
RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" \
    && php /tmp/composer-setup.php --install-dir=/usr/bin --filename=composer \
    && php -r "unlink('/tmp/composer-setup.php');"

EXPOSE 80

WORKDIR "/app"

ENTRYPOINT ["/usr/bin/entrypoint.sh"]
