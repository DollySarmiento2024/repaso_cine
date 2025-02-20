FROM mysql:latest

# contraseña root base de datos
ENV MYSQL_ROOT_PASSWORD=fernanda 

#nombre base de datos
ENV MYSQL_DATABASE=cine

# usuario y contraseña base de datos
ENV MYSQL_USER=fernanda
ENV MYSQL_PASWORD=fernanda

COPY cine.sql /docker-entrypoint-initdb.d/
