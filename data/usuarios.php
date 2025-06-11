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
    <!-- Prism Syntax Highlighting-->
    <!-- Ladda-->
    <link rel="stylesheet" href="vendor/ladda/ladda-themeless.min.css">

    <link rel="stylesheet" href="vendor/prismjs/plugins/toolbar/prism-toolbar.css">
    <link rel="stylesheet" href="vendor/prismjs/themes/prism-okaidia.css">
    <!-- The Main Theme stylesheet (Contains also Bootstrap CSS)-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- dataTables-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../img/IEEH.png">
    <style>
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

      .fa-question-circle {
        margin-left: 5px;
        font-size: 16px;
        cursor: pointer;
      }

      .toggle-password {
        color: #6c757d;
        transition: color 0.3s ease;
      }

      .toggle-password:hover {
        color: #000;
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
            <div class="col-lg-12 mb-4">
              <div class="card  h-100">
                <div class="card-header">
                  <div class="row">
                    <div class="col-6 text-start">
                      <p class="card-heading">USUARIOS</p>
                    </div>
                    <div class="col-6 text-end">
                      <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                        data-bs-target="#modalRegistro">
                        <i class="fas fa-plus"></i> Nuevo Usuario
                      </button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <!-- Modal de Registro de Usuario -->
                  <div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="modalRegistroLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalRegistroLabel">Registrar Nuevo Usuario</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form id="formRegistro">
                            <div class="mb-3">
                              <label for="email" class="form-label">Correo Electrónico</label>
                              <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="row">
                              <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                              </div>
                              <div class="col-md-6 mb-3">
                                <label for="apellidoP" class="form-label">Primer Apellido</label>
                                <input type="text" class="form-control" id="apellidoP" name="apellidoP" required>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6 mb-3">
                                <label for="apellidoM" class="form-label">Segundo Apellido</label>
                                <input type="text" class="form-control" id="apellidoM" name="apellidoM" required>
                              </div>
                              <div class="col-md-6 mb-3">
                                <label for="rol" class="form-label">Rol</label>
                                <select class="form-select" id="rol" name="rol" required>
                                  <option value="">Selecciona un rol</option>
                                  <option value="1">Administrador</option>
                                  <option value="2">Usuario</option>
                                </select>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6 mb-3">
                                <label class="form-label d-block">Activo</label>
                                <div class="form-check form-switch switch-lg">
                                  <input class="form-check-input" type="checkbox" id="activo" name="activo" checked>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Guardar Registro</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <style>
                    .switch-lg .form-check-input {
                      width: 3rem;
                      /* Aumenta el ancho del switch */
                      height: 1.5rem;
                      /* Aumenta la altura del switch */
                    }
                  </style>
                  <br>
                  <div class="table-responsive">
                    <table class="table table-hover mb-0 display nowrap" id="user" width="100%">
                      <thead class="table-dark">
                        <tr>
                          <th>ID</th>
                          <th>EMAIL</th>
                          <th>NOMBRES</th>
                          <th>PRIMER APELLIDO</th>
                          <th>SEGUNDO APELLIDO</th>
                          <th>PASSWORD</th>
                          <th>ROL</th>
                          <th>ACTIVO</th>
                          <th>FECHA DE CREACIÓN</th>
                          <th>ACCIONES</th>
                        </tr>
                      </thead>
                      <tbody id="dtBody">
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- Modal de Modificación de Usuario -->
                <div class="modal fade" id="modalModificar" tabindex="-1" aria-labelledby="modalModificarLabel"
                  aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalModificarLabel">Modificar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form id="formModificar">
                          <input type="hidden" id="modificar_idusuario" name="idusuario">

                          <div class="mb-3">
                            <label for="modificar_email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="modificar_email" name="email" required>
                          </div>
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="modificar_nombre" class="form-label">Nombre</label>
                              <input type="text" class="form-control" id="modificar_nombre" name="nombre" required>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="modificar_apellidoP" class="form-label">Primer Apellido</label>
                              <input type="text" class="form-control" id="modificar_apellidoP" name="apellidoP" required>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="modificar_apellidoM" class="form-label">Segundo Apellido</label>
                              <input type="text" class="form-control" id="modificar_apellidoM" name="apellidoM" required>
                            </div>

                            <div class="col-md-6 mb-3 position-relative">
                              <label for="modificar_password" class="form-label">Contraseña</label>
                              <input type="password" class="form-control" id="modificar_password" name="password"
                                required>
                              <i class="fas fa-eye toggle-password"
                                style="position: absolute; right: 18px; top: 70%; transform: translateY(-50%); cursor: pointer;"></i>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="modificar_rol" class="form-label">Rol</label>
                              <select class="form-select" id="modificar_rol" name="rol" required>
                                <option value="">Selecciona un rol</option>
                                <option value="1">Administrador</option>
                                <option value="2">Usuario</option>
                              </select>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label class="form-label d-block">Activo</label>
                              <div class="form-check form-switch switch-lg">
                                <input class="form-check-input" type="checkbox" id="modificar_activo" name="activo">
                              </div>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="modificar_fecha_creacion" class="form-label">Fecha de Creación</label>
                            <input type="text" class="form-control" id="modificar_fecha_creacion" name="fecha_creacion"
                              readonly>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal de Módulos -->
                <div class="modal fade" id="modalModulos" tabindex="-1" aria-labelledby="modalModulosLabel"
                  aria-hidden="true">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalModulosLabel">Gestion de Módulos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form id="formModulos">
                          <input type="hidden" id="modulos_idusuario" name="idusuario">
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label class="form-label d-block">Dashboard</label>
                              <div class="form-check form-switch switch-lg">
                                <input class="form-check-input" type="checkbox" id="modulo_dashboard" name="dashboard">
                              </div>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label class="form-label d-block">Usuarios</label>
                              <div class="form-check form-switch switch-lg">
                                <input class="form-check-input" type="checkbox" id="modulo_usuarios" name="usuarios">
                              </div>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label class="form-label d-block">Formulario</label>
                              <div class="form-check form-switch switch-lg">
                                <input class="form-check-input" type="checkbox" id="modulo_formulario" name="formulario">
                              </div>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label class="form-label d-block">Inicio</label>
                              <div class="form-check form-switch switch-lg">
                                <input class="form-check-input" type="checkbox" id="modulo_inicio" name="inicio">
                              </div>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label class="form-label d-block">Reportes</label>
                              <div class="form-check form-switch switch-lg">
                                <input class="form-check-input" type="checkbox" id="modulo_reportes" name="reportes">
                              </div>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label class="form-label d-block">Descarga de documentos</label>
                              <div class="form-check form-switch switch-lg">
                                <input class="form-check-input" type="checkbox" id="modulo_descarga" name="descarga">
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="guardarModulos">Guardar Cambios</button>
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
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
      integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- JavaScript files-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Main Theme JS File-->
    <script src="js/theme.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTable --->
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.36/build/pdfmake.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.36/build/vfs_fonts.js"></script>
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
        $("#formRegistro").submit(function (event) {
          event.preventDefault();

          var formData = $(this).serialize();

          $.ajax({
            url: "../controlador/usuarios/controlador_user.php",
            type: "POST",
            data: formData,
            dataType: "json",
            beforeSend: function () {
              Swal.fire({
                title: "Registrando...",
                text: "Por favor, espera un momento.",
                allowOutsideClick: false,
                didOpen: () => {
                  Swal.showLoading();
                }
              });
            },
            success: function (response) {
              Swal.close();
              if (response.status === "success") {
                Swal.fire("¡Éxito!", response.message, "success").then(() => {
                  $("#modalRegistro").modal("hide");
                  $("#formRegistro")[0].reset();
                  location.reload();
                });
              } else {
                Swal.fire("Error", response.message, "error");
              }
            },
            error: function () {
              Swal.close();
              Swal.fire("Error", "No se pudo procesar la solicitud.", "error");
            }
          });
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        var table = $('#user').DataTable({
          order: [[0, 'asc']],
          columnDefs: [
            { orderable: false, targets: [5, 9] }
          ],
          language: {
            "sProcessing": "<br>Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
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
          processing: true,
          serverSide: true,
          ajax: {
            url: "../controlador/usuarios/get_users.php",
            type: "POST",
            data: function (d) {
              d.activo = 1;
            },
            error: function (xhr, error, thrown) {
              console.log(xhr.responseText);
              $("#dtBody").empty();
              $("#dtBody").append('<tr><td colspan="100%">Ocurrió un error al cargar los datos. Por favor, inténtelo de nuevo más tarde.</td></tr>');
            }
          },
          columns: [
            { data: "idusuario", title: "ID" },
            { data: "email", title: "EMAIL" },
            { data: "nombre", title: "NOMBRES" },
            { data: "apellidoP", title: "PRIMER APELLIDO" },
            { data: "apellidoM", title: "SEGUNDO APELLIDO" },
            {
              data: "password",
              title: "PASSWORD",
              render: function () {
                return "**********";
              }
            },
            {
              data: "rol", title: "ROL",
              render: function (data) {
                return data == 1 ? "Administrador" : "Usuario";
              }
            },
            {
              data: "activo",
              title: "ACTIVO",
              render: function (data) {
                //console.log("Valor de 'activo':", data); 
                return data == 1 ? "Activo" : "Inactivo";
              }
            },
            { data: "fecha_creacion", title: "FECHA DE CREACIÓN" },
            {
              data: null,
              title: "ACCIONES",
              render: function (data) {
                return `
                  <button class="btn btn-danger btn-sm" onclick="eliminarUsuario(${data.idusuario})">
                    <i class="fas fa-trash"></i> 
                  </button>
                  <button class="btn btn-warning btn-sm" onclick="modificarUsuario(${data.idusuario})">
                    <i class="fas fa-edit"></i> 
                  </button>
                  <button class="btn btn-info btn-sm modulosBtn" data-id="${data.idusuario}" data-bs-toggle="modal" data-bs-target="#modalModulos">
                    <i class="fas fa-cogs"></i> 
                  </button>
                `;
              }
            }
          ],
          dom: "Bfrtip",
          lengthMenu: [
            [10, 25, 50, -1],
            ['10 registros', '25 registros', '50 registros', 'Todos']
          ],
          buttons: [
            'pageLength',
            'colvis',
            {
              extend: 'excel',
              footer: true,
              title: 'USUARIOS ALMACÉN | IEEH',
              filename: 'Usuarios_Excel',
              text: 'Excel <i class="fas fa-file-excel"></i>',
              className: 'excelButton',
            },
            {
              extend: 'pdf',
              footer: true,
              title: 'USUARIOS ALMACÉN | IEEH',
              filename: 'Usuarios_pdf',
              text: 'PDF <i class="far fa-file-pdf"></i>',
              orientation: 'landscape',
              className: 'pdfButton',
            },
            {
              extend: 'print',
              footer: true,
              title: 'USUARIOS ALMACÉN | IEEH',
              filename: 'Print_File',
              text: 'Imprimir <i class="fa fa-print"></i>',
              orientation: 'landscape',
              className: 'printButton',
            },
            {
              extend: 'copy',
              footer: true,
              title: 'USUARIOS ALMACÉN | IEEH',
              filename: 'Copy_File',
              text: 'Copiar <i class="fa fa-clone"></i>',
              className: 'copyButton',
            }
          ]
        });
      });
    </script>
    <script>
      function eliminarUsuario(idusuario) {
        Swal.fire({
          title: '¿Estás seguro?',
          text: "¡No podrás revertir esta acción!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, eliminar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '../controlador/usuarios/eliminar_usuario.php',
              type: 'POST',
              data: { idusuario: idusuario },
              success: function (response) {
                if (response.success) {
                  Swal.fire(
                    '¡Eliminado!',
                    'El usuario ha sido eliminado.',
                    'success'
                  ).then(() => {
                    $('#user').DataTable().ajax.reload();
                  });
                } else {
                  Swal.fire(
                    'Error',
                    'No se pudo eliminar el usuario.',
                    'error'
                  );
                }
              },
              error: function () {
                Swal.fire(
                  'Error',
                  'Ocurrió un error al intentar eliminar el usuario.',
                  'error'
                );
              }
            });
          }
        });
      }
    </script>
    <script>
      function modificarUsuario(idusuario) {
        $.ajax({
          url: '../controlador/usuarios/obtener_usuario.php',
          type: 'POST',
          data: { idusuario: idusuario },
          success: function (response) {
            try {
              if (response && response.success) {
                const usuario = response.data;

                $('#modalModificarLabel').text('Modificar Usuario');
                $('#modificar_idusuario').val(usuario.idusuario);
                $('#modificar_email').val(usuario.email);
                $('#modificar_nombre').val(usuario.nombre);
                $('#modificar_apellidoP').val(usuario.apellidoP);
                $('#modificar_apellidoM').val(usuario.apellidoM);
                $('#modificar_rol').val(usuario.rol);
                $('#modificar_activo').prop('checked', usuario.activo == 1);
                $('#modificar_password').val(usuario.password);
                $('#modificar_fecha_creacion').val(usuario.fecha_creacion);

                $('#modalModificar').modal('show');
              } else {
                Swal.fire('Error', response.message || 'No se pudieron cargar los datos del usuario.', 'error');
              }
            } catch (error) {
              console.error('Error al procesar la respuesta:', error);
              Swal.fire('Error', 'La respuesta del servidor no es válida.', 'error');
            }
          },
          error: function (xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
            Swal.fire('Error', 'Ocurrió un error al cargar los datos del usuario.', 'error');
          }
        });
      }

      $('#formModificar').on('submit', function (e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.ajax({
          url: '../controlador/usuarios/guardar_usuario.php',
          type: 'POST',
          data: formData,
          success: function (response) {
            try {
              const data = JSON.parse(response);
              if (data.success) {
                Swal.fire('¡Éxito!', data.message || 'Los cambios se guardaron correctamente.', 'success').then(() => {
                  $('#modalModificar').modal('hide');
                  $('#user').DataTable().ajax.reload();
                });
              } else {
                Swal.fire('Error', data.message || 'No se pudieron guardar los cambios.', 'error');
              }
            } catch (error) {
              console.error('Error al parsear la respuesta JSON:', error);
              Swal.fire('Error', 'La respuesta del servidor no es válida.', 'error');
            }
          },
          error: function (xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
            Swal.fire('Error', 'Ocurrió un error al guardar los cambios.', 'error');
          }
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('.toggle-password').click(function () {
          const passwordInput = $('#modificar_password');
          const icon = $(this);

          if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
          } else {
            passwordInput.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
          }
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $(document).on('click', '.modulosBtn', function () {
          const idusuario = $(this).data('id');
          $('#modulos_idusuario').val(idusuario);

          $.ajax({
            url: '../controlador/usuarios/obtener_permisos.php',
            type: 'POST',
            data: { idusuario: idusuario },
            success: function (response) {
              const permisos = JSON.parse(response);
              if (permisos.success) {
                // Marcar los switches según los permisos
                $('#modulo_dashboard').prop('checked', permisos.data.dashboard == 1);
                $('#modulo_usuarios').prop('checked', permisos.data.usuarios == 1);
                $('#modulo_formulario').prop('checked', permisos.data.formulario == 1);
                $('#modulo_inicio').prop('checked', permisos.data.inicio == 1);
                $('#modulo_reportes').prop('checked', permisos.data.reportes == 1);
                $('#modulo_descarga').prop('checked', permisos.data.descarga == 1);
              } else {
                Swal.fire('Error', permisos.message || 'No se pudieron cargar los permisos.', 'error');
              }
            },
            error: function () {
              Swal.fire('Error', 'Ocurrió un error al cargar los permisos.', 'error');
            }
          });
        });

        $('#guardarModulos').on('click', function () {
          const idusuario = $('#modulos_idusuario').val();
          const permisos = {
            dashboard: $('#modulo_dashboard').is(':checked') ? 1 : 0,
            usuarios: $('#modulo_usuarios').is(':checked') ? 1 : 0,
            formulario: $('#modulo_formulario').is(':checked') ? 1 : 0,
            inicio: $('#modulo_inicio').is(':checked') ? 1 : 0,
            reportes: $('#modulo_reportes').is(':checked') ? 1 : 0,
            descarga: $('#modulo_descarga').is(':checked') ? 1 : 0
          };

          $.ajax({
            url: '../controlador/usuarios/guardar_permisos.php',
            type: 'POST',
            data: { idusuario: idusuario, permisos: permisos },
            success: function (response) {
              const data = JSON.parse(response);
              if (data.success) {
                Swal.fire('Éxito', 'Los permisos se guardaron correctamente.', 'success').then(() => {
                  location.reload();
                });
              } else {
                Swal.fire('Error', 'No se pudieron guardar los permisos.', 'error');
              }
            },
            error: function () {
              Swal.fire('Error', 'Ocurrió un error al guardar los permisos.', 'error');
            }
          });
        });
      });
    </script>
  </body>

  </html>
  <?php
}
?>