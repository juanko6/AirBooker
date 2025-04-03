#!/bin/bash

# Cambiar APP_URL a ngrok
sed -i 's|APP_URL=.*|APP_URL=https://6e62-79-117-252-173.ngrok-free.app|' .env

# Limpiar caché
php artisan config:cache
php artisan route:cache
php artisan view:clear

echo "Configuración cambiada a NGROK (https://6e62-79-117-252-173.ngrok-free.app)"