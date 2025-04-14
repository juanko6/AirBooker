#!/bin/bash

# Paso 1: Cambiar al directorio del proyecto
cd ~/Escritorio/DSS/AirBooker/airbooker || { echo "No se pudo acceder al directorio del proyecto"; exit 1; }

# Paso 2: Iniciar el servidor de Laravel en segundo plano
echo "Iniciando servidor de Laravel..."
php artisan serve > /dev/null 2>&1 &
sleep 3  # Esperar a que el servidor arranque completamente

# Paso 3: Iniciar ngrok en segundo plano
echo "Iniciando ngrok..."
ngrok http 8000 > /dev/null &
sleep 3  # Esperar a que ngrok inicie completamente

# Paso 4: Capturar la URL generada por ngrok
NGROK_URL=$(curl -s http://localhost:4040/api/tunnels | jq -r '.tunnels[0].public_url')

# Verificar si se obtuvo la URL
if [ -z "$NGROK_URL" ]; then
    echo "No se pudo obtener la URL de ngrok. Verifica que ngrok esté funcionando."
    exit 1
fi

# Paso 5: Actualizar el archivo .env con la nueva URL
echo "Actualizando archivo .env con la URL de ngrok..."
sed -i "s|APP_URL=.*|APP_URL=$NGROK_URL|" .env

# Paso 6: Limpiar caché de Laravel
echo "Limpiando caché de Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:clear

# Paso 7: Abrir la URL en el navegador con el encabezado correcto
echo "Abriendo $NGROK_URL en el navegador..."
curl -H "User-Agent: ngrok-skip-browser-warning" "$NGROK_URL"
xdg-open "$NGROK_URL" || open "$NGROK_URL"

echo "Configuración completada. Servidor listo en $NGROK_URL"

Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:131.0) Gecko/20100101 Firefox/131.0