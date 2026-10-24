
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro de Estudiantes</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card {
            border-radius: 25px !important;
            overflow: hidden;
        }

        #contadorNombre {
            display: block;
            text-align: right;
            margin-top: 5px;
            color: #6c757d;
        }
    </style>

</head>

<body class="bg-dark">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8 col-md-10">

            <div class="card shadow border-0">

                <!-- Encabezado -->
                <div class="card-header bg-primary text-white text-center py-4">

                    <h2 class="mb-1">Registro de Estudiantes</h2>

                    <p class="mb-0">
                        Complete la información solicitada
                    </p>

                </div>

                <div class="card-body p-4">

                    <form action="procesar.php"
                          method="POST"
                          id="formEstudiante"
                          novalidate>

                        <div id="mensajeError"
                             class="alert alert-danger d-none"
                             role="alert"></div>

                        <!-- INFORMACIÓN PERSONAL -->
                        <fieldset class="border rounded p-4 mb-4">

                            <legend class="float-none w-auto px-3 text-primary fw-bold">
                                Información personal
                            </legend>

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label for="nombre" class="form-label fw-bold">
                                        Nombre
                                    </label>

                                    <input type="text"
                                           name="nombre"
                                           id="nombre"
                                           class="form-control"
                                           placeholder="Ingrese su nombre"
                                           maxlength="100"
                                           required>

                                    <!-- Contador de caracteres -->
                                    <small id="contadorNombre"
                                           aria-live="polite">
                                        0 / 100 caracteres
                                    </small>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label for="apellido" class="form-label fw-bold">
                                        Apellido
                                    </label>

                                    <input type="text"
                                           name="apellido"
                                           id="apellido"
                                           class="form-control"
                                           placeholder="Ingrese su apellido"
                                           required>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label for="documento" class="form-label fw-bold">
                                        Documento
                                    </label>

                                    <input type="text"
                                           name="documento"
                                           id="documento"
                                           class="form-control"
                                           placeholder="Número de documento"
                                           required>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label for="fecha_nacimiento" class="form-label fw-bold">
                                        Fecha de nacimiento
                                    </label>

                                    <input type="date"
                                           name="fecha_nacimiento"
                                           id="fecha_nacimiento"
                                           class="form-control"
                                           required>

                                </div>

                            </div>

                        </fieldset>

                        <!-- INFORMACIÓN ACADÉMICA -->
                        <fieldset class="border rounded p-4 mb-4">

                            <legend class="float-none w-auto px-3 text-primary fw-bold">
                                Información académica
                            </legend>

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label for="codigo_estudiantil" class="form-label fw-bold">
                                        Código estudiantil
                                    </label>

                                    <input type="text"
                                           name="codigo_estudiantil"
                                           id="codigo_estudiantil"
                                           class="form-control"
                                           placeholder="Ej: 30260001"
                                           required>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label for="programa" class="form-label fw-bold">
                                        Programa académico
                                    </label>

                                    <select name="programa"
                                            id="programa"
                                            class="form-select"
                                            required>

                                        <option value="" selected>
                                            Seleccione...
                                        </option>

                                        <option value="Ingeniería Informática">
                                            Ingeniería Informática
                                        </option>

                                        <option value="Administración de Empresas">
                                            Administración de Empresas
                                        </option>

                                        <option value="Contaduría Pública">
                                            Contaduría Pública
                                        </option>

                                    </select>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label for="semestre" class="form-label fw-bold">
                                        Semestre
                                    </label>

                                    <select name="semestre"
                                            id="semestre"
                                            class="form-select"
                                            required>

                                        <option value="" selected>
                                            Seleccione...
                                        </option>

                                        <option value="1">1° Semestre</option>
                                        <option value="2">2° Semestre</option>
                                        <option value="3">3° Semestre</option>
                                        <option value="4">4° Semestre</option>
                                        <option value="5">5° Semestre</option>
                                        <option value="6">6° Semestre</option>
                                        <option value="7">7° Semestre</option>
                                        <option value="8">8° Semestre</option>
                                        <option value="9">9° Semestre</option>
                                        <option value="10">10° Semestre</option>

                                    </select>

                                </div>

                            </div>

                        </fieldset>

                        <!-- INFORMACIÓN DE CONTACTO -->
                        <fieldset class="border rounded p-4 mb-4">

                            <legend class="float-none w-auto px-3 text-primary fw-bold">
                                Información de contacto
                            </legend>

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label for="correo" class="form-label fw-bold">
                                        Correo electrónico
                                    </label>

                                    <input type="email"
                                           name="correo"
                                           id="correo"
                                           class="form-control"
                                           placeholder="ejemplo@correo.com"
                                           required>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label for="telefono" class="form-label fw-bold">
                                        Teléfono
                                    </label>

                                    <input type="text"
                                           name="telefono"
                                           id="telefono"
                                           class="form-control"
                                           placeholder="Número de teléfono"
                                           required>

                                </div>

                                <div class="col-12 mb-3">

                                    <label for="direccion" class="form-label fw-bold">
                                        Dirección
                                    </label>

                                    <input type="text"
                                           name="direccion"
                                           id="direccion"
                                           class="form-control"
                                           placeholder="Dirección de residencia"
                                           required>

                                </div>

                            </div>

                        </fieldset>

                        <!-- BOTONES -->
                        <div class="d-flex justify-content-center gap-2 flex-wrap">

                            <button type="submit"
                                    class="btn btn-primary px-4">
                                Registrar estudiante
                            </button>

                            <button type="reset"
                                    class="btn btn-outline-secondary px-4">
                                Limpiar formulario
                            </button>

                            <a href="listar.php"
                               class="btn btn-success px-4">
                                Consultar
                            </a>

                        </div>

                    </form>

                </div>

                <!-- Pie -->
                <div class="card-footer text-center text-muted">
                    Sistema de Registro de Estudiantes
                </div>

            </div>

        </div>

    </div>

</div>

<script src="js/app.js"></script>

</body>
</html>
