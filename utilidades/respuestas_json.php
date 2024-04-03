<?php

function operacionExitosa ($operacion) {
    return '{"operacion": "'.$operacion.'", "estado":"exitoso"}';
}

function error ($descripcion) {
    return '{"error":"'.$descripcion.'"}';
}

function accesoNoPermitido () {
    return error ('Clave de acceso incorrecta');
}

function hostNoPermitido () {
    return error ('Host no registrado en la API');
}

function errorSolicitud () {
    return error ('Se detectó un error en la estructura de la solicitud');
}

function sinResultado () {
    return error ('No se encontró ningún resultado');
}

function errorFormatoJSON () {
    return error ('Los datos deben ser enviados en formato JSON');
}

function datosFaltantes () {
    return error ('No se recibieron todos los datos necesarios');
}

?>