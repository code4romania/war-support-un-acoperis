FROM citizennext/webserver:latest

RUN apt-get update

# install Nginx
COPY config/nginx/default /etc/nginx/sites-available/default

# install Supervisord
COPY config/supervisor/supervisor.conf /etc/supervisor/conf.d/supervisor.conf

RUN mkdir /app
RUN chown -R www-data:www-data /app

EXPOSE 80

VOLUME ["/app"]

COPY ./run.sh /tmp/run.sh
RUN chmod +x /tmp/run.sh

ENTRYPOINT ["/tmp/run.sh"]
