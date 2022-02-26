FROM mysql:8

COPY ./db_init.sql /docker-entrypoint-initdb.d/01_db_init.sql
RUN chmod -R 755 /docker-entrypoint-initdb.d/
