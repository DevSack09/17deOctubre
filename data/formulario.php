<?php
session_start();
if (empty($_SESSION["idusuario"])) {
    header("location: ../index.php");
} else {

    include "../controlador/sesion_activa/datos_sesion.php";
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Premio 17 de octubre | IEEH</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <!-- Google fonts - Popppins for copy-->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&amp;display=swap"
            rel="stylesheet">
        <!-- Ladda-->
        <link rel="stylesheet" href="vendor/ladda/ladda-themeless.min.css">
        <!-- Prism Syntax Highlighting-->
        <link rel="stylesheet" href="vendor/prismjs/plugins/toolbar/prism-toolbar.css">
        <link rel="stylesheet" href="vendor/prismjs/themes/prism-okaidia.css">
        <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
            integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <!-- The Main Theme stylesheet (Contains also Bootstrap CSS)-->
        <link rel="stylesheet" href="css/style.violet.css" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="css/custom.css">
        <!-- Favicon-->
        <link rel="shortcut icon" href="../img/IEEH.png">

        <style>
        </style>
    </head>

    <body>
        <header class="header">
            <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow">
                <a class="sidebar-toggler text-gray-500 me-4 me-lg-5 lead" href="#"><i class="fas fa-align-left"></i></a>
                <a class="navbar-brand fw-bold text-uppercase text-base" style="text-align: center;" href="index.php">
                    <span class="d-none d-brand-partial">Premio 17 de octubre </span><br>
                    <span class="d-none d-sm-inline">Dédima Tercera Edición </span>
                </a>
                <ul class="ms-auto d-flex align-items-center list-unstyled mb-0">
                    <li class="nav-item dropdown ms-auto">
                        <a class="nav-link pe-0" id="userInfo" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="avatar p-1" src="img/generico.png" alt="Jason Doe">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated" aria-labelledby="userInfo">
                            <div class="dropdown-header text-gray-700">
                                <h6 class="text-uppercase font-weight-bold"><?php echo $nombreCompleto; ?></h6>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../controlador/controlador_cerrar.php">Cerrar Sesión</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </header>
        <div class="d-flex align-items-stretch">
            <!-- Menú -->
            <?php include 'menu.php'; ?>
            <div class="page-holder bg-gray-100">
                <div class="container-fluid px-lg-4 px-xl-5">
                    <!-- Page Header-->
                    <div class="page-header">
                        <h1 class="page-heading text-center">Formulario de registro</h1>
                    </div>
                    <section>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4 style="color: #495057;"><strong>Progreso del formulario:</strong></h4>
                                <div class="progress custom-height mb-3">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        0%
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="g-3 needs-validation" id="formRegistro"
                                    action="../controlador/controlador_form.php" method="post"
                                    enctype="multipart/form-data">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="curp">CURP <span class="required">*</span></label>
                                        <div class="input-icon">
                                            <i class="fas fa-id-card"></i>
                                            <input class="form-control" id="curp" name="curp" type="text"
                                                placeholder="Ej. RAMJ920313HDFRMR01" required minlength="18" maxlength="18"
                                                data-validacion-manual="true" onblur="validarCurp()">
                                        </div>
                                        <a href="https://www.gob.mx/curp/" target="_blank">Si no conoces tu CURP, haz clic
                                            aquí para obtenerla</a>
                                        <div id="curp-feedback" class="text-danger mt-2" style="display: none;">
                                            <!-- Mensaje de error se mostrará aquí -->
                                        </div>
                                        <div class="valid-feedback">Muy bien!</div>
                                        <div class="invalid-feedback">Por favor, introduzca su CURP.</div>
                                    </div>

                                    <!-- Alertas -->
                                    <div id="alert-container" style="position: relative; margin-top: 20px;">
                                        <!-- Aquí se mostrarán las alertas -->
                                    </div>

                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingDatosPersonales">
                                                <button class="accordion-button fw-bold fs-5" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseDatosPersonales"
                                                    aria-expanded="true" aria-controls="collapseDatosPersonales">
                                                    Datos personales
                                                </button>
                                            </h2>
                                            <div id="collapseDatosPersonales" class="accordion-collapse collapse show"
                                                aria-labelledby="headingDatosPersonales" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="apellidopaterno">Apellido paterno
                                                                <span class="required">*</span></label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-user-tag"></i>
                                                                <input class="form-control" id="apellidopaterno" type="text"
                                                                    placeholder="Ej. Ramirez" name="apellidopaterno"
                                                                    disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Por favor, introduzca su apellido
                                                                paterno.
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="apellidomaterno">Apellido
                                                                Materno</label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-user-tag"></i>
                                                                <input class="form-control" id="apellidomaterno" type="text"
                                                                    placeholder="Ej. Pérez" name="apellidomaterno" disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Por favor, introduzca su apellido
                                                                materno.
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="nombre">Nombre(s) <span
                                                                    class="required">*</span></label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-user"></i>
                                                                <input class="form-control" id="nombre" type="text"
                                                                    placeholder="Ej. Juan" name="nombre" disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Por favor, introduzca su
                                                                nombre(s).
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-2">
                                                            <label class="form-label" for="fechanacimiento">Fecha de
                                                                nacimiento
                                                                <span class="required">*</span></label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-calendar-alt"></i>
                                                                <input class="form-control" id="fechanacimiento" type="date"
                                                                    name="fechanacimiento" disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Por favor, introduzca su fecha de
                                                                nacimiento.
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label" for="edad">Edad <span
                                                                    class="required">*</span></label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-sort-numeric-up"></i>
                                                                <input class="form-control" id="edad" type="text"
                                                                    placeholder="Ej. 25" minlength="2" maxlength="2"
                                                                    name="edad" disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Por favor, introduzca su edad.
                                                            </div>
                                                            <div class="invalid-feedback min-max-length">La edad debe tener
                                                                2
                                                                caracteres
                                                                y
                                                                ser mayor a 18 años.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Términos -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTerminos">
                                                <button class="accordion-button fw-bold fs-5 collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTerminos"
                                                    aria-expanded="false" aria-controls="collapseTerminos">
                                                    Términos
                                                </button>
                                            </h2>
                                            <div id="collapseTerminos" class="accordion-collapse collapse"
                                                aria-labelledby="headingTerminos" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <!-- Aceptación del Aviso de Privacidad Integral -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="terminos_privacidad" name="terminos_privacidad"
                                                                    disabled>
                                                                <label class="form-check-label" for="terminos_privacidad">
                                                                    He leído y comprendo los términos del
                                                                    <a href="ruta_al_archivo/aviso_de_privacidad_integral.pdf"
                                                                        target="_blank">
                                                                        Aviso de Privacidad Integral
                                                                    </a>.
                                                                </label>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Debe aceptar los términos del
                                                                Aviso de Privacidad Integral.</div>
                                                        </div>
                                                    </div>

                                                    <!-- Aceptación del Formato para Otorgar Consentimiento Expreso -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="terminos_consentimiento"
                                                                    name="terminos_consentimiento" disabled>
                                                                <label class="form-check-label"
                                                                    for="terminos_consentimiento">
                                                                    He leído y comprendo los términos de
                                                                    <a href="ruta_al_archivo/formato_para_otorgar_consentimiento_expreso.pdf"
                                                                        target="_blank">
                                                                        Formato para Otorgar Consentimiento Expreso
                                                                    </a>.
                                                                </label>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Debe aceptar los términos del
                                                                Formato para Otorgar Consentimiento Expreso.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                        <button type="submit" id="btnGuardar" class="btn btn-primary"
                                            style="display: none;">Guardar</button>
                                        <button type="button" id="btnActualizar" class="btn btn-warning"
                                            style="display: none;">Actualizar</button>
                                        <button type="button" id="btnCancelar" class="btn btn-secondary"
                                            style="display: none;">Cancelar</button>
                                        <button type="button" id="btnFinalizar" class="btn btn-danger"
                                            style="display: none;">Finalizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
                <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 text-center text-md-start fw-bold">
                                <p class="mb-2 mb-md-0 fw-bold">Unidad de Tecnologías de la Información y Comunicaciones
                                    &copy; 2025</p>
                            </div>
                            <div class="col-md-6 text-center text-md-end text-gray-400">
                                <p class="mb-0">Version 1.0.0</p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- JavaScript files-->
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Main Theme JS File-->
        <script src="js/theme.js"></script>
        <!-- <script src="js/forms-validation.js"></script> -->
        <!-- Prism for syntax highlighting-->
        <script src="vendor/prismjs/prism.js"></script>
        <script src="vendor/prismjs/plugins/normalize-whitespace/prism-normalize-whitespace.min.js"></script>
        <script src="vendor/prismjs/plugins/toolbar/prism-toolbar.min.js"></script>
        <script src="vendor/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>
        <script type="text/javascript">
            // Optional
            Prism.plugins.NormalizeWhitespace.setDefaults({
                'remove-trailing': true,
                'remove-indent': true,
                'left-trim': true,
                'right-trim': true,
            }); 
        </script>

        <!-- validación para la curp-->
        <script>
            function mostrarAlerta(tipo, mensaje, temporal = true) {
                const alertContainer = document.getElementById('alert-container');

                alertContainer.innerHTML = '';

                const alert = document.createElement('div');
                alert.className = `alert alert-${tipo} fade show`;
                alert.style.animation = 'fadeIn 0.5s';
                alert.innerHTML = `
            <span>${mensaje}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>`;
                alertContainer.appendChild(alert);

                if (temporal) {
                    setTimeout(() => {
                        alert.style.animation = 'fadeOut 0.5s';
                        setTimeout(() => alert.remove(), 500);
                    }, 10000);
                }
            }

            function bloquearFormulario() {
                const formFields = document.querySelectorAll('#formRegistro input, #formRegistro select, #formRegistro button');
                formFields.forEach((field) => {
                    if (!field.classList.contains('accordion-button') && field.id !== 'curp') {
                        field.disabled = true;
                    }
                });
                document.getElementById('btnGuardar').style.display = 'none';
                document.getElementById('btnActualizar').style.display = 'none';
            }

            function habilitarFormulario() {
                const formFields = document.querySelectorAll('#formRegistro input, #formRegistro select, #formRegistro button');
                formFields.forEach((field) => {
                    if (!field.classList.contains('accordion-button')) {
                        field.disabled = false;
                    }
                });
                document.getElementById('btnGuardar').style.display = 'block';
                document.getElementById('btnActualizar').style.display = 'none';
            }

            function validarCurp() {
                const curpInput = document.getElementById('curp');
                const feedback = document.getElementById('curp-feedback');

                const curpRegex = /^[A-Z]{4}\d{6}[HM][A-Z]{5}[A-Z\d]{2}$/i;

                if (!curpInput.value.trim()) {
                    mostrarAlerta('warning', 'Por favor, introduzca su CURP.');
                    curpInput.focus();
                    bloquearFormulario();
                    return;
                }

                if (curpInput.value.trim().length !== 18) {
                    mostrarAlerta('warning', 'El CURP debe tener exactamente 18 caracteres.');
                    curpInput.focus();
                    bloquearFormulario();
                    return;
                }

                if (!curpRegex.test(curpInput.value.trim())) {
                    mostrarAlerta('warning', 'El CURP no tiene el formato correcto.');
                    curpInput.focus();
                    bloquearFormulario();
                    return;
                }

                feedback.style.display = 'none';

                mostrarAlerta('info', '<i class="fas fa-spinner fa-spin"></i> Validando CURP...', false);

                setTimeout(() => {
                    fetch('../controlador/validar_curp.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ curp: curpInput.value }),
                    })
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error('Error en la respuesta del servidor');
                            }
                            return response.json();
                        })
                        .then((data) => {
                            document.querySelector('#alert-container .alert').remove();

                            if (data.exists) {
                                feedback.style.display = 'block';
                                feedback.textContent = 'El CURP ya está registrado. Por favor, use otro.';
                                bloquearFormulario();
                                mostrarAlerta('danger', 'El CURP ya está registrado. Por favor, intente con otro.');
                            } else {
                                feedback.style.display = 'none';
                                habilitarFormulario();
                                mostrarAlerta('success', 'El CURP es válido. Puede continuar con el registro.');
                            }
                        })
                        .catch((error) => {
                            document.querySelector('#alert-container .alert').remove();

                            console.error('Error al validar el CURP:', error);
                            mostrarAlerta('danger', 'Hubo un error al validar el CURP. Intente nuevamente.');
                            bloquearFormulario();
                        });
                }, 2000);
            }

            document.addEventListener('DOMContentLoaded', () => {
                bloquearFormulario();
            });

            document.getElementById('curp').addEventListener('input', (event) => {
                const curpInput = event.target.value.trim();

                if (curpInput === '' || curpInput.length !== 18) {
                    bloquearFormulario();
                }
            });
        </script>
        <!-- Guardar registros-->
        <script>
            $(document).ready(function () {
                function bloquearFormulario() {
                    const formFields = $('#formRegistro input, #formRegistro select, #formRegistro button');
                    formFields.each(function () {
                        if (!$(this).hasClass('accordion-button')) {
                            $(this).prop('disabled', true);
                        }
                    });
                }

                $("#formRegistro").submit(function (event) {
                    event.preventDefault();

                    const curpField = $("#curp");
                    curpField.prop("disabled", false);

                    const feedback = document.getElementById("curp-feedback");
                    if (feedback.style.display === "block") {
                        Swal.fire("Error", "Por favor, corrija la CURP antes de continuar.", "error");
                        curpField.prop("disabled", true);
                        return;
                    }

                    const formData = $(this).serialize();

                    Swal.fire({
                        title: "¿Estás seguro?",
                        text: "¿Deseas guardar los cambios realizados?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí, guardar",
                        cancelButtonText: "Cancelar",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "../controlador/controlador_form.php",
                                type: "POST",
                                data: formData,
                                dataType: "json",
                                beforeSend: function () {
                                    Swal.fire({
                                        title: "Guardando...",
                                        text: "Por favor, espera un momento.",
                                        allowOutsideClick: false,
                                        didOpen: () => {
                                            Swal.showLoading();
                                        },
                                    });
                                },
                                success: function (response) {
                                    Swal.close();
                                    if (response.status === "success") {
                                        Swal.fire({
                                            title: "¡Éxito!",
                                            text: response.message,
                                            icon: "success",
                                            confirmButtonText: "OK",
                                            allowOutsideClick: false,
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire("Error", response.message, "error");
                                    }
                                },
                                error: function () {
                                    Swal.close();
                                    Swal.fire("Error", "No se pudo procesar la solicitud.", "error");
                                },
                                complete: function () {
                                    curpField.prop("disabled", true);
                                },
                            });
                        }
                    });
                });

                document.addEventListener("DOMContentLoaded", () => {
                    bloquearFormulario();
                });
            });
        </script>
        <!-- obtener información -->
        <script>
            $(document).ready(function () {
                const formFields = $('#formRegistro input, #formRegistro select, #formRegistro button');
                const curpField = $('#curp');
                let originalFormData = {};

                // Función para bloquear completamente el formulario
                function bloquearFormularioCompleto() {
                    // Deshabilitar todos los campos del formulario, excepto los botones del acordeón
                    $('#formRegistro :input').not('.accordion-button').prop('disabled', true);

                    // Ocultar todos los botones
                    $('#btnGuardar, #btnActualizar, #btnCancelar, #btnFinalizar').hide();

                    // Mostrar una alerta indicando que el formulario ya está finalizado
                    Swal.fire({
                        title: "Formulario Finalizado",
                        text: "Este formulario ya ha sido finalizado y no se puede modificar.",
                        icon: "info",
                        confirmButtonText: "OK",
                        allowOutsideClick: false,
                    });
                }

                // Función para bloquear el formulario
                function bloquearFormulario() {
                    formFields.each(function () {
                        if (!$(this).hasClass('accordion-button') && this.id !== 'btnActualizar') {
                            $(this).prop('disabled', true);
                        }
                    });
                    $('#btnActualizar').show().prop('disabled', false);
                    $('#btnGuardar, #btnCancelar').hide();

                    // Asegurarse de que el botón "Finalizar" siempre esté visible y habilitado
                    $('#btnFinalizar').show().prop('disabled', false);
                }

                // Función para habilitar el formulario
                function habilitarFormulario() {
                    formFields.each(function () {
                        if (!$(this).hasClass('accordion-button')) {
                            $(this).prop('disabled', false);
                        }
                    });
                    curpField.prop('disabled', true); // CURP siempre deshabilitado
                    $('#btnGuardar, #btnCancelar').show();
                    $('#btnActualizar').hide();

                    // Asegurarse de que el botón "Finalizar" siempre esté visible y habilitado
                    $('#btnFinalizar').show().prop('disabled', false);
                }

                // Función para guardar los valores originales
                function guardarValoresOriginales() {
                    originalFormData = {};
                    $('#formRegistro')
                        .serializeArray()
                        .forEach((field) => {
                            originalFormData[field.name] = field.value;
                        });
                }

                // Función para restaurar los valores originales
                function restaurarValoresOriginales() {
                    for (const name in originalFormData) {
                        $(`[name="${name}"]`).val(originalFormData[name]);
                    }
                }

                // Cargar datos del formulario
                function cargarDatos() {
                    $.ajax({
                        url: "../controlador/get_registration.php",
                        type: "GET",
                        dataType: "json",
                        success: function (response) {
                            if (response.status === "success") {
                                const data = response.data;

                                // Cargar los datos en los campos del formulario
                                $('#curp').val(data.curp);
                                $('#nombre').val(data.nombre);
                                $('#apellidopaterno').val(data.apellidoP);
                                $('#apellidomaterno').val(data.apellidoM);
                                $('#fechanacimiento').val(data.fecha_nacimiento);
                                $('#edad').val(data.edad);
                                $('#terminos_privacidad').prop('checked', data.acepta_privacidad == 1);
                                $('#terminos_consentimiento').prop('checked', data.acepta_consentimiento == 1);

                                // Guardar los valores originales
                                guardarValoresOriginales();

                                // Verificar el estado del formulario
                                if (data.status == 1) {
                                    // Bloquear el formulario si ya está finalizado
                                    bloquearFormularioCompleto();
                                } else {
                                    // Habilitar el formulario si no está finalizado
                                    bloquearFormulario();
                                }
                            } else {
                                console.error(response.message);
                            }
                        },
                        error: function () {
                            console.error("Error al obtener los datos del registro.");
                        }
                    });
                }

                // Botón "Actualizar"
                $('#btnActualizar').click(function (event) {
                    event.preventDefault();

                    Swal.fire({
                        title: "¿Estás seguro?",
                        text: "¿Deseas habilitar los campos para actualizar la información?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí, actualizar",
                        cancelButtonText: "Cancelar",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            habilitarFormulario();
                        }
                    });
                });

                // Botón "Cancelar"
                $('#btnCancelar').click(function (event) {
                    event.preventDefault();

                    Swal.fire({
                        title: "¿Estás seguro?",
                        text: "¿Deseas cancelar la edición? Todos los cambios no guardados se perderán.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí, cancelar",
                        cancelButtonText: "Continuar editando",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            bloquearFormulario();
                            Swal.fire(
                                "Edición cancelada",
                                "Has cancelado la edición del formulario.",
                                "info"
                            );
                            location.reload();
                        }
                    });
                });

                // Formulario: Guardar cambios
                $('#formRegistro').submit(function (event) {
                    event.preventDefault();

                    const formData = $(this).serialize();

                    Swal.fire({
                        title: "¿Estás seguro?",
                        text: "¿Deseas guardar los cambios realizados?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí, guardar",
                        cancelButtonText: "Cancelar",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#btnGuardar').prop('disabled', true);
                            Swal.fire({
                                title: "Guardando...",
                                text: "Por favor, espera un momento.",
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });

                            $.ajax({
                                url: "../controlador/controlador_form.php",
                                type: "POST",
                                data: formData,
                                dataType: "json",
                                success: function (response) {
                                    Swal.close();
                                    if (response.status === "success") {
                                        Swal.fire({
                                            title: "¡Éxito!",
                                            text: response.message,
                                            icon: "success",
                                            confirmButtonText: "OK",
                                            allowOutsideClick: false,
                                        }).then(() => {
                                            guardarValoresOriginales();
                                            bloquearFormulario();
                                        });
                                    } else {
                                        Swal.fire("Error", response.message, "error");
                                    }
                                },
                                error: function () {
                                    Swal.close();
                                    Swal.fire("Error", "No se pudo procesar la solicitud.", "error");
                                },
                                complete: function () {
                                    $('#btnGuardar').prop('disabled', false);
                                },
                            });
                        }
                    });
                });

                // Botón "Finalizar"
                $('#btnFinalizar').click(function (event) {
                    event.preventDefault();

                    // Validar que todos los campos obligatorios estén completos
                    if (!$('#formRegistro')[0].checkValidity()) {
                        Swal.fire({
                            title: "Campos incompletos",
                            text: "Por favor, complete todos los campos obligatorios antes de finalizar.",
                            icon: "warning",
                            confirmButtonText: "OK",
                        });
                        $('#formRegistro')[0].reportValidity(); // Resalta los campos inválidos
                        return;
                    }

                    // Confirmar con el usuario si desea finalizar el formulario
                    Swal.fire({
                        title: "¿Estás seguro?",
                        text: "Una vez finalizado, no podrás modificar el formulario.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí, finalizar",
                        cancelButtonText: "Cancelar",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Obtener el CURP del formulario
                            const curp = $('#curp').val();

                            // Enviar solicitud AJAX para guardar los datos y actualizar el estado
                            $.ajax({
                                url: "../controlador/finalizar_formulario.php", // Archivo PHP para finalizar el formulario
                                type: "POST",
                                data: { curp: curp },
                                dataType: "json",
                                beforeSend: function () {
                                    Swal.fire({
                                        title: "Finalizando...",
                                        text: "Por favor, espera un momento.",
                                        allowOutsideClick: false,
                                        didOpen: () => {
                                            Swal.showLoading();
                                        },
                                    });
                                },
                                success: function (response) {
                                    Swal.close();
                                    if (response.status === "success") {
                                        Swal.fire({
                                            title: "¡Éxito!",
                                            text: response.message,
                                            icon: "success",
                                            confirmButtonText: "OK",
                                            allowOutsideClick: false,
                                        }).then(() => {
                                            // Bloquear el formulario completamente
                                            bloquearFormularioCompleto();
                                        });
                                    } else {
                                        Swal.fire("Error", response.message, "error");
                                    }
                                },
                                error: function () {
                                    Swal.close();
                                    Swal.fire("Error", "No se pudo procesar la solicitud.", "error");
                                },
                            });
                        }
                    });
                });

                // Cargar datos iniciales
                cargarDatos();
            });
        </script>
    </body>

    </html>
    <?php
}
?>