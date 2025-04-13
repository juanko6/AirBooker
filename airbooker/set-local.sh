#!/bin/bash

# Cambiar APP_URL a localhost
sed -i 's|APP_URL=.*|APP_URL=http://localhost:8000|' .env

# Limpiar caché
php artisan config:cache
php artisan route:cache
php artisan view:clear

echo "Configuración cambiada a LOCAL (http://localhost:8000)"