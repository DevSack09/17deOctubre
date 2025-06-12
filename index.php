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
                                <input id="email" name="email" type="text" placeholder="Correo electrónico" />
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
                            <!-- <a style="font-size: 15px; text-align: left;" class="link-forgot-password" id="sign-up-btn"
                                href="#">
                                Si aun no tienes una cuenta registrate aquí.
                            </a> -->
                            <!-- Campo oculto para almacenar el token de reCAPTCHA -->
                            <input type="hidden" name="recaptcha_response" id="recaptchaResponse"><br>
                            <input name="btningresar" type="submit" value="Iniciar sesión" class="btn solid" />

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
                            <h1>Premio 17 de octubre 2025 | IEEH</h1>
                            <h2>Décima Tercera Edición</h2>
                            <!-- <p>El corazón del Instituto está en su almacén: donde cada entrada y salida impulsa el crecimiento, la eficiencia y el éxito.</p> -->
                            <p style="font-size: 20px;">¿Aún no tienes una cuenta? Regístrate aquí.</p>
                            <button class="btn transparent" id="sign-up-btn">Registrarse</button>
                        </div>
                        <img src="img/undraw_calendar_8r6s.svg" class="image" alt="" />
                    </div>
                    <div class="panel right-panel">
                        <div class="content">
                            <h1>Premio 17 de octubre 2025 | IEEH</h1>
                            <h2>Décima Tercera Edición</h2>
                            <!-- <p>Un almacén organizado es la clave para un trabajo exitoso.</p> -->
                            <p style="font-size: 20px;">Si ya tienes una cuenta inicia sesión aquí.</p>
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