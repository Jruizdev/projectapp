<?php

// Obtener URL
$path = isset($_SERVER ['PATH_INFO']) ? $_SERVER ['PATH_INFO'] : '/';

// API Key
putenv('key=123');

// Hosts permitidos
$hosts_permitidos = array ('localhost');

class Utilidades {

    public static function obtenerURLID () {
        global $path;

        if($path === '/') die();

        // Obtener ID de proyecto enviado en la URL
        $url_explode = explode('/', $path);
        $id = end( $url_explode );

        return $id;
    }

    public static function obtenerDatosPost () {
        $datos = json_decode(file_get_contents('php://input'), true);
        return $datos;
    }

}

?>