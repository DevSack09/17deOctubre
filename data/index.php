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
    <style>
      .page-holder {
        padding-top: 2rem;
      }

      .scroll-container {
        display: flex;
        overflow-x: auto;
        gap: 10px;
        padding: 10px;
      }

      .card-articulo {
        width: 350px;
        flex: 0 0 auto;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      .bg-danger-light {
        background-color: #f8d7da;
      }

      .bg-warning-light {
        background-color: #fff3cd;
      }

      .bg-critical {
        background-color: rgb(214, 81, 94);
        color: white;
      }

      /* Efecto de parpadeo */
      @keyframes blink {

        0%,
        100% {
          opacity: 1;
        }

        50% {
          opacity: 0;
        }
      }

      .blink {
        animation: blink 1.5s infinite;
      }
    </style>
  </head>

  <body>
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow">
        <a class="sidebar-toggler text-gray-500 me-4 me-lg-5 lead" href="#"><i class="fas fa-align-left"></i></a>
        <a class="navbar-brand fw-bold text-uppercase text-base" href="index.php">
          <span class="d-none d-brand-partial"> </span>
          <span class="d-none d-sm-inline">Sistema de Control de Almacén</span>
        </a>
        <ul class="ms-auto d-flex align-items-center list-unstyled mb-0">
          <li class="nav-item dropdown ms-auto">
            <a class="nav-link pe-0" id="userInfo" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <img class="avatar p-1" src="img/generico.png" alt="Jason Doe">
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated" aria-labelledby="userInfo">
              <div class="dropdown-header text-gray-700">
                <h6 class="text-uppercase font-weight-bold"><?php echo $nombreCompleto; ?></h6><small
                  align='right'><?php echo $nombreArea; ?></small><br><small
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
          <section class="mb-4 mb-lg-4">
            <h2 class="section-heading section-heading-ms mb-4">Indicadores</h2>
            <!-- Indicadores -->
            <div class="row">
              <!-- Indicadores -->
              <div class="col-lg-3 mb-2">
                <div class="card-widget h-100">
                  <div class="card-widget-body">
                    <div class="dot me-3 bg-indigo"></div>
                    <div class="text">
                      <h6 class="mb-0">Registros de Artículos en Almacén</h6><span class="text-gray-500"
                        id="numArticulos">0</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-indigo"><i class="fas fa-server"></i></div>
                </div>
              </div>
              <div class="col-lg-3 mb-2">
                <div class="card-widget h-100">
                  <div class="card-widget-body">
                    <div class="dot me-3 bg-green"></div>
                    <div class="text">
                      <h6 class="mb-0">Vales de Salida Registrados</h6><span class="text-gray-500" id="numVales">0</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-green"><i class="far fa-clipboard"></i></div>
                </div>
              </div>
              <div class="col-lg-3 mb-2">
                <div class="card-widget h-100">
                  <div class="card-widget-body">
                    <div class="dot me-3 bg-blue"></div>
                    <div class="text">
                      <h6 class="mb-0">Proveedores Registrados</h6><span class="text-gray-500"
                        id="numProveedores">0</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-blue"><i class="fa fa-dolly-flatbed"></i></div>
                </div>
              </div>
              <div class="col-lg-3 mb-2">
                <div class="card-widget h-100">
                  <div class="card-widget-body">
                    <div class="dot me-3 bg-red"></div>
                    <div class="text">
                      <h6 class="mb-0">Entrada de Facturas Registradas</h6><span class="text-gray-500"
                        id="numCompras">0</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
                </div>
              </div>
            </div>
          </section>
          <section class="mb-3 mb-lg-3">
            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <h2 class="section-heading section-heading-ms mb-4">Histórico</h2>
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-heading">Últimos 7 vales registrados</h4>
                  </div>
                  <div class="card-body" id="panelValesRegis">
                    <div class="alert alert-info text-center" role="alert">
                      Cargando información...
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 col-lg-6">
                <h2 class="section-heading section-heading-ms mb-4">Gráfica</h2>
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-heading">Artículos de mayor demanda</h4>
                  </div>
                  <div class="card-body">
                    <div class="chart-holder w-100">
                      <canvas id="barChart"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-sm-12">
                <h2 class="section-heading section-heading-ms mb-4">Artículos con Bajo Stock</h2>
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-heading">Artículos Críticos</h4>
                    <div id="totalCriticos" class="text-danger fw-bold blink" style="display: none;">
                      <i class="fas fa-exclamation-triangle me-2"></i>
                      Total de Artículos Críticos: <span id="numeroCriticos">0</span>
                    </div>
                  </div>
                  <div class="card-body" id="panelBajoStock">
                    <div class="scroll-container">
                      <div class="alert alert-warning text-center w-100" role="alert">
                        Cargando información...
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
    <script>
      const numArt = document.getElementById('numArticulos');
      const numVale = document.getElementById('numVales');
      const numProv = document.getElementById('numProveedores');
      const numCom = document.getElementById('numCompras');

      const panelValesLast = document.getElementById('panelValesRegis');

      document.addEventListener("DOMContentLoaded", (event) => {
        cargarNumeros();
      });

      const cargarNumeros = () => {
        fetch('../controlador/dashboard/controller_dashboard.php')
          .then(response => response.json())
          .then(data => {
            if (data.response == "success") {
              //console.log(data);
              numArt.innerHTML = data.articulos;
              numVale.innerHTML = data.vales;
              numProv.innerHTML = data.provee;
              numCom.innerHTML = data.facturasRegistradas;

              panelValesLast.innerHTML = "";
              data.valesRegistrados.forEach((vale) => {
                panelValesLast.innerHTML += cardVale(vale);
              });

              grafica(data.grafica)
            } else {
              Swal.fire({ icon: 'error', title: data.msg });
            }
          });
      }

      const cardVale = (vale) => {
        return `
          <div class="d-flex justify-content-between align-items-start align-items-sm-center mb-4 flex-column flex-sm-row">
            <div class="left d-flex align-items-center">
              <div class="icon icon-lg shadow me-3 text-gray-700">
                <i class="far fa-sticky-note"></i>
              </div>
              <div class="text">
                <h6 class="mb-0 d-flex align-items-center">
                  <span>${vale.responsable != null ? vale.responsable : ` - `}</span>
                  <span class="dot dot-sm ms-2 bg-indigo"></span>
                </h6>
                <small class="text-gray-500">${vale.nombre_area}</small>
              </div>
            </div>
            <div class="right ms-5 ms-sm-0 ps-3 ps-sm-0">
              <h6>Fecha: ${vale.fecha_vale}</h6>
              <h6>Folio: ${vale.folio}</h6>
            </div>
          </div>`;
      }

      const grafica = (data) => {
        const colores = data.map(item => item.color);
        const articulos = data.map(item => item.descripcion_articulo);
        const cantidad = data.map(item => item.total_salida);

        let lineChart1 = new Chart(document.getElementById("barChart"), {
          type: 'bar',
          data: {
            labels: articulos,
            datasets: [{
              label: 'Salidas de almacén en el último mes',
              data: cantidad,
              backgroundColor: colores,
              hoverOffset: 4,
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              },
            }
          }
        });
      }
    </script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        function obtenerArticulosConBajoStock() {
          $.ajax({
            url: '../controlador/dashboard/controller_index.php',
            type: 'POST',
            data: { action: 'get_articulos_bajo_stock' },
            success: function (response) {
              var articulos = JSON.parse(response);
              var panelBajoStock = $('.scroll-container');
              panelBajoStock.empty();

              if (articulos.length === 0) {
                panelBajoStock.append(`
                        <div class="alert alert-success text-center w-100" role="alert">
                            ¡No hay artículos con bajo stock o stock mínimo válido!
                        </div>
                    `);
                $('#totalCriticos').hide();
              } else {
                $('#numeroCriticos').text(articulos.length);
                $('#totalCriticos').show();

                articulos.forEach(function (articulo) {
                  // Determinar si el artículo tiene stock <= 0
                  const isCritical = articulo.stock <= 0;

                  panelBajoStock.append(`
                            <div class="card-articulo ${isCritical ? 'bg-critical' : 'bg-warning-light'}">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <h5>${articulo.descripcion_articulo}</h5>
                                        <h6 class="mb-0 ${isCritical ? 'text-white' : 'text-warning'}">Stock Actual: ${articulo.stock}</h6>
                                        <h6 class="mb-0 ${isCritical ? 'text-white' : 'text-warning'}">Stock Mínimo: ${articulo.stock_minimo}</h6>
                                    </div>
                                    <svg class="svg-icon" style="width: 24px; height: 24px;">
                                        <use xlink:href="icons/orion-svg-sprite.svg#speed-1"></use>
                                    </svg>
                                </div>
                            </div>
                        `);
                });
              }
            },
            error: function (xhr, status, error) {
              console.error('Error al cargar artículos con bajo stock:', error);
              $('#panelBajoStock').html(`
                    <div class="alert alert-danger text-center" role="alert">
                        Error al cargar la información.
                    </div>
                `);
              $('#totalCriticos').hide();
            }
          });
        }

        obtenerArticulosConBajoStock();
      });
    </script>
  </body>

  </html>
  <?php
}
?>