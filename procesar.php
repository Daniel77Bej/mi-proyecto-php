
<?php

// Conectar con la base de datos
include("conexion.php");

// 1. Comprobar que la solicitud sea mediante POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Método de solicitud no permitido");
}

// 2. Recibir y normalizar los datos
$nombre = trim($_POST["nombre"] ?? "");
$apellido = trim($_POST["apellido"] ?? "");
$ID = trim($_POST["documento"] ?? "");
$fecha_nacimiento = trim($_POST["fecha_nacimiento"] ?? "");
$codigo_estudiantil = trim($_POST["codigo_estudiantil"] ?? "");
$programa = trim($_POST["programa"] ?? "");
$semestreRecibido = $_POST["semestre"] ?? "";
$correo = trim($_POST["correo"] ?? "");
$telefono = trim($_POST["telefono"] ?? "");
$direccion = trim($_POST["direccion"] ?? "");

// 3. Validar campos obligatorios
if (
    $nombre === "" ||
    $apellido === "" ||
    $ID === "" ||
    $fecha_nacimiento === "" ||
    $codigo_estudiantil === "" ||
    $programa === "" ||
    $semestreRecibido === "" ||
    $correo === "" ||
    $telefono === "" ||
    $direccion === ""
) {
    die("Error: todos los campos son obligatorios");
}

// 4. Validar correo
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("Error: el correo electrónico no tiene un formato válido");
}

// 5. Validar semestre
$semestre = filter_var(
    $semestreRecibido,
    FILTER_VALIDATE_INT,
    [
        "options" => [
            "min_range" => 1,
            "max_range" => 10
        ]
    ]
);

if ($semestre === false) {
    die("Error: el semestre debe ser un número entre 1 y 10");
}

// 6. Validar programa
$programasPermitidos = [
    "Ingeniería Informática",
    "Ingeniería Industrial",
    "Administración de Empresas"
];

if (!in_array($programa, $programasPermitidos, true)) {
    die("Error: el programa seleccionado no es válido");
}

// 7. Verificar si el correo ya está registrado
$consulta = $conexion->prepare(
    "SELECT ID FROM personal WHERE correo = ?"
);

$consulta->bind_param("s", $correo);
$consulta->execute();
$consulta->store_result();

if ($consulta->num_rows > 0) {
    $consulta->close();
    $conexion->close();
    die("Error: el correo ya está registrado");
}

$consulta->close();

// 8. Insertar mediante una consulta preparada
$insertar = $conexion->prepare(
    "INSERT INTO personal
    (ID, apellido, nombre, fecha_nacimiento, codigo_estudiantil, programa, semestre, correo, telefono, direccion)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
);

$insertar->bind_param(
    "ssssssisss",
    $ID,
    $apellido,
    $nombre,
    $fecha_nacimiento,
    $codigo_estudiantil,
    $programa,
    $semestre,
    $correo,
    $telefono,
    $direccion
);

// 9. Ejecutar la inserción
if ($insertar->execute()) {
    echo "Registro guardado correctamente";
} else {
    echo "No fue posible guardar el registro";
}

// 10. Cerrar conexiones
$insertar->close();
$conexion->close();

?>
