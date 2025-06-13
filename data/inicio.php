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
    </head>
    <style>
        .navbar .nav-item.dropdown.ms-auto {
            margin-right: 20px;
        }
    </style>

    <body>
        <!-- navbar-->
        <header class="header">
            <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow">
                <a class="sidebar-toggler text-gray-500 me-4 me-lg-5 lead" href="#"><i class="fas fa-align-left"></i></a>
                <a class="navbar-brand fw-bold text-uppercase text-base" style="text-align: center;" href="index.php">
                    <span class="d-none d-brand-partial">Premio 17 de octubre </span><br>
                    <span class="d-none d-sm-inline">Décima Tercera Edición </span>
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
                    <li>
                        <div class="theme-switch" id="themeSwitch">
                            <i class="fas fa-sun light-icon" id="lightIcon"></i>
                            <i class="fas fa-moon dark-icon" id="darkIcon" style="display: none;"></i>
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

                    <section>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4 style="color: #495057;"><strong>Instrucciones para el Registro:</strong></h4>
                                <h4 class="card-heading text-center"></h4>
                            </div>
                            <div class="card-body">
                                <div>
                                    <br>
                                    <ol>
                                        <li>Consulta las bases de la Convocatoria.</li>
                                        <br>
                                        <li>Descarga los documentos de uso general.</li>
                                        <br>
                                        <li>Elige tu rango de edad y descarga los documentos que te corresponden.
                                        </li>
                                        <br>
                                        <li>Llena el formulario de registro, te recomendamos tener a la mano los formatos
                                            que descargaste, debidamente requisitados; considera que deberás destinar al
                                            menos 60 minutos de tu tiempo, para registrar tus datos y subir los documentos.
                                        </li>
                                        <br>
                                        <li>Guarda tu progreso, en caso de que no puedas concluir tu proceso de registro,
                                            haz clic en el botón <strong>“Guardar”</strong> para que no se pierda tu
                                            progreso, esto te
                                            permitirá retomarlo en otro momento.
                                        </li>
                                        <br>
                                        <li>Una vez que termines tu registro, haz clic en el botón
                                            <strong>“Finalizar”</strong>. Toma en
                                            cuenta que después de realizar esta acción, no podrás actualizar tus datos, ni
                                            añadir otros documentos, por lo que previamente deberás de revisar que la
                                            información que registraste es la correcta y que cargaste adecuadamente todos
                                            los documentos.
                                        </li>
                                        <br>
                                        <li>Finalmente, ayúdanos a mejorar, contestando la encuesta de retroalimentación que
                                            recibirás con la confirmación de tu registro.
                                        </li>
                                    </ol>
                                    <div class="alert alert-primary">
                                        <i class="fas fa-info-circle"></i> <strong>Importante:</strong>
                                        Todos los campos marcados con (<span style="color: red;">*</span>) son
                                        obligatorios. Omitir esta información puede impedirnos procesar tu registro.
                                    </div>
                                </div><br><br>
                                <div style="text-align: center; margin-top: 20px;">
                                    <a href="formulario.php" class="btn btn-primary">Ir al formulario</a>
                                </div>
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
        <!-- Main Theme JS File-->
        <script src="js/theme.js"></script>
        <script src="../js/darkLight.js"></script>

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
    </body>

    </html>
    <?php
}
?>