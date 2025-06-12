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
            .gap-3 {
                gap: 1rem;
            }

            .btn-outline-primary {
                border-color: #7d4ac7;
                color: #7d4ac7;
            }

            .btn-outline-primary:hover {
                background-color: #7d4ac7;
                color: white;
            }

            .btn-outline-secondary {
                border-color: #6c757d;
            }

            .btn-outline-secondary:hover {
                background-color: #6c757d;
                color: white;
            }

            .text-primary {
                color: #7d4ac7 !important;
            }

            .card {
                transition: transform 0.2s;
            }

            .card:hover {
                transform: translateY(-5px);
            }

            .arrow-animation {
                position: fixed;
                right: 145px;
                top: 40px;
                left: unset;
                bottom: unset;
                transform: none;
                z-index: 2000;
                display: none;
                flex-direction: column;
                align-items: center;
            }

            .arrow-circle-glow {
                width: 60px;
                height: 60px;
                background: radial-gradient(circle, #9a6ee2 60%, #fff 100%);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 0 40px 10px #9a6ee2, 0 4px 12px rgba(125, 74, 199, 0.3);
                margin-bottom: 0;
                animation: pulse-glow 2s infinite;
            }

            .arrow-circle-glow i {
                font-size: 36px;
                color: #fff;
                text-shadow: 0 0 12px #9a6ee2, 0 0 20px #9a6ee2;
                animation: arrowBounceUp 1.5s infinite;
            }

            @keyframes arrowBounceUp {

                0%,
                20%,
                50%,
                80%,
                100% {
                    transform: translateY(0);
                }

                40% {
                    transform: translateY(-32px);
                }

                60% {
                    transform: translateY(-16px);
                }
            }

            @keyframes pulse-glow {
                0% {
                    box-shadow: 0 0 80px 30px #9a6ee2, 0 4px 12px rgba(125, 74, 199, 0.3);
                }

                70% {
                    box-shadow: 0 0 140px 50px #9a6ee2, 0 4px 12px rgba(125, 74, 199, 0.3);
                }

                100% {
                    box-shadow: 0 0 80px 30px #9a6ee2, 0 4px 12px rgba(125, 74, 199, 0.3);
                }
            }

            @media (max-width: 576px) {
                .row-cols-sm-2 {
                    grid-template-columns: repeat(1, 1fr);
                }

                .arrow-animation {
                    right: 10px;
                    top: 10px;
                }

                .arrow-circle-glow {
                    width: 36px;
                    height: 36px;
                }

                .arrow-circle-glow i {
                    font-size: 20px;
                }
            }

            .navbar .nav-item.dropdown.ms-auto {
                margin-right: 20px;
            }
        </style>

    </head>

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
                                <h4 style="color: #495057;"><strong>Documentación:</strong></h4>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="alert alert-primary">
                                        <i class="fas fa-info-circle"></i> <strong>Importante:</strong>
                                        seleccione su rango de edad para acceder a los documentos correspondientes.
                                        Asegúrese de descargar únicamente los que apliquen a su caso.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="download">Descarga de documentos:</label>
                                    <div class="input-icon">
                                        <i class="fas fa-user-tag"></i>
                                        <select class="form-control" id="download" name="download">
                                            <option selected disabled value="">Seleccione su rango de edad</option>
                                            <option value="todas">Documentos generales</option>
                                            <option value="menores">Mujeres de 15 a 17 años</option>
                                            <option value="mayores">Mujeres de 18 años en adelante</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="documentosContainer" style="display: none; margin-top: 20px;">
                                    <h5 style="color: #495057; margin-bottom: 25px; text-align: center;"><strong>Documentos
                                            requeridos:</strong></h5>
                                    <div id="listaDocumentos" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-4">
                                    </div>
                                    <div class="text-center mt-4">
                                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                                            <button id="descargarZipBtn" class="btn btn-primary position-relative">
                                                <span id="zipText"><i class="fas fa-file-archive"></i> Descargar todos
                                                    (ZIP)</span>
                                                <span id="loadingIcon" style="display: none;">
                                                    <i class="fas fa-spinner fa-spin"></i> Descargando...
                                                </span>
                                            </button>
                                            <a href="https://www.win-rar.com/download.html" target="_blank"
                                                class="btn btn-outline-secondary">
                                                <i class="fas fa-download"></i> Obtener aplicación WinRAR
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div id="arrowAnimation" class="arrow-animation" style="display: none;">
                        <div class="arrow-circle">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                    </div>
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
        <script>
            const documentos = {
                menores: [
                    { nombre: "CARTA DE AUTORIZACIÓN", url: "Docs/Menores/CARTA DE AUTORIZACIÓN.docx" },
                    { nombre: "DECLARACIÓN DE ORIGINALIDAD", url: "Docs/Menores/DOCD PARA PERSONAS MENORES DE EDAD 2025.docx" },
                    { nombre: "CONSENTIMIENTO EXPRESO MENORES 2025", url: "Docs/Menores/CONSENTIMIENTO EXPRESO MENORES 2025.docx" }
                ],
                mayores: [
                    { nombre: "DECLARACIÓN DE  ORIGINALIDAD Y CESIÓN DE DERECHOS 2025", url: "Docs/Mayores/DECLARACIÓN DE ORIGINALIDAD Y CESIÓN DE DERECHOS 2025.docx" },
                    { nombre: "CONSENTIMIENTO EXPRESO PREMIO 17 OCTUBRE", url: "Docs/Mayores/CONSENTIMIENTO EXPRESO PREMIO 17 OCTUBRE.docx" }
                ],
                todas: [
                    { nombre: "CONVOCATORIA EXTENSA", url: "Docs/Todos/CONVOCATORIA EXTENSA_VF_10.06.25.pdf" },
                    { nombre: "GUÍA NORMAS APA", url: "Docs/Todos/Guía-Normas-APA-7ma-Edición.pdf" },
                    { nombre: "PLANTILLA ENSAYO 2025", url: "Docs/Todos/Plantilla Ensayo 2025 APA 7.docx" },
                    { nombre: "RÚBRICA LETRAS CON TRASCENDENCIA", url: "Docs/Todos/Rúbrica Letras con Trascendencia.pdf" },
                    { nombre: "RÚBRICA LETRAS CONTEMPORÁNEAS", url: "Docs/Todos/Rúbrica Letras Contemporáneas.pdf" },
                    { nombre: "RÚBRICA LETRAS JÓVENES", url: "Docs/Todos/Rúbrica Letras Jóvenes.pdf" }
                ]
            };

            const selectEdad = document.getElementById('download');
            const documentosContainer = document.getElementById('documentosContainer');
            const listaDocumentos = document.getElementById('listaDocumentos');
            const descargarZipBtn = document.getElementById('descargarZipBtn');
            const zipText = document.getElementById('zipText');
            const loadingIcon = document.getElementById('loadingIcon');
            const arrowAnimation = document.getElementById('arrowAnimation');

            selectEdad.addEventListener('change', function () {
                const valor = this.value;
                documentosContainer.style.display = valor ? 'block' : 'none';
                listaDocumentos.innerHTML = '';

                if (valor === 'todas') {
                    const todosDocumentos = [...documentos.todas];
                    renderDocumentos(todosDocumentos);
                } else if (valor) {
                    renderDocumentos(documentos[valor]);
                }
            });

            function renderDocumentos(documentosArray) {
                documentosArray.forEach(doc => {
                    const docElement = document.createElement('div');
                    docElement.className = 'col';
                    docElement.innerHTML = `
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-file-word text-primary mb-3" style="font-size: 3rem;"></i>
                    <h6 class="card-title">${doc.nombre}</h6>
                    <a href="${doc.url}" download class="btn btn-sm btn-outline-primary mt-2 w-100">
                        <i class="fas fa-download"></i> Descargar
                    </a>
                </div>
            </div>
        `;
                    listaDocumentos.appendChild(docElement);
                });
            }

            arrowAnimation.innerHTML = `
                                                        <div class="arrow-circle-glow">
                                                            <i class="fas fa-arrow-up"></i>
                                                        </div>
                                                    `;

            const style = document.createElement('style');
            style.innerHTML = `
                                            .arrow-animation {
                                                position: fixed;
                                                right: 145px;
                                                top: 40px;
                                                left: unset;
                                                bottom: unset;
                                                transform: none;
                                                z-index: 2000;
                                                display: none;
                                                flex-direction: column;
                                                align-items: center;
                                            }
                                            .arrow-circle-glow {
                                                width: 60px;
                                                height: 60px;
                                                background: radial-gradient(circle, #9a6ee2 60%, #fff 100%);
                                                border-radius: 50%;
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                                box-shadow: 0 0 40px 10px #9a6ee2, 0 4px 12px rgba(125, 74, 199, 0.3);
                                                margin-bottom: 0;
                                                animation: pulse-glow 2s infinite;
                                            }
                                            .arrow-circle-glow i {
                                                font-size: 36px;
                                                color: #fff;
                                                text-shadow: 0 0 12px #9a6ee2, 0 0 20px #9a6ee2;
                                                animation: arrowBounceUp 1.5s infinite;
                                            }
                                            @keyframes arrowBounceUp {
                                                0%, 20%, 50%, 80%, 100% { transform: translateY(0);}
                                                40% { transform: translateY(-32px);}
                                                60% { transform: translateY(-16px);}
                                            }
                                            @keyframes pulse-glow {
                                                0% { box-shadow: 0 0 80px 30px #9a6ee2, 0 4px 12px rgba(125, 74, 199, 0.3);}
                                                70% { box-shadow: 0 0 140px 50px #9a6ee2, 0 4px 12px rgba(125, 74, 199, 0.3);}
                                                100% { box-shadow: 0 0 80px 30px #9a6ee2, 0 4px 12px rgba(125, 74, 199, 0.3);}
                                            }
                                            @media (max-width: 576px) {
                                                .arrow-animation {
                                                    right: 10px;
                                                    top: 10px;
                                                }
                                                .arrow-circle-glow {
                                                    width: 36px;
                                                    height: 36px;
                                                }
                                                .arrow-circle-glow i {
                                                    font-size: 20px;
                                                }
                                            }
                                            `;
            document.head.appendChild(style);

            // Evento para descargar ZIP
            descargarZipBtn.addEventListener('click', function () {
                if (!selectEdad.value) return;

                zipText.style.display = 'none';
                loadingIcon.style.display = 'inline-block';

                fetch(`../controlador/documentos-zip.php?tipo=${selectEdad.value}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Error en la descarga');
                        return response.blob();
                    })
                    .then(blob => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = `documentos-${selectEdad.value}.zip`;
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                        a.remove();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al descargar el archivo ZIP');
                    })
                    .finally(() => {
                        setTimeout(() => {
                            zipText.style.display = 'inline-block';
                            loadingIcon.style.display = 'none';
                        }, 3000);
                    });
            });
        </script>
    </body>

    </html>
    <?php
}
?>