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

CREATE USER 'alumno'@'localhost' IDENTIFIED BY 'alumno';

# Asigna permisos al usuario

GRANT ALL PRIVILEGES ON dss.* TO 'alumno'@'localhost';

# crear base de datos

CREATE DATABASE dss;
GRANT ALL PRIVILEGES ON dss.* TO 'alumno'@'localhost';


# Refresca los privilegios
FLUSH PRIVILEGES;
EXIT;

#Para insertar los datos de los seeders a la BD
php artisan db:seed


# estructura de migration para que se guarden los nombres de las relaciones
# muchos a muchos con la nomenclatura <tabla1>_<tabla2>


# se crean migraciones



 
# Nueva actualizacion en los modelos + seeders + migrations.
Se ha añadido a la BD siguientes columnas:
-Tabla user: imagen
-Tabla aerolinea: imagen
-Tabla vuelo: 
-Duracion del viaje tipo date  "fechaFinVuelo"
-Tipo de clase enum(clase 'Primera Clase', 'Ejecutiva', 'Económica')

Mejora en las carta vuelo.

Agregando nuevas imagenes.


# falta
Añadir UrlImagenDestino tipo string en la tabla vuelo por defecto sera img-default.jpg




#Actualizar contraseña de user:

Desde la consola:
    php artisan tinker
    use Illuminate\Support\Facades\Hash;
    $newPassword = 'password';
    $hashedPassword = Hash::make($newPassword);

Desde consola SQL:
    UPDATE users SET password = 'HASH' WHERE id = ID_USER;
