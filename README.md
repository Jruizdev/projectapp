# ProjectAPP
Es un proyecto web desarrollado con el objetivo de gestionar la información referente a los proyectos realizados de manera centralizada, permitiendo recuperarlos y presentarlos en el portafolio (https://jrodev.com) de forma automática. 
Para la gestión de la información, se utiliza una base de datos MySQL, la cual, se conecta al servicio API REST para recuperar la información o realizar cambios en los proyectos. La API fue desarrollada utilizando PHP y MySQL.

- URL de la API: https://jrodev.x10.mx/

## Recuperar información de todos los proyectos:
Es posible recuperar un objeto JSON con la información de todos los proyectos, únicamente realizando una llamada con el método GET a la API, sin ningún parámetro adicional. Ejemplo: 
```
// URL para obtener la información de todos los proyectos
https://jrodev.x10.mx/
```

## Recuperar información de un proyecto específico:
Se deberá realizar una llamada con el método GET, enviando como parámetro el ID del proyecto. Ejemplo:

```
// URL para obtener la información del proyecto con ID "PTTW"
https://jrodev.x10.mx?id=PTTW
```

## Agregar un nuevo proyecto:
Es necesario realizar una llamada a la API mediante el método POST, enviando la información del proyecto como un objeto JSON y la llave de acceso como un parámetro de tipo GET. Ejemplo:

```
// JSON con la información del proyecto, se debe enviar como parte del "body" de la petición POST
{
	"proyecto_id": "PN1",
	"nombre": "Nuevo proyecto",
	"descripcion": "Descripcion del proyecto",
	"habilidades": "HTML5, JavaScript",
	"portada": "#url de la imagen de portada",
	"repositorio": "#enlace al repositorio del proyecto",
	"enlace": "#enlace al sitio del proyecto"
}
```

```
// Enviando llave de acceso como parámetro
https://jrodev.x10.mx?apikey=[llave de acceso]
```

## Actualizar información de un nuevo proyecto:
Se deberá enviar la información actualizada del proyecto como un objeto JSON utilizando el método PUT, enviando como parámetro GET la llave de acceso. Ejemplo:
```
// JSON con la información actualizada del proyecto, se debe enviar como parte del "body" de la petición PUT
{
	"nombre": "Nuevo proyecto",
	"descripcion": "Descripcion del proyecto actualizada",
	"habilidades": "HTML5, JavaScript",
	"portada": "#url de la imagen de portada",
	"repositorio": "#enlace al repositorio del proyecto",
	"enlace": "#enlace al sitio del proyecto"
}
```

```
// Ejemplo de la estructura URL utilizada para actualizar la información del proyecto con ID "PN1"
https://jrodev.x10.mx/index.php/PN1?apikey=[llave de acceso]
```

## Eliminar un proyecto:
Esta acción se realiza mediante una petición con el método "DELETE" a la API, enviando únicamente el ID del proyecto por eliminar y la llave de acceso como parámetros. Ejemplo:

```
// Ejemplo de la estructura URL utilizada para eliminar el proyecto con ID "PN1" con el método "DELETE" 
https://jrodev.x10.mx/index.php/PN1?apikey=[llave de acceso]
```
