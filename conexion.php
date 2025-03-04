<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'trips';

    $conexion = new mysqli($host, $user, $pass, $db);

    if ($conexion->connect_error) {
        $conexion->connect_error;
    }
    // echo 'Conectado a la Base de Datos!';
?>