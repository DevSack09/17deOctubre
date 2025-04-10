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
    <title>IEEH | Sistema de Almacén</title>
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
    <!-- The Main Theme stylesheet (Contains also Bootstrap CSS)-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.css" rel="stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../img/IEEH.png">
    <style>
      /************************choice.js*****************************/
      /* Reducir la altura del campo de selección */
      .choices__inner {
        min-height: calc(2.12rem + 2px);
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.25;
        background-color: white
      }

      .choices__item {
        font-size: .875rem;
        line-height: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }

      /* Aumentar el tamaño del menú desplegable */
      .choices__list--dropdown {
        max-height: 500px;
        z-index: 1100;
      }

      .dataTables_filter {
        display: none;
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
          <div class="card">
            <div class="card-header">
              <h4 class="card-heading">REPORTES</h4>
            </div>
            <div class="card-body">
              <form id="reporteForm">
                <div class="row mb-3">
                  <div class="col-md-4">
                    <label for="reporte" class="form-label">Reporte</label>
                    <select class="form-control" id="reporte" name="reporte">
                      <option value="" disabled selected>Seleccionar</option>
                      <option value="entradas">Reportes de entradas</option>
                      <!-- <option value="entrada_facturas_registradas">Entrada de Facturas Registradas</option> -->
                      <option value="stock">Existencias de artículos</option>
                      <option value="articulos_por_area">Salida de artículos</option>
                      <!-- <option value="salida_vales">Salida de Vales</option> -->
                      <option value="cancelacion_vales">Cancelación de vales</option>
                    </select>
                  </div>
                  <div class="col-md-4" id="tipo-entrada-container" style="display: none;">
                    <label for="tipo_entrada" class="form-label">Tipo de Entrada</label>
                    <select class="form-control" id="tipo_entrada" name="tipo_entrada">
                      <option value="" disabled selected>Seleccionar</option>
                      <option value="articulo">Por Artículo</option>
                      <option value="proveedor">Por Proveedor</option>
                    </select>
                  </div>
                  <div class="col-md-4" id="info-entrada-container" style="display: none;">
                    <label for="info_entrada" class="form-label">Información</label>
                    <select class="form-control" id="info_entrada" name="info_entrada">
                      <option value="" disabled selected>Seleccionar</option>
                    </select>
                  </div>
                  <div class="col-md-4" id="area-container" style="display: none;">
                    <label for="area" class="form-label">Área</label>
                    <select class="form-control" id="area" name="area">
                      <option value="" disabled selected>Seleccionar</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-3">
                    <label class="form-label" for="fecha_inicio">Fecha inicio</label>
                    <input class="form-control" id="fecha_inicio" name="fecha_inicio" type="date">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label" for="fecha_fin">Fecha fin</label>
                    <input class="form-control" id="fecha_fin" name="fecha_fin" type="date">
                  </div>
                  <div class="col-md-3 align-self-end">
                    <button class="btn btn-primary" type="submit">Consultar</button>
                  </div>
                </div>
              </form>
              <div class="table-responsive mb-3">
                <table class="table table-hover display nowrap" id="reportTable" width="100%">
                  <thead class="table-dark">
                    <tr id="tableHeaders"></tr>
                  </thead>
                  <tbody id="dtBody"></tbody>
                </table>
              </div>
            </div>
          </div>
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
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <!-- Main Theme JS File-->
    <script src="js/theme.js"></script>
    <!-- Prism for syntax highlighting-->
    <script src="vendor/prismjs/prism.js"></script>
    <script src="vendor/prismjs/plugins/normalize-whitespace/prism-normalize-whitespace.min.js"></script>
    <script src="vendor/prismjs/plugins/toolbar/prism-toolbar.min.js"></script>
    <script src="vendor/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>
    <!-- DataTable --->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.36/build/pdfmake.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.36/build/vfs_fonts.js"></script>
  <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Script de Choices.js -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
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
        var table = null;

        // Inicializar Choices.js para #reporte
        const choicesReporte = new Choices("#reporte", {
          placeholder: true,
          placeholderValue: "Selecciona un tipo de reporte...",
          searchPlaceholderValue: "Buscar tipo de reporte...",
          itemSelectText: "Seleccionar",
          shouldSort: false,
        });

        // Inicializar Choices.js para #tipo_entrada
        const choicesTipoEntrada = new Choices("#tipo_entrada", {
          placeholder: true,
          placeholderValue: "Selecciona un tipo de entrada...",
          searchPlaceholderValue: "Buscar tipo de entrada...",
          itemSelectText: "Seleccionar",
          shouldSort: false,
        });

        // Inicializar Choices.js para #info_entrada
        const choicesInfoEntrada = new Choices("#info_entrada", {
          placeholder: true,
          placeholderValue: "Selecciona una opción...",
          searchPlaceholderValue: "Buscar...",
          itemSelectText: "Seleccionar",
          shouldSort: false,
        });

        // Inicializar Choices.js para #area
        const choicesArea = new Choices("#area", {
          placeholder: true,
          placeholderValue: "Selecciona un área...",
          searchPlaceholderValue: "Buscar área...",
          itemSelectText: "Seleccionar",
          shouldSort: false,
        });

        // Mostrar u ocultar contenedores según el tipo de reporte seleccionado
        $('#reporte').change(function () {
          var reporte = $(this).val();
          if (reporte === 'entradas') {
            $('#tipo-entrada-container').show();
            $('#info-entrada-container').show();
            $('#area-container').hide();
          } else if (reporte === 'articulos_por_area') {
            $('#tipo-entrada-container').hide();
            $('#info-entrada-container').hide();
            $('#area-container').show();
            cargarAreas(); // Cargar las áreas disponibles
          } else {
            $('#tipo-entrada-container').hide();
            $('#info-entrada-container').hide();
            $('#area-container').hide();
          }
        });

        $('#tipo_entrada').change(function () {
          var tipoEntrada = $(this).val();
          if (tipoEntrada) {
            cargarInformacion(tipoEntrada);
          } else {
            $('#info-entrada-container').hide();
          }
        });

        function cargarInformacion(tipoEntrada) {
          $.ajax({
            url: '../controlador/reportes/datatable_reportes.php',
            type: 'POST',
            data: {
              action: 'get_info',
              tipo_entrada: tipoEntrada
            },
            success: function (response) {
              var data = JSON.parse(response);

              choicesInfoEntrada.setChoices(
                data.map((item) => ({
                  value: item.id,
                  label: item.nombre,
                })),
                "value",
                "label",
                true
              );

              $('#info-entrada-container').show();
            }
          });
        }

        function cargarAreas() {
          $.ajax({
            url: '../controlador/reportes/datatable_reportes.php',
            type: 'POST',
            data: {
              action: 'get_areas'
            },
            success: function (response) {
              var data = JSON.parse(response);
              choicesArea.setChoices(
                data.map((item) => ({
                  value: item.id,
                  label: item.nombre,
                })),
                "value",
                "label",
                true
              );
            }
          });
        }


        $('#reporteForm').submit(function (e) {
          e.preventDefault();
          var reporte = $('#reporte').val();
          var tipoEntrada = $('#tipo_entrada').val();
          var infoEntrada = $('#info_entrada').val();
          var area = $('#area').val();
          var fecha_inicio = $('#fecha_inicio').val();
          var fecha_fin = $('#fecha_fin').val();

          console.log("Reporte seleccionado: " + reporte);
          console.log("Tipo de entrada: " + tipoEntrada);
          console.log("Información de entrada: " + infoEntrada);
          console.log("Área: " + area);
          console.log("Fecha inicio: " + fecha_inicio);
          console.log("Fecha fin: " + fecha_fin);

          var columns = getColumns(reporte, tipoEntrada);
          updateTableHeaders(columns);

          if ($.fn.DataTable.isDataTable('#reportTable')) {
            $('#reportTable').DataTable().clear().destroy();
          }

          $('#tableHeaders').empty();
          $('#reportTable tbody').empty();

          updateTableHeaders(columns);

          table = $('#reportTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
              "url": "../controlador/reportes/datatable_reportes.php",
              "type": "POST",
              "data": {
                "reporte": reporte,
                "tipo_entrada": tipoEntrada,
                "info_entrada": infoEntrada,
                "area": area,
                "fecha_inicio": fecha_inicio,
                "fecha_fin": fecha_fin
              },
              "dataSrc": function (json) {
                console.log("Respuesta JSON del servidor:", json);
                return json.data;
              }
            },
            "columns": columns,
            "language": {
              "sProcessing": "<br>Procesando...",
              "sLengthMenu": "Mostrar _MENU_ registros",
              "sZeroRecords": "No se encontraron resultados",
              "sEmptyTable": "Ningún dato disponible en esta tabla",
              "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix": "",
              "sSearch": "Buscar:",
              "sUrl": "",
              "sInfoThousands": ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
              },
              "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }
            },
            "lengthMenu": [
              [10, 20, 30, 50, 5000],
              [10, 20, 30, 50, 'All']
            ],
            "buttons": [
              'pageLength',
              'colvis',
              {
                extend: 'excel',
                footer: true,
                title: 'REPORTES ALMACÉN | IEEH',
                filename: 'Reportes_Excel',
                text: 'Excel <i class="fas fa-file-excel"></i>',
                className: 'excelButton',
              },
              {
                extend: 'pdf',
                footer: true,
                title: 'REPORTES ALMACÉN | IEEH',
                filename: 'Reportes_pdf',
                text: 'PDF <i class="far fa-file-pdf"></i>',
                orientation: 'landscape',
                className: 'pdfButton',
              },
              {
                extend: 'print',
                footer: true,
                title: 'REPORTES ALMACÉN | IEEH',
                filename: 'Print_File',
                text: 'Imprimir <i class="fa fa-print"></i>',
                orientation: 'landscape',
                className: 'printButton',
              },
              {
                extend: 'copy',
                footer: true,
                title: 'REPORTES ALMACÉN | IEEH',
                filename: 'Copy_File',
                text: 'Copiar <i class="fa fa-clone"></i>',
                className: 'copyButton',
              }
            ],
            "dom": 'Bfrtip'
          });
        });

        function getColumns(reporte, tipoEntrada) {
          if (reporte === 'entradas') {
            if (tipoEntrada === 'proveedor') {
              return [
                { "data": 0, "title": "#" },
                { "data": 1, "title": "Fecha" },
                { "data": 2, "title": "Orden de compra" },
                { "data": 3, "title": "Factura Código" },
                { "data": 4, "title": "Descripción Artículo" },
                { "data": 5, "title": "Proveedor" },
                { "data": 6, "title": "Cantidad Recibida" },
                { "data": 7, "title": "Precio" },
                { "data": 8, "title": "IVA" },
                { "data": 9, "title": "Total Artículo" }
              ];
            } else {
              return [
                { "data": 0, "title": "#" },
                { "data": 1, "title": "Fecha" },
                { "data": 2, "title": "Orden de compra" },
                { "data": 3, "title": "Factura Código" },
                { "data": 4, "title": "Descripción Artículo" },
                { "data": 5, "title": "Proveedor" },
                { "data": 6, "title": "Cantidad Recibida" },
                { "data": 7, "title": "Precio" },
                { "data": 8, "title": "IVA" },
                { "data": 9, "title": "Total Artículo" }
              ];
            }
          } else if (reporte === 'stock') {
            return [
              { "data": 0, "title": "#" },
              { "data": 1, "title": "Descripción Artículo" },
              { "data": 2, "title": "Partida" },
              { "data": 3, "title": "Unidad" },
              { "data": 4, "title": "Stock" }
            ];
          } else if (reporte === 'articulos_por_area') {
            return [
              { "data": 0, "title": "#" },
              { "data": 1, "title": "Folio" },
              { "data": 2, "title": "Área" },
              { "data": 3, "title": "Departamento" },
              { "data": 4, "title": "Descripción Artículo" },
              { "data": 5, "title": "Unidad" },
              { "data": 6, "title": "Cantidad" },
              { "data": 7, "title": "Fecha de Salida" }
            ];
          } else if (reporte === 'cancelacion_vales') {
            return [
              { "data": 0, "title": "#" },
              { "data": 1, "title": "ID Vale" },
              { "data": 2, "title": "Folio Vale" },
              { "data": 3, "title": "Área" },
              { "data": 4, "title": "Descripción Artículo" },
              { "data": 5, "title": "Cantidad" },
              { "data": 6, "title": "Fecha de Salida" },
              { "data": 7, "title": "Fecha de Cancelación" }
            ];
          } else if (reporte === 'entrada_facturas_registradas') {
            return [
              { "data": 0, "title": "#" },
              { "data": 1, "title": "Código de Factura" },
              { "data": 2, "title": "Total de Registros" }
            ];
          } else if (reporte === 'salida_vales') {
            return [
              { "data": 0, "title": "#" },
              { "data": 1, "title": "Folio" },
              { "data": 2, "title": "Nombre del Área" },
              { "data": 3, "title": "Fecha del Vale" }
            ];
          } else {
            return [];
          }
        }

        function updateTableHeaders(columns) {
          var headerRow = $('#tableHeaders');
          headerRow.empty();
          columns.forEach(function (col) {
            headerRow.append('<th>' + col.title + '</th>');
          });
        }
      });
    </script>

  </body>

  </html>
  <?php
}
?>