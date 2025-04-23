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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&amp;display=swap" rel="stylesheet">
    <!-- Ladda-->
    <link rel="stylesheet" href="vendor/ladda/ladda-themeless.min.css">
    <!-- Prism Syntax Highlighting-->
    <link rel="stylesheet" href="vendor/prismjs/plugins/toolbar/prism-toolbar.css">
    <link rel="stylesheet" href="vendor/prismjs/themes/prism-okaidia.css">
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
      integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- The Main Theme stylesheet (Contains also Bootstrap CSS)-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../img/IEEH.png">
  </head>

  <body>
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow">
        <a class="sidebar-toggler text-gray-500 me-4 me-lg-5 lead" href="#"><i class="fas fa-align-left"></i></a>
        <a class="navbar-brand fw-bold text-uppercase text-base" href="index.php">
          <span class="d-none d-brand-partial"> </span>
          <span class="d-none d-sm-inline">Premio 17 de octubre</span>
        </a>
        <ul class="ms-auto d-flex align-items-center list-unstyled mb-0">
          <li class="nav-item dropdown ms-auto">
            <a class="nav-link pe-0" id="userInfo" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <img class="avatar p-1" src="img/generico.png" alt="Jason Doe">
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated" aria-labelledby="userInfo">
              <div class="dropdown-header text-gray-700">
                <h6 class="text-uppercase font-weight-bold"><?php echo $nombreCompleto; ?></h6><br><small
                  align='right'><b><?php echo $rolDescripcion; ?></b></small>
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
          <!-- Indicadores -->
          <section class="mb-3 mb-lg-5">
            <div class="row">
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card-widget h-100">
                  <div class="card-widget-body">
                    <div class="dot me-3 bg-indigo"></div>
                    <div class="text">
                      <h6 class="mb-0">Data consumed</h6><span class="text-gray-500">145,14 GB</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-indigo"><i class="fas fa-server"></i></div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card-widget h-100">
                  <div class="card-widget-body">
                    <div class="dot me-3 bg-green"></div>
                    <div class="text">
                      <h6 class="mb-0">Open cases</h6><span class="text-gray-500">32</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-green"><i class="far fa-clipboard"></i></div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card-widget h-100">
                  <div class="card-widget-body">
                    <div class="dot me-3 bg-blue"></div>
                    <div class="text">
                      <h6 class="mb-0">Work orders</h6><span class="text-gray-500">400</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-blue"><i class="fa fa-dolly-flatbed"></i></div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card-widget h-100">
                  <div class="card-widget-body">
                    <div class="dot me-3 bg-red"></div>
                    <div class="text">
                      <h6 class="mb-0">New invoices</h6><span class="text-gray-500">123</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
                </div>
              </div>
            </div>
          </section>
          <section class="mb-4 mb-lg-5">
            <h2 class="section-heading section-heading-ms mb-4 mb-lg-5">Finances 💰</h2>
            <div class="row">
              <div class="col-lg-7 mb-4 mb-lg-0">
                <div class="card h-100">
                  <div class="card-header">
                    <h4 class="card-heading">Your Account Balance</h4>
                  </div>
                  <div class="card-body">
                    <div class="chart-holder w-100">
                      <canvas id="lineChart1"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="h-50 pb-4 pb-lg-2">
                  <div class="card h-100">
                    <div class="card-body d-flex">
                      <div class="row w-100 align-items-center">
                        <div class="col-sm-5 mb-4 mb-sm-0">
                          <h2 class="mb-0 d-flex align-items-center"><span>86.4</span><span
                              class="dot bg-green d-inline-block ms-3"></span></h2><span
                            class="text-muted text-uppercase small">Work hours</span>
                          <hr><small class="text-muted">Hours worked this month</small>
                        </div>
                        <div class="col-sm-7">
                          <canvas id="pieChartHome1"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="h-50 pt-lg-2">
                  <div class="card h-100">
                    <div class="card-body d-flex">
                      <div class="row w-100 align-items-center">
                        <div class="col-sm-5 mb-4 mb-sm-0">
                          <h2 class="mb-0 d-flex align-items-center"><span>325</span><span
                              class="dot bg-indigo d-inline-block ms-3"></span></h2><span
                            class="text-muted text-uppercase small">Tasks Completed</span>
                          <hr><small class="text-muted">Tasks Completed this months</small>
                        </div>
                        <div class="col-sm-7">
                          <canvas id="pieChartHome2"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 text-center text-md-start fw-bold">
                <p class="mb-2 mb-md-0 fw-bold">Unidad de Tecnologías de la Información y Comunicaciones &copy; 2025</p>
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
    <!-- Init Charts on Homepage-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/charts-defaults.js"></script>
    <script src="js/charts-home.js"></script>
    <!-- Main Theme JS File-->
    <script src="js/theme.js"></script>
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