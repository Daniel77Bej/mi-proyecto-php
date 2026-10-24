<?php

// Conexión a la base de datos
$conexion = new mysqli(
    "localhost",
    "root",
    "",
    "estudiantes"
);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener ID
$id = $_GET['id'];


// Eliminar estudiante
$sql = "DELETE FROM personal WHERE ID = ?";

$stmt = $conexion->prepare($sql);

$stmt->bind_param("i", $id);


if ($stmt->execute()) {

    // Regresar al listado
    header("Location: listar.php");
    exit;

} else {

    echo "Error al eliminar: " . $conexion->error;

}


$conexion->close();

?>