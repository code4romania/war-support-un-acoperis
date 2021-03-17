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

ENTRYPOINT ["/usr/bin/supervisord"]
