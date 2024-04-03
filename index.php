<?php
require_once ('utilidades/util.php');
require_once ('utilidades/bd.php');
require_once ('utilidades/respuestas_json.php');

$bd = new Conexion ();
$metodo = $_SERVER ['REQUEST_METHOD'];

// Formato de respuesta
header('Content-Type: application/json');

// Evitar que otros host realicen peticiones a la API
if (array_search($_SERVER['HTTP_HOST'], $hosts_permitidos) === null) die (hostNoPermitido ());

switch ($metodo) {
    case 'GET': GET (); break;
    case 'POST': POST (); break;
    case 'PUT': PUT(); break;
    case 'DELETE': DELETE (); break;
}

function GET () {
    global $bd;

    // Obtener todos los proyectos
    if (!isset ($_GET ['id'])) {
        echo $bd->obtenerProyectos();
        return;
    }

    // Obtener proyecto específico
    $id = $_GET ['id'];
    echo $bd->obtenerProyecto ($id);
}

function POST () {
    global $bd;

    $datos_post = Utilidades::obtenerDatosPost();

    if (!isset($_GET ['apikey'])) {
        echo accesoNoPermitido ();
        return;
    }
    $key = $_GET ['apikey'];
    
    // Agregar nuevo proyecto
    echo $bd->agregarproyecto ($datos_post, $key);
    
}

function PUT () {
    global $bd;

    $id_proyecto = Utilidades::obtenerURLID ();
    $datos_post = Utilidades::obtenerDatosPost ();
    
    if($id_proyecto == null || !isset($datos_post)) {
        echo errorSolicitud ();
        return;
    }
    if(!isset($_GET ['apikey'])) {
        echo accesoNoPermitido ();
        return;
    }
    $key = $_GET ['apikey'];

    // Actualizar información de proyecto
    echo $bd->actualizarProyecto ($id_proyecto, $datos_post, $key);
}

function DELETE () {
    global $bd;

    $id_proyecto = Utilidades::obtenerURLID ();

    if (!isset ($_GET ['apikey'])) {
        echo accesoNoPermitido ();
        return;
    }
    if (!isset($id_proyecto)) {
        echo errorSolicitud ();
        return;
    }

    $key = $_GET ['apikey'];

    // Eliminar proyecto
    echo $bd->eliminarProyecto ($id_proyecto, $key);
}

?>