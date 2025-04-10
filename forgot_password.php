<?php
session_start();
if (!empty($_SESSION["idusuario"]) && $_SESSION['rol'] == 'Administrador') {
  header("location: material/pages/dashboard.php");
} else if (!empty($_SESSION["idusuario"]) && $_SESSION['rol'] == 'Usuario') {
  header("location: inicio.php");
} else {
  ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <title>Premio 17 de octubre | IEEH</title>
      <link rel="icon" type="image/png" href="img/IEEH.png" />
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <script src="https://kit.fontawesome.com/5bcc3d727d.js" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
      <link rel="stylesheet" href="css/style.css" />
      <link rel="stylesheet" href="css/alert.css" />

    </head>

    <body>
      <div class="theme-switch" id="themeSwitch">
        <i class="fas fa-sun light-icon" id="lightIcon"></i>
        <i class="fas fa-moon dark-icon" id="darkIcon" style="display: none;"></i>
      </div>
      <div class="container">
        <div class="forms-container">
          <div class="signin-signup">
            <!-- formulario -->
            <form id="resetForm" method="POST" action="controlador/send_reset_link.php">
              <h2>Restablecer Contraseña</h2>
              <div class="input-field">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Introduce tu correo electrónico" />
              </div>
              <button id="resetButton" type="submit" class="btn">
                Enviar enlace
                <span id="loadingText" style="display: none; margin-left: 10px;">
                  <i class="fas fa-spinner fa-spin"></i>
                </span>
              </button>
            </form>

          </div>
        </div>
        <div class="panels-container">
          <div class="panel left-panel">
            <div class="content">
              <h3>IEEH | Sistema de Almacén</h3>
              <p>
                Cuidar lo que almacenamos es proteger lo que construimos juntoso.
              </p>
              <!-- <button class="btn transparent" id="sign-up-btn">
              Registrarse
            </button> -->
            </div>
            <img src="img/undraw_secure-login_m11a.svg" class="image" alt="" />
          </div>
        </div>
      </div>
      <script src="js/darkLight.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
        document.getElementById('resetForm').addEventListener('submit', function (e) {
          e.preventDefault();

          var resetButton = document.getElementById('resetButton');
          var loadingText = document.getElementById('loadingText');

          resetButton.disabled = true;
          loadingText.style.display = 'inline';
          resetButton.childNodes[0].textContent = " Cargando...";

          var formData = new FormData(this);

          fetch(this.action, {
            method: 'POST',
            body: formData
          })
            .then(response => response.json())
            .then(data => {
              resetButton.disabled = false;
              loadingText.style.display = 'none';
              resetButton.childNodes[0].textContent = "Enviar enlace";

              if (data.status === 'success') {
                Swal.fire({
                  icon: 'success',
                  title: 'Éxito',
                  text: data.message,
                }).then(() => {
                  window.location.href = 'index.php';
                });
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: data.message,
                });
              }
            })
            .catch(error => {
              resetButton.disabled = false;
              loadingText.style.display = 'none';
              resetButton.childNodes[0].textContent = "Enviar enlace";
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al procesar la solicitud. Por favor, inténtalo nuevamente.',
              });
            });
        });
      </script>

    </body>

    </html>
  <?php
}
?>