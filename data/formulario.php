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
            .navbar .nav-item.dropdown.ms-auto {
                margin-right: 20px;
            }
        </style>
    </head>

    <body>
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
                    <!-- Page Header-->
                    <div class="page-header">
                        <h1 class="page-heading text-center">Formulario de registro</h1>
                    </div>
                    <section>
                        <div class="card mb-4">
                            <!-- Progress bar -->
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
                                    action="../controlador/controlador_form.php" method="post" enctype="multipart/form-data"
                                    novalidate>
                                    <!-- Curp -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="curp">CURP <span class="required">*</span></label>
                                        <div class="input-icon">
                                            <i class="fas fa-id-card"></i>
                                            <input class="form-control" id="curp" name="curp" type="text"
                                                placeholder="Ej. RAMJ920313HDFRMR01" required minlength="18" maxlength="18"
                                                data-validacion-manual="true" onblur="validarCurp()">
                                        </div>
                                        <a href="https://www.gob.mx/curp/" target="_blank">Si no conoces tu CURP, haz clic
                                            aquí.</a>
                                        <div id="curp-feedback" class="text-danger mt-2" style="display: none;">
                                        </div>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Por favor, introduzca su CURP.</div>
                                    </div>

                                    <div id="alert-container" style="position: relative; margin-top: 20px;">
                                    </div>

                                    <div class="accordion" id="accordionExample">
                                        <!-- Datos personales -->
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
                                                            <label class="form-label" for="apellidopaterno">Primer apellido
                                                                <span class="required">*</span></label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-user-tag"></i>
                                                                <input class="form-control" id="apellidopaterno" type="text"
                                                                    placeholder="Ej. Ramirez" name="apellidopaterno"
                                                                    disabled required>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Por favor, introduzca su primer
                                                                apellido.
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="apellidomaterno">Segundo
                                                                apellido</label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-user-tag"></i>
                                                                <input class="form-control" id="apellidomaterno" type="text"
                                                                    placeholder="Ej. Pérez" name="apellidomaterno" disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Por favor, introduzca su segundo
                                                                apellido.
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="nombre">Nombre(s) <span
                                                                    class="required">*</span></label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-user"></i>
                                                                <input class="form-control" id="nombre" type="text"
                                                                    placeholder="Ej. Juan" name="nombre" disabled required>
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
                                                                    name="fechanacimiento" disabled required>
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
                                                                    name="edad" disabled required>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Por favor, introduzca su edad.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Domicilio -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingDomicilio">
                                                <button class="accordion-button fw-bold fs-5 collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseDomicilio"
                                                    aria-expanded="false" aria-controls="collapseDomicilio">
                                                    Domicilio
                                                </button>
                                            </h2>
                                            <div id="collapseDomicilio" class="accordion-collapse collapse"
                                                aria-labelledby="headingDomicilio" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="calle">Calle <span
                                                                    class="required">*</span></label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-road"></i>
                                                                <input class="form-control" id="calle" name="calle"
                                                                    type="text" placeholder="Ej. Reforma" required disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Por favor, introduzca su calle.
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label" for="numeroExterior">No. Exterior
                                                                <span class="required">*</span></label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-door-open"></i>
                                                                <input class="form-control" id="numeroExterior"
                                                                    name="numeroExterior" type="text" placeholder="Ej. 123"
                                                                    required disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Por favor, introduzca el número
                                                                exterior.</div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label" for="numeroInterior">No.
                                                                Interior</label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-door-closed"></i>
                                                                <input class="form-control" id="numeroInterior"
                                                                    name="numeroInterior" type="text" placeholder="Ej. 4B"
                                                                    disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Por favor, introduzca el número
                                                                interior.</div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="colonia">Colonia <span
                                                                    class="required">*</span></label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-city"></i>
                                                                <input class="form-control" id="colonia" name="colonia"
                                                                    type="text" placeholder="Ej. Centro" required disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Por favor, introduzca su colonia.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3">
                                                            <label class="form-label" for="cp">Código Postal <span
                                                                    class="required">*</span></label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-mail-bulk"></i>
                                                                <input class="form-control" id="cp" name="cp" type="text"
                                                                    placeholder="Ej. 42000" required minlength="5"
                                                                    maxlength="5" disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Por favor, introduzca su código
                                                                postal.</div>
                                                            <div class="invalid-feedback min-max-length">El código postal
                                                                debe tener 5 dígitos.</div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label" for="municipio">Municipio <span
                                                                    class="required">*</span></label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-map"></i>
                                                                <select class="form-control" id="municipio" name="municipio"
                                                                    required disabled>
                                                                    <option selected disabled value="">Seleccione un
                                                                        municipio</option>
                                                                    <option value="Acatlán">Acatlán</option>
                                                                    <option value="Acaxochitlán">Acaxochitlán</option>
                                                                    <option value="Actopan">Actopan</option>
                                                                    <option value="Agua Blanca de Iturbide">Agua Blanca de
                                                                        Iturbide</option>
                                                                    <option value="Ajacuba">Ajacuba</option>
                                                                    <option value="Alfajayucan">Alfajayucan</option>
                                                                    <option value="Almoloya">Almoloya</option>
                                                                    <option value="Apan">Apan</option>
                                                                    <option value="El Arenal">El Arenal</option>
                                                                    <option value="Atitalaquia">Atitalaquia</option>
                                                                    <option value="Atlapexco">Atlapexco</option>
                                                                    <option value="Atotonilco el Grande">Atotonilco el
                                                                        Grande</option>
                                                                    <option value="Atotonilco de Tula">Atotonilco de Tula
                                                                    </option>
                                                                    <option value="Calnali">Calnali</option>
                                                                    <option value="Cardonal">Cardonal</option>
                                                                    <option value="Cuautepec de Hinojosa">Cuautepec de
                                                                        Hinojosa</option>
                                                                    <option value="Chapantongo">Chapantongo</option>
                                                                    <option value="Chapulhuacán">Chapulhuacán</option>
                                                                    <option value="Chilcuautla">Chilcuautla</option>
                                                                    <option value="Eloxochitlán">Eloxochitlán</option>
                                                                    <option value="Emiliano Zapata">Emiliano Zapata</option>
                                                                    <option value="Epazoyucan">Epazoyucan</option>
                                                                    <option value="Francisco I. Madero">Francisco I. Madero
                                                                    </option>
                                                                    <option value="Huasca de Ocampo">Huasca de Ocampo
                                                                    </option>
                                                                    <option value="Huautla">Huautla</option>
                                                                    <option value="Huazalingo">Huazalingo</option>
                                                                    <option value="Huehuetla">Huehuetla</option>
                                                                    <option value="Huejutla de Reyes">Huejutla de Reyes
                                                                    </option>
                                                                    <option value="Huichapan">Huichapan</option>
                                                                    <option value="Ixmiquilpan">Ixmiquilpan</option>
                                                                    <option value="Jacala de Ledezma">Jacala de Ledezma
                                                                    </option>
                                                                    <option value="Jaltocán">Jaltocán</option>
                                                                    <option value="Juárez Hidalgo">Juárez Hidalgo</option>
                                                                    <option value="Lolotla">Lolotla</option>
                                                                    <option value="Metepec">Metepec</option>
                                                                    <option value="San Agustín Metzquititlán">San Agustín
                                                                        Metzquititlán</option>
                                                                    <option value="Metztitlán">Metztitlán</option>
                                                                    <option value="Mineral del Chico">Mineral del Chico
                                                                    </option>
                                                                    <option value="Mineral del Monte">Mineral del Monte
                                                                    </option>
                                                                    <option value="La Misión">La Misión</option>
                                                                    <option value="Mixquiahuala de Juárez">Mixquiahuala de
                                                                        Juárez</option>
                                                                    <option value="Molango de Escamilla">Molango de
                                                                        Escamilla</option>
                                                                    <option value="Nicolás Flores">Nicolás Flores</option>
                                                                    <option value="Nopala de Villagrán">Nopala de Villagrán
                                                                    </option>
                                                                    <option value="Omitlán de Juárez">Omitlán de Juárez
                                                                    </option>
                                                                    <option value="San Felipe Orizatlán">San Felipe
                                                                        Orizatlán</option>
                                                                    <option value="Pacula">Pacula</option>
                                                                    <option value="Pachuca de Soto">Pachuca de Soto</option>
                                                                    <option value="Pisaflores">Pisaflores</option>
                                                                    <option value="Progreso de Obregón">Progreso de Obregón
                                                                    </option>
                                                                    <option value="Mineral de la Reforma">Mineral de la
                                                                        Reforma</option>
                                                                    <option value="San Agustín Tlaxiaca">San Agustín
                                                                        Tlaxiaca</option>
                                                                    <option value="San Bartolo Tutotepec">San Bartolo
                                                                        Tutotepec</option>
                                                                    <option value="San Salvador">San Salvador</option>
                                                                    <option value="Santiago de Anaya">Santiago de Anaya
                                                                    </option>
                                                                    <option value="Santiago Tulantepec de Lugo Guerrero">
                                                                        Santiago Tulantepec de Lugo Guerrero</option>
                                                                    <option value="Singuilucan">Singuilucan</option>
                                                                    <option value="Tasquillo">Tasquillo</option>
                                                                    <option value="Tecozautla">Tecozautla</option>
                                                                    <option value="Tenango de Doria">Tenango de Doria
                                                                    </option>
                                                                    <option value="Tepeapulco">Tepeapulco</option>
                                                                    <option value="Tepehuacán de Guerrero">Tepehuacán de
                                                                        Guerrero</option>
                                                                    <option value="Tepeji del Río de Ocampo">Tepeji del Río
                                                                        de Ocampo</option>
                                                                    <option value="Tepetitlán">Tepetitlán</option>
                                                                    <option value="Tetepango">Tetepango</option>
                                                                    <option value="Villa de Tezontepec">Villa de Tezontepec
                                                                    </option>
                                                                    <option value="Tezontepec de Aldama">Tezontepec de
                                                                        Aldama</option>
                                                                    <option value="Tianguistengo">Tianguistengo</option>
                                                                    <option value="Tizayuca">Tizayuca</option>
                                                                    <option value="Tlahuelilpan">Tlahuelilpan</option>
                                                                    <option value="Tlahuiltepa">Tlahuiltepa</option>
                                                                    <option value="Tlanalapa">Tlanalapa</option>
                                                                    <option value="Tlanchinol">Tlanchinol</option>
                                                                    <option value="Tlaxcoapan">Tlaxcoapan</option>
                                                                    <option value="Tolcayuca">Tolcayuca</option>
                                                                    <option value="Tula de Allende">Tula de Allende</option>
                                                                    <option value="Tulancingo de Bravo">Tulancingo de Bravo
                                                                    </option>
                                                                    <option value="Xochiatipan">Xochiatipan</option>
                                                                    <option value="Xochicoatlán">Xochicoatlán</option>
                                                                    <option value="Yahualica">Yahualica</option>
                                                                    <option value="Zacualtipán de Ángeles">Zacualtipán de
                                                                        Ángeles</option>
                                                                    <option value="Zapotlán de Juárez">Zapotlán de Juárez
                                                                    </option>
                                                                    <option value="Zempoala">Zempoala</option>
                                                                    <option value="Zimapán">Zimapán</option>
                                                                </select>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Por favor, seleccione un
                                                                municipio.</div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label" for="localidad">Localidad <span
                                                                    class="required">*</span></label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-map-pin"></i>
                                                                <input class="form-control" id="localidad" name="localidad"
                                                                    type="text" placeholder="Ej. Pachuca de Soto" required
                                                                    disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Por favor, introduzca su
                                                                localidad.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Estudios Section -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingEstudios">
                                                <button class="accordion-button fw-bold fs-5 collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseEstudios"
                                                    aria-expanded="false" aria-controls="collapseEstudios">
                                                    Estudios concluidos y ocupación actual
                                                </button>
                                            </h2>
                                            <div id="collapseEstudios" class="accordion-collapse collapse"
                                                aria-labelledby="headingEstudios" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mb-3">
                                                        <!-- Último grado de estudios -->
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="gradoEstudios">¿Último grado de
                                                                estudios que concluyó?
                                                                <span class="required">*</span></label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-graduation-cap"></i>
                                                                <select class="form-control" id="gradoEstudios"
                                                                    name="gradoEstudios" required disabled>
                                                                    <option value="">Seleccione una opción</option>
                                                                    <option value="Secundaria">Secundaria</option>
                                                                    <option value="Bachillerato">Bachillerato</option>
                                                                    <option value="Licenciatura">Licenciatura</option>
                                                                    <option value="Maestría">Maestría</option>
                                                                    <option value="Doctorado">Doctorado</option>
                                                                </select>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Por favor, seleccione un grado de estudios.
                                                            </div>
                                                        </div>

                                                        <!-- Ocupación actual -->
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="ocupacionActual">¿Cuál es su
                                                                ocupación actual?
                                                                <span class="required">*</span></label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-briefcase"></i>
                                                                <input class="form-control" id="ocupacionActual"
                                                                    name="ocupacionActual" type="text"
                                                                    placeholder="Ej. Profesor" required disabled />
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Por favor, introduzca su ocupación actual.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Estudios que cursa actualmente y/o cargo que desempeña -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingEstudiosActuales">
                                                <button class="accordion-button fw-bold fs-5 collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseEstudiosActuales"
                                                    aria-expanded="false" aria-controls="collapseEstudiosActuales">
                                                    Estudios que cursa actualmente y/o cargo que desempeña
                                                </button>
                                            </h2>
                                            <div id="collapseEstudiosActuales" class="accordion-collapse collapse"
                                                aria-labelledby="headingEstudiosActuales"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mb-3">
                                                        <!-- Grado Actual -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="gradoActual">Grado</label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-layer-group"></i>
                                                                <input class="form-control" id="gradoActual"
                                                                    name="gradoActual" type="text"
                                                                    placeholder="Ej. Tercer semestre" disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Campo no válido.</div>
                                                        </div>

                                                        <!-- Estudios Actuales -->
                                                        <div class="col-md-4">
                                                            <label class="form-label"
                                                                for="estudiosActuales">Estudios</label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-book"></i>
                                                                <input class="form-control" id="estudiosActuales"
                                                                    name="estudiosActuales" type="text"
                                                                    placeholder="Ej. Derecho" disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Campo no válido.</div>
                                                        </div>

                                                        <!-- Cargo Actual -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="cargoActual">Cargo</label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-user-tie"></i>
                                                                <input class="form-control" id="cargoActual"
                                                                    name="cargoActual" type="text"
                                                                    placeholder="Ej. Asistente administrativo" disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Campo no válido.</div>
                                                        </div>
                                                    </div>

                                                    <!-- Centro de Estudios o Lugar de Trabajo -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="centroEstudiosTrabajo">
                                                                Nombre del centro de estudios y/o lugar de trabajo <span
                                                                    class="required">*</span>
                                                            </label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-school"></i>
                                                                <input class="form-control" id="centroEstudiosTrabajo"
                                                                    name="centroEstudiosTrabajo" type="text"
                                                                    placeholder="Ej. Universidad Autónoma de Hidalgo"
                                                                    required disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Por favor, introduzca Nombre del centro de estudios y/o
                                                                lugar de trabajo.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Datos de contacto -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingDatosContacto">
                                                <button class="accordion-button fw-bold fs-5 collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseDatosContacto"
                                                    aria-expanded="false" aria-controls="collapseDatosContacto">
                                                    Datos de contacto
                                                </button>
                                            </h2>
                                            <div id="collapseDatosContacto" class="accordion-collapse collapse"
                                                aria-labelledby="headingDatosContacto" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mb-3">
                                                        <!-- Correo Electrónico -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="correo">
                                                                Correo electrónico <span class="required">*</span>
                                                            </label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-envelope"></i>
                                                                <input class="form-control" id="correo" name="correo"
                                                                    type="email" placeholder="Ej. ejemplo@correo.com"
                                                                    required disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Por favor, introduzca un correo válido.
                                                            </div>
                                                        </div>

                                                        <!-- Número Fijo -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="numerofijo">Número fijo</label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-phone"></i>
                                                                <input class="form-control" id="numerofijo"
                                                                    name="numerofijo" type="text"
                                                                    placeholder="Ej. XXXXXXXXXX" minlength="10"
                                                                    maxlength="10" disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Por favor, introduzca un número válido.
                                                            </div>
                                                        </div>

                                                        <!-- Confirmar Número Fijo -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="confirmarnumerofijo">Confirmar
                                                                número fijo</label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-phone-volume"></i>
                                                                <input class="form-control" id="confirmarnumerofijo"
                                                                    name="confirmarnumerofijo" type="text"
                                                                    placeholder="Confirme su número fijo" minlength="10"
                                                                    maxlength="10" disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Los números fijos no coinciden.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <!-- Número Móvil -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="numeromovil">
                                                                Número móvil <span class="required">*</span>
                                                            </label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-mobile-alt"></i>
                                                                <input class="form-control" id="numeromovil"
                                                                    name="numeromovil" type="text"
                                                                    placeholder="Ej. XXXXXXXXXX" required minlength="10"
                                                                    maxlength="10" disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Por favor, introduzca su número móvil.
                                                            </div>
                                                        </div>

                                                        <!-- Confirmar Número Móvil -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="confirmarnumeromovil">
                                                                Confirmar número móvil <span class="required">*</span>
                                                            </label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-check-circle"></i>
                                                                <input class="form-control" id="confirmarnumeromovil"
                                                                    name="confirmarnumeromovil" type="text"
                                                                    placeholder="Confirme su número móvil" required
                                                                    minlength="10" maxlength="10" disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Los números móviles no coinciden.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Redes Sociales -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingRedesSociales">
                                                <button class="accordion-button fw-bold fs-5 collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseRedesSociales"
                                                    aria-expanded="false" aria-controls="collapseRedesSociales">
                                                    Redes sociales
                                                </button>
                                            </h2>
                                            <div id="collapseRedesSociales" class="accordion-collapse collapse"
                                                aria-labelledby="headingRedesSociales" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mb-3">
                                                        <!-- Facebook -->
                                                        <div class="col-md-3">
                                                            <label class="form-label" for="facebook">Facebook</label>
                                                            <div class="input-icon">
                                                                <i class="fab fa-facebook-f"></i>
                                                                <input class="form-control" id="facebook" name="facebook"
                                                                    type="text" placeholder="Ej. facebook.com/tuusuario"
                                                                    disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                        </div>

                                                        <!-- TikTok -->
                                                        <div class="col-md-3">
                                                            <label class="form-label" for="tiktok">TikTok</label>
                                                            <div class="input-icon">
                                                                <i class="fab fa-tiktok"></i>
                                                                <input class="form-control" id="tiktok" name="tiktok"
                                                                    type="text" placeholder="Ej. tiktok.com/@tuusuario"
                                                                    disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                        </div>

                                                        <!-- Instagram -->
                                                        <div class="col-md-3">
                                                            <label class="form-label" for="instagram">Instagram</label>
                                                            <div class="input-icon">
                                                                <i class="fab fa-instagram"></i>
                                                                <input class="form-control" id="instagram" name="instagram"
                                                                    type="text" placeholder="Ej. instagram.com/tuusuario"
                                                                    disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                        </div>

                                                        <!-- Otra red social -->
                                                        <div class="col-md-3">
                                                            <label class="form-label" for="otra">Otra</label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-globe"></i>
                                                                <input class="form-control" id="otra" name="otraRedSocial"
                                                                    type="text" placeholder="Otra red social o enlace"
                                                                    disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Ensayo -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingEnsayo">
                                                <button class="accordion-button fw-bold fs-5 collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseEnsayo"
                                                    aria-expanded="false" aria-controls="collapseEnsayo">
                                                    Ensayo
                                                </button>
                                            </h2>
                                            <div id="collapseEnsayo" class="accordion-collapse collapse"
                                                aria-labelledby="headingEnsayo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mb-3">
                                                        <!-- Seudónimo -->
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="seudonimo">
                                                                Seudónimo con el que se identificará durante el desarrollo
                                                                de este concurso:
                                                                <span class="required">*</span>
                                                            </label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-user-secret"></i>
                                                                <input class="form-control" id="seudonimo" name="seudonimo"
                                                                    type="text" placeholder="Ej. PlumaLibre" required
                                                                    disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Por favor, introduzca su seudónimo.
                                                            </div>
                                                        </div>

                                                        <!-- Título del Ensayo -->
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="titulo_ensayo">
                                                                Título del Ensayo <span class="required">*</span>
                                                            </label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-pen-nib"></i>
                                                                <input class="form-control" id="titulo_ensayo"
                                                                    name="titulo_ensayo" type="text"
                                                                    placeholder="Título de tu ensayo" required disabled>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Por favor, introduzca el título del ensayo.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <!-- Categoría -->
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="categoria">
                                                                Categoría en la que concursas <span
                                                                    class="required">*</span>
                                                            </label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-list"></i>
                                                                <select class="form-control" id="categoria" name="categoria"
                                                                    required disabled>
                                                                    <option value="" disabled selected>Seleccione una
                                                                        categoría</option>
                                                                    <option value="Letras jóvenes">Letras jóvenes (15-19
                                                                        años)</option>
                                                                    <option value="Letras contemporáneas">Letras
                                                                        contemporáneas (20-29 años)</option>
                                                                    <option value="Letras trascendencia">Letras
                                                                        trascendencia (30 años en adelante)</option>
                                                                </select>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Por favor, seleccione una categoría.
                                                            </div>
                                                        </div>

                                                        <!-- Archivo del Ensayo -->
                                                        <div class="col-md-6 mb-3" id="grupo_archivo_ensayo">
                                                            <label class="form-label" for="archivo_ensayo">
                                                                Cargue su ensayo en formato PDF <span
                                                                    class="required">*</span>
                                                                <small class="text-muted">(Formato PDF, máximo 3MB)</small>
                                                            </label>
                                                            <div
                                                                class="input-group file-input-group mb-2 input-file-section">
                                                                <input class="form-control" type="file" id="archivo_ensayo"
                                                                    name="archivo_ensayo" accept=".pdf" required disabled>
                                                                <div class="invalid-feedback d-none">Por favor, cargue su
                                                                    ensayo.</div>
                                                                <div class="valid-feedback d-none">Archivo listo.</div>
                                                            </div>
                                                            <div class="archivo-cargado-section" style="display:none;">
                                                                <div class="alert alert-success text-center"
                                                                    style="padding: 0.25rem 1rem; font-size: 0.9rem;">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <strong>Éxito:</strong>
                                                                    Ya cargó tu ensayo.
                                                                </div>
                                                                <div class="mb-2 d-flex justify-content-center">
                                                                    <a href="#" target="_blank"
                                                                        class="btn btn-outline-primary btn-view-file me-2">
                                                                        Ver ensayo cargado
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn btn-outline-danger btn-reload-file">
                                                                        Volver a cargar ensayo
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Carga de documentos: Participantes mayores de edad -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingDocumentosAdultos">
                                                <button class="accordion-button fw-bold fs-5 collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseDocumentosAdultos"
                                                    aria-expanded="false" aria-controls="collapseDocumentosAdultos">
                                                    Carga de documentos: Participantes mayores de edad
                                                </button>
                                            </h2>
                                            <div id="collapseDocumentosAdultos" class="accordion-collapse collapse"
                                                aria-labelledby="headingDocumentosAdultos"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mb-3">
                                                        <!-- Credencial para Votar -->
                                                        <div class="col-md-6 mb-3" id="grupo_credencial_votar">
                                                            <label class="form-label" for="credencial_votar">
                                                                Credencial para votar (INE/IFE) <span
                                                                    class="required">*</span>
                                                                <small class="text-muted">(Formato PDF, máximo 3MB)</small>
                                                            </label>
                                                            <div
                                                                class="input-group file-input-group mb-2 input-file-section">
                                                                <input class="form-control" type="file"
                                                                    id="credencial_votar" name="credencial_votar"
                                                                    accept=".pdf" required>
                                                                <div class="invalid-feedback d-none">Debe subir el PDF de
                                                                    su credencial para votar.</div>
                                                                <div class="valid-feedback d-none">Archivo listo.</div>
                                                            </div>
                                                            <div class="archivo-cargado-section" style="display:none;">
                                                                <div class="alert alert-success text-center"
                                                                    style="padding: 0.25rem 1rem; font-size: 0.9rem;">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <strong>Éxito:</strong>
                                                                    Ya cargó un archivo para este campo.
                                                                </div>
                                                                <div class="mb-2 d-flex justify-content-center">
                                                                    <a href="#" target="_blank"
                                                                        class="btn btn-outline-primary btn-view-file me-2">
                                                                        Ver archivo cargado
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn btn-outline-danger btn-reload-file">
                                                                        Volver a cargar archivo
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Declaración de Originalidad -->
                                                        <div class="col-md-6 mb-3" id="grupo_declaracion_originalidad">
                                                            <label class="form-label" for="declaracion_originalidad">
                                                                Declaración de originalidad <span class="required">*</span>
                                                                <small class="text-muted">(Formato PDF, máximo 3MB)</small>
                                                            </label>
                                                            <div
                                                                class="input-group file-input-group mb-2 input-file-section">
                                                                <input class="form-control" type="file"
                                                                    id="declaracion_originalidad"
                                                                    name="declaracion_originalidad" accept=".pdf" required>
                                                                <div class="invalid-feedback d-none">Debe subir el PDF de
                                                                    su declaración de originalidad.</div>
                                                                <div class="valid-feedback d-none">Archivo listo.</div>
                                                            </div>
                                                            <div class="archivo-cargado-section" style="display:none;">
                                                                <div class="alert alert-success text-center"
                                                                    style="padding: 0.25rem 1rem; font-size: 0.9rem;">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <strong>Éxito:</strong>
                                                                    Ya cargó un archivo para este campo.
                                                                </div>
                                                                <div class="mb-2 d-flex justify-content-center">
                                                                    <a href="#" target="_blank"
                                                                        class="btn btn-outline-primary btn-view-file me-2">
                                                                        Ver archivo cargado
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn btn-outline-danger btn-reload-file">
                                                                        Volver a cargar archivo
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Consentimiento Expreso (Adultos) -->
                                                        <div class="col-md-6 mb-3"
                                                            id="grupo_consentimiento_expreso_adultos">
                                                            <label class="form-label" for="consentimiento_expreso_adultos">
                                                                Consentimiento expreso <span class="required">*</span>
                                                                <small class="text-muted">(Formato PDF, máximo 3MB)</small>
                                                            </label>
                                                            <div
                                                                class="input-group file-input-group mb-2 input-file-section">
                                                                <input class="form-control" type="file"
                                                                    id="consentimiento_expreso_adultos"
                                                                    name="consentimiento_expreso_adultos" accept=".pdf"
                                                                    required>
                                                                <div class="invalid-feedback d-none">Debe subir el PDF de
                                                                    consentimiento expreso.</div>
                                                                <div class="valid-feedback d-none">Archivo listo.</div>
                                                            </div>
                                                            <div class="archivo-cargado-section" style="display:none;">
                                                                <div class="alert alert-success text-center"
                                                                    style="padding: 0.25rem 1rem; font-size: 0.9rem;">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <strong>Éxito:</strong>
                                                                    Ya cargó un archivo para este campo.
                                                                </div>
                                                                <div class="mb-2 d-flex justify-content-center">
                                                                    <a href="#" target="_blank"
                                                                        class="btn btn-outline-primary btn-view-file me-2">
                                                                        Ver archivo cargado
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn btn-outline-danger btn-reload-file">
                                                                        Volver a cargar archivo
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Mensaje importante -->
                                                    <div class="alert alert-primary">
                                                        <i class="fas fa-info-circle"></i> <strong>Importante:</strong>
                                                        Todos los documentos deben estar en <strong>formato PDF</strong>,
                                                        ser legibles y no exceder 3MB.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Carga de documentos: Participantes menores de edad -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingDocumentosMenores">
                                                <button class="accordion-button fw-bold fs-5 collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseDocumentosMenores"
                                                    aria-expanded="false" aria-controls="collapseDocumentosMenores">
                                                    Carga de documentos: Participantes menores de edad
                                                </button>
                                            </h2>
                                            <div id="collapseDocumentosMenores" class="accordion-collapse collapse"
                                                aria-labelledby="headingDocumentosMenores"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mb-3">
                                                        <!-- Identificación con fotografía (ahora solo PDF) -->
                                                        <div class="col-md-6 mb-3" id="grupo_identificacion_fotografia">
                                                            <label class="form-label" for="identificacion_fotografia">
                                                                Identificación con fotografía (credencial de estudiante
                                                                vigente u otra): <span class="required">*</span>
                                                                <small class="text-muted">(Formato PDF, máximo 3MB)</small>
                                                            </label>
                                                            <div
                                                                class="input-group file-input-group mb-2 input-file-section">
                                                                <input class="form-control" type="file"
                                                                    id="identificacion_fotografia"
                                                                    name="identificacion_fotografia" accept=".pdf" required>
                                                                <div class="invalid-feedback d-none">Debe subir una
                                                                    identificación con fotografía en pdf.</div>
                                                                <div class="valid-feedback d-none">Archivo listo.</div>
                                                            </div>
                                                            <div class="archivo-cargado-section" style="display:none;">
                                                                <div class="alert alert-success text-center"
                                                                    style="padding: 0.25rem 1rem; font-size: 0.9rem;">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <strong>Éxito:</strong> Ya cargó un archivo para este
                                                                    campo.
                                                                </div>
                                                                <div class="mb-2 d-flex justify-content-center">
                                                                    <a href="#" target="_blank"
                                                                        class="btn btn-outline-primary btn-view-file me-2">
                                                                        Ver archivo cargado
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn btn-outline-danger btn-reload-file">
                                                                        Volver a cargar archivo
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Carta de Autorización (solo PDF) -->
                                                        <div class="col-md-6 mb-3" id="grupo_carta_autorizacion">
                                                            <label class="form-label" for="carta_autorizacion">
                                                                Carta de Autorización, debidamente requisitada y firmada:
                                                                <span class="required">*</span>
                                                                <small class="text-muted">(Formato PDF, máximo 3MB)</small>
                                                            </label>
                                                            <div
                                                                class="input-group file-input-group mb-2 input-file-section">
                                                                <input class="form-control" type="file"
                                                                    id="carta_autorizacion" name="carta_autorizacion"
                                                                    accept=".pdf" required>
                                                                <div class="invalid-feedback d-none">Debe subir la carta de
                                                                    autorización en PDF.</div>
                                                                <div class="valid-feedback d-none">Archivo listo.</div>
                                                            </div>
                                                            <div class="archivo-cargado-section" style="display:none;">
                                                                <div class="alert alert-success text-center"
                                                                    style="padding: 0.25rem 1rem; font-size: 0.9rem;">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <strong>Éxito:</strong> Ya cargó un archivo para este
                                                                    campo.
                                                                </div>
                                                                <div class="mb-2 d-flex justify-content-center">
                                                                    <a href="#" target="_blank"
                                                                        class="btn btn-outline-primary btn-view-file me-2">
                                                                        Ver archivo cargado
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn btn-outline-danger btn-reload-file">
                                                                        Volver a cargar archivo
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <!-- Declaración de Originalidad y Cesión de Derechos (solo PDF) -->
                                                        <div class="col-md-6 mb-3"
                                                            id="grupo_declaracion_originalidad_menores">
                                                            <label class="form-label"
                                                                for="declaracion_originalidad_menores">
                                                                Carta de Declaración de Originalidad y Cesión de Derechos:
                                                                <span class="required">*</span>
                                                                <small class="text-muted">(Formato PDF, máximo 3MB)</small>
                                                            </label>
                                                            <div
                                                                class="input-group file-input-group mb-2 input-file-section">
                                                                <input class="form-control" type="file"
                                                                    id="declaracion_originalidad_menores"
                                                                    name="declaracion_originalidad_menores" accept=".pdf"
                                                                    required>
                                                                <div class="invalid-feedback d-none">Debe subir este
                                                                    documento en PDF.</div>
                                                                <div class="valid-feedback d-none">Archivo listo.</div>
                                                            </div>
                                                            <div class="archivo-cargado-section" style="display:none;">
                                                                <div class="alert alert-success text-center"
                                                                    style="padding: 0.25rem 1rem; font-size: 0.9rem;">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <strong>Éxito:</strong> Ya cargó un archivo para este
                                                                    campo.
                                                                </div>
                                                                <div class="mb-2 d-flex justify-content-center">
                                                                    <a href="#" target="_blank"
                                                                        class="btn btn-outline-primary btn-view-file me-2">
                                                                        Ver archivo cargado
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn btn-outline-danger btn-reload-file">
                                                                        Volver a cargar archivo
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Comprobante de Domicilio del Tutor (solo PDF) -->
                                                        <div class="col-md-6 mb-3" id="grupo_comprobante_domicilio_tutor">
                                                            <label class="form-label" for="comprobante_domicilio_tutor">
                                                                Comprobante de Domicilio (Vigente) del Tutor: <span
                                                                    class="required">*</span>
                                                                <small class="text-muted">(Formato PDF, máximo 3MB)</small>
                                                            </label>
                                                            <div
                                                                class="input-group file-input-group mb-2 input-file-section">
                                                                <input class="form-control" type="file"
                                                                    id="comprobante_domicilio_tutor"
                                                                    name="comprobante_domicilio_tutor" accept=".pdf"
                                                                    required>
                                                                <div class="invalid-feedback d-none">Debe subir un
                                                                    comprobante en PDF.</div>
                                                                <div class="valid-feedback d-none">Archivo listo.</div>
                                                            </div>
                                                            <div class="archivo-cargado-section" style="display:none;">
                                                                <div class="alert alert-success text-center"
                                                                    style="padding: 0.25rem 1rem; font-size: 0.9rem;">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <strong>Éxito:</strong> Ya cargó un archivo para este
                                                                    campo.
                                                                </div>
                                                                <div class="mb-2 d-flex justify-content-center">
                                                                    <a href="#" target="_blank"
                                                                        class="btn btn-outline-primary btn-view-file me-2">
                                                                        Ver archivo cargado
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn btn-outline-danger btn-reload-file">
                                                                        Volver a cargar archivo
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <!-- Consentimiento Expreso (Menores, solo PDF) -->
                                                        <div class="col-md-6 mb-3"
                                                            id="grupo_consentimiento_expreso_menores">
                                                            <label class="form-label" for="consentimiento_expreso_menores">
                                                                Formato para Otorgar Consentimiento Expreso: <span
                                                                    class="required">*</span>
                                                                <small class="text-muted">(Formato PDF, máximo 3MB)</small>
                                                            </label>
                                                            <div
                                                                class="input-group file-input-group mb-2 input-file-section">
                                                                <input class="form-control" type="file"
                                                                    id="consentimiento_expreso_menores"
                                                                    name="consentimiento_expreso_menores" accept=".pdf"
                                                                    required>
                                                                <div class="invalid-feedback d-none">Debe subir este
                                                                    documento en PDF.</div>
                                                                <div class="valid-feedback d-none">Archivo listo.</div>
                                                            </div>
                                                            <div class="archivo-cargado-section" style="display:none;">
                                                                <div class="alert alert-success text-center"
                                                                    style="padding: 0.25rem 1rem; font-size: 0.9rem;">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <strong>Éxito:</strong> Ya cargó un archivo para este
                                                                    campo.
                                                                </div>
                                                                <div class="mb-2 d-flex justify-content-center">
                                                                    <a href="#" target="_blank"
                                                                        class="btn btn-outline-primary btn-view-file me-2">
                                                                        Ver archivo cargado
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn btn-outline-danger btn-reload-file">
                                                                        Volver a cargar archivo
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- INE del Tutor (solo PDF) -->
                                                        <div class="col-md-6 mb-3" id="grupo_ine_tutor">
                                                            <label class="form-label" for="ine_tutor">
                                                                INE del Tutor: <span class="required">*</span>
                                                                <small class="text-muted">(Formato PDF, máximo 3MB)</small>
                                                            </label>
                                                            <div
                                                                class="input-group file-input-group mb-2 input-file-section">
                                                                <input class="form-control" type="file" id="ine_tutor"
                                                                    name="ine_tutor" accept=".pdf" required>
                                                                <div class="invalid-feedback d-none">Debe subir una
                                                                    identificación en PDF.</div>
                                                                <div class="valid-feedback d-none">Archivo listo.</div>
                                                            </div>
                                                            <div class="archivo-cargado-section" style="display:none;">
                                                                <div class="alert alert-success text-center"
                                                                    style="padding: 0.25rem 1rem; font-size: 0.9rem;">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <strong>Éxito:</strong> Ya cargó un archivo para este
                                                                    campo.
                                                                </div>
                                                                <div class="mb-2 d-flex justify-content-center">
                                                                    <a href="#" target="_blank"
                                                                        class="btn btn-outline-primary btn-view-file me-2">
                                                                        Ver archivo cargado
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn btn-outline-danger btn-reload-file">
                                                                        Volver a cargar archivo
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="alert alert-primary">
                                                        <i class="fas fa-info-circle"></i> <strong>Importante:</strong>
                                                        Todos los documentos deben estar en <strong>formato PDF</strong>,
                                                        ser legibles y no exceder 3MB.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Acciones afirmativas -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingAccionesAfirmativas">
                                                <button class="accordion-button fw-bold fs-5 collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseAccionesAfirmativas"
                                                    aria-expanded="false" aria-controls="collapseAccionesAfirmativas">
                                                    Grupos de atencion prioritaria
                                                </button>
                                            </h2>
                                            <div id="collapseAccionesAfirmativas" class="accordion-collapse collapse"
                                                aria-labelledby="headingAccionesAfirmativas"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mb-3">
                                                        <!-- Persona con discapacidad -->
                                                        <div class="col-md-4">
                                                            <label class="form-label d-block">¿Es una persona con
                                                                discapacidad?
                                                                <span class="required">*</span></label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="discapacidad" id="discapacidad_si" value="sí"
                                                                    required disabled />
                                                                <label class="form-check-label"
                                                                    for="discapacidad_si">Sí</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="discapacidad" id="discapacidad_no" value="no"
                                                                    required disabled />
                                                                <label class="form-check-label"
                                                                    for="discapacidad_no">No</label>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Este campo es obligatorio.
                                                            </div>
                                                        </div>

                                                        <!-- ¿Cuál es la discapacidad? -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="discapacidad_cual">¿Cuál?</label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-wheelchair"></i>
                                                                <input type="text" class="form-control"
                                                                    id="discapacidad_cual" name="discapacidad_cual" required
                                                                    disabled />
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Este campo es obligatorio.
                                                            </div>
                                                        </div>

                                                        <!-- Tipo de discapacidad -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="tipo_discapacidad">¿De qué tipo
                                                                es?</label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-universal-access"></i>
                                                                <select class="form-control" id="tipo_discapacidad"
                                                                    name="tipo_discapacidad" required disabled>
                                                                    <option value="" disabled selected>
                                                                        Seleccione una opción
                                                                    </option>
                                                                    <option value="Física o motora">
                                                                        Física o motora
                                                                    </option>
                                                                    <option value="Sensorial">Sensorial</option>
                                                                    <option value="Intelectual">
                                                                        Intelectual
                                                                    </option>
                                                                    <option value="Mental">Mental</option>
                                                                </select>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Este campo es obligatorio.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <!-- Habla lengua indígena -->
                                                        <div class="col-md-4">
                                                            <label class="form-label d-block">¿Habla alguna lengua indígena?
                                                                <span class="required">*</span></label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="lengua_indigena" id="lengua_si" value="sí"
                                                                    required disabled />
                                                                <label class="form-check-label" for="lengua_si">Sí</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="lengua_indigena" id="lengua_no" value="no"
                                                                    required disabled />
                                                                <label class="form-check-label" for="lengua_no">No</label>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Este campo es obligatorio.
                                                            </div>
                                                        </div>

                                                        <!-- ¿Cuál es la lengua? -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="lengua_cual">¿Cuál?</label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-language"></i>
                                                                <input type="text" class="form-control" id="lengua_cual"
                                                                    name="lengua_cual" required disabled />
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Este campo es obligatorio.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <!-- Auto adscripción indígena -->
                                                        <div class="col-md-4">
                                                            <label class="form-label d-block">¿Se auto adscribe como
                                                                indígena?
                                                                <span class="required">*</span></label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="auto_indigena" id="auto_indigena_si" value="sí"
                                                                    required disabled />
                                                                <label class="form-check-label"
                                                                    for="auto_indigena_si">Sí</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="auto_indigena" id="auto_indigena_no" value="no"
                                                                    required disabled />
                                                                <label class="form-check-label"
                                                                    for="auto_indigena_no">No</label>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Este campo es obligatorio.
                                                            </div>
                                                        </div>

                                                        <!-- Comunidad indígena -->
                                                        <div class="col-md-4">
                                                            <label class="form-label d-block">¿Forma parte de una comunidad
                                                                indígena?
                                                                <span class="required">*</span></label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="comunidad_indigena" id="comunidad_si" value="sí"
                                                                    required disabled />
                                                                <label class="form-check-label"
                                                                    for="comunidad_si">Sí</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="comunidad_indigena" id="comunidad_no" value="no"
                                                                    required disabled />
                                                                <label class="form-check-label"
                                                                    for="comunidad_no">No</label>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Este campo es obligatorio.
                                                            </div>
                                                        </div>

                                                        <!-- ¿Cuál es la comunidad? -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="comunidad_cual">¿Cuál?</label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-users"></i>
                                                                <input type="text" class="form-control" id="comunidad_cual"
                                                                    name="comunidad_cual" required disabled />
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Este campo es obligatorio.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <!-- Diversidad sexual y de género -->
                                                        <div class="col-md-4">
                                                            <label class="form-label d-block">¿Se autoadscribe como persona
                                                                de la diversidad
                                                                sexual y de género?
                                                                <span class="required">*</span></label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="diversidad" id="diversidad_si" value="sí" required
                                                                    disabled />
                                                                <label class="form-check-label"
                                                                    for="diversidad_si">Sí</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="diversidad" id="diversidad_no" value="no" required
                                                                    disabled />
                                                                <label class="form-check-label"
                                                                    for="diversidad_no">No</label>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Este campo es obligatorio.
                                                            </div>
                                                        </div>

                                                        <!-- ¿Cuál es la diversidad? -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="diversidad_cual">¿Cuál?</label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-rainbow"></i>
                                                                <input type="text" class="form-control" id="diversidad_cual"
                                                                    name="diversidad_cual" required disabled />
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Este campo es obligatorio.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <!-- Medio convocatoria -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="medio_convocatoria">¿Cómo se
                                                                enteró de la convocatoria?
                                                                <span class="required">*</span></label>
                                                            <div class="input-icon">
                                                                <i class="fas fa-bullhorn"></i>
                                                                <select class="form-control" id="medio_convocatoria"
                                                                    name="medio_convocatoria" required disabled>
                                                                    <option value="" disabled selected>
                                                                        Seleccione una opción
                                                                    </option>
                                                                    <option value="Página web">Página web</option>
                                                                    <option value="RRSS">RRSS</option>
                                                                    <option value="Cartel">Cartel</option>
                                                                    <option value="Platica informativa">
                                                                        Plática informativa
                                                                    </option>
                                                                    <option value="Publicacion">
                                                                        Publicación
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">
                                                                Este campo es obligatorio.
                                                            </div>
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
                                                                    disabled required>
                                                                <label class="form-check-label" for="terminos_privacidad">
                                                                    He leído y comprendo los términos del
                                                                    <a href="Docs/Todos/API 2025.pdf" target="_blank">
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
                                                                    name="terminos_consentimiento" disabled required>
                                                                <label class="form-check-label"
                                                                    for="terminos_consentimiento">
                                                                    He leído y comprendo los términos de
                                                                    <a href="Docs/Todos/APS 2025.pdf" target="_blank">
                                                                        Aviso de Privacidad Simplificado
                                                                    </a>.
                                                                </label>
                                                            </div>
                                                            <div class="valid-feedback">Muy bien!</div>
                                                            <div class="invalid-feedback">Debe aceptar los términos del
                                                                Aviso de Privacidad Simplificado.</div>
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
        <!-- FUNCIONES INPUT FILE -->
        <script>
            function getArchivoUrl(archivoRuta) {
                archivoRuta = archivoRuta.replace(/^data\//, '');
                if (!archivoRuta.startsWith('/')) archivoRuta = '/' + archivoRuta;
                return '/17deoctubre' + archivoRuta;
            }

            function inicializarCamposArchivos(archivos) {
                const campos = [
                    'credencial_votar',
                    'declaracion_originalidad',
                    'consentimiento_expreso_adultos',
                    'identificacion_fotografia',
                    'carta_autorizacion',
                    'declaracion_originalidad_menores',
                    'comprobante_domicilio_tutor',
                    'consentimiento_expreso_menores',
                    'ine_tutor'
                ];
                campos.forEach(fieldId => {
                    const $grupo = $('#grupo_' + fieldId);
                    const $inputFile = $grupo.find('input[type="file"]');
                    const $fileSection = $grupo.find('.input-file-section');
                    const $archivoCargadoSection = $grupo.find('.archivo-cargado-section');
                    const $btnView = $grupo.find('.btn-view-file');
                    const $btnReload = $grupo.find('.btn-reload-file');
                    const archivoRuta = archivos[fieldId];

                    if (archivoRuta && archivoRuta.trim() !== '') {
                        $fileSection.hide();
                        $archivoCargadoSection.show();
                        $btnView.attr('href', getArchivoUrl(archivoRuta));
                    } else {
                        $fileSection.show();
                        $archivoCargadoSection.hide();
                        $inputFile.val('');
                    }

                    $btnReload.off('click').on('click', function () {
                        Swal.fire({
                            title: '¿Volver a cargar archivo?',
                            text: 'Esto eliminará el archivo actual y te permitirá seleccionar uno nuevo. ¿Estás seguro?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Sí, volver a cargar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $archivoCargadoSection.hide();
                                $fileSection.show();
                                $inputFile.val('');
                            }
                        });
                    });
                });
            }
        </script>
        <!-- Progress bar -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const form = document.querySelector("#formRegistro");
                const progressBar = document.querySelector(".progress-bar");
                const requiredFields = form.querySelectorAll(
                    "input[required], select[required], textarea[required]"
                );

                const fileFieldIds = [
                    'credencial_votar',
                    'declaracion_originalidad',
                    'consentimiento_expreso_adultos'
                ];

                let archivosCargados = window.archivosCargados || {
                    credencial_votar: '',
                    declaracion_originalidad: '',
                    consentimiento_expreso_adultos: ''
                };

                function archivoYaCargado(fieldId) {
                    return archivosCargados[fieldId] && archivosCargados[fieldId].trim() !== '';
                }

                const totalRequired = () => {
                    return requiredFields.length;
                };

                function actualizarProgreso() {
                    // Campos generales siempre visibles y requeridos
                    const generales = [
                        '#curp',
                        '#nombre',
                        '#apellidopaterno',
                        '#fechanacimiento',
                        '#edad',
                        '#calle',
                        '#numeroExterior',
                        '#colonia',
                        '#cp',
                        '#municipio',
                        '#localidad',
                        '#gradoEstudios',
                        '#ocupacionActual',
                        '#centroEstudiosTrabajo',
                        '#correo',
                        '#numeromovil',
                        '#seudonimo',
                        '#titulo_ensayo',
                        '#categoria',
                        '#archivo_ensayo',
                        '#confirmarnumeromovil',
                        '#terminos_privacidad',
                        '#terminos_consentimiento',

                        'input[name="discapacidad"]',
                        'input[name="lengua_indigena"]',
                        'input[name="auto_indigena"]',
                        'input[name="comunidad_indigena"]',
                        'input[name="diversidad"]',
                        '#medio_convocatoria'
                    ];

                    // Detectar qué sección está visible
                    let visibles = [];
                    if ($('#collapseDocumentosAdultos').closest('.accordion-item').is(':visible')) {
                        visibles = [
                            '#credencial_votar',
                            '#declaracion_originalidad',
                            '#consentimiento_expreso_adultos'
                        ];
                    } else if ($('#collapseDocumentosMenores').closest('.accordion-item').is(':visible')) {
                        visibles = [
                            '#identificacion_fotografia',
                            '#carta_autorizacion',
                            '#declaracion_originalidad_menores',
                            '#comprobante_domicilio_tutor',
                            '#consentimiento_expreso_menores',
                            '#ine_tutor'
                        ];
                    }

                    const camposAContar = generales.concat(visibles);
                    let completados = 0;
                    let radiosContados = {};
                    console.log('--- Campos que se están contabilizando en la progress bar ---');

                    camposAContar.forEach(selector => {
                        if (selector.startsWith('input[name=')) {
                            const nameMatch = selector.match(/name="([^"]+)"/);
                            if (nameMatch) {
                                const name = nameMatch[1];
                                if (radiosContados[name]) return;
                                radiosContados[name] = true;
                                const $radios = $(`input[name="${name}"]`);
                                let estado = $radios.is(':checked') ? 'completado' : 'pendiente';
                                if ($radios.is(':checked')) {
                                    completados++;
                                }
                                console.log(`input[name="${name}"]: ${estado}`);
                            }
                        }
                        else {
                            const $field = $(selector);
                            if (selector === '#curp') {
                                let estado = ($field.val() && $field.val().trim() !== "") ? 'completado' : 'pendiente';
                                if ($field.val() && $field.val().trim() !== "") completados++;
                                console.log(`${selector}: ${estado}`);
                            } else if ($field.length && $field.closest('.accordion-item').is(':visible')) {
                                let estado = '';
                                if ($field.attr('type') === 'checkbox') {
                                    estado = $field.is(':checked') ? 'completado' : 'pendiente';
                                    if ($field.is(':checked')) completados++;
                                } else if ($field.attr('type') === 'file') {
                                    const fieldId = $field.attr('id');
                                    const tieneArchivo = ($field.val() && $field.val().trim() !== "") || (archivosCargados[fieldId] && archivosCargados[fieldId].trim() !== "");
                                    estado = tieneArchivo ? 'completado' : 'pendiente';
                                    if (tieneArchivo) completados++;
                                } else {
                                    estado = ($field.val() && $field.val().trim() !== "") ? 'completado' : 'pendiente';
                                    if ($field.val() && $field.val().trim() !== "") completados++;
                                }
                                console.log(`${selector}: ${estado}`);
                            }
                        }
                    });

                    const porcentaje = Math.round((completados / camposAContar.length) * 100);
                    $('.progress-bar').css('width', porcentaje + '%').attr('aria-valuenow', porcentaje).text(porcentaje + '%');
                    console.log(`Progreso: ${completados}/${camposAContar.length} (${porcentaje}%)`);
                }

                window.actualizarProgreso = actualizarProgreso;

                requiredFields.forEach((field) => {
                    const eventType = field.tagName === "SELECT" ? "change" : "input";
                    field.addEventListener(eventType, () => {
                        actualizarProgreso();
                    });
                });

                function cargarDatos() {
                    $.ajax({
                        url: "../controlador/get_registration.php",
                        type: "GET",
                        dataType: "json",
                        success: function (response) {
                            if (response.status === "success") {
                                const data = response.data;

                                $('#curp').val(data.curp);
                                $('#nombre').val(data.nombre);
                                $('#apellidopaterno').val(data.apellidoP);
                                $('#apellidomaterno').val(data.apellidoM);
                                $('#fechanacimiento').val(data.fecha_nacimiento);
                                $('#edad').val(data.edad);
                                $('#terminos_privacidad').prop('checked', data.acepta_privacidad == 1);
                                $('#terminos_consentimiento').prop('checked', data.acepta_consentimiento == 1);

                                $('#calle').val(response.data.calle);
                                $('#numeroExterior').val(response.data.numeroExterior);
                                $('#numeroInterior').val(response.data.numeroInterior);
                                $('#colonia').val(response.data.colonia);
                                $('#cp').val(response.data.cp);
                                $('#municipio').val(response.data.municipio);
                                $('#localidad').val(response.data.localidad);

                                $('#gradoEstudios').val(response.data.gradoEstudios);
                                $('#ocupacionActual').val(response.data.ocupacionActual);

                                $('#gradoActual').val(response.data.gradoActual);
                                $('#estudiosActuales').val(response.data.estudiosActuales);
                                $('#cargoActual').val(response.data.cargoActual);
                                $('#centroEstudiosTrabajo').val(response.data.centroEstudiosTrabajo);

                                $('#correo').val(response.data.correo);
                                $('#numerofijo').val(response.data.numerofijo);
                                $('#numeromovil').val(response.data.numeromovil);
                                $('#confirmarnumeromovil').val(response.data.numeromovil);

                                $('#facebook').val(response.data.facebook);
                                $('#tiktok').val(response.data.tiktok);
                                $('#instagram').val(response.data.instagram);
                                $('#otra').val(response.data.otraRedSocial);

                                $('#seudonimo').val(response.data.seudonimo);
                                $('#titulo_ensayo').val(response.data.titulo_ensayo);
                                $('#categoria').val(response.data.categoria);


                                archivosCargados = {
                                    archivo_ensayo: response.data.archivo_ensayo,
                                    credencial_votar: data.credencial_votar,
                                    declaracion_originalidad: data.declaracion_originalidad,
                                    consentimiento_expreso_adultos: data.consentimiento_expreso_adultos,
                                    identificacion_fotografia: data.identificacion_fotografia,
                                    carta_autorizacion: data.carta_autorizacion,
                                    declaracion_originalidad_menores: data.declaracion_originalidad_menores,
                                    comprobante_domicilio_tutor: data.comprobante_domicilio_tutor,
                                    consentimiento_expreso_menores: data.consentimiento_expreso_menores,
                                    ine_tutor: data.ine_tutor
                                };
                                inicializarCamposArchivos(archivosCargados);

                                actualizarProgreso();
                            } else {
                                console.error(response.message);
                            }
                        },
                        error: function () {
                            console.error("Error al obtener los datos del registro.");
                        }
                    });
                }

                cargarDatos();
            });
        </script>
        <!-- validación para la curp-->
        <script>
            // ==================== FUNCIONES GENERALES ====================
            function mostrarAlerta(tipo, mensaje, temporal = true) {
                const alertContainer = document.getElementById('alert-container');
                alertContainer.innerHTML = '';

                const alert = document.createElement('div');
                alert.className = `alert alert-${tipo} fade show`;
                alert.style.animation = 'fadeIn 0.5s';
                alert.innerHTML = `
            <span>${mensaje}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
                alertContainer.appendChild(alert);

                if (temporal) {
                    setTimeout(() => {
                        alert.style.animation = 'fadeOut 0.5s';
                        setTimeout(() => alert.remove(), 500);
                    }, 10000);
                }
            }

            function bloquearFormulario() {
                document.querySelectorAll('#formRegistro input:not(#curp), #formRegistro select, #formRegistro button:not(.accordion-button)')
                    .forEach(field => field.disabled = true);
                document.getElementById('btnGuardar').style.display = 'none';
            }

            function habilitarFormulario() {
                document.querySelectorAll('#formRegistro input, #formRegistro select, #formRegistro button:not(.accordion-button)')
                    .forEach(field => field.disabled = false);
                document.getElementById('btnGuardar').style.display = 'block';
            }

            // ==================== VALIDACIÓN DE CURP (MEJORADA) ====================
            function validarCurp() {
                const curpInput = document.getElementById('curp');
                const curp = curpInput.value.trim().toUpperCase();
                const feedback = document.getElementById('curp-feedback');
                const btnSubmit = document.getElementById('btnGuardar');

                // Resetear estado
                feedback.style.display = 'none';
                btnSubmit.disabled = true;

                if (!curp) {
                    mostrarAlerta('warning', 'Por favor, introduzca su CURP.');
                    curpInput.focus();
                    bloquearFormulario();
                    return;
                }

                if (curp.length !== 18) {
                    mostrarAlerta('warning', 'El CURP debe tener exactamente 18 caracteres.');
                    curpInput.focus();
                    bloquearFormulario();
                    return;
                }

                const curpRegex = /^[A-Z]{4}\d{6}[HM][A-Z]{5}[A-Z\d]{2}$/i;;
                if (!curpRegex.test(curp)) {
                    mostrarAlerta('warning', 'El CURP no tiene el formato correcto');
                    curpInput.focus();
                    bloquearFormulario();
                    return;
                }

                mostrarAlerta('info', '<i class="fas fa-spinner fa-spin"></i> Validando CURP...', false);

                fetch('../controlador/validar_curp.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ curp }),
                })
                    .then(response => {
                        if (!response.ok) throw new Error('Error en la respuesta del servidor');
                        return response.json();
                    })
                    .then(data => {
                        document.querySelector('#alert-container .alert').remove();

                        if (data.error) {
                            mostrarAlerta('danger', `${data.error}`);
                            bloquearFormulario();
                        } else if (data.exists) {
                            feedback.style.display = 'block';
                            mostrarAlerta('danger', 'El CURP ya está registrado. Por favor, use otro');
                            bloquearFormulario();
                        } else {
                            mostrarAlerta('success', 'El CURP es válido. Puede continuar con el registro');
                            habilitarFormulario();
                            document.getElementById('apellidopaterno').focus();
                        }
                    })
                    .catch(error => {
                        document.querySelector('#alert-container .alert').remove();
                        mostrarAlerta('danger', 'Error al validar. Intente nuevamente.');
                        console.error('Error:', error);
                    })
                    .finally(() => {
                        btnSubmit.disabled = false;
                    });
            }

            document.addEventListener('DOMContentLoaded', () => {
                bloquearFormulario();

                document.getElementById('curp').addEventListener('input', (e) => {
                    e.target.value = e.target.value.toUpperCase();
                    if (e.target.value.trim().length !== 18) {
                        bloquearFormulario();
                    }
                });
            });
        </script>
        <!-- validaciones input file -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const fileFields = [
                    'credencial_votar',
                    'declaracion_originalidad',
                    'consentimiento_expreso_adultos',
                    'identificacion_fotografia',
                    'carta_autorizacion',
                    'declaracion_originalidad_menores',
                    'comprobante_domicilio_tutor',
                    'consentimiento_expreso_menores',
                    'ine_tutor'
                ];

                fileFields.forEach(fieldId => {
                    const inputFile = document.getElementById(fieldId);
                    if (!inputFile) return;

                    const grupo = document.getElementById('grupo_' + fieldId);
                    const feedbackContainer = grupo ? grupo.querySelector('.input-file-section') : null;
                    const invalidFeedback = feedbackContainer ? feedbackContainer.querySelector('.invalid-feedback') : null;
                    const validFeedback = feedbackContainer ? feedbackContainer.querySelector('.valid-feedback') : null;

                    inputFile.addEventListener('change', function () {
                        const file = this.files[0];
                        let valid = true;

                        if (file) {
                            if (file.type !== "application/pdf" && !file.name.toLowerCase().endsWith('.pdf')) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Archivo no válido',
                                    text: 'Sólo se permite subir archivos en formato PDF.',
                                });
                                this.value = "";
                                valid = false;
                            } else if (file.size > 3 * 1024 * 1024) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Archivo demasiado grande',
                                    text: 'El archivo debe pesar máximo 3 MB.',
                                });
                                this.value = "";
                                valid = false;
                            }
                        }

                        if (feedbackContainer && invalidFeedback && validFeedback) {
                            if (valid && file) {
                                inputFile.classList.add('is-valid');
                                inputFile.classList.remove('is-invalid');
                                invalidFeedback.classList.remove('d-block');
                                invalidFeedback.classList.add('d-none');
                                validFeedback.classList.remove('d-none');
                                validFeedback.classList.add('d-block');
                            } else {
                                inputFile.classList.add('is-invalid');
                                inputFile.classList.remove('is-valid');
                                invalidFeedback.classList.remove('d-none');
                                invalidFeedback.classList.add('d-block');
                                validFeedback.classList.remove('d-block');
                                validFeedback.classList.add('d-none');
                            }
                        }
                    });
                });
            });
        </script>
        <!-- procesamiento -->
        <script>
            $(document).ready(function () {
                const $form = $('#formRegistro');
                const $curpField = $('#curp');
                const $btnGuardar = $('#btnGuardar');
                const $btnActualizar = $('#btnActualizar');
                const $btnCancelar = $('#btnCancelar');
                const $btnFinalizar = $('#btnFinalizar');
                let originalFormData = {};
                let loadingAlert;
                let formHasBeenSaved = false;
                let archivosCargados = {
                    credencial_votar: '',
                    declaracion_originalidad: '',
                    consentimiento_expreso_adultos: ''
                };


                // ==================== FUNCIONES DE ESTADO ====================
                function setInitialState() {
                    if (formHasBeenSaved) {
                        $form.find(':input').not('.accordion-button').prop('disabled', true);
                        $curpField.prop('disabled', true);

                        $btnGuardar.hide();
                        $btnActualizar.show().prop('disabled', false);
                        $btnCancelar.hide();
                        $btnFinalizar.show().prop('disabled', false);
                    } else {
                        $form.find(':input').not('#curp, .accordion-button').prop('disabled', true);
                        $curpField.prop('disabled', false);

                        $btnGuardar.show();
                        $btnActualizar.hide();
                        $btnCancelar.hide();
                        $btnFinalizar.hide();
                    }
                }

                function enableEditMode() {
                    $form.find(':input').not('#curp, .accordion-button').prop('disabled', false);

                    $btnGuardar.show();
                    $btnActualizar.hide();
                    $btnCancelar.show();
                    $btnFinalizar.hide();
                }

                function disableForm() {
                    $form.find(':input').not('.accordion-button').prop('disabled', true);
                    $curpField.prop('disabled', true);

                    $btnGuardar.hide();
                    $btnActualizar.show().prop('disabled', false);
                    $btnCancelar.hide();
                    $btnFinalizar.show().prop('disabled', false);
                }

                function lockFormPermanently() {
                    $form.find(':input').not('.accordion-button').prop('disabled', true);
                    $btnGuardar.add($btnActualizar).add($btnCancelar).add($btnFinalizar).hide();

                    Swal.fire({
                        title: "Formulario Finalizado",
                        text: "Este formulario ya ha sido finalizado y no se puede modificar.",
                        icon: "info",
                        confirmButtonText: "OK",
                        allowOutsideClick: false
                    });
                }

                // ==================== FUNCIONES AUXILIARES ====================
                function showLoading(message = 'Procesando...') {
                    loadingAlert = Swal.fire({
                        title: message,
                        html: 'Por favor espere',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                    return loadingAlert;
                }

                function sendRequest(url, data = {}, method = 'POST') {
                    showLoading();

                    return $.ajax({
                        url: url,
                        type: method,
                        data: data,
                        dataType: 'json'
                    }).always(() => {
                        if (loadingAlert) Swal.close();
                    });
                }

                function handleError(error) {
                    console.error('Error:', error);
                    let message = 'Error en el servidor';

                    if (error.responseJSON && error.responseJSON.message) {
                        message = error.responseJSON.message;
                    } else if (error.statusText) {
                        message = error.statusText;
                    }

                    Swal.fire('Error', message, 'error');
                }

                function saveFormState() {
                    originalFormData = {};
                    $form.serializeArray().forEach(field => {
                        originalFormData[field.name] = field.value;
                    });
                }

                function restoreFormState() {
                    Object.entries(originalFormData).forEach(([name, value]) => {
                        const $field = $(`[name="${name}"]`);
                        if ($field.is('input[type="checkbox"]')) {
                            $field.prop('checked', Boolean(value));
                        } else {
                            $field.val(value);
                        }
                    });
                }

                function prepareFormForSubmit() {
                    const disabledFields = $form.find(':input:disabled');
                    disabledFields.prop('disabled', false);
                    return disabledFields;
                }

                function restoreAfterSubmit(disabledFields) {
                    disabledFields.prop('disabled', true);
                }

                function validateRequiredFields() {
                    let isValid = true;

                    $form.find('.is-invalid').removeClass('is-invalid');
                    $form.find('.is-valid').removeClass('is-valid');
                    $form.find('.invalid-feedback').removeClass('d-block').addClass('d-none');
                    $form.find('.valid-feedback').removeClass('d-block').addClass('d-none');

                    $form.find('[required]').each(function () {
                        const $field = $(this);
                        const $feedbackContainer = $field.closest('.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-6, .col-md-7, .col-md-12, .form-check');
                        const $invalidFeedback = $feedbackContainer.find('.invalid-feedback');
                        const $validFeedback = $feedbackContainer.find('.valid-feedback');
                        let fieldValid = true;

                        if ($field.is(':checkbox')) {
                            fieldValid = $field.is(':checked');
                        }
                        else if ($field.attr('type') === 'file') {
                            const fieldId = $field.attr('id');
                            fieldValid = ($field.val() && $field.val().trim() !== '') ||
                                (archivosCargados[fieldId] && archivosCargados[fieldId].trim() !== '');
                        }
                        else {
                            fieldValid = $field.val() && $field.val().trim() !== '';
                        }

                        if (fieldValid) {
                            // Campo válido
                            $field.addClass('is-valid').removeClass('is-invalid');
                            $invalidFeedback.removeClass('d-block').addClass('d-none');
                            $validFeedback.removeClass('d-none').addClass('d-block');
                        } else {
                            // Campo inválido
                            $field.addClass('is-invalid').removeClass('is-valid');
                            $invalidFeedback.removeClass('d-none').addClass('d-block');
                            $validFeedback.removeClass('d-block').addClass('d-none');
                            isValid = false;
                        }
                    });

                    $form.find('input[type="radio"][required]').each(function () {
                        const name = $(this).attr('name');
                        const $group = $form.find(`input[name="${name}"]`);
                        const $container = $group.closest('.col-md-4, .form-check, .form-group');
                        const $invalidFeedback = $container.find('.invalid-feedback');
                        const $validFeedback = $container.find('.valid-feedback');

                        if ($group.data('validated')) return;
                        $group.data('validated', true);

                        if ($group.is(':checked')) {
                            $group.removeClass('is-invalid').addClass('is-valid');
                            $invalidFeedback.removeClass('d-block').addClass('d-none');
                            $validFeedback.removeClass('d-none').addClass('d-block');
                        } else {
                            $group.removeClass('is-valid').addClass('is-invalid');
                            $invalidFeedback.removeClass('d-none').addClass('d-block');
                            $validFeedback.removeClass('d-block').addClass('d-none');
                            isValid = false;
                        }
                    });
                    $form.find('input[type="radio"][required]').removeData('validated');

                    return isValid;
                }


                // ==================== MANEJO DE EVENTOS ====================
                function loadInitialData() {
                    showLoading('Cargando datos...');

                    sendRequest('../controlador/get_registration.php', {}, 'GET')
                        .then(response => {
                            if (response.status === "success") {
                                formHasBeenSaved = true;

                                $('#curp').val(response.data.curp);
                                $('#nombre').val(response.data.nombre);
                                $('#apellidopaterno').val(response.data.apellidoP);
                                $('#apellidomaterno').val(response.data.apellidoM);
                                $('#fechanacimiento').val(response.data.fecha_nacimiento);
                                $('#edad').val(response.data.edad);
                                $('#terminos_privacidad').prop('checked', response.data.acepta_privacidad == 1);
                                $('#terminos_consentimiento').prop('checked', response.data.acepta_consentimiento == 1);

                                $('#calle').val(response.data.calle);
                                $('#numeroExterior').val(response.data.numeroExterior);
                                $('#numeroInterior').val(response.data.numeroInterior);
                                $('#colonia').val(response.data.colonia);
                                $('#cp').val(response.data.cp);
                                $('#municipio').val(response.data.municipio);
                                $('#localidad').val(response.data.localidad);

                                $('#gradoEstudios').val(response.data.gradoEstudios);
                                $('#ocupacionActual').val(response.data.ocupacionActual);

                                $('#gradoActual').val(response.data.gradoActual);
                                $('#estudiosActuales').val(response.data.estudiosActuales);
                                $('#cargoActual').val(response.data.cargoActual);
                                $('#centroEstudiosTrabajo').val(response.data.centroEstudiosTrabajo);

                                $('#correo').val(response.data.correo);
                                $('#numerofijo').val(response.data.numerofijo);
                                $('#confirmarnumerofijo').val(response.data.numerofijo);
                                $('#numeromovil').val(response.data.numeromovil);
                                $('#confirmarnumeromovil').val(response.data.numeromovil);

                                $('#facebook').val(response.data.facebook);
                                $('#tiktok').val(response.data.tiktok);
                                $('#instagram').val(response.data.instagram);
                                $('#otra').val(response.data.otraRedSocial);

                                $('#seudonimo').val(response.data.seudonimo);
                                $('#titulo_ensayo').val(response.data.titulo_ensayo);
                                $('#categoria').val(response.data.categoria);


                                // === ACCIONES AFIRMATIVAS ===
                                // Discapacidad
                                if (response.data.discapacidad === "sí") {
                                    $('#discapacidad_si').prop('checked', true);
                                } else if (response.data.discapacidad === "no") {
                                    $('#discapacidad_no').prop('checked', true);
                                } else {
                                    $('input[name="discapacidad"]').prop('checked', false);
                                }
                                $('#discapacidad_cual').val(response.data.discapacidad_cual || '');
                                $('#tipo_discapacidad').val(response.data.tipo_discapacidad || '');

                                // Lengua indígena
                                if (response.data.lengua_indigena === "sí") {
                                    $('#lengua_si').prop('checked', true);
                                } else if (response.data.lengua_indigena === "no") {
                                    $('#lengua_no').prop('checked', true);
                                } else {
                                    $('input[name="lengua_indigena"]').prop('checked', false);
                                }
                                $('#lengua_cual').val(response.data.lengua_cual || '');

                                // Auto adscripción indígena
                                if (response.data.auto_indigena === "sí") {
                                    $('#auto_indigena_si').prop('checked', true);
                                } else if (response.data.auto_indigena === "no") {
                                    $('#auto_indigena_no').prop('checked', true);
                                } else {
                                    $('input[name="auto_indigena"]').prop('checked', false);
                                }

                                // Comunidad indígena
                                if (response.data.comunidad_indigena === "sí") {
                                    $('#comunidad_si').prop('checked', true);
                                } else if (response.data.comunidad_indigena === "no") {
                                    $('#comunidad_no').prop('checked', true);
                                } else {
                                    $('input[name="comunidad_indigena"]').prop('checked', false);
                                }
                                $('#comunidad_cual').val(response.data.comunidad_cual || '');

                                // Diversidad sexual y de género
                                if (response.data.diversidad === "sí") {
                                    $('#diversidad_si').prop('checked', true);
                                } else if (response.data.diversidad === "no") {
                                    $('#diversidad_no').prop('checked', true);
                                } else {
                                    $('input[name="diversidad"]').prop('checked', false);
                                }
                                $('#diversidad_cual').val(response.data.diversidad_cual || '');

                                // Medio de convocatoria
                                $('#medio_convocatoria').val(response.data.medio_convocatoria || '');

                                $('input[name="discapacidad"]').trigger('change');
                                $('input[name="lengua_indigena"]').trigger('change');
                                $('input[name="auto_indigena"]').trigger('change');
                                $('input[name="auto_indigena"]').trigger('change');
                                $('input[name="comunidad_indigena"]').trigger('change');
                                $('input[name="diversidad"]').trigger('change');

                                if (typeof actualizarProgreso === 'function') {
                                    actualizarProgreso();
                                }


                                const $grupoArchivoEnsayo = $('#grupo_archivo_ensayo');
                                const $fileSectionEnsayo = $grupoArchivoEnsayo.find('.input-file-section');
                                const $archivoCargadoSectionEnsayo = $grupoArchivoEnsayo.find('.archivo-cargado-section');
                                const $btnViewEnsayo = $grupoArchivoEnsayo.find('.btn-view-file');
                                const archivoEnsayoRuta = response.data.archivo_ensayo;

                                if (archivoEnsayoRuta && archivoEnsayoRuta.trim() !== '') {
                                    $fileSectionEnsayo.hide();
                                    $archivoCargadoSectionEnsayo.show();
                                    $btnViewEnsayo.attr('href', getArchivoUrl(archivoEnsayoRuta));
                                } else {
                                    $fileSectionEnsayo.show();
                                    $archivoCargadoSectionEnsayo.hide();
                                    $('#archivo_ensayo').val('');
                                }

                                archivosCargados = {
                                    archivo_ensayo: response.data.archivo_ensayo,
                                    credencial_votar: response.data.credencial_votar,
                                    declaracion_originalidad: response.data.declaracion_originalidad,
                                    consentimiento_expreso_adultos: response.data.consentimiento_expreso_adultos,
                                    identificacion_fotografia: response.data.identificacion_fotografia,
                                    carta_autorizacion: response.data.carta_autorizacion,
                                    declaracion_originalidad_menores: response.data.declaracion_originalidad_menores,
                                    comprobante_domicilio_tutor: response.data.comprobante_domicilio_tutor,
                                    consentimiento_expreso_menores: response.data.consentimiento_expreso_menores,
                                    ine_tutor: response.data.ine_tutor
                                };
                                inicializarCamposArchivos(archivosCargados);


                                response.data.status == 1 ? lockFormPermanently() : setInitialState();
                            } else if (response.message === "No se encontraron registros para este usuario.") {
                                formHasBeenSaved = false;

                                inicializarCamposArchivos({
                                    credencial_votar: '',
                                    declaracion_originalidad: '',
                                    consentimiento_expreso_adultos: ''
                                });

                                Swal.close();
                                setInitialState();
                            } else {
                                throw new Error(response.message || 'Error al cargar datos');
                            }
                        })
                        .catch(error => {
                            if (!error.responseJSON || error.responseJSON.message !== "No se encontraron registros para este usuario.") {
                                handleError(error);
                            } else {
                                formHasBeenSaved = false;

                                archivosCargados = {
                                    credencial_votar: '',
                                    declaracion_originalidad: '',
                                    consentimiento_expreso_adultos: ''
                                };
                                inicializarCamposArchivos(archivosCargados);

                                Swal.close();
                                setInitialState();
                            }
                        });
                }

                $btnActualizar.click(e => {
                    e.preventDefault();
                    Swal.fire({
                        title: "¿Estás seguro?",
                        text: "¿Deseas habilitar los campos para actualizar la información?",
                        icon: "warning",
                        showCancelButton: true,
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí, actualizar",
                        cancelButtonText: "Cancelar",
                    }).then(result => {
                        if (result.isConfirmed) enableEditMode();
                    });
                });

                $btnCancelar.click(e => {
                    e.preventDefault();
                    Swal.fire({
                        title: "¿Descartar cambios?",
                        text: "Se perderán todas las modificaciones no guardadas.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Sí, descartar",
                        cancelButtonText: "Continuar editando"
                    }).then(result => {
                        if (result.isConfirmed) {
                            restoreFormState();
                            disableForm();
                        }
                    });
                });

                $btnFinalizar.click(e => {
                    e.preventDefault();

                    if (!validateRequiredFields()) {
                        Swal.fire({
                            title: "Campos incompletos",
                            html: "Por favor, complete todos los campos obligatorios antes de finalizar.",
                            icon: "warning",
                            didOpen: () => {
                                const firstError = $('.is-invalid').first();
                                if (firstError.length) {
                                    $('html, body').animate({
                                        scrollTop: firstError.offset().top - 100
                                    }, 500);
                                }
                            }
                        });
                        return;
                    }

                    Swal.fire({
                        title: "¿Finalizar formulario?",
                        text: "Una vez finalizado, no será posible realizar cambios o modificaciones en la información proporcionada. Por favor, asegúrese de revisar cuidadosamente todos los datos antes de enviarlo.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Sí, finalizar",
                        cancelButtonText: "Cancelar"
                    }).then(result => {
                        if (result.isConfirmed) {
                            showLoading('Finalizando...');

                            const disabledFields = prepareFormForSubmit();
                            const formData = new FormData($form[0]);
                            restoreAfterSubmit(disabledFields);

                            $.ajax({
                                url: '../controlador/controlador_form.php',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status === "success") {
                                        $.ajax({
                                            url: '../controlador/finalizar_formulario.php',
                                            type: 'POST',
                                            data: { curp: $curpField.val() },
                                            dataType: 'json',
                                            success: function (response2) {
                                                if (loadingAlert) Swal.close();
                                                if (response2.status === "success") {
                                                    Swal.fire({
                                                        title: "¡Formulario finalizado!",
                                                        text: "Formulario finalizado correctamente. Se ha enviado un correo de confirmación a la dirección registrada.\n\nAyúdanos a mejorar respondiendo la siguiente encuesta:",
                                                        icon: "success",
                                                        confirmButtonText: "Encuesta de retroalimentación",
                                                        allowOutsideClick: false
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            window.open(
                                                                "http://localhost/17deoctubre/data/encuestasatisfaccion.php?usuario_id=" + encodeURIComponent(response2.usuario_id),
                                                                "_blank"
                                                            );
                                                            lockFormPermanently();
                                                        } else {
                                                            lockFormPermanently();
                                                        }
                                                    });
                                                } else {
                                                    handleError({ responseJSON: response2 });
                                                }
                                            },
                                            error: function (error) {
                                                if (loadingAlert) Swal.close();
                                                handleError(error);
                                            },
                                            complete: function () { /* No cerrar SweetAlert  */ }
                                        });
                                    } else {
                                        if (loadingAlert) Swal.close();
                                        handleError({ responseJSON: response });
                                    }
                                },
                                error: function (error) {
                                    if (loadingAlert) Swal.close();
                                    handleError(error);
                                },
                                complete: function () { /* No cerrar SweetAlert */ }
                            });
                        }
                    });
                });

                $form.submit(e => {
                    e.preventDefault();

                    Swal.fire({
                        title: "¿Estás seguro?",
                        text: "¿Deseas guardar los cambios realizados?",
                        icon: "warning",
                        showCancelButton: true,
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí, guardar",
                        cancelButtonText: "Cancelar",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            showLoading('Guardando progreso...');

                            const disabledFields = prepareFormForSubmit();
                            const formData = new FormData($form[0]);
                            restoreAfterSubmit(disabledFields);

                            $.ajax({
                                url: '../controlador/controlador_form.php',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status === "success") {
                                        formHasBeenSaved = true;
                                        Swal.close();
                                        setTimeout(() => {
                                            Swal.fire({
                                                title: "¡Progreso guardado!",
                                                text: "Puede continuar más tarde.",
                                                icon: "success"
                                            }).then(() => {
                                                disableForm();
                                                loadInitialData();
                                            });
                                        }, 200);
                                    } else {
                                        handleError({ responseJSON: response });
                                    }
                                },
                                error: handleError,
                                complete: function () { /* No cerrar SweetAlert */ }
                            });
                        }
                    });
                });

                $form.on('input change', '[required]', function () {
                    const $field = $(this);
                    const $feedbackContainer = $field.closest('.col-md-4, .col-md-12, .form-check');

                    $field.removeClass('is-invalid is-valid');
                    $feedbackContainer.find('.invalid-feedback').removeClass('d-block').addClass('d-none');
                    $feedbackContainer.find('.valid-feedback').removeClass('d-block').addClass('d-none');

                    if (!$field.is(':checkbox') && $field.val().trim() !== '') {
                        $field.addClass('is-valid');
                        $feedbackContainer.find('.valid-feedback').removeClass('d-none').addClass('d-block');
                    }

                    if ($field.is(':checkbox') && $field.is(':checked')) {
                        $field.addClass('is-valid');
                        $feedbackContainer.find('.valid-feedback').removeClass('d-none').addClass('d-block');
                    }
                });

                setInitialState();
                loadInitialData();
            });
        </script>
        <!-- Menjo de secciones por edad -->
        <script>
            $(document).ready(function () {
                // ==================== CONSTANTES Y VARIABLES ====================
                const $form = $('#formRegistro');
                const $curpField = $('#curp');
                const $btnGuardar = $('#btnGuardar');
                const $btnActualizar = $('#btnActualizar');
                const $btnCancelar = $('#btnCancelar');
                const $btnFinalizar = $('#btnFinalizar');
                let originalFormData = {};
                let loadingAlert;
                let formHasBeenSaved = false;
                let archivosCargados = {
                    credencial_votar: '',
                    declaracion_originalidad: '',
                    consentimiento_expreso_adultos: '',
                    identificacion_fotografia: '',
                    carta_autorizacion: '',
                    declaracion_originalidad_menores: '',
                    comprobante_domicilio_tutor: '',
                    consentimiento_expreso_menores: '',
                    ine_tutor: ''
                };

                // ==================== SECCIONES Y CAMPOS DE DOCUMENTOS ====================
                const seccionAdultos = $('#collapseDocumentosAdultos').closest('.accordion-item');
                const seccionMenores = $('#collapseDocumentosMenores').closest('.accordion-item');
                const camposAdultos = [
                    'credencial_votar',
                    'declaracion_originalidad',
                    'consentimiento_expreso_adultos'
                ];
                const camposMenores = [
                    'identificacion_fotografia',
                    'carta_autorizacion',
                    'declaracion_originalidad_menores',
                    'comprobante_domicilio_tutor',
                    'consentimiento_expreso_menores',
                    'ine_tutor'
                ];
                let ultimaEdad = null;

                function ocultarSeccionesDocumentos() {
                    seccionAdultos.hide();
                    seccionMenores.hide();
                    camposAdultos.forEach(id => {
                        $('#' + id).prop('required', false).prop('disabled', true);
                    });
                    camposMenores.forEach(id => {
                        $('#' + id).prop('required', false).prop('disabled', true);
                    });
                }

                function mostrarSeccionPorEdad(edad) {
                    ocultarSeccionesDocumentos();
                    if (edad >= 18) {
                        seccionAdultos.show();
                        camposAdultos.forEach(id => {
                            $('#' + id).prop('required', true).prop('disabled', false);
                        });
                    } else if (edad > 0 && edad <= 17) {
                        seccionMenores.show();
                        camposMenores.forEach(id => {
                            $('#' + id).prop('required', true).prop('disabled', false);
                        });
                    }
                }

                function limpiarCampos(ids) {
                    ids.forEach(id => {
                        $('#' + id).val('').prop('required', false).prop('disabled', true);
                        $('#' + id).removeClass('is-valid is-invalid');
                        $('#grupo_' + id + ' .valid-feedback').removeClass('d-block').addClass('d-none');
                        $('#grupo_' + id + ' .invalid-feedback').removeClass('d-block').addClass('d-none');
                        $('#grupo_' + id + ' .archivo-cargado-section').hide();
                        $('#grupo_' + id + ' .input-file-section').show();
                        if (archivosCargados[id]) archivosCargados[id] = '';
                    });
                }

                // ==================== FUNCIONES DE ESTADO ====================
                function setInitialState() {
                    if (formHasBeenSaved) {
                        $form.find(':input').not('.accordion-button').prop('disabled', true);
                        $curpField.prop('disabled', true);
                        $btnGuardar.hide();
                        $btnActualizar.show().prop('disabled', false);
                        $btnCancelar.hide();
                        $btnFinalizar.show().prop('disabled', false);
                    } else {
                        $form.find(':input').not('#curp, .accordion-button').prop('disabled', true);
                        $curpField.prop('disabled', false);
                        $btnGuardar.show();
                        $btnActualizar.hide();
                        $btnCancelar.hide();
                        $btnFinalizar.hide();
                    }
                }

                function enableEditMode() {
                    $form.find(':input').not('#curp, .accordion-button').prop('disabled', false);
                    $btnGuardar.show();
                    $btnActualizar.hide();
                    $btnCancelar.show();
                    $btnFinalizar.hide();
                }

                function disableForm() {
                    $form.find(':input').not('.accordion-button').prop('disabled', true);
                    $curpField.prop('disabled', true);
                    $btnGuardar.hide();
                    $btnActualizar.show().prop('disabled', false);
                    $btnCancelar.hide();
                    $btnFinalizar.show().prop('disabled', false);
                }

                function lockFormPermanently() {
                    $form.find(':input').not('.accordion-button').prop('disabled', true);
                    $btnGuardar.add($btnActualizar).add($btnCancelar).add($btnFinalizar).hide();
                    Swal.fire({
                        title: "Formulario Finalizado",
                        text: "Este formulario ya ha sido finalizado y no se puede modificar.",
                        icon: "info",
                        confirmButtonText: "OK",
                        allowOutsideClick: false
                    });
                }

                // ==================== FUNCIONES AUXILIARES ====================
                function showLoading(message = 'Procesando...') {
                    loadingAlert = Swal.fire({
                        title: message,
                        html: 'Por favor espere',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                    return loadingAlert;
                }

                function sendRequest(url, data = {}, method = 'POST') {
                    showLoading();

                    return $.ajax({
                        url: url,
                        type: method,
                        data: data,
                        dataType: 'json'
                    }).always(() => {
                        if (loadingAlert) Swal.close();
                    });
                }

                function handleError(error) {
                    console.error('Error:', error);
                    let message = 'Error en el servidor';

                    if (error.responseJSON && error.responseJSON.message) {
                        message = error.responseJSON.message;
                    } else if (error.statusText) {
                        message = error.statusText;
                    }

                    Swal.fire('Error', message, 'error');
                }

                function saveFormState() {
                    originalFormData = {};
                    $form.serializeArray().forEach(field => {
                        originalFormData[field.name] = field.value;
                    });
                }

                function restoreFormState() {
                    Object.entries(originalFormData).forEach(([name, value]) => {
                        const $field = $(`[name="${name}"]`);
                        if ($field.is('input[type="checkbox"]')) {
                            $field.prop('checked', Boolean(value));
                        } else {
                            $field.val(value);
                        }
                    });
                }

                function prepareFormForSubmit() {
                    const disabledFields = $form.find(':input:disabled');
                    disabledFields.prop('disabled', false);
                    return disabledFields;
                }

                function restoreAfterSubmit(disabledFields) {
                    disabledFields.prop('disabled', true);
                }

                function validateRequiredFields() {
                    let isValid = true;
                    $form.find('.is-invalid').removeClass('is-invalid');
                    $form.find('.is-valid').removeClass('is-valid');
                    $form.find('.invalid-feedback').removeClass('d-block').addClass('d-none');
                    $form.find('.valid-feedback').removeClass('d-block').addClass('d-none');
                    $form.find('[required]').each(function () {
                        const $field = $(this);
                        const $feedbackContainer = $field.closest('.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-6, .col-md-7, .col-md-12, .form-check');
                        const $invalidFeedback = $feedbackContainer.find('.invalid-feedback');
                        const $validFeedback = $feedbackContainer.find('.valid-feedback');
                        let fieldValid = true;
                        if ($field.is(':checkbox')) {
                            fieldValid = $field.is(':checked');
                        } else if ($field.attr('type') === 'file') {
                            const fieldId = $field.attr('id');
                            fieldValid = ($field.val() && $field.val().trim() !== '') ||
                                (archivosCargados[fieldId] && archivosCargados[fieldId].trim() !== '');
                        } else {
                            fieldValid = $field.val() && $field.val().trim() !== '';
                        }
                        if (fieldValid) {
                            $field.addClass('is-valid').removeClass('is-invalid');
                            $invalidFeedback.removeClass('d-block').addClass('d-none');
                            $validFeedback.removeClass('d-none').addClass('d-block');
                        } else {
                            $field.addClass('is-invalid').removeClass('is-valid');
                            $invalidFeedback.removeClass('d-none').addClass('d-block');
                            $validFeedback.removeClass('d-block').addClass('d-none');
                            isValid = false;
                        }
                    });
                    return isValid;
                }

                // ==================== MANEJO DE SECCIONES POR EDAD ====================
                ocultarSeccionesDocumentos();

                function loadInitialData() {
                    showLoading('Cargando datos...');
                    sendRequest('../controlador/get_registration.php', {}, 'GET')
                        .then(response => {
                            if (response.status === "success") {
                                formHasBeenSaved = true;
                                $('#curp').val(response.data.curp);
                                $('#nombre').val(response.data.nombre);
                                $('#apellidopaterno').val(response.data.apellidoP);
                                $('#apellidomaterno').val(response.data.apellidoM);
                                $('#fechanacimiento').val(response.data.fecha_nacimiento);
                                $('#edad').val(response.data.edad);
                                $('#terminos_privacidad').prop('checked', response.data.acepta_privacidad == 1);
                                $('#terminos_consentimiento').prop('checked', response.data.acepta_consentimiento == 1);

                                $('#calle').val(response.data.calle);
                                $('#numeroExterior').val(response.data.numeroExterior);
                                $('#numeroInterior').val(response.data.numeroInterior);
                                $('#colonia').val(response.data.colonia);
                                $('#cp').val(response.data.cp);
                                $('#municipio').val(response.data.municipio);
                                $('#localidad').val(response.data.localidad);

                                $('#gradoEstudios').val(response.data.gradoEstudios);
                                $('#ocupacionActual').val(response.data.ocupacionActual);

                                $('#gradoActual').val(response.data.gradoActual);
                                $('#estudiosActuales').val(response.data.estudiosActuales);
                                $('#cargoActual').val(response.data.cargoActual);
                                $('#centroEstudiosTrabajo').val(response.data.centroEstudiosTrabajo);

                                $('#correo').val(response.data.correo);
                                $('#numerofijo').val(response.data.numerofijo);
                                $('#confirmarnumerofijo').val(response.data.numerofijo);
                                $('#numeromovil').val(response.data.numeromovil);
                                $('#confirmarnumeromovil').val(response.data.numeromovil);

                                $('#facebook').val(response.data.facebook);
                                $('#tiktok').val(response.data.tiktok);
                                $('#instagram').val(response.data.instagram);
                                $('#otra').val(response.data.otraRedSocial);

                                $('#seudonimo').val(response.data.seudonimo);
                                $('#titulo_ensayo').val(response.data.titulo_ensayo);
                                $('#categoria').val(response.data.categoria);


                                // === ACCIONES AFIRMATIVAS ===
                                // Discapacidad
                                if (response.data.discapacidad === "sí") {
                                    $('#discapacidad_si').prop('checked', true);
                                } else if (response.data.discapacidad === "no") {
                                    $('#discapacidad_no').prop('checked', true);
                                } else {
                                    $('input[name="discapacidad"]').prop('checked', false);
                                }
                                $('#discapacidad_cual').val(response.data.discapacidad_cual || '');
                                $('#tipo_discapacidad').val(response.data.tipo_discapacidad || '');

                                // Lengua indígena
                                if (response.data.lengua_indigena === "sí") {
                                    $('#lengua_si').prop('checked', true);
                                } else if (response.data.lengua_indigena === "no") {
                                    $('#lengua_no').prop('checked', true);
                                } else {
                                    $('input[name="lengua_indigena"]').prop('checked', false);
                                }
                                $('#lengua_cual').val(response.data.lengua_cual || '');

                                // Auto adscripción indígena
                                if (response.data.auto_indigena === "sí") {
                                    $('#auto_indigena_si').prop('checked', true);
                                } else if (response.data.auto_indigena === "no") {
                                    $('#auto_indigena_no').prop('checked', true);
                                } else {
                                    $('input[name="auto_indigena"]').prop('checked', false);
                                }

                                // Comunidad indígena
                                if (response.data.comunidad_indigena === "sí") {
                                    $('#comunidad_si').prop('checked', true);
                                } else if (response.data.comunidad_indigena === "no") {
                                    $('#comunidad_no').prop('checked', true);
                                } else {
                                    $('input[name="comunidad_indigena"]').prop('checked', false);
                                }
                                $('#comunidad_cual').val(response.data.comunidad_cual || '');

                                // Diversidad sexual y de género
                                if (response.data.diversidad === "sí") {
                                    $('#diversidad_si').prop('checked', true);
                                } else if (response.data.diversidad === "no") {
                                    $('#diversidad_no').prop('checked', true);
                                } else {
                                    $('input[name="diversidad"]').prop('checked', false);
                                }
                                $('#diversidad_cual').val(response.data.diversidad_cual || '');

                                // Medio de convocatoria
                                $('#medio_convocatoria').val(response.data.medio_convocatoria || '');

                                $('input[name="discapacidad"]').trigger('change');
                                $('input[name="lengua_indigena"]').trigger('change');
                                $('input[name="auto_indigena"]').trigger('change'); // 
                                $('input[name="auto_indigena"]').trigger('change');
                                $('input[name="comunidad_indigena"]').trigger('change');
                                $('input[name="diversidad"]').trigger('change');

                                if (typeof actualizarProgreso === 'function') {
                                    actualizarProgreso();
                                }


                                const $grupoArchivoEnsayo = $('#grupo_archivo_ensayo');
                                const $fileSectionEnsayo = $grupoArchivoEnsayo.find('.input-file-section');
                                const $archivoCargadoSectionEnsayo = $grupoArchivoEnsayo.find('.archivo-cargado-section');
                                const $btnViewEnsayo = $grupoArchivoEnsayo.find('.btn-view-file');
                                const archivoEnsayoRuta = response.data.archivo_ensayo;

                                if (archivoEnsayoRuta && archivoEnsayoRuta.trim() !== '') {
                                    $fileSectionEnsayo.hide();
                                    $archivoCargadoSectionEnsayo.show();
                                    $btnViewEnsayo.attr('href', getArchivoUrl(archivoEnsayoRuta));
                                } else {
                                    $fileSectionEnsayo.show();
                                    $archivoCargadoSectionEnsayo.hide();
                                    $('#archivo_ensayo').val('');
                                }

                                archivosCargados = {
                                    credencial_votar: response.data.credencial_votar,
                                    declaracion_originalidad: response.data.declaracion_originalidad,
                                    consentimiento_expreso_adultos: response.data.consentimiento_expreso_adultos,
                                    identificacion_fotografia: response.data.identificacion_fotografia,
                                    carta_autorizacion: response.data.carta_autorizacion,
                                    declaracion_originalidad_menores: response.data.declaracion_originalidad_menores,
                                    comprobante_domicilio_tutor: response.data.comprobante_domicilio_tutor,
                                    consentimiento_expreso_menores: response.data.consentimiento_expreso_menores,
                                    ine_tutor: response.data.ine_tutor
                                };
                                inicializarCamposArchivos(archivosCargados);


                                const edadCargada = parseInt(response.data.edad, 10);
                                mostrarSeccionPorEdad(edadCargada);
                                ultimaEdad = edadCargada;

                                response.data.status == 1 ? lockFormPermanently() : setInitialState();
                            } else if (response.message === "No se encontraron registros para este usuario.") {
                                formHasBeenSaved = false;
                                inicializarCamposArchivos({
                                    credencial_votar: '',
                                    declaracion_originalidad: '',
                                    consentimiento_expreso_adultos: '',
                                    identificacion_fotografia: '',
                                    carta_autorizacion: '',
                                    declaracion_originalidad_menores: '',
                                    comprobante_domicilio_tutor: '',
                                    consentimiento_expreso_menores: '',
                                    ine_tutor: ''
                                });
                                ocultarSeccionesDocumentos();
                                ultimaEdad = null;
                                Swal.close();
                                setInitialState();
                            } else {
                                throw new Error(response.message || 'Error al cargar datos');
                            }
                        })
                        .catch(error => {
                            if (!error.responseJSON || error.responseJSON.message !== "No se encontraron registros para este usuario.") {
                                handleError(error);
                            } else {
                                formHasBeenSaved = false;
                                archivosCargados = {
                                    credencial_votar: '',
                                    declaracion_originalidad: '',
                                    consentimiento_expreso_adultos: '',
                                    identificacion_fotografia: '',
                                    carta_autorizacion: '',
                                    declaracion_originalidad_menores: '',
                                    comprobante_domicilio_tutor: '',
                                    consentimiento_expreso_menores: '',
                                    ine_tutor: ''
                                };
                                inicializarCamposArchivos(archivosCargados);
                                ocultarSeccionesDocumentos();
                                ultimaEdad = null;
                                Swal.close();
                                setInitialState();
                            }
                        });
                }

                $('#edad').on('focus', function () {
                    ultimaEdad = $(this).val();
                });

                $('#edad').on('change', function () {
                    const nuevaEdad = parseInt($(this).val(), 10);
                    const edadAnterior = parseInt(ultimaEdad, 10);

                    if (isNaN(nuevaEdad) || nuevaEdad === edadAnterior) {
                        mostrarSeccionPorEdad(nuevaEdad);
                        ultimaEdad = nuevaEdad;
                        return;
                    }

                    let camposLimpiar = [];
                    let mensaje = '';
                    let seccion = '';

                    if (edadAnterior >= 18 && nuevaEdad <= 17) {
                        camposLimpiar = camposAdultos;
                        mensaje = 'Al cambiar la edad a menor de edad, se perderán los datos y archivos cargados en la sección "Participantes mayores de edad". ¿Desea continuar?';
                        seccion = 'adultos';
                    } else if (edadAnterior <= 17 && nuevaEdad >= 18) {
                        camposLimpiar = camposMenores;
                        mensaje = 'Al cambiar la edad a mayor de edad, se perderán los datos y archivos cargados en la sección "Participantes menores de edad". ¿Desea continuar?';
                        seccion = 'menores';
                    } else {
                        mostrarSeccionPorEdad(nuevaEdad);
                        ultimaEdad = nuevaEdad;
                        return;
                    }

                    Swal.fire({
                        title: '¡Atención!',
                        text: mensaje,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, continuar',
                        cancelButtonText: 'Cancelar',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '../controlador/limpiar_seccion.php',
                                type: 'POST',
                                data: {
                                    curp: $('#curp').val(),
                                    seccion: seccion
                                },
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status === "success") {
                                        limpiarCampos(camposLimpiar);
                                        mostrarSeccionPorEdad(nuevaEdad);
                                        ultimaEdad = nuevaEdad;
                                        Swal.fire('Listo', 'La sección fue limpiada correctamente.', 'success');
                                    } else {
                                        Swal.fire('Error', response.message || 'No se pudo limpiar la sección en la base de datos.', 'error');
                                    }
                                },
                                error: function () {
                                    Swal.fire('Error', 'No se pudo limpiar la sección en la base de datos.', 'error');
                                }
                            });
                        } else {
                            $('#edad').val(edadAnterior);
                            mostrarSeccionPorEdad(edadAnterior);
                            ultimaEdad = edadAnterior;
                        }
                    });
                });

                // ==================== INICIALIZACIÓN ====================
                setInitialState();
                loadInitialData();
            });
        </script>
        <script>
            $(document).ready(function () {
                const $grupoArchivoEnsayo = $('#grupo_archivo_ensayo');
                const $inputArchivoEnsayo = $grupoArchivoEnsayo.find('input[type="file"]');
                const $fileSectionEnsayo = $grupoArchivoEnsayo.find('.input-file-section');
                const $archivoCargadoSectionEnsayo = $grupoArchivoEnsayo.find('.archivo-cargado-section');
                const $btnViewEnsayo = $grupoArchivoEnsayo.find('.btn-view-file');
                const $btnReloadEnsayo = $grupoArchivoEnsayo.find('.btn-reload-file');
                const $validFeedbackEnsayo = $fileSectionEnsayo.find('.valid-feedback');
                const $invalidFeedbackEnsayo = $fileSectionEnsayo.find('.invalid-feedback');

                $inputArchivoEnsayo.on('change', function () {
                    const file = this.files[0];
                    let valid = true;

                    if (file) {
                        if (file.type !== "application/pdf" && !file.name.toLowerCase().endsWith('.pdf')) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Archivo no válido',
                                text: 'Sólo se permite subir archivos en formato PDF.',
                            });
                            this.value = "";
                            valid = false;
                        } else if (file.size > 3 * 1024 * 1024) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Archivo demasiado grande',
                                text: 'El archivo debe pesar máximo 3 MB.',
                            });
                            this.value = "";
                            valid = false;
                        }
                    }

                    if (valid && file) {
                        $inputArchivoEnsayo.addClass('is-valid').removeClass('is-invalid');
                        $invalidFeedbackEnsayo.removeClass('d-block').addClass('d-none');
                        $validFeedbackEnsayo.removeClass('d-none').addClass('d-block');
                    } else {
                        $inputArchivoEnsayo.addClass('is-invalid').removeClass('is-valid');
                        $invalidFeedbackEnsayo.removeClass('d-none').addClass('d-block');
                        $validFeedbackEnsayo.removeClass('d-block').addClass('d-none');
                    }
                });

                $btnReloadEnsayo.off('click').on('click', function () {
                    Swal.fire({
                        title: '¿Volver a cargar archivo?',
                        text: 'Esto eliminará el archivo actual y te permitirá seleccionar uno nuevo. ¿Estás seguro?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, volver a cargar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $archivoCargadoSectionEnsayo.hide();
                            $fileSectionEnsayo.show();
                            $inputArchivoEnsayo.val('');
                        }
                    });
                });
            });
        </script>

        <script>
            function validarConfirmacionTelefonosSweetAlert() {
                $('#confirmarnumerofijo').on('blur', function () {
                    const fijo = $('#numerofijo').val();
                    const confirmarFijo = $('#confirmarnumerofijo').val();
                    if (confirmarFijo !== '' && fijo !== '' && fijo !== confirmarFijo) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Números fijos no coinciden',
                            text: 'El número fijo y su confirmación no son iguales. Corrige para continuar.',
                            confirmButtonText: 'Aceptar'
                        }).then(() => {
                            $('#confirmarnumerofijo').focus();
                        });
                    }
                });

                $('#confirmarnumeromovil').on('blur', function () {
                    const movil = $('#numeromovil').val();
                    const confirmarMovil = $('#confirmarnumeromovil').val();
                    if (confirmarMovil !== '' && movil !== '' && movil !== confirmarMovil) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Números móviles no coinciden',
                            text: 'El número móvil y su confirmación no son iguales. Corrige para continuar.',
                            confirmButtonText: 'Aceptar'
                        }).then(() => {
                            $('#confirmarnumeromovil').focus();
                        });
                    }
                });
            }

            $(document).ready(function () {
                validarConfirmacionTelefonosSweetAlert();
            });
        </script>
        <!-- ==================== CALCULAR EDAD DESDE FECHA DE NACIMIENTO ==================== -->
        <script>
            function calcularEdadDesdeFecha(fechaNacimiento) {
                if (!fechaNacimiento) return '';
                const hoy = new Date();
                const partes = fechaNacimiento.split('-');
                if (partes.length !== 3) return '';
                const nacimiento = new Date(partes[0], partes[1] - 1, partes[2]);
                let edad = hoy.getFullYear() - nacimiento.getFullYear();
                const m = hoy.getMonth() - nacimiento.getMonth();
                if (m < 0 || (m === 0 && hoy.getDate() < nacimiento.getDate())) {
                    edad--;
                }
                return edad > 0 ? edad : '';
            }

            $(document).ready(function () {
                $('#fechanacimiento').on('change', function () {
                    const fecha = $(this).val();
                    const edad = calcularEdadDesdeFecha(fecha);
                    $('#edad').val(edad).trigger('change');
                });
            });
            /* ==================== CALCULAR EDAD DESDE FECHA DE NACIMIENTO ==================== */
            function soloNumerosInput(selector) {
                $(document).on('input', selector, function () {
                    this.value = this.value.replace(/\D/g, '');
                });
            }

            $(document).ready(function () {
                soloNumerosInput('#edad, #numeroExterior, #numeroInterior, #cp, #numerofijo, #confirmarnumerofijo, #numeromovil, #confirmarnumeromovil');
            });
        </script>

        <script>

            $(document).ready(function () {
                $('input[name="discapacidad"]').on('change', function () {
                    if ($('#discapacidad_si').is(':checked')) {
                        $('#discapacidad_cual').prop('disabled', false).prop('required', true);
                        $('#tipo_discapacidad').prop('disabled', false).prop('required', true);
                    } else {
                        $('#discapacidad_cual').val('').prop('disabled', true).prop('required', false)
                            .removeClass('is-valid is-invalid');
                        $('#tipo_discapacidad').val('').prop('disabled', true).prop('required', false)
                            .removeClass('is-valid is-invalid');
                    }
                    actualizarProgreso && actualizarProgreso();
                });

                $('input[name="lengua_indigena"]').on('change', function () {
                    if ($('#lengua_si').is(':checked')) {
                        $('#lengua_cual').prop('disabled', false).prop('required', true);
                    } else {
                        $('#lengua_cual').val('').prop('disabled', true).prop('required', false)
                            .removeClass('is-valid is-invalid');
                    }
                    actualizarProgreso && actualizarProgreso();
                });

                $('input[name="comunidad_indigena"]').on('change', function () {
                    if ($('#comunidad_si').is(':checked')) {
                        $('#comunidad_cual').prop('disabled', false).prop('required', true);
                    } else {
                        $('#comunidad_cual').val('').prop('disabled', true).prop('required', false)
                            .removeClass('is-valid is-invalid');
                    }
                    actualizarProgreso && actualizarProgreso();
                });

                $('input[name="diversidad"]').on('change', function () {
                    if ($('#diversidad_si').is(':checked')) {
                        $('#diversidad_cual').prop('disabled', false).prop('required', true);
                    } else {
                        $('#diversidad_cual').val('').prop('disabled', true).prop('required', false)
                            .removeClass('is-valid is-invalid');
                    }
                    actualizarProgreso && actualizarProgreso();
                });

                $('input[name="discapacidad"]').trigger('change');
                $('input[name="lengua_indigena"]').trigger('change');
                $('input[name="auto_indigena"]').trigger('change');
                $('input[name="comunidad_indigena"]').trigger('change');
                $('input[name="diversidad"]').trigger('change');

                if (typeof actualizarProgreso === 'function') {
                    actualizarProgreso();
                }
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const correoInput = document.getElementById('correo');
                let alertaActiva = null;

                function esCorreoValido(correo) {
                    if (!correo) return false;
                    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                    return regex.test(correo);
                }

                function manejarAlerta(correo) {
                    if (alertaActiva !== null) return;

                    const esValido = esCorreoValido(correo);

                    if (!esValido && correo) {
                        alertaActiva = Swal.fire({
                            icon: 'error',
                            title: 'Correo no válido',
                            html: 'Por favor ingresa un correo electrónico válido.<br>Ejemplo: <strong>usuario@dominio.com</strong>',
                            confirmButtonText: 'Entendido',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then(() => {
                            alertaActiva = null;
                            correoInput.focus();
                        });
                    }
                }

                correoInput.addEventListener('blur', function () {
                    manejarAlerta(correoInput.value.trim());
                });

            });
        </script>

    </body>

    </html>
    <?php
}
?>