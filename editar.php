<?php

include("conexion.php");

// Obtener y validar el ID
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("Identificador no válido");
}

// Buscar estudiante
$consulta = $conexion->prepare(
    "SELECT * FROM personal WHERE ID = ?"
);

$consulta->bind_param("i", $id);
$consulta->execute();

$resultado = $consulta->get_result();

$estudiante = $resultado->fetch_assoc();

// Verificar que exista
if (!$estudiante) {
    die("Estudiante no encontrado");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Editar Estudiante</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <h2>Editar estudiante</h2>

    <form action="actualizar.php" method="POST">

        <!-- ID oculto -->
        <input type="hidden"
               name="id"
               value="<?php echo $estudiante['ID']; ?>">

        <div class="mb-3">

            <label class="form-label">Nombre</label>

            <input type="text"
                   name="nombre"
                   class="form-control"
                   value="<?php echo htmlspecialchars($estudiante['nombre']); ?>"
                   required>

        </div>


        <div class="mb-3">

            <label class="form-label">Apellido</label>

            <input type="text"
                   name="apellido"
                   class="form-control"
                   value="<?php echo htmlspecialchars($estudiante['apellido']); ?>"
                   required>

        </div>


        <div class="mb-3">

            <label class="form-label">Fecha de nacimiento</label>

            <input type="date"
                   name="fecha_nacimiento"
                   class="form-control"
                   value="<?php echo htmlspecialchars($estudiante['fecha_nacimiento']); ?>"
                   required>

        </div>


        <div class="mb-3">

            <label class="form-label">Código estudiantil</label>

            <input type="text"
                   name="codigo_estudiantil"
                   class="form-control"
                   value="<?php echo htmlspecialchars($estudiante['codigo_estudiantil']); ?>"
                   required>

        </div>


        <div class="mb-3">

            <label class="form-label">Programa</label>

            <input type="text"
                   name="programa"
                   class="form-control"
                   value="<?php echo htmlspecialchars($estudiante['programa']); ?>"
                   required>

        </div>


        <div class="mb-3">

            <label class="form-label">Semestre</label>

            <input type="text"
                   name="semestre"
                   class="form-control"
                   value="<?php echo htmlspecialchars($estudiante['semestre']); ?>"
                   required>

        </div>


        <div class="mb-3">

            <label class="form-label">Correo</label>

            <input type="email"
                   name="correo"
                   class="form-control"
                   value="<?php echo htmlspecialchars($estudiante['correo']); ?>"
                   required>

        </div>


        <div class="mb-3">

            <label class="form-label">Teléfono</label>

            <input type="text"
                   name="telefono"
                   class="form-control"
                   value="<?php echo htmlspecialchars($estudiante['telefono']); ?>"
                   required>

        </div>


        <div class="mb-3">

            <label class="form-label">Dirección</label>

            <input type="text"
                   name="direccion"
                   class="form-control"
                   value="<?php echo htmlspecialchars($estudiante['direccion']); ?>"
                   required>

        </div>


        <button type="submit" class="btn btn-success">
            Guardar cambios
        </button>

        <a href="listar.php" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

</body>
</html>