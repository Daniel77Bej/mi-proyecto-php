<?php 

include("conexion.php"); 

// Obtener y validar el ID 
$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT); 

if (!$id) { 
    die("Identificador no válido"); 
} 

// Obtener los datos enviados por el formulario 
$nombre = trim($_POST["nombre"] ?? ""); 
$apellido = trim($_POST["apellido"] ?? ""); 
$fecha_nacimiento = trim($_POST["fecha_nacimiento"] ?? ""); 
$codigo_estudiantil = trim($_POST["codigo_estudiantil"] ?? ""); 
$programa = trim($_POST["programa"] ?? ""); 
$semestre = trim($_POST["semestre"] ?? ""); 
$correo = trim($_POST["correo"] ?? ""); 
$telefono = trim($_POST["telefono"] ?? ""); 
$direccion = trim($_POST["direccion"] ?? ""); 

// Verificar que no haya campos vacíos 
if ( 
    $nombre === "" || 
    $apellido === "" || 
    $fecha_nacimiento === "" || 
    $codigo_estudiantil === "" || 
    $programa === "" || 
    $semestre === "" || 
    $correo === "" || 
    $telefono === "" || 
    $direccion === "" 
) { 
    die("Todos los campos son obligatorios"); 
} 

// Verificar correo 
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) { 
    die("Correo electrónico no válido"); 
} 

// Preparar UPDATE 
$sql = $conexion->prepare( 
    "UPDATE personal SET 
        nombre = ?, 
        apellido = ?, 
        fecha_nacimiento = ?, 
        codigo_estudiantil = ?, 
        programa = ?, 
        semestre = ?, 
        correo = ?, 
        telefono = ?, 
        direccion = ? 
    WHERE ID = ?" 
); 

// Asociar los datos 
$sql->bind_param( 
    "sssssssssi", 
    $nombre, 
    $apellido, 
    $fecha_nacimiento, 
    $codigo_estudiantil, 
    $programa, 
    $semestre, 
    $correo, 
    $telefono, 
    $direccion, 
    $id 
); 

// Ejecutar actualización 
if ($sql->execute()) { 

    header("Location: listar.php?actualizado=1"); 
    exit; 

} else { 

    die("Error al actualizar: " . $sql->error); 

} 

?>