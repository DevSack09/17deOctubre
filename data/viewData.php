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
                /* Ajusta este valor según necesites */
            }

            .row>[class*="col-"]>section>.card.h-100 {
                height: 100%;
                display: flex;
                flex-direction: column;
            }

            .row {
                align-items: stretch;
            }

            .sidebar-toggler {
                position: relative;
                z-index: 10;
            }
        </style>
    </head>

    <body>
        <header class="header">
            <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow">
                <a class="sidebar-toggler text-gray-500 me-4 me-lg-5 lead" href="#" onclick="history.back(); return false;">
                    <i class="fas fa-arrow-left"></i>
                </a>
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
            <div class="page-holder bg-gray-100">
                <div class="container-fluid px-lg-4 px-xl-5">
                    <!-- Page Header-->
                    <div class="page-header">
                        <h1 class="page-heading text-center">consulta de información</h1>
                    </div>
                    <div class="row">
                        <!-- Formulario: ocupa la mitad en pantallas grandes, 100% en pantallas chicas -->
                        <div class="col-12 col-lg-7 mb-4">
                            <!-- formulario -->
                            <section>
                                <div class="card h-100">
                                    <div class="card-header">
                                        <div class="row g-5">
                                            <div class="col-xl-4 col-md-6">
                                                <h6 class="subtitle fw-normal text-muted">Folio</h6>
                                                <h5 class="m-b-25">(folio)<span class="ms-3 float-end text-red">(icono)
                                                    </span>
                                                </h5>
                                            </div>
                                            <div class="col-xl-4 col-md-6">
                                                <h6 class="subtitle fw-normal text-muted">Estatus</h6>
                                                <h5 class="m-b-25">(Estatus)<span
                                                        class="ms-3 float-end text-blue">(icono)</span>
                                                </h5>
                                            </div>
                                            <div class="col-xl-4 col-md-6">
                                                <h6 class="subtitle fw-normal text-muted">Encuesta</h6>
                                                <h5 class="m-b-25">(Encuesta)<span
                                                        class="ms-3 float-end text-primary">(icono)</span>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form class="g-3 needs-validation" id="formRegistro"
                                            action="../controlador/controlador_form.php" method="post"
                                            enctype="multipart/form-data" novalidate>
                                            <!-- Curp -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="curp">CURP <span
                                                        class="required">*</span></label>
                                                <div class="input-icon">
                                                    <i class="fas fa-id-card"></i>
                                                    <input class="form-control" id="curp" name="curp" type="text"
                                                        placeholder="Ej. RAMJ920313HDFRMR01" required minlength="18"
                                                        maxlength="18" data-validacion-manual="true" onblur="validarCurp()"
                                                        disabled>
                                                </div>
                                                <div id="curp-feedback" class="text-danger mt-2" style="display: none;">
                                                    <!-- Mensaje de error se mostrará aquí -->
                                                </div>
                                                <div class="valid-feedback"></div>
                                                <div class="invalid-feedback">Por favor, introduzca su CURP.</div>
                                            </div>

                                            <!-- Alertas -->
                                            <div id="alert-container" style="position: relative; margin-top: 20px;">
                                                <!-- Aquí se mostrarán las alertas -->
                                            </div>

                                            <div class="accordion" id="accordionExample">
                                                <!-- Datos personales -->
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingDatosPersonales">
                                                        <button class="accordion-button fw-bold fs-5" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseDatosPersonales" aria-expanded="true"
                                                            aria-controls="collapseDatosPersonales">
                                                            Datos personales
                                                        </button>
                                                    </h2>
                                                    <div id="collapseDatosPersonales"
                                                        class="accordion-collapse collapse show"
                                                        aria-labelledby="headingDatosPersonales"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row mb-3">
                                                                <div class="col-md-4">
                                                                    <label class="form-label" for="apellidopaterno">Primer
                                                                        apellido
                                                                        <span class="required">*</span></label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-user-tag"></i>
                                                                        <input class="form-control" id="apellidopaterno"
                                                                            type="text" placeholder="Ej. Ramirez"
                                                                            name="apellidopaterno" disabled required>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                    <div class="invalid-feedback">Por favor, introduzca su
                                                                        primer
                                                                        apellido.
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label" for="apellidomaterno">Segundo
                                                                        apellido</label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-user-tag"></i>
                                                                        <input class="form-control" id="apellidomaterno"
                                                                            type="text" placeholder="Ej. Pérez"
                                                                            name="apellidomaterno" disabled>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                    <div class="invalid-feedback">Por favor, introduzca su
                                                                        segundo
                                                                        apellido.
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label" for="nombre">Nombre(s) <span
                                                                            class="required">*</span></label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-user"></i>
                                                                        <input class="form-control" id="nombre" type="text"
                                                                            placeholder="Ej. Juan" name="nombre" disabled
                                                                            required>
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
                                                                        <input class="form-control" id="fechanacimiento"
                                                                            type="date" name="fechanacimiento" disabled
                                                                            required>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                    <div class="invalid-feedback">Por favor, introduzca su
                                                                        fecha
                                                                        de
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
                                                                    <div class="invalid-feedback">Por favor, introduzca su
                                                                        edad.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Domicilio -->
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingDomicilio">
                                                        <button class="accordion-button fw-bold fs-5 collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseDomicilio" aria-expanded="false"
                                                            aria-controls="collapseDomicilio">
                                                            Domicilio
                                                        </button>
                                                    </h2>
                                                    <div id="collapseDomicilio" class="accordion-collapse collapse"
                                                        aria-labelledby="headingDomicilio"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row mb-3">
                                                                <div class="col-md-4">
                                                                    <label class="form-label" for="calle">Calle <span
                                                                            class="required">*</span></label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-road"></i>
                                                                        <input class="form-control" id="calle" name="calle"
                                                                            type="text" placeholder="Ej. Reforma" required
                                                                            disabled>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                    <div class="invalid-feedback">Por favor, introduzca su
                                                                        calle.
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label" for="numeroExterior">No.
                                                                        Exterior
                                                                        <span class="required">*</span></label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-door-open"></i>
                                                                        <input class="form-control" id="numeroExterior"
                                                                            name="numeroExterior" type="text"
                                                                            placeholder="Ej. 123" required disabled>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                    <div class="invalid-feedback">Por favor, introduzca el
                                                                        número
                                                                        exterior.</div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label" for="numeroInterior">No.
                                                                        Interior</label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-door-closed"></i>
                                                                        <input class="form-control" id="numeroInterior"
                                                                            name="numeroInterior" type="text"
                                                                            placeholder="Ej. 4B" disabled>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                    <div class="invalid-feedback">Por favor, introduzca el
                                                                        número
                                                                        interior.</div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label" for="colonia">Colonia <span
                                                                            class="required">*</span></label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-city"></i>
                                                                        <input class="form-control" id="colonia"
                                                                            name="colonia" type="text"
                                                                            placeholder="Ej. Centro" required disabled>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                    <div class="invalid-feedback">Por favor, introduzca su
                                                                        colonia.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-3">
                                                                    <label class="form-label" for="cp">Código Postal <span
                                                                            class="required">*</span></label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-mail-bulk"></i>
                                                                        <input class="form-control" id="cp" name="cp"
                                                                            type="text" placeholder="Ej. 42000" required
                                                                            minlength="5" maxlength="5" disabled>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                    <div class="invalid-feedback">Por favor, introduzca su
                                                                        código
                                                                        postal.</div>
                                                                    <div class="invalid-feedback min-max-length">El código
                                                                        postal
                                                                        debe tener 5 dígitos.</div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label" for="municipio">Municipio
                                                                        <span class="required">*</span></label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-map"></i>
                                                                        <select class="form-control" id="municipio"
                                                                            name="municipio" required disabled>
                                                                            <option selected disabled value="">Seleccione un
                                                                                municipio</option>
                                                                            <option value="Acatlán">Acatlán</option>
                                                                            <option value="Acaxochitlán">Acaxochitlán
                                                                            </option>
                                                                            <option value="Actopan">Actopan</option>
                                                                            <option value="Agua Blanca de Iturbide">Agua
                                                                                Blanca
                                                                                de
                                                                                Iturbide</option>
                                                                            <option value="Ajacuba">Ajacuba</option>
                                                                            <option value="Alfajayucan">Alfajayucan</option>
                                                                            <option value="Almoloya">Almoloya</option>
                                                                            <option value="Apan">Apan</option>
                                                                            <option value="El Arenal">El Arenal</option>
                                                                            <option value="Atitalaquia">Atitalaquia</option>
                                                                            <option value="Atlapexco">Atlapexco</option>
                                                                            <option value="Atotonilco el Grande">Atotonilco
                                                                                el
                                                                                Grande</option>
                                                                            <option value="Atotonilco de Tula">Atotonilco de
                                                                                Tula
                                                                            </option>
                                                                            <option value="Calnali">Calnali</option>
                                                                            <option value="Cardonal">Cardonal</option>
                                                                            <option value="Cuautepec de Hinojosa">Cuautepec
                                                                                de
                                                                                Hinojosa</option>
                                                                            <option value="Chapantongo">Chapantongo</option>
                                                                            <option value="Chapulhuacán">Chapulhuacán
                                                                            </option>
                                                                            <option value="Chilcuautla">Chilcuautla</option>
                                                                            <option value="Eloxochitlán">Eloxochitlán
                                                                            </option>
                                                                            <option value="Emiliano Zapata">Emiliano Zapata
                                                                            </option>
                                                                            <option value="Epazoyucan">Epazoyucan</option>
                                                                            <option value="Francisco I. Madero">Francisco I.
                                                                                Madero
                                                                            </option>
                                                                            <option value="Huasca de Ocampo">Huasca de
                                                                                Ocampo
                                                                            </option>
                                                                            <option value="Huautla">Huautla</option>
                                                                            <option value="Huazalingo">Huazalingo</option>
                                                                            <option value="Huehuetla">Huehuetla</option>
                                                                            <option value="Huejutla de Reyes">Huejutla de
                                                                                Reyes
                                                                            </option>
                                                                            <option value="Huichapan">Huichapan</option>
                                                                            <option value="Ixmiquilpan">Ixmiquilpan</option>
                                                                            <option value="Jacala de Ledezma">Jacala de
                                                                                Ledezma
                                                                            </option>
                                                                            <option value="Jaltocán">Jaltocán</option>
                                                                            <option value="Juárez Hidalgo">Juárez Hidalgo
                                                                            </option>
                                                                            <option value="Lolotla">Lolotla</option>
                                                                            <option value="Metepec">Metepec</option>
                                                                            <option value="San Agustín Metzquititlán">San
                                                                                Agustín
                                                                                Metzquititlán</option>
                                                                            <option value="Metztitlán">Metztitlán</option>
                                                                            <option value="Mineral del Chico">Mineral del
                                                                                Chico
                                                                            </option>
                                                                            <option value="Mineral del Monte">Mineral del
                                                                                Monte
                                                                            </option>
                                                                            <option value="La Misión">La Misión</option>
                                                                            <option value="Mixquiahuala de Juárez">
                                                                                Mixquiahuala
                                                                                de
                                                                                Juárez</option>
                                                                            <option value="Molango de Escamilla">Molango de
                                                                                Escamilla</option>
                                                                            <option value="Nicolás Flores">Nicolás Flores
                                                                            </option>
                                                                            <option value="Nopala de Villagrán">Nopala de
                                                                                Villagrán
                                                                            </option>
                                                                            <option value="Omitlán de Juárez">Omitlán de
                                                                                Juárez
                                                                            </option>
                                                                            <option value="San Felipe Orizatlán">San Felipe
                                                                                Orizatlán</option>
                                                                            <option value="Pacula">Pacula</option>
                                                                            <option value="Pachuca de Soto">Pachuca de Soto
                                                                            </option>
                                                                            <option value="Pisaflores">Pisaflores</option>
                                                                            <option value="Progreso de Obregón">Progreso de
                                                                                Obregón
                                                                            </option>
                                                                            <option value="Mineral de la Reforma">Mineral de
                                                                                la
                                                                                Reforma</option>
                                                                            <option value="San Agustín Tlaxiaca">San Agustín
                                                                                Tlaxiaca</option>
                                                                            <option value="San Bartolo Tutotepec">San
                                                                                Bartolo
                                                                                Tutotepec</option>
                                                                            <option value="San Salvador">San Salvador
                                                                            </option>
                                                                            <option value="Santiago de Anaya">Santiago de
                                                                                Anaya
                                                                            </option>
                                                                            <option
                                                                                value="Santiago Tulantepec de Lugo Guerrero">
                                                                                Santiago Tulantepec de Lugo Guerrero
                                                                            </option>
                                                                            <option value="Singuilucan">Singuilucan</option>
                                                                            <option value="Tasquillo">Tasquillo</option>
                                                                            <option value="Tecozautla">Tecozautla</option>
                                                                            <option value="Tenango de Doria">Tenango de
                                                                                Doria
                                                                            </option>
                                                                            <option value="Tepeapulco">Tepeapulco</option>
                                                                            <option value="Tepehuacán de Guerrero">
                                                                                Tepehuacán de
                                                                                Guerrero</option>
                                                                            <option value="Tepeji del Río de Ocampo">Tepeji
                                                                                del
                                                                                Río
                                                                                de Ocampo</option>
                                                                            <option value="Tepetitlán">Tepetitlán</option>
                                                                            <option value="Tetepango">Tetepango</option>
                                                                            <option value="Villa de Tezontepec">Villa de
                                                                                Tezontepec
                                                                            </option>
                                                                            <option value="Tezontepec de Aldama">Tezontepec
                                                                                de
                                                                                Aldama</option>
                                                                            <option value="Tianguistengo">Tianguistengo
                                                                            </option>
                                                                            <option value="Tizayuca">Tizayuca</option>
                                                                            <option value="Tlahuelilpan">Tlahuelilpan
                                                                            </option>
                                                                            <option value="Tlahuiltepa">Tlahuiltepa</option>
                                                                            <option value="Tlanalapa">Tlanalapa</option>
                                                                            <option value="Tlanchinol">Tlanchinol</option>
                                                                            <option value="Tlaxcoapan">Tlaxcoapan</option>
                                                                            <option value="Tolcayuca">Tolcayuca</option>
                                                                            <option value="Tula de Allende">Tula de Allende
                                                                            </option>
                                                                            <option value="Tulancingo de Bravo">Tulancingo
                                                                                de
                                                                                Bravo
                                                                            </option>
                                                                            <option value="Xochiatipan">Xochiatipan</option>
                                                                            <option value="Xochicoatlán">Xochicoatlán
                                                                            </option>
                                                                            <option value="Yahualica">Yahualica</option>
                                                                            <option value="Zacualtipán de Ángeles">
                                                                                Zacualtipán
                                                                                de
                                                                                Ángeles</option>
                                                                            <option value="Zapotlán de Juárez">Zapotlán de
                                                                                Juárez
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
                                                                    <label class="form-label" for="localidad">Localidad
                                                                        <span class="required">*</span></label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-map-pin"></i>
                                                                        <input class="form-control" id="localidad"
                                                                            name="localidad" type="text"
                                                                            placeholder="Ej. Pachuca de Soto" required
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
                                                        <button class="accordion-button fw-bold fs-5 collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseEstudios" aria-expanded="false"
                                                            aria-controls="collapseEstudios">
                                                            Estudios
                                                        </button>
                                                    </h2>
                                                    <div id="collapseEstudios" class="accordion-collapse collapse"
                                                        aria-labelledby="headingEstudios"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row mb-3">
                                                                <!-- Último grado de estudios -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="gradoEstudios">¿Último
                                                                        grado
                                                                        de
                                                                        estudios que concluyó?
                                                                        <span class="required">*</span></label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-graduation-cap"></i>
                                                                        <select class="form-control" id="gradoEstudios"
                                                                            name="gradoEstudios" required disabled>
                                                                            <option value="">Seleccione una opción</option>
                                                                            <option value="Secundaria">Secundaria</option>
                                                                            <option value="Bachillerato">Bachillerato
                                                                            </option>
                                                                            <option value="Licenciatura">Licenciatura
                                                                            </option>
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
                                                                    <label class="form-label" for="ocupacionActual">¿Cuál es
                                                                        su
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
                                                        <button class="accordion-button fw-bold fs-5 collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseEstudiosActuales" aria-expanded="false"
                                                            aria-controls="collapseEstudiosActuales">
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
                                                                    <label class="form-label"
                                                                        for="gradoActual">Grado</label>
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
                                                                    <label class="form-label"
                                                                        for="cargoActual">Cargo</label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-user-tie"></i>
                                                                        <input class="form-control" id="cargoActual"
                                                                            name="cargoActual" type="text"
                                                                            placeholder="Ej. Asistente administrativo"
                                                                            disabled>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                    <div class="invalid-feedback">Campo no válido.</div>
                                                                </div>
                                                            </div>

                                                            <!-- Centro de Estudios o Lugar de Trabajo -->
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="centroEstudiosTrabajo">
                                                                        Nombre del centro de estudios y/o lugar de trabajo
                                                                        <span class="required">*</span>
                                                                    </label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-school"></i>
                                                                        <input class="form-control"
                                                                            id="centroEstudiosTrabajo"
                                                                            name="centroEstudiosTrabajo" type="text"
                                                                            placeholder="Ej. Universidad Autónoma de Hidalgo"
                                                                            required disabled>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                    <div class="invalid-feedback">
                                                                        Por favor, introduzca Nombre del centro de estudios
                                                                        y/o
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
                                                        <button class="accordion-button fw-bold fs-5 collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseDatosContacto" aria-expanded="false"
                                                            aria-controls="collapseDatosContacto">
                                                            Datos de contacto
                                                        </button>
                                                    </h2>
                                                    <div id="collapseDatosContacto" class="accordion-collapse collapse"
                                                        aria-labelledby="headingDatosContacto"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row mb-3">
                                                                <!-- Correo Electrónico -->
                                                                <div class="col-md-4">
                                                                    <label class="form-label" for="correo">
                                                                        Correo electrónico <span class="required">*</span>
                                                                    </label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-envelope"></i>
                                                                        <input class="form-control" id="correo"
                                                                            name="correo" type="email"
                                                                            placeholder="Ej. ejemplo@correo.com" required
                                                                            disabled>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                    <div class="invalid-feedback">
                                                                        Por favor, introduzca un correo válido.
                                                                    </div>
                                                                </div>

                                                                <!-- Número Fijo -->
                                                                <div class="col-md-4">
                                                                    <label class="form-label" for="numerofijo">Número
                                                                        fijo</label>
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
                                                                <!-- Número Móvil -->
                                                                <div class="col-md-4">
                                                                    <label class="form-label" for="numeromovil">
                                                                        Número móvil <span class="required">*</span>
                                                                    </label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-mobile-alt"></i>
                                                                        <input class="form-control" id="numeromovil"
                                                                            name="numeromovil" type="text"
                                                                            placeholder="Ej. XXXXXXXXXX" required
                                                                            minlength="10" maxlength="10" disabled>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                    <div class="invalid-feedback">
                                                                        Por favor, introduzca su número móvil.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Redes Sociales -->
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingRedesSociales">
                                                        <button class="accordion-button fw-bold fs-5 collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseRedesSociales" aria-expanded="false"
                                                            aria-controls="collapseRedesSociales">
                                                            Redes sociales
                                                        </button>
                                                    </h2>
                                                    <div id="collapseRedesSociales" class="accordion-collapse collapse"
                                                        aria-labelledby="headingRedesSociales"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row mb-3">
                                                                <!-- Facebook -->
                                                                <div class="col-md-3">
                                                                    <label class="form-label"
                                                                        for="facebook">Facebook</label>
                                                                    <div class="input-icon">
                                                                        <i class="fab fa-facebook-f"></i>
                                                                        <input class="form-control" id="facebook"
                                                                            name="facebook" type="text"
                                                                            placeholder="Ej. facebook.com/tuusuario"
                                                                            disabled>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                </div>

                                                                <!-- TikTok -->
                                                                <div class="col-md-3">
                                                                    <label class="form-label" for="tiktok">TikTok</label>
                                                                    <div class="input-icon">
                                                                        <i class="fab fa-tiktok"></i>
                                                                        <input class="form-control" id="tiktok"
                                                                            name="tiktok" type="text"
                                                                            placeholder="Ej. tiktok.com/@tuusuario"
                                                                            disabled>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                </div>

                                                                <!-- Instagram -->
                                                                <div class="col-md-3">
                                                                    <label class="form-label"
                                                                        for="instagram">Instagram</label>
                                                                    <div class="input-icon">
                                                                        <i class="fab fa-instagram"></i>
                                                                        <input class="form-control" id="instagram"
                                                                            name="instagram" type="text"
                                                                            placeholder="Ej. instagram.com/tuusuario"
                                                                            disabled>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                </div>

                                                                <!-- Otra red social -->
                                                                <div class="col-md-3">
                                                                    <label class="form-label" for="otra">Otra</label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-globe"></i>
                                                                        <input class="form-control" id="otra"
                                                                            name="otraRedSocial" type="text"
                                                                            placeholder="Otra red social o enlace" disabled>
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
                                                        <button class="accordion-button fw-bold fs-5 collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseEnsayo" aria-expanded="false"
                                                            aria-controls="collapseEnsayo">
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
                                                                        Seudónimo con el que se identificará durante el
                                                                        desarrollo
                                                                        de este concurso:
                                                                        <span class="required">*</span>
                                                                    </label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-user-secret"></i>
                                                                        <input class="form-control" id="seudonimo"
                                                                            name="seudonimo" type="text"
                                                                            placeholder="Ej. PlumaLibre" required disabled>
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
                                                                            placeholder="Título de tu ensayo" required
                                                                            disabled>
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
                                                                        <select class="form-control" id="categoria"
                                                                            name="categoria" required disabled>
                                                                            <option value="" disabled selected>Seleccione
                                                                                una
                                                                                categoría</option>
                                                                            <option value="Letras jóvenes">Letras jóvenes
                                                                                (15-19
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Acciones afirmativas -->
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingAccionesAfirmativas">
                                                        <button class="accordion-button fw-bold fs-5 collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseAccionesAfirmativas"
                                                            aria-expanded="false"
                                                            aria-controls="collapseAccionesAfirmativas">
                                                            Acciones afirmativas
                                                        </button>
                                                    </h2>
                                                    <div id="collapseAccionesAfirmativas"
                                                        class="accordion-collapse collapse"
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
                                                                            name="discapacidad" id="discapacidad_si"
                                                                            value="sí" required disabled />
                                                                        <label class="form-check-label"
                                                                            for="discapacidad_si">Sí</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="discapacidad" id="discapacidad_no"
                                                                            value="no" required disabled />
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
                                                                    <label class="form-label"
                                                                        for="discapacidad_cual">¿Cuál?</label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-wheelchair"></i>
                                                                        <input type="text" class="form-control"
                                                                            id="discapacidad_cual" name="discapacidad_cual"
                                                                            required disabled />
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                    <div class="invalid-feedback">
                                                                        Este campo es obligatorio.
                                                                    </div>
                                                                </div>

                                                                <!-- Tipo de discapacidad -->
                                                                <div class="col-md-4">
                                                                    <label class="form-label" for="tipo_discapacidad">¿De
                                                                        qué
                                                                        tipo
                                                                        es?</label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-universal-access"></i>
                                                                        <select class="form-control" id="tipo_discapacidad"
                                                                            name="tipo_discapacidad" required disabled>
                                                                            <option value="" disabled selected>
                                                                                Seleccione una opción
                                                                            </option>
                                                                            <option value="física o motora">
                                                                                Física o motora
                                                                            </option>
                                                                            <option value="sensorial">Sensorial</option>
                                                                            <option value="intelectual">
                                                                                Intelectual
                                                                            </option>
                                                                            <option value="mental">Mental</option>
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
                                                                    <label class="form-label d-block">¿Habla alguna lengua
                                                                        indígena?
                                                                        <span class="required">*</span></label>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="lengua_indigena" id="lengua_si" value="sí"
                                                                            required disabled />
                                                                        <label class="form-check-label"
                                                                            for="lengua_si">Sí</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="lengua_indigena" id="lengua_no" value="no"
                                                                            required disabled />
                                                                        <label class="form-check-label"
                                                                            for="lengua_no">No</label>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                    <div class="invalid-feedback">
                                                                        Este campo es obligatorio.
                                                                    </div>
                                                                </div>

                                                                <!-- ¿Cuál es la lengua? -->
                                                                <div class="col-md-4">
                                                                    <label class="form-label"
                                                                        for="lengua_cual">¿Cuál?</label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-language"></i>
                                                                        <input type="text" class="form-control"
                                                                            id="lengua_cual" name="lengua_cual" required
                                                                            disabled />
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
                                                                            name="auto_indigena" id="auto_indigena_si"
                                                                            value="sí" required disabled />
                                                                        <label class="form-check-label"
                                                                            for="auto_indigena_si">Sí</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="auto_indigena" id="auto_indigena_no"
                                                                            value="no" required disabled />
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
                                                                    <label class="form-label d-block">¿Forma parte de una
                                                                        comunidad
                                                                        indígena?
                                                                        <span class="required">*</span></label>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="comunidad_indigena" id="comunidad_si"
                                                                            value="sí" required disabled />
                                                                        <label class="form-check-label"
                                                                            for="comunidad_si">Sí</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="comunidad_indigena" id="comunidad_no"
                                                                            value="no" required disabled />
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
                                                                    <label class="form-label"
                                                                        for="comunidad_cual">¿Cuál?</label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-users"></i>
                                                                        <input type="text" class="form-control"
                                                                            id="comunidad_cual" name="comunidad_cual"
                                                                            required disabled />
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
                                                                    <label class="form-label d-block">¿Se autoadscribe como
                                                                        persona
                                                                        de la diversidad
                                                                        sexual y de género?
                                                                        <span class="required">*</span></label>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="diversidad" id="diversidad_si" value="sí"
                                                                            required disabled />
                                                                        <label class="form-check-label"
                                                                            for="diversidad_si">Sí</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="diversidad" id="diversidad_no" value="no"
                                                                            required disabled />
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
                                                                    <label class="form-label"
                                                                        for="diversidad_cual">¿Cuál?</label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-rainbow"></i>
                                                                        <input type="text" class="form-control"
                                                                            id="diversidad_cual" name="diversidad_cual"
                                                                            required disabled />
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
                                                                    <label class="form-label" for="medio_convocatoria">¿Cómo
                                                                        se
                                                                        enteró de la convocatoria?
                                                                        <span class="required">*</span></label>
                                                                    <div class="input-icon">
                                                                        <i class="fas fa-bullhorn"></i>
                                                                        <select class="form-control" id="medio_convocatoria"
                                                                            name="medio_convocatoria" required disabled>
                                                                            <option value="" disabled selected>
                                                                                Seleccione una opción
                                                                            </option>
                                                                            <option value="pagina web">Página web</option>
                                                                            <option value="rrss">RRSS</option>
                                                                            <option value="cartel">Cartel</option>
                                                                            <option value="platica informativa">
                                                                                Plática informativa
                                                                            </option>
                                                                            <option value="publicacion">
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
                                                        <button class="accordion-button fw-bold fs-5 collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseTerminos" aria-expanded="false"
                                                            aria-controls="collapseTerminos">
                                                            Términos
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTerminos" class="accordion-collapse collapse"
                                                        aria-labelledby="headingTerminos"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <!-- Aceptación del Aviso de Privacidad Integral -->
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="terminos_privacidad"
                                                                            name="terminos_privacidad" disabled required>
                                                                        <label class="form-check-label"
                                                                            for="terminos_privacidad">
                                                                            He leído y comprendo los términos del
                                                                            <a href="Docs/Todos/API 2025.pdf"
                                                                                target="_blank">
                                                                                Aviso de Privacidad Integral
                                                                            </a>.
                                                                        </label>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                    <div class="invalid-feedback">Debe aceptar los términos
                                                                        del
                                                                        Aviso de Privacidad Integral.</div>
                                                                </div>
                                                            </div>

                                                            <!-- Aceptación del Formato para Otorgar Consentimiento Expreso -->
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="terminos_consentimiento"
                                                                            name="terminos_consentimiento" disabled
                                                                            required>
                                                                        <label class="form-check-label"
                                                                            for="terminos_consentimiento">
                                                                            He leído y comprendo los términos de
                                                                            <a href="Docs/Mayores/CONSENTIMIENTO EXPRESO PREMIO 17 OCTUBRE.pdf"
                                                                                target="_blank">
                                                                                Formato para Otorgar Consentimiento Expreso
                                                                            </a>.
                                                                        </label>
                                                                    </div>
                                                                    <div class="valid-feedback">Muy bien!</div>
                                                                    <div class="invalid-feedback">Debe aceptar los términos
                                                                        del
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
                        <!-- Visor de documentos: ocupa la mitad en pantallas grandes, 100% en pantallas chicas -->
                        <div class="col-12 col-lg-5 mb-4">
                            <!-- visor de documentos -->
                            <section>
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="card-heading">Visualización de documentos</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-12">
                                            <label class="form-label" for="viewDocument">Documento:</label>
                                            <div class="input-icon">
                                                <i class="fas fa-book"></i>
                                                <select class="form-control" id="viewDocument" name="viewDocument">
                                                    <option selected disabled value="">Seleccione una opción</option>
                                                </select>
                                            </div>
                                            <div id="visorDocumento" class="mt-3"></div>
                                        </div>
                                    </div>
                                </div>
                            </section>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Main Theme JS File-->
        <script src="js/theme.js"></script>
        <script src="../js/darkLight.js"></script>
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
        <script>
            $(document).ready(function () {
                // Obtener el parámetro usuario_id de la URL
                function getParameterByName(name) {
                    const url = window.location.href;
                    name = name.replace(/[\[\]]/g, '\\$&');
                    const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
                    const results = regex.exec(url);
                    if (!results) return null;
                    if (!results[2]) return '';
                    return decodeURIComponent(results[2].replace(/\+/g, ' '));
                }

                const usuario_id = getParameterByName('usuario_id');
                if (!usuario_id) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se proporcionó el usuario_id.'
                    });
                    return;
                }

                // Solicitar la información del registro usando getInformation.php
                $.ajax({
                    url: '../controlador/dashboard/getInformation.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { usuario_id: usuario_id },
                    success: function (response) {
                        if (response.status === 'success') {
                            const data = response.data;
                            // Llena los campos del formulario con los datos recibidos
                            $('#curp').val(data.curp);
                            $('#nombre').val(data.nombre);
                            $('#apellidopaterno').val(data.apellidoP);
                            $('#apellidomaterno').val(data.apellidoM);
                            $('#fechanacimiento').val(data.fecha_nacimiento);
                            $('#edad').val(data.edad);
                            $('#calle').val(data.calle);
                            $('#numeroExterior').val(data.numeroExterior);
                            $('#numeroInterior').val(data.numeroInterior);
                            $('#colonia').val(data.colonia);
                            $('#cp').val(data.cp);
                            $('#municipio').val(data.municipio);
                            $('#localidad').val(data.localidad);
                            $('#gradoEstudios').val(data.gradoEstudios);
                            $('#ocupacionActual').val(data.ocupacionActual);
                            $('#gradoActual').val(data.gradoActual);
                            $('#estudiosActuales').val(data.estudiosActuales);
                            $('#cargoActual').val(data.cargoActual);
                            $('#centroEstudiosTrabajo').val(data.centroEstudiosTrabajo);
                            $('#correo').val(data.correo);
                            $('#numerofijo').val(data.numerofijo);
                            $('#numeromovil').val(data.numeromovil);
                            $('#facebook').val(data.facebook);
                            $('#tiktok').val(data.tiktok);
                            $('#instagram').val(data.instagram);
                            $('#otra').val(data.otraRedSocial);
                            $('#seudonimo').val(data.seudonimo);
                            $('#titulo_ensayo').val(data.titulo_ensayo);
                            $('#categoria').val(data.categoria);

                            // Acciones afirmativas
                            if (data.discapacidad === "sí") {
                                $('#discapacidad_si').prop('checked', true);
                            } else if (data.discapacidad === "no") {
                                $('#discapacidad_no').prop('checked', true);
                            }
                            $('#discapacidad_cual').val(data.discapacidad_cual);
                            $('#tipo_discapacidad').val(data.tipo_discapacidad);

                            if (data.lengua_indigena === "sí") {
                                $('#lengua_si').prop('checked', true);
                            } else if (data.lengua_indigena === "no") {
                                $('#lengua_no').prop('checked', true);
                            }
                            $('#lengua_cual').val(data.lengua_cual);

                            if (data.auto_indigena === "sí") {
                                $('#auto_indigena_si').prop('checked', true);
                            } else if (data.auto_indigena === "no") {
                                $('#auto_indigena_no').prop('checked', true);
                            }

                            if (data.comunidad_indigena === "sí") {
                                $('#comunidad_si').prop('checked', true);
                            } else if (data.comunidad_indigena === "no") {
                                $('#comunidad_no').prop('checked', true);
                            }
                            $('#comunidad_cual').val(data.comunidad_cual);

                            if (data.diversidad === "sí") {
                                $('#diversidad_si').prop('checked', true);
                            } else if (data.diversidad === "no") {
                                $('#diversidad_no').prop('checked', true);
                            }
                            $('#diversidad_cual').val(data.diversidad_cual);

                            $('#medio_convocatoria').val(data.medio_convocatoria);

                            // Terminos y consentimientos
                            $('#terminos_privacidad').prop('checked', data.acepta_privacidad == 1 || data.acepta_privacidad === true || data.acepta_privacidad === "1");
                            $('#terminos_consentimiento').prop('checked', data.acepta_consentimiento == 1 || data.acepta_consentimiento === true || data.acepta_consentimiento === "1");

                            // Agrega esto dentro del success del AJAX, después de llenar los campos del formulario y de actualizar el header:

                            // 1. Mapea los archivos y nombres a mostrar
                            const archivos = [
                                { campo: 'archivo_ensayo', nombre: 'Ensayo' },
                                { campo: 'credencial_votar', nombre: 'Credencial para votar' },
                                { campo: 'declaracion_originalidad', nombre: 'Declaración de originalidad' },
                                { campo: 'consentimiento_expreso_adultos', nombre: 'Consentimiento expreso adultos' },
                                { campo: 'identificacion_fotografia', nombre: 'Identificación con fotografía' },
                                { campo: 'carta_autorizacion', nombre: 'Carta de autorización' },
                                { campo: 'declaracion_originalidad_menores', nombre: 'Declaración de originalidad menores' },
                                { campo: 'comprobante_domicilio_tutor', nombre: 'Comprobante de domicilio tutor' },
                                { campo: 'consentimiento_expreso_menores', nombre: 'Consentimiento expreso menores' },
                                { campo: 'ine_tutor', nombre: 'INE tutor' }
                            ];

                            // 2. Llena el select con los archivos existentes
                            let options = '<option selected disabled value="">Seleccione una opción</option>';
                            archivos.forEach(a => {
                                if (data[a.campo]) {
                                    // Solo muestra si existe archivo
                                    options += `<option value="${data[a.campo]}">${a.nombre}</option>`;
                                }
                            });
                            $('#viewDocument').html(options);

                            // 3. Evento para visualizar el archivo seleccionado debajo del select
                            $('#viewDocument').off('change').on('change', function () {
                                const fileUrl = $(this).val();
                                let visor = '';
                                if (fileUrl) {
                                    // Si es PDF, usa <iframe>, si es imagen, usa <img>
                                    const ext = fileUrl.split('.').pop().toLowerCase();
                                    if (ext === 'pdf') {
                                        visor = `<iframe src="../${fileUrl}" width="100%" height="750px" style="border:1px solid #ccc;"></iframe>`;
                                    } else if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
                                        visor = `<img src="../${fileUrl}" alt="Documento" style="max-width:100%;max-height:750px;border:1px solid #ccc;">`;
                                    } else {
                                        visor = `<a href="../${fileUrl}" target="_blank">Ver archivo</a>`;
                                    }
                                }
                                // Si no existe el contenedor, lo crea
                                if ($('#visorDocumento').length === 0) {
                                    $('#viewDocument').parent().after('<div id="visorDocumento" class="mt-3"></div>');
                                }
                                $('#visorDocumento').html(visor);
                            });

                            // Agrega esto dentro del success del AJAX, después de llenar los campos del formulario:
                            const folio = data.folio || '';
                            const estatus = (data.status == 1) ? 'Finalizado' : 'Pendiente';
                            const encuesta = (data.status == 1) ? 'Realizada' : 'No finalizada';

                            // Iconos y colores personalizados
                            let iconFolio = '<i class="fas fa-hashtag text-secondary"></i>';
                            let iconEstatus = (estatus === 'Finalizado')
                                ? '<i class="fas fa-check-circle text-success"></i>'
                                : '<i class="fas fa-clock text-warning"></i>';
                            let iconEncuesta = (encuesta === 'Realizada')
                                ? '<i class="fas fa-poll text-success"></i>'
                                : '<i class="fas fa-times-circle text-danger"></i>';

                            // HTML con hr vertical usando utilidades de Bootstrap
                            // HTML con hr vertical usando utilidades de Bootstrap, todo en una sola línea
                            $('.card-header .row.g-5').html(`
                                <div class="col-xl-4 col-md-6 d-flex align-items-center">
                                    <h6 class="subtitle fw-normal text-muted mb-0 me-2"><b>Folio</b></h6>
                                    <div class="vr mx-3" style="height: 30px;"></div>
                                    <h5 class="m-b-25 mb-0 me-2">${folio}</h5>
                                </div>
                                <div class="col-xl-4 col-md-6 d-flex align-items-center">
                                    <h6 class="subtitle fw-normal text-muted mb-0 me-2"><b>Estatus</b></h6>
                                    <div class="vr mx-3" style="height: 30px;"></div>
                                    <h5 class="m-b-25 mb-0 me-2">${estatus}</h5>
                                </div>
                                <div class="col-xl-4 col-md-6 d-flex align-items-center">
                                    <h6 class="subtitle fw-normal text-muted mb-0 me-2"><b>Encuesta</b></h6>
                                    <div class="vr mx-3" style="height: 30px;"></div>
                                    <h5 class="m-b-25 mb-0 me-2">${encuesta}</h5>
                                </div>
                            `);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'No se pudo obtener la información del registro.'
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al obtener la información del registro.'
                        });
                    }
                });
            });
        </script>

    </body>

    </html>
    <?php
}
?>