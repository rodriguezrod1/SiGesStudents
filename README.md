# SiGeStudens

## Descripción

Esta es una mini aplicación web para la gestión (CRUD) de estudiantes y cursos, donde se crean y asignan estudiantes a cursos, se visualizan la cantidad de estudiantes por cursos, cursos asociados a estudiantes,  Top 3 de los cursos con más estudiantes en los últimos 6 meses, lista de cursos donde se encuentra asignado un estudiante.

## Tecnologías

La aplicación se desarrolló utilizando las siguientes tecnologías:

- Laravel 9
- Vite
- Blade + Vue.js 3 + Inertia.js
- Base de datos MySQL
- Bootstrap 5
- Plantilla Codebase Admin 5.4

## Instalación

1. Clona el repositorio o descarga el ZIP.
2. Ejecuta `composer install`.
3. Ejecuta `npm install && npm run dev`.
4. Copia `.env.example` a `.env` y configura la conexión de base de datos.
5. Ejecuta `php artisan key:generate`.
6. Ejecuta `php artisan migrate`.
7. Ejecuta `php artisan serve` para iniciar la aplicación localmente.

## Despliegue

La aplicación se puede desplegar en un servidor web utilizando cualquier proveedor de alojamiento como [Komodohosting](https://komodohosting.online/) o [AWS](https://aws.amazon.com/es/). Asegúrate de seguir los pasos de instalación anteriores para configurar la aplicación en tu servidor.

## Contribución

Si deseas contribuir a este proyecto, por favor crea una rama y luego envía una solicitud de extracción.

## Créditos

La aplicación está basada en la plantilla de [Codebase Admin 5.4](https://themeforest.net/item/codebase-bootstrap-5-admin-dashboard-template-ui-kit/33485463).