# 📁 Geoportal laravel

Este proyecto es una aplicación web desarrollada en **Laravel** que permite a los usuarios autenticados realizar la visualizacion de mapas con WFS o WMS. La autenticación está implementada usando **Laravel Sanctum**.

---

## 🔐 Autenticación

La autenticación de usuarios se gestiona mediante **Laravel Sanctum**. Los usuarios pueden:

- Registrarse
- Iniciar sesión
- Cerrar sesión

Las vistas relacionadas están ubicadas en la carpeta `views/auth`.

---

## 🖼️ Estructura de Vistas

Las vistas se encuentran en `resources/views/` y están organizadas de la siguiente manera:

- `auth/`
  - `login.blade.php`: Formulario de inicio de sesión
  - `register.blade.php`: Formulario de registro

- `layouts/`
  - `app.blade.php`: Plantilla principal que envuelve las vistas
  - `alerts.blade.php`: Vista parcial para mostrar mensajes de alerta

- `geovisor.blade.php`: Página principal donde se muestra el mapa cargado con Leaflet.

---

## 🧠 Controladores

Los controladores principales se encuentran en `app/Http/Controllers/`:

- `GeovisorController`: Carga la vista principal y estructura de carpetas.
- `RegistroController`: Controla el registro de usuarios.
- `LoginController`: Maneja el inicio de sesión.
- `LogoutController`: Maneja el cierre de sesión.

---

## 🛠 Funcionalidades

- ✅ Registro e inicio de sesión (con Laravel Sanctum)
- ✅ Se pueden cargar capas en formato WFS y WMS
- ✅ Tiene un boton para ver las capas activas
- ✅ Tiene un boton para centrar el mapa en Colombia
- ✅ Tiene un boton para cargar el mapa base deseado

---

## ⚙️ Requisitos

- PHP >= 8.1
- Laravel 10+
- Composer
- MySQL

---

## 🚀 Instalación
1. Clona el repositorio:
```bash
git clone https://github.com/nJuanPablo/geoportal-laravel.git
```
2. Instala las dependencias:
```bash
composer install
npm install
```
3. Cree el archivo de entorno:
```bash
cp .env.example .env
php artisan key:generate
```
4. Configura la base de datos en .env.
5. Ejecuta las migraciones:
```bash
php artisan migrate:fresh --seed
```
6. Inicia el servidor:
```bash
php artisan serve
```

## 📂 Para subir la pagina a un hosting con Ubuntu

Tener en cuenta que se debe tener el puerto habilitado 8080

1. Instalar Docker:
```bash
sudo apt update
sudo apt install docker.io
sudo apt install docker-compose
docker -v
docker-compose -v
```
2. Copiar el directorio:
```bash
git clone https://github.com/nJuanPablo/geoportal-laravel.git
```
3. Abrir el directorio
```bash
cd geoportal-laravel
mv .env.example .env
```
4. Construir los contenedores
```bash
sudo docker-compose up -d --build
```
6. Correr los comandos de Laravel
```bash
docker exec -it laravel_app composer install
docker exec -it laravel_app php artisan key:generate
docker exec -it laravel_app php artisan migrate:fresh --seed
```

## 🧱 Error
Se tuvo un error de denegacion de permisos, posiblemente el `chown` puede estar ejecutándose antes de que los archivos estén presentes si los copias después en el `Dockerfile`. Para corregirlo se ejecutaron los siguientes comandos: 

```bash
docker exec -it laravel_app bash
chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage
```


## ✍️ Usuarios de prueba 
* Username: JuanPablo - password: N4v13mbr3123*-*
* Username: JQuintero - password: ba2E46C7wn6K
* Username: JAyala - password: Y3Fu6J1KNI4E
* Username: AGalindo - password: YLP92Ia5M7uH

## ✍️ Autor
Juan Pablo Navarro Cabiativa

## 📄 Licencia

Copyright (c) 2025 Juan Pablo Navarro Cabiativa

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights  
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell      
copies of the Software, and to permit persons to whom the Software is         
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in     
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR     
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,      
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE   
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER        
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING       
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS  
IN THE SOFTWARE.
