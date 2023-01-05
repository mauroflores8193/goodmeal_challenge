# Project Name: GoodMeal Challenge

### Descripción

El presente proyecto es un reto técnico desarrollado para la empresa GoodMeal

### Tecnologías

* PHP
* Laravel
* VueJs
* MySQL
* Docker
* Docker compose

## Requisitos

- Docker instalado

## Instalación y ejecución 🛠️

- Clonar el proyecto.
- Ingresar a la carpeta del proyecto
- Construir los contenedores: `docker-compose build`
- Iniciar el servicio: `docker-compose up -d`
- Instalar las dependencias del backend: `docker-compose exec crud-service composer install`
- Ejecutar las migraciones: `docker-compose exec crud-service php artisan migrate`
- Ejecutar los seeders: `docker-compose exec crud-service php artisan db:seed`

Los microservicios por defecto corren en los siguientes puertos:

- crud-service: 8000
- frontend: 8080

### Testing ⚙️

Para la ejecución de tests automáticos:

- Ejecutar el servicio con `docker-compose up -d`.
- En otro terminal, ejecutar test para
  crud-service `docker-compose exec crud-service php artisan test --testsuite=Feature`.
- En otro terminal, ejecutar test para el fronted `docker-compose exec frontend yarn run test:unit`.

#### Nota

Una vez ejecutados los test de crud-service hay que volver a ejecutar
`docker-compose exec crud-service php artisan db:seed` para volver a poblar la base de datos

### Autores ✒️

* **Autor:** Mauro Flores F., mauroflores8193@gmail.com
