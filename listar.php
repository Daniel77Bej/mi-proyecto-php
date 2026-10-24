

<?php

$conexion = new mysqli(
    "localhost",
    "root",
    "",
    "estudiantes"
);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$consultaProgramas = $conexion->query(
    "SELECT DISTINCT programa
     FROM personal
     WHERE programa IS NOT NULL
     AND programa <> ''
     ORDER BY programa ASC"
);

$buscar = trim($_GET["buscar"] ?? "");
$programa = trim($_GET["programa"] ?? "");
$orden = $_GET["orden"] ?? "asc";

if ($orden !== "desc") {
    $orden = "asc";
}

$consultaProgramas->data_seek(0);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lista de Estudiantes</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 15px;
            color: #222;
            background-color: #fff;
        }

        h2 {
            font-size: 25px;
            margin: 10px 0 20px;
        }

        .busqueda {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .busqueda input,
        .busqueda select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .busqueda input {
            flex: 1;
            min-width: 220px;
        }

        .busqueda select {
            min-width: 180px;
        }

        .btn-buscar,
        .btn-limpiar {
            display: inline-block;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-buscar {
            background-color: #2563eb;
        }

        .btn-buscar:hover {
            background-color: #1d4ed8;
        }

        .btn-limpiar {
            background-color: #6b7280;
        }

        .btn-limpiar:hover {
            background-color: #4b5563;
        }

        .contenedor-tabla {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 1100px;
            table-layout: fixed;
            border-collapse: collapse;
            font-size: 13px;
        }

        th {
            background-color: #52ab03;
            color: white;
            padding: 12px 6px;
            text-align: left;
            overflow-wrap: anywhere;
            line-height: 1.3;
        }

        td {
            padding: 12px 6px;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
            overflow-wrap: anywhere;
            line-height: 1.4;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        th:nth-child(1), td:nth-child(1) {
            width: 5%;
        }

        th:nth-child(2), td:nth-child(2),
        th:nth-child(3), td:nth-child(3) {
            width: 8%;
        }

        th:nth-child(4), td:nth-child(4) {
            width: 10%;
        }

        th:nth-child(5), td:nth-child(5) {
            width: 10%;
        }

        th:nth-child(6), td:nth-child(6) {
            width: 11%;
        }

        th:nth-child(7), td:nth-child(7) {
            width: 6%;
        }

        th:nth-child(8), td:nth-child(8) {
            width: 13%;
        }

        th:nth-child(9), td:nth-child(9) {
            width: 8%;
        }

        th:nth-child(10), td:nth-child(10) {
            width: 11%;
        }

        th:nth-child(11), td:nth-child(11) {
            width: 10%;
        }

        .acciones {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 5px;
        }

        .editar,
        .eliminar {
            text-decoration: none;
            font-weight: bold;
            font-size: 12px;
        }

        .editar {
            color: #2563eb;
        }

        .eliminar {
            color: #dc2626;
        }

        .editar:hover,
        .eliminar:hover {
            text-decoration: underline;
        }

        .sin-resultados {
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fff3cd;
            border: 1px solid #ffe69c;
            border-radius: 6px;
            color: #664d03;
        }

        .volver {
            display: inline-block;
            margin-top: 18px;
            padding: 10px 15px;
            background-color: #17275c;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
        }

        .volver:hover {
            background-color: #243b82;
        }

        [hidden] {
            display: none !important;
        }

        @media (max-width: 1100px) {
            body {
                margin: 8px;
            }

            h2 {
                font-size: 21px;
            }
        }
    </style>

</head>

<body>

    <h2>Listado de Estudiantes</h2>

    <form method="GET" action="listar.php"
          class="busqueda" id="formBusqueda">

        <input
            type="text"
            name="buscar"
            placeholder="Buscar por nombre o correo..."
            value="<?php echo htmlspecialchars($buscar, ENT_QUOTES, 'UTF-8'); ?>"
        >

        <select name="programa">

            <option value="">Todos los programas</option>

            <?php while ($filaPrograma = $consultaProgramas->fetch_assoc()) { ?>

                <option
                    value="<?php echo htmlspecialchars($filaPrograma['programa'], ENT_QUOTES, 'UTF-8'); ?>"
                    <?php echo ($programa === $filaPrograma['programa']) ? 'selected' : ''; ?>
                >
                    <?php
                    echo htmlspecialchars(
                        $filaPrograma['programa'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>
                </option>

            <?php } ?>

        </select>

        <select name="orden">

            <option value="asc"
                <?php echo ($orden === "asc") ? "selected" : ""; ?>>
                Nombre A-Z
            </option>

            <option value="desc"
                <?php echo ($orden === "desc") ? "selected" : ""; ?>>
                Nombre Z-A
            </option>

        </select>

        <button type="submit" class="btn-buscar">
            Buscar
        </button>

        <a href="listar.php" class="btn-limpiar">
            Limpiar
        </a>

    </form>

    <?php if (isset($_GET["actualizado"]) && $_GET["actualizado"] == "1") { ?>

        <script>
            alert("El estudiante se actualizó correctamente.");

            window.history.replaceState(
                {},
                document.title,
                "listar.php"
            );
        </script>

    <?php } ?>

    <div id="mensajeCarga">
        Cargando estudiantes...
    </div>

    <div id="mensajeResultados" class="sin-resultados" hidden>
        No se encontraron estudiantes con los criterios seleccionados.
    </div>

    <div id="mensajeErrorLista" class="sin-resultados" hidden>
        No fue posible cargar los estudiantes. Intenta nuevamente.
    </div>

    <div class="contenedor-tabla">

        <table id="tablaEstudiantes">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de nacimiento</th>
                    <th>Código estudiantil</th>
                    <th>Programa</th>
                    <th>Semestre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody id="tabla-estudiantes"></tbody>

        </table>

    </div>

    <a class="volver" href="index.php">
        Volver al formulario
    </a>

    <script src="js/app.js"></script>

</body>
</html>

<?php
$consultaProgramas->free();
$conexion->close();
?>

