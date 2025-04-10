<?php
session_start();
if (!empty($_SESSION["idusuario"]) && $_SESSION['rol'] == 'Administrador') {
    header("location: data/dashboard.php");
} else if (!empty($_SESSION["idusuario"]) && $_SESSION['rol'] == 'Usuario') {
    header("location: data/index.php");
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
                        <!-- formulario login -->
                        <form method="POST" action="#" class="sign-in-form">
                            <h2 class="title">Iniciar sesión</h2>
                            <?php
                            include "modelo/conexion.php";
                            include "controlador/controlador_login.php";
                            ?>
                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <input id="email" name="email" type="text" placeholder="Email" />
                            </div>
                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input id="password" name="password" type="password" placeholder="Contraseña" />
                                <span id="togglePassword" class="toggle-password">
                                    <i class="far fa-eye"></i>
                                </span>
                            </div>
                            <a style="font-size: 15px; text-align: left;" class="link-forgot-password"
                                href="forgot_password.php">
                                Olvidé mi contraseña
                            </a>
                            <!-- Campo oculto para almacenar el token de reCAPTCHA -->
                            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                            <input name="btningresar" type="submit" value="Iniciar sesión" class="btn solid" />
                            <a href="#" class="rounded-button google-login-button">
                                <span class="google-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path
                                            d="M113.47 309.408L95.648 375.94l-65.139 1.378C11.042 341.211 0 299.9 0 256c0-42.451 10.324-82.483 28.624-117.732h.014L86.63 148.9l25.404 57.644c-5.317 15.501-8.215 32.141-8.215 49.456.002 18.792 3.406 36.797 9.651 53.408z"
                                            fill="#fbbb00" />
                                        <path
                                            d="M507.527 208.176C510.467 223.662 512 239.655 512 256c0 18.328-1.927 36.206-5.598 53.451-12.462 58.683-45.025 109.925-90.134 146.187l-.014-.014-73.044-3.727-10.338-64.535c29.932-17.554 53.324-45.025 65.646-77.911h-136.89V208.176h245.899z"
                                            fill="#518ef8" />
                                        <path
                                            d="M416.253 455.624l.014.014C372.396 490.901 316.666 512 256 512c-97.491 0-182.252-54.491-225.491-134.681l82.961-67.91c21.619 57.698 77.278 98.771 142.53 98.771 28.047 0 54.323-7.582 76.87-20.818l83.383 68.262z"
                                            fill="#28b446" />
                                        <path
                                            d="M419.404 58.936l-82.933 67.896C313.136 112.246 285.552 103.82 256 103.82c-66.729 0-123.429 42.957-143.965 102.724l-83.397-68.276h-.014C71.23 56.123 157.06 0 256 0c62.115 0 119.068 22.126 163.404 58.936z"
                                            fill="#f14336" />
                                    </svg></span>
                                <span>Sign in with google</span>
                            </a>
                        </form>

                        <!-- formulario registrar -->
                        <form id="registroForm" method="POST" action="#" class="sign-up-form">
                            <h2 class="title">Registrarse</h2>
                            <div class="input-field">
                                <i class="fas fa-envelope"></i>
                                <input id="email" name="email" type="email" placeholder="Correo" />
                            </div>
                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <input id="nombre" name="nombre" type="text" placeholder="Nombre" />
                            </div>
                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <input id="apellidoP" name="apellidoP" type="text" placeholder="Primer apellido" />
                            </div>
                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <input id="apellidoM" name="apellidoM" type="text" placeholder="Segundo apellido" />
                            </div>
                            <button id="submitBtn" type="submit" class="btn">
                                Registrarse
                                <span id="loadingText" style="display: none; margin-left: 10px;"><i
                                        class="fas fa-spinner fa-spin"></i> Cargando...</span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="panels-container">
                    <div class="panel left-panel">
                        <div class="content">
                            <h3>Premio 17 de octubre | IEEH</h3>
                            <!-- <p>El corazón del Instituto está en su almacén: donde cada entrada y salida impulsa el crecimiento, la eficiencia y el éxito.</p> -->
                            <p>Si aun no tienes una cuenta registrate aquí.</p>
                            <button class="btn transparent" id="sign-up-btn">Registrarse</button>
                        </div>
                        <img src="img/undraw_calendar_8r6s.svg" class="image" alt="" />
                    </div>
                    <div class="panel right-panel">
                        <div class="content">
                            <h3>Premio 17 de octubre | IEEH</h3>
                            <!-- <p>Un almacén organizado es la clave para un trabajo exitoso.</p> -->
                            <p>Si ya tienes una cuenta inicia sesión aquí.</p>
                            <button class="btn transparent" id="sign-in-btn"> Iniciar sesión</button>
                        </div>
                        <img src="img/undraw_workspace_s6wf.svg" class="image" alt="" />
                    </div>
                </div>
            </div>
            <script src="js/app.js"></script>
            <script src="js/darkLight.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://www.google.com/recaptcha/api.js?render=6LcMXigqAAAAAC0N6KZ7uED5UyrQSgifIjSj0TjP"></script>
            <script>
                grecaptcha.ready(function () {
                    grecaptcha.execute('6LcMXigqAAAAAC0N6KZ7uED5UyrQSgifIjSj0TjP', { action: 'login' }).then(function (token) {
                        document.getElementById('recaptchaResponse').value = token;
                    });
                });
            </script>
            <script>
                document.getElementById('registroForm').addEventListener('submit', function (event) {
                    event.preventDefault();
                    var body = new FormData(this);
                    var submitBtn = document.getElementById('submitBtn');

                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span id="loadingText"><i class="fas fa-spinner fa-spin"></i> Cargando...</span>';

                    fetch('controlador/controlador_registrar.php', { method: 'POST', body })
                        .then(response => response.json())
                        .then(data => {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = 'Registrarse';
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'Éxito',
                                    text: data.message,
                                    icon: 'success'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: data.message,
                                    icon: 'error'
                                });
                            }
                        })
                        .catch(error => {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = 'Registrarse';
                            Swal.fire({
                                title: 'Error',
                                text: 'Ocurrió un problema. Intenta nuevamente.',
                                icon: 'error'
                            });
                        });
                });
            </script>
            <script>
                const togglePassword = document.getElementById('togglePassword');
                const passwordField = document.getElementById('password');


                togglePassword.addEventListener('click', function () {
                    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordField.setAttribute('type', type);

                    this.querySelector('i').classList.toggle('fa-eye');
                    this.querySelector('i').classList.toggle('fa-eye-slash');
                });
            </script>
        </body>

        </html>
    <?php
}
?>