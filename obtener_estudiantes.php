

<?php

header("Content-Type: application/json; charset=UTF-8");

$conexion = new mysqli(
    "localhost",
    "root",
    "",
    "estudiantes"
);

if ($conexion->connect_error) {
    http_response_code(500);

    echo json_encode([
        "error" => "Error de conexión con la base de datos."
    ]);

    exit;
}

$buscar = trim($_GET["buscar"] ?? "");
$programa = trim($_GET["programa"] ?? "");
$orden = ($_GET["orden"] ?? "asc") === "desc" ? "DESC" : "ASC";

$sql = "SELECT ID, nombre, apellido, fecha_nacimiento,
               codigo_estudiantil, programa, semestre,
               correo, telefono, direccion
        FROM personal
        WHERE 1 = 1";

$parametros = [];
$tipos = "";

if ($buscar !== "") {
    $sql .= " AND (nombre LIKE ? OR correo LIKE ?)";

    $criterio = "%" . $buscar . "%";

    $parametros[] = $criterio;
    $parametros[] = $criterio;

    $tipos .= "ss";
}

if ($programa !== "") {
    $sql .= " AND programa = ?";

    $parametros[] = $programa;

    $tipos .= "s";
}

$sql .= " ORDER BY nombre " . $orden;

$consulta = $conexion->prepare($sql);

if (!$consulta) {
    http_response_code(500);

    echo json_encode([
        "error" => "Error al preparar la consulta."
    ]);

    $conexion->close();
    exit;
}

if (!empty($parametros)) {
    $consulta->bind_param($tipos, ...$parametros);
}

if (!$consulta->execute()) {
    http_response_code(500);

    echo json_encode([
        "error" => "Error al consultar los estudiantes."
    ]);

    $consulta->close();
    $conexion->close();
    exit;
}

$resultado = $consulta->get_result();

$estudiantes = [];

while ($fila = $resultado->fetch_assoc()) {
    $estudiantes[] = $fila;
}

echo json_encode(
    $estudiantes,
    JSON_UNESCAPED_UNICODE
);

$consulta->close();
$conexion->close();

?>

