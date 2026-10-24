<?php

$servidor = "localhost";
$usuario = "root";
$password = "";
$bd = "estudiantes";

$conexion = new mysqli($servidor, $usuario, $password, $bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

?>