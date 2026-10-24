
document.addEventListener("DOMContentLoaded", function () {

    

    const formulario = document.getElementById("formEstudiante");

    if (formulario) {

        const nombre = document.getElementById("nombre");
        const correo = document.getElementById("correo");
        const mensajeError = document.getElementById("mensajeError");
        const contadorNombre = document.getElementById("contadorNombre");

        
        if (nombre && contadorNombre) {

            function actualizarContador() {
                contadorNombre.textContent =
                    nombre.value.length + " / 100 caracteres";
            }

            nombre.addEventListener("input", actualizarContador);

            actualizarContador();
        }

        
        formulario.addEventListener("submit", function (evento) {

            evento.preventDefault();

            mensajeError.classList.add("d-none");
            mensajeError.textContent = "";

            nombre.classList.remove("is-invalid");
            correo.classList.remove("is-invalid");

            if (nombre.value.trim() === "") {

                mensajeError.textContent = "El nombre es obligatorio.";
                mensajeError.classList.remove("d-none");
                nombre.classList.add("is-invalid");
                nombre.focus();

                return;
            }

            if (correo.value.trim() === "") {

                mensajeError.textContent =
                    "El correo electrónico es obligatorio.";

                mensajeError.classList.remove("d-none");
                correo.classList.add("is-invalid");
                correo.focus();

                return;
            }

            if (!correo.checkValidity()) {

                mensajeError.textContent =
                    "Ingresa un correo electrónico válido.";

                mensajeError.classList.remove("d-none");
                correo.classList.add("is-invalid");
                correo.focus();

                return;
            }

            
            formulario.submit();

        });

        // Quitar la marca de error al corregir los campos
        nombre.addEventListener("input", function () {
            nombre.classList.remove("is-invalid");
        });

        correo.addEventListener("input", function () {
            correo.classList.remove("is-invalid");
        });

    }


    

    const tabla = document.getElementById("tabla-estudiantes");

    if (tabla) {

        const formularioBusqueda =
            document.getElementById("formBusqueda");

        const mensajeCarga =
            document.getElementById("mensajeCarga");

        const mensajeResultados =
            document.getElementById("mensajeResultados");

        const mensajeErrorLista =
            document.getElementById("mensajeErrorLista");

        function cargarEstudiantes() {

            tabla.replaceChildren();

            mensajeCarga.hidden = false;
            mensajeResultados.hidden = true;
            mensajeErrorLista.hidden = true;

            const datos = new URLSearchParams(
                new FormData(formularioBusqueda)
            );

            fetch("obtener_estudiantes.php?" + datos.toString())

                .then(function (respuesta) {

                    if (!respuesta.ok) {
                        throw new Error(
                            "No se pudieron consultar los estudiantes."
                        );
                    }

                    return respuesta.json();

                })

                .then(function (estudiantes) {

                    if (!Array.isArray(estudiantes)) {
                        throw new Error(
                            "La respuesta del servidor no es válida."
                        );
                    }

                    estudiantes.forEach(function (estudiante) {

                        // Crear la fila
                        const fila = document.createElement("tr");

                        // Crear las celdas de datos
                        const campos = [
                            "ID",
                            "nombre",
                            "apellido",
                            "fecha_nacimiento",
                            "codigo_estudiantil",
                            "programa",
                            "semestre",
                            "correo",
                            "telefono",
                            "direccion"
                        ];

                        campos.forEach(function (campo) {

                            const celda = document.createElement("td");

                            celda.textContent = estudiante[campo] ?? "";

                            fila.appendChild(celda);

                        });

                        // Crear la celda de acciones
                        const celdaAcciones =
                            document.createElement("td");

                        const acciones =
                            document.createElement("div");

                        acciones.className = "acciones";

                        // Enlace para editar
                        const enlaceEditar =
                            document.createElement("a");

                        enlaceEditar.className = "editar";

                        enlaceEditar.href =
                            "editar.php?id=" +
                            encodeURIComponent(estudiante.ID);

                        enlaceEditar.textContent = "Editar";

                        // Separador
                        const separador =
                            document.createElement("span");

                        separador.textContent = " / ";

                        // Enlace para eliminar
                        const enlaceEliminar =
                            document.createElement("a");

                        enlaceEliminar.className =
                            "eliminar enlace-eliminar";

                        enlaceEliminar.href =
                            "eliminar.php?id=" +
                            encodeURIComponent(estudiante.ID);

                        enlaceEliminar.textContent = "Eliminar";

                        // Confirmar antes de eliminar
                        enlaceEliminar.addEventListener(
                            "click",
                            function (evento) {

                                const confirmar = confirm(
                                    "¿Está seguro de eliminar este estudiante?"
                                );

                                if (!confirmar) {
                                    evento.preventDefault();
                                }

                            }
                        );

                        // Agregar acciones a la fila
                        acciones.appendChild(enlaceEditar);
                        acciones.appendChild(separador);
                        acciones.appendChild(enlaceEliminar);

                        celdaAcciones.appendChild(acciones);

                        fila.appendChild(celdaAcciones);

                        // Agregar la fila a la tabla
                        tabla.appendChild(fila);

                    });

                    // Mostrar mensaje si no hay resultados
                    if (estudiantes.length === 0) {
                        mensajeResultados.hidden = false;
                    }

                })

                .catch(function (error) {

                    // Manejar errores de la solicitud
                    mensajeErrorLista.hidden = false;

                    console.error(
                        "Error al cargar los estudiantes:",
                        error
                    );

                })

                .finally(function () {

                    // Ocultar el mensaje de carga al terminar
                    mensajeCarga.hidden = true;

                });

        }

        // Buscar sin recargar la página
        formularioBusqueda.addEventListener(
            "submit",
            function (evento) {

                evento.preventDefault();

                cargarEstudiantes();

            }
        );

        // Restablecer los filtros
        formularioBusqueda.addEventListener(
            "reset",
            function () {

                setTimeout(cargarEstudiantes, 0);

            }
        );

        // Cargar estudiantes al abrir la página
        cargarEstudiantes();

    }

});
