# 🌟 AirBooker: Tu Plataforma de Reservas de Vuelos 🚀

## 🎯 Propósito General
AirBooker es una **plataforma web de reservas de vuelos** desarrollada con **Laravel** que permite a los usuarios **buscar**, **reservar** y **gestionar vuelos** de manera eficiente. ✈️ El proyecto cuenta con dos interfaces principales:

- **Interfaz de Usuario**: Para clientes que buscan y reservan vuelos. 👤  
- **Panel de Administración**: Para gestionar usuarios, vuelos, aerolíneas, ofertas y reservas. 🛠️  

---

## ✨ Características Principales

### 🧳 Para Usuarios/Clientes:
#### Búsqueda de Vuelos 🔍
- Filtrado por **origen**, **destino** y **fechas** 📅  
- Opciones de filtrado avanzado (**aerolíneas**, **precios**, **clase**) 💼  
- Ordenación de resultados por **precio** o **fecha** ⬆️⬇️  

#### Gestión de Cuenta 👤
- Registro e inicio de sesión 🔐  
- Perfil de usuario personalizable 🎨  
- Visualización de historial de reservas 📋  

#### Reserva de Vuelos 🎟️
- Proceso de reserva simplificado ✔️  
- Acceso a **ofertas** y **descuentos** 💰  
- Gestión de reservas (**consultar**, **modificar**, **cancelar**) 🔄  

#### Cartera Virtual 💳
- Gestión de fondos para compras 💸  
- Historial de transacciones 📊  

---

### 🛠️ Para Administradores:
#### Dashboard 📈
- Resumen estadístico de la plataforma 📊  
- Gráficos de reservas por mes 📅  

#### Gestión de Entidades 📂
- **Usuarios**: Administración de cuentas y roles 👥  
- **Vuelos**: Creación, edición y eliminación ✈️  
- **Aerolíneas**: Administración de compañías aéreas 🏷️  
- **Ofertas**: Gestión de descuentos y promociones 💡  
- **Reservas**: Supervisión y gestión del estado de las reservas 📝  

---

## 🗃️ Estructura de Datos
El sistema se basa en cinco entidades principales:  

- **Usuarios**: Almacena información personal, credenciales y roles. 👤  
- **Vuelos**: Contiene detalles como origen, destino, fechas, precios y aerolínea. ✈️  
- **Aerolíneas**: Registro de compañías aéreas con sus logotipos e información. 🏷️  
- **Ofertas**: Promociones y descuentos aplicables a vuelos específicos. 💰  
- **Reservas**: Registra las reservas realizadas por los usuarios. 📋  

---

## 🎨 Diseño e Interfaz
La plataforma cuenta con un diseño **moderno** y **responsive** 📱💻:  

- Página de inicio con **buscador prominente** 🔍  
- Sección de **ofertas destacadas** 🎉  
- Sección de **ventajas de usar AirBooker** 🌟  
- Sección de **preguntas frecuentes** ❓  
- Interfaz de búsqueda con **filtros laterales** 📋  
- Listado claro de vuelos con **detalles relevantes** ✈️  
- Panel de administración **intuitivo** y **funcional** 🛠️  

---

## 🛠️ Tecnologías Utilizadas
- **Backend**: PHP con framework Laravel 🐘  
- **Frontend**: HTML, CSS, JavaScript, Blade (motor de plantillas de Laravel) 🖥️  
- **Base de datos**: MySQL 🗄️  
- **Multimedia**: Imágenes de destinos y logos de aerolíneas, videos promocionales 🎥  

---

## 🌟 Funcionalidades Destacadas
- Sistema de **cálculo de precios** con descuentos 💰  
- **Filtrado avanzado** de vuelos 🔍  
- **Panel de administración completo** 🛠️  
- Visualización de **estadísticas** 📊  
- Sistema de **autenticación** y **roles** 🔐  
- Gestión de imágenes para destinos 📷  

---

# 🛠️ Instrucciones de Configuración para AirBooker en Linux 🐧

¡Bienvenido a la guía de configuración de **AirBooker** en tu sistema **Linux**! 🚀 Sigue estos pasos para configurar y ejecutar el proyecto después de clonarlo. ¡Vamos a ello! 💻

---

## 🔧 **Requisitos Previos**

Antes de comenzar, asegúrate de tener instalados los siguientes componentes en tu sistema Linux. Ejecuta los comandos proporcionados para instalarlos:

```bash
# Actualizar los repositorios de paquetes 🔄
sudo apt update

# Instalar PHP y extensiones necesarias 💻
sudo apt install -y php8.1 php8.1-cli php8.1-common php8.1-mysql php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml php8.1-bcmath php8.1-intl php8.1-readline

# Instalar Composer (gestor de dependencias de PHP) 🎵
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

# Instalar MySQL 🗄️
sudo apt install -y mysql-server

# Iniciar el servicio de MySQL ⚡
sudo systemctl start mysql
sudo systemctl enable mysql
```

---

## 📂 **Configuración del Proyecto**

Una vez que hayas clonado el repositorio, sigue estos pasos para configurar el proyecto:

```bash
# Navegar al directorio del proyecto 📁
cd AirBooker/airbooker

# Instalar dependencias de PHP con Composer 📦
composer install

# Crear archivo de entorno 🌍
cp .env.example .env

# Generar clave de aplicación 🔑
php artisan key:generate
```

---

## 🗃️ **Configuración de la Base de Datos**

Crea la base de datos y configura un usuario para el proyecto:

```bash
# Iniciar sesión en MySQL 🛡️
sudo mysql -u root -p

# Crear la base de datos (en la consola de MySQL) 🖥️
CREATE DATABASE airbooker;
CREATE USER 'airbooker'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON airbooker.* TO 'airbooker'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

---

## ✏️ **Actualizar Archivo de Entorno**

Edita el archivo `.env` con la información de la base de datos:

```bash
# Abrir el archivo .env con tu editor favorito 📝
nano .env

# Modificar las siguientes líneas ⚙️
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alumno
DB_USERNAME=alumno
DB_PASSWORD=alumno
```

---

## 🚀 **Ejecutar Migraciones y Seeders**

Genera las tablas en la base de datos y carga datos de prueba:

```bash
# Ejecutar migraciones para crear las tablas en la base de datos 📊
php artisan migrate

# Cargar datos de prueba 🎲
php artisan db:seed
```

---

## 🔑 **Configurar Permisos de Almacenamiento**

Asegúrate de que los directorios de almacenamiento tengan los permisos adecuados:

```bash
# Establecer permisos adecuados para los directorios de almacenamiento 🛠️
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R $USER:www-data storage bootstrap/cache
```

---

## 🖇️ **Enlazar Almacenamiento**

Crea un enlace simbólico para el almacenamiento:

```bash
# Crear enlace simbólico para el almacenamiento 📂
php artisan storage:link
```

---

## ⚡ **Optimizar la Aplicación**

Limpia y reconstruye la caché para mejorar el rendimiento:

```bash
# Limpiar y reconstruir la caché 🧹
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🎨 **Instalar Dependencias de Frontend (si es necesario)**

Si el proyecto incluye frontend, instala las dependencias necesarias:

```bash
# Instalar Node.js y npm 🌟
sudo apt install -y nodejs npm

# Instalar dependencias de frontend 🛠️
npm install

# Compilar assets 📦
npm run dev
```

---

## ▶️ **Iniciar el Servidor**

Finalmente, inicia el servidor de desarrollo:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Ahora puedes acceder a la aplicación en tu navegador web visitando:  
🔗 [http://localhost:8000](http://localhost:8000)

---

## 🛠️ **Solución de Problemas Comunes**

### ❌ Error de permisos
```bash
sudo chown -R $USER:www-data .
chmod -R 775 storage bootstrap/cache
```

### ❌ Error de extensiones PHP
Verifica que todas las extensiones requeridas estén habilitadas:
```bash
php -m
```

### ❌ Error de conexión a la base de datos
Verifica que el servicio MySQL esté funcionando:
```bash
sudo systemctl status mysql
```

### ❌ Error "No application encryption key has been specified"
Genera una nueva clave de aplicación:
```bash
php artisan key:generate
```

---

## 📝 En Resumen
AirBooker es una **aplicación web completa** para la gestión de reservas de vuelos 🚀 que ofrece funcionalidades tanto para **usuarios finales** como para **administradores** de la plataforma, permitiendo un proceso fluido desde la **búsqueda** hasta la **reserva** y **seguimiento** de vuelos, con una interfaz **intuitiva** y **moderna**. 🌍✈️  

🎉 ¡Felicidades! Ahora tienes **AirBooker** configurado y listo para usar en tu sistema Linux. 🚀 ¡Disfruta explorando y gestionando vuelos con esta increíble plataforma! 🌟
