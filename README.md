# Propiedades - API REST Lumen  
API REST de propiedades inmobiliarias.

## **Requerimientos**
PHP 7.2
MySQL 5.7
Apache 2.4
Composer

## **Instalación**

 1. Clonar repositorio - rama master (development tambien tiene los ultimos cambios, ya que trabajo en development y luego al finalizar mergeo con master). 
 2. Crear en MySQL una base de datos con collation utf8mb4_general_ci y con un nombre a eleccion (por ejemplo: propiedades).
 3. Crear archivo .env a partir del .env.example y configurarlo con: las credenciales de base de datos, una KEY para el campo APP_KEY y una KEY para el campo JWT_SECRET (Este ultimo hay que agregarlo ya que no figura por default en el archivo).
 4. Ejecutar dentro del proyecto el comando para instalar las librerías necesarias para el funcionamiento del proyecto: composer install
 5. Ejecutar el comando para migraciones y seeders: php artisan migrate --seed
 6. Correr el servidor: php artisan serve

## **Login**
  
**URL**: {Endpoint}/login  
**Method**: POST  
**Params**:  
*usuario: requerido, string  
clave: requerido, string*  
  
**Header**  
  
_Content-Type: application/x-www-form-urlencoded_  
  
**Success**  
  
**Code**: _200_  
**Content**:  
*{
"token": "eyJ0eXAiOiJKV1QiLCJhbGciO2..."
}*

## **Listado de propiedades**
  
**URL**: {Endpoint}/propiedades  
**Method**: GET
**Params**:  
***tipo_propiedad**: opcional, integer. Valores posibles: 1-casa, 2-departamento, 3-PH, 4-local, 5-campo, 6-quinta   
**tipo_operacion**: opcional, integer. Valores posibles: 1-venta, 2-alquiler
**precio_desde**: opcional, decimal
**precio_hasta**: opcional, decimal
**texto_libre**: opcional, string*
  
**Header**    
Authorization: Bearer {token}
  
**Success - Ejemplo**  
**Code**: _200_  
**Ejemplo**:  
    *{
	    "data": [
	    {
	    "id": 1,
	    "titulo": "Magnam dicta sequi sunt voluptatum id est aut.",
	    "descripcion": "Inventore eum eaque dolore hic. Quia perferendis magni ratione sit. Corporis possimus et nihil iusto ut.",
	    "tipo_propiedad": "PH",
	    "estado": "closed",
	    "tipo_operacion": "alquiler",
	    "precio_minimo": "58.00",
	    "precio_maximo": "17.00"
	    },*
	    ],
	"links": {
	"first": "http://localhost:8000/api/propiedades?page=1",
	"last": "http://localhost:8000/api/propiedades?page=2",
	"prev": null,
	"next": "http://localhost:8000/api/propiedades?page=2"
	},
	"meta": {
	"current_page": 1,
	"from": 1,
	"last_page": 2,
	"path": "http://localhost:8000/api/propiedades",
	"per_page": 50,
	"to": 50,
	"total": 99
	}
}

## Mostrar una propiedad
**URL**: {Endpoint}/propiedades/1  
**Method**: GET
  
**Header**    
Authorization: Bearer {token}
  
**Success - Ejemplo**  
**Code**: _200_  
**Ejemplo**:  
*{
"data": {
"id": 2,
"titulo": "Quis pariatur voluptas et quae commodi qui voluptas quasi.",
"descripcion": "Dolorum saepe odio dolorem sapiente voluptas. Et sed nihil recusandae in. Dolorum possimus impedit et.",
"tipo_propiedad": "departamento",
"estado": "available",
"tipo_operacion": "venta",
"precio_minimo": "34.00",
"precio_maximo": "73.00"
}
}*

## Modificar tipo de operación de una propiedad
**URL**: {Endpoint}/propiedades/1  
**Method**: PUT
**Params**:  
tipo_operacion: requerido, integer. Valores posibles: 1-venta, 2-alquiler
 
**Header**    
Authorization: Bearer {token}
Content-Type: application/x-www-form-urlencoded
  
**Success - Ejemplo**  
**Code**: _200_  
**Ejemplo**:  
*{
"data": {
"message": "La propiedad se ha modificado correctamente"
}
}

## Eliminar una propiedad
**URL**: {Endpoint}/propiedades/1  
**Method**: DELETE

**Header**    
Authorization: Bearer {token}
  
**Success - Ejemplo**  
**Code**: _200_  
**Ejemplo**:  
{
"data": {
"message": "La propiedad se ha eliminado correctamente"
}
}

## TODO

- Controlar que no falte ningún paso para la instalación del sistema
 - Mejorar el Handler de Excepciones.
 - Mejorar las validaciones de los campos de entrada y desacoplaros del controlador (creando clases Request de validaciones).
 - Implementar traducción al español de mensajes de error en validaciones de campos.
 - Completar documentación
