# Luego de instalar 
# composer
# php
# Laravel

laravel new airbooker

# se inicia con 

php artisan serve

# si se hace alguna modificacion en la configuracion de la base de datos se debe poner

# en el fichero .env en la parte de 

php artisan migrate

# este creara las tablas necesarias en la base de datos

# ############################################ #
# comandos para crear el usuario y contrasena  #
# ############################################ #

# ingresar como root

mysql -u root -p

# poner contrasena de root y luego

CREATE USER 'airbooker-db'@'localhost' IDENTIFIED BY 'ssd-24-25';

# Asigna permisos al usuario

GRANT ALL PRIVILEGES ON airbooker_db.* TO 'airbooker-db'@'localhost';

# crear base de datos

CREATE DATABASE airbooker_db;
GRANT ALL PRIVILEGES ON airbooker_db.* TO 'airbooker-db'@'localhost';


# Refresca los privilegios
FLUSH PRIVILEGES;

EXIT;
