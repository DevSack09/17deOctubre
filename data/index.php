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
    <link rel="stylesheet" href="css/style.violet.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../img/IEEH.png">
    <!-- dataTables-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.css" rel="stylesheet">
  </head>
  <style>
    .navbar .nav-item.dropdown.ms-auto {
      margin-right: 20px;
    }

    .excelButton {
      background: green !important;
      color: white !important;
    }

    .pdfButton {
      background: #dc3545 !important;
      color: white !important;
    }

    .printButton {
      background: #4650dd !important;
      color: white !important;
    }

    .copyButton {
      background: #343a40 !important;
      color: white !important;
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
          <!-- INDICADORES -->
          <section class="mb-3 ">
            <div class="row">
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card-widget h-100">
                  <div class="card-widget-body">
                    <div class="dot me-3 bg-indigo"></div>
                    <div class="text">
                      <h6 class="mb-0">Total de registros</h6>
                      <span id="totalRegistros" class="text-gray-500">...</span>
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
                      <h6 class="mb-0">Registros Pendientes</h6>
                      <span id="registrosPendientes" class="text-gray-500">...</span>
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
                      <h6 class="mb-0">Encuesta de retroalimentación</h6>
                      <span id="totalEncuestas" class="text-gray-500">...</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-blue"><i class="fa fa-dolly-flatbed"></i></div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card-widget h-100">
                  <div class="card-widget-body d-flex align-items-center">
                    <div class="dot me-3 bg-warning"></div>
                    <div class="text w-100">
                      <h6 class="mb-0">Cuenta regresiva</h6>
                      <span id="countdownTimer" class="text-gray-500"></span>
                      <div class="progress mt-2" style="height: 8px;">
                        <div id="progressBarCountdown" class="progress-bar bg-warning" role="progressbar"
                          style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small id="countdownPercent" class="text-muted"></small>
                    </div>
                  </div>
                  <div class="icon text-white bg-warning"><i class="fas fa-hourglass-half"></i></div>
                </div>
              </div>
            </div>
          </section>
          <!-- DATATABLE -->
          <section>
            <div class="col-lg-12 mb-4">
              <div class="card h-100">
                <div class="card-header">
                  <h5 class="card-heading">Resultado de búsqueda</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover mb-0 display nowrap" id="lookup" width="100%">
                      <thead class="table-dark">
                        <tr>
                          <th>ID</th>
                          <th>NOMBRES</th>
                          <th>PRIMER APELLIDO</th>
                          <th>SEGUNDO APELLIDO</th>
                          <th>MUNICIPIO</th>
                          <th>EDAD</th>
                          <th>ENCUESTA</th>
                          <th>ESTATUS</th>
                          <th>FOLIO</th>
                          <th class="text-center">ACCIONES</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th><input type="text" placeholder="Buscar" class="form-control form-control-sm" /></th>
                          <th><input type="text" placeholder="Buscar" class="form-control form-control-sm" /></th>
                          <th><input type="text" placeholder="Buscar" class="form-control form-control-sm" /></th>
                          <th><input type="text" placeholder="Buscar" class="form-control form-control-sm" /></th>
                          <th><input type="text" placeholder="Buscar" class="form-control form-control-sm" /></th>
                          <th><input type="text" placeholder="Buscar" class="form-control form-control-sm" /></th>
                          <th><input type="text" placeholder="Buscar" class="form-control form-control-sm" /></th>
                          <th><input type="text" placeholder="Buscar" class="form-control form-control-sm" /></th>
                          <th><input type="text" placeholder="Buscar" class="form-control form-control-sm" /></th>
                          <th></th>
                        </tr>
                      </tfoot>
                      <tbody id="dtBody">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- GRAFICAS -->
          <section>
            <div class="card mb-4">
              <div class="card-header">
                <h4 class="card-heading">Gráficas</h4>
              </div>
              <div class="card-body" style="">
                <div>
                  <br>
                  <div class="alert alert-primary">
                    <i class="fas fa-info-circle"></i> <strong>Importante:</strong>
                    Selecciona una opción para visualizar la gráfica correspondiente.
                  </div>
                  <div class="col-md-3">
                    <label class="form-label" for="grafica">Grafica</label>
                    <div class="input-icon">
                      <i class="fas fa-map"></i>
                      <select class="form-control" id="grafica" name="grafica">
                        <option selected disabled value="">Seleccione una opción</option>
                        <option value="Categoría">Categoría</option>
                        <option value="Edad">Edad</option>
                        <option value="Escolaridad">Escolaridad</option>
                        <option value="Municipio">Municipio</option>
                      </select>
                    </div>
                  </div>
                  <div class="my-4 d-flex justify-content-center">
                    <div style="width: 100%; max-width: 1000px; min-width: 320px; height: 420px;">
                      <canvas id="graficaDashboard" width="100%" height="350"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- generar reporte -->
          <section class="col-md-6">
            <div class="row text-dark">
              <div class="col-md-6 col-xl-6 mb-">
                <div class="card credit-card bg-hover-gradient-green">
                  <div class="credict-card-content">
                    <div class="h1 mb-3 mb-lg-1"><i class="fas fa-file-excel"></i></div>
                    <div class="credict-card-bottom">
                      <div class="text-uppercase flex-shrink-0 me-1 mb-1">
                        <div class="fw-bold">Registros</div>
                        <small class="text-gray-500">Excel</small>
                      </div>
                    </div>
                  </div>
                  <a class="stretched-link" href="../controlador/dashboard/generar_excel.php"></a>
                </div>
              </div>
              <div class="col-md-6 col-xl-6 mb-">
                <div class="card credit-card bg-hover-gradient-green" id="abrirCerrarRegistrosCard"
                  style="cursor:pointer;">
                  <div class="credict-card-content">
                    <div class="h1 mb-3 mb-lg-1" id="iconoAbrirCerrar"><i class="fas fa-lock"></i></div>
                    <div class="credict-card-bottom">
                      <div class="text-uppercase flex-shrink-0 me-1 mb-1">
                        <div class="fw-bold" id="textoAbrirCerrar">Cerrar registros</div>
                        <small class="text-gray-500" id="subTextoAbrirCerrar">Finalizar y bloquear</small>
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
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Main Theme JS File-->
    <script src="js/theme.js"></script>
    <script src="../js/darkLight.js"></script>
    <!-- DataTable --->
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.36/build/pdfmake.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.36/build/vfs_fonts.js"></script>

  <!-- Prism for syntax highlighting-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    <!-- DataTable JS -->
    <script>
      $(document).ready(function () {
        var table = $('#lookup').DataTable({
          language: {
            "sProcessing": "<br>Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
              "sFirst": "Primero",
              "sLast": "Último",
              "sNext": "Siguiente",
              "sPrevious": "Anterior"
            }
          },
          processing: true,
          serverSide: true,
          ajax: {
            url: "../controlador/dashboard/getDatatable.php",
            type: "POST",
            error: function (data) {
              $("#dtBody").empty();
              $("#dtBody").append('<tr><th colspan="100%">No se encontraron registros</th></tr>');
              $("#lookup_processing").css("display", "none");
            }
          },
          columns: [
            { data: 'id' },
            { data: 'nombres' },
            { data: 'primer_apellido' },
            { data: 'segundo_apellido' },
            { data: 'municipio' },
            { data: 'edad' },
            { data: 'encuesta' },
            { data: 'estatus' },
            { data: 'folio' },
            {
              data: null,
              orderable: false,
              searchable: false,
              className: "text-center",
              render: function (data, type, row) {
                return `
            <button class="btn btn-info btn-sm ver-registro" data-id="${row.id}" title="Ver"><i class="fas fa-eye"></i></button>
            <button class="btn btn-danger btn-sm eliminar-registro" data-id="${row.id}" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
          `;
              }
            }
          ],
          dom: "Bfrtip",
          lengthMenu: [
            [10, 25, 50, 10000],
            ['10 filas', '25 filas', '50 filas', 'Todos']
          ],
          buttons: [
            'pageLength',
            'colvis',
            {
              extend: 'excel',
              footer: true,
              title: 'REGISTRO PREMIO 17 DE OCTUBRE',
              filename: 'Export_File_Excel',
              text: 'Excel <i class="fas fa-file-excel"></i>',
              className: 'excelButton',
            },
            {
              extend: 'pdf',
              footer: true,
              title: 'REGISTRO PREMIO 17 DE OCTUBRE',
              filename: 'Export_File_pdf',
              text: 'PDF <i class="far fa-file-pdf"></i>',
              orientation: 'landscape',
              className: 'pdfButton',
            },
            {
              extend: 'print',
              footer: true,
              title: 'REGISTRO PREMIO 17 DE OCTUBRE',
              filename: 'Print_File',
              text: 'Imprimir <i class="fa fa-print"></i>',
              orientation: 'landscape',
              className: 'printButton',
            },
            {
              extend: 'copy',
              footer: true,
              title: 'REGISTRO PREMIO 17 DE OCTUBRE',
              filename: 'Copy_File',
              text: 'Copiar <i class="fa fa-clone"></i>',
              className: 'copyButton',
            }
          ],
          initComplete: function () {
            // Filtros por columna
            this.api().columns().every(function () {
              var that = this;
              $('input', this.footer()).on('keyup change clear', function () {
                if (that.search() !== this.value) {
                  that.search(this.value).draw();
                }
              });
            });
          }
        });

        $('#lookup tbody').on('click', '.ver-registro', function () {
          var usuario_id = $(this).data('id');
          if (usuario_id) {
            window.location.href = 'viewData.php?usuario_id=' + encodeURIComponent(usuario_id);
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'No se pudo obtener el ID del registro.'
            });
          }
        });

        $('#lookup tbody').on('click', '.eliminar-registro', function () {
          var id = $(this).data('id');
          var row = table.row($(this).closest('tr')).data();
          if (row) {
            Swal.fire({
              title: '¿Estás seguro?',
              html: `<b>Nombre:</b> ${row.nombres} ${row.primer_apellido}<br><b>Folio:</b> ${row.folio}<br><br>Esta acción no se puede deshacer.`,
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Sí, eliminar',
              cancelButtonText: 'Cancelar'
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  url: '../controlador/dashboard/eliminarRegistro.php',
                  type: 'POST',
                  data: { id: id },
                  success: function (resp) {
                    table.ajax.reload(null, false);
                    Swal.fire({
                      icon: 'success',
                      title: 'Eliminado',
                      text: 'El registro ha sido eliminado correctamente.'
                    });
                  },
                  error: function () {
                    Swal.fire({
                      icon: 'error',
                      title: 'Error',
                      text: 'No se pudo eliminar el registro.'
                    });
                  }
                });
              }
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'No se pudo obtener la información del registro.'
            });
          }
        });
      });
    </script>
    <!-- INDICADORES -->
    <script>
      $(document).ready(function () {
        $.ajax({
          url: '../controlador/dashboard/getDataAdmin.php',
          method: 'GET',
          dataType: 'json',
          success: function (data) {
            if (data.totalRegistros !== undefined) {
              $('#totalRegistros').text(data.totalRegistros);
            }
            if (data.registrosPendientes !== undefined) {
              $('#registrosPendientes').text(data.registrosPendientes);
            }
            if (data.totalEncuestas !== undefined) {
              $('#totalEncuestas').text(data.totalEncuestas);
            }
          },
          error: function () {
            $('#totalRegistros, #registrosPendientes, #totalEncuestas').text('Error');
          }
        });
      });
    </script>
    <!-- GRAFICAS -->
    <script>
      let chartInstance = null;

      function getRandomColors(num) {
        const colors = [];
        for (let i = 0; i < num; i++) {
          const hue = Math.floor(Math.random() * 360);
          colors.push(`hsl(${hue}, 70%, 65%)`);
        }
        return colors;
      }

      function renderChart(labels, data, label, type = 'bar') {
        const ctx = document.getElementById('graficaDashboard').getContext('2d');
        if (chartInstance) chartInstance.destroy();
        const colors = getRandomColors(labels.length);
        chartInstance = new Chart(ctx, {
          type: type,
          data: {
            labels: labels,
            datasets: [{
              label: label,
              data: data,
              backgroundColor: colors,
              borderColor: '#fff',
              borderWidth: 2,
              hoverOffset: 16
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: type !== 'bar',
                position: type === 'pie' || type === 'doughnut' ? 'right' : 'top',
                labels: {
                  color: '#333',
                  font: { size: 16, weight: 'bold' }
                }
              },
              tooltip: {
                enabled: true,
                backgroundColor: '#23233a',
                titleColor: '#fff',
                bodyColor: '#fff',
                borderColor: '#7d4ac7',
                borderWidth: 1,
                padding: 12
              },
              title: {
                display: true,
                text: label,
                color: '#7d4ac7',
                font: { size: 20, weight: 'bold' },
                padding: { top: 10, bottom: 20 }
              }
            },
            layout: {
              padding: 20
            },
            scales: type === 'bar' ? {
              x: {
                ticks: { color: '#333', font: { size: 14 } },
                grid: { color: '#e0e0e0' }
              },
              y: {
                beginAtZero: true,
                ticks: { color: '#333', font: { size: 14 } },
                grid: { color: '#e0e0e0' }
              }
            } : {}
          }
        });
      }

      $(document).ready(function () {
        let dashboardData = null;

        $('#graficaDashboard').hide();

        $.ajax({
          url: '../controlador/dashboard/getDataAdmin.php',
          method: 'GET',
          dataType: 'json',
          success: function (data) {
            dashboardData = data;
            $('#grafica').val('');
            $('#graficaDashboard').hide();
            if (chartInstance) chartInstance.destroy();
          }
        });

        $('#grafica').on('change', function () {
          const val = $(this).val();
          if (!val) {
            $('#graficaDashboard').hide();
            if (chartInstance) chartInstance.destroy();
            return;
          }
          if (val === 'Categoría') showCategoria();
          else if (val === 'Edad') showEdad();
          else if (val === 'Escolaridad') showEscolaridad();
          else if (val === 'Municipio') showMunicipio();
        });

        function showCategoria() {
          const cats = dashboardData.categorias || {};
          $('#graficaDashboard').show();
          renderChart(
            Object.keys(cats),
            Object.values(cats),
            'Personas por categoría',
            'doughnut'
          );
        }

        function showEdad() {
          const edades = dashboardData.edades || {};
          $('#graficaDashboard').show();
          renderChart(
            Object.keys(edades),
            Object.values(edades),
            'Personas por edad',
            'bar'
          );
        }

        function showEscolaridad() {
          const esc = dashboardData.escolaridad || {};
          $('#graficaDashboard').show();
          renderChart(
            Object.keys(esc),
            Object.values(esc),
            'Personas por escolaridad',
            'pie'
          );
        }

        function showMunicipio() {
          const mun = dashboardData.municipios || {};
          $('#graficaDashboard').show();
          renderChart(
            Object.keys(mun),
            Object.values(mun),
            'Personas por municipio',
            'bar'
          );
        }
      });
    </script>
    <!-- Cerrar registros -->
    <script>
      $(document).ready(function () {
        $.ajax({
          url: '../controlador/dashboard/abrirCerrarRegistros.php',
          type: 'POST',
          data: { consulta_estado: 1 },
          dataType: 'json',
          success: function (resp) {
            if (resp.abierto == 1) {
              // Registros abiertos: card azul
              $('#iconoAbrirCerrar').html('<i class="fas fa-lock"></i>');
              $('#textoAbrirCerrar').text('Cerrar registros');
              $('#subTextoAbrirCerrar').text('Finalizar y bloquear');
              $('#abrirCerrarRegistrosCard')
                .removeClass('bg-hover-gradient-green bg-hover-gradient-blue')
                .addClass('bg-hover-gradient-red');
            } else {
              // Registros cerrados: card roja
              $('#iconoAbrirCerrar').html('<i class="fas fa-lock-open"></i>');
              $('#textoAbrirCerrar').text('Abrir registros');
              $('#subTextoAbrirCerrar').text('Permitir nuevos registros');
              $('#abrirCerrarRegistrosCard')
                .removeClass('bg-hover-gradient-green bg-hover-gradient-red')
                .addClass('bg-hover-gradient-blue');
            }
          }
        });

        $('#abrirCerrarRegistrosCard').on('click', function () {
          let accion = $('#textoAbrirCerrar').text().includes('Cerrar') ? 'cerrar' : 'abrir';
          let titulo = accion === 'cerrar' ? 'Cerrar registros' : 'Abrir registros';
          let texto = accion === 'cerrar'
            ? 'Ingresa la contraseña para cerrar los registros y finalizar los pendientes:'
            : 'Ingresa la contraseña para abrir los registros:';
          let confirmBtn = accion === 'cerrar' ? 'Cerrar registros' : 'Abrir registros';

          Swal.fire({
            title: titulo,
            text: texto,
            input: 'password',
            inputPlaceholder: 'Contraseña',
            inputAttributes: { autocapitalize: 'off', autocomplete: 'off' },
            showCancelButton: true,
            confirmButtonText: confirmBtn,
            cancelButtonText: 'Cancelar',
            preConfirm: (password) => {
              if (!password) {
                Swal.showValidationMessage('Debes ingresar la contraseña');
              }
              return password;
            }
          }).then((result) => {
            if (result.isConfirmed && result.value) {
              $.ajax({
                url: '../controlador/dashboard/abrirCerrarRegistros.php',
                type: 'POST',
                data: { password: result.value, accion: accion },
                dataType: 'json',
                success: function (resp) {
                  if (resp.status === 'success') {
                    Swal.fire('¡Listo!', resp.message, 'success').then(() => {
                      location.reload();
                    });
                  } else {
                    Swal.fire('Error', resp.message, 'error');
                  }
                },
                error: function () {
                  Swal.fire('Error', 'No se pudo procesar la solicitud.', 'error');
                }
              });
            }
          });
        });
      });
    </script>

    <script>
      // Fecha objetivo: 1 de octubre 2025 23:59:59
      const targetDateWidget = new Date('2025-10-01T23:59:59');
      // Fecha de apertura: 10 de junio 2025 00:00:00
      const startDateWidget = new Date('2025-06-10T00:00:00');

      function getTimeRemainingWidget(endtime) {
        const now = new Date();
        const t = endtime - now;
        const days = Math.floor(t / (1000 * 60 * 60 * 24));
        const hours = Math.floor((t / (1000 * 60 * 60)) % 24);
        const minutes = Math.floor((t / 1000 / 60) % 60);
        const seconds = Math.floor((t / 1000) % 60);
        return {
          total: t,
          days,
          hours,
          minutes,
          seconds
        };
      }

      function updateCountdownWidget() {
        const t = getTimeRemainingWidget(targetDateWidget);
        const formatted = `${t.days}d ${String(t.hours).padStart(2, '0')}h ${String(t.minutes).padStart(2, '0')}m ${String(t.seconds).padStart(2, '0')}s`;
        $('#countdownTimer').text(formatted);

        const totalTime = targetDateWidget - startDateWidget;
        const restante = t.total > 0 ? t.total : 0;
        const transcurrido = totalTime - restante;
        const percent = Math.min(100, Math.max(0, (transcurrido / totalTime) * 100));
        $('#progressBarCountdown').css('width', percent + '%').attr('aria-valuenow', percent);
        $('#countdownPercent').text(`Avance: ${percent.toFixed(1)}%`);
      }

      $(document).ready(function () {
        updateCountdownWidget();
        setInterval(updateCountdownWidget, 1000);
      });
    </script>
  </body>

  </html>
  <?php
}
?>