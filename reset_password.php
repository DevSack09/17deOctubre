<?php
session_start();
if (!empty($_SESSION["idusuario"]) && $_SESSION['rol'] == 'Administrador') {
    header("location: material/pages/dashboard.php");
} else if (!empty($_SESSION["idusuario"]) && $_SESSION['rol'] == 'Usuario') {
    header("location: inicio.php");
} else {
    include "modelo/conexion.php";

    $token = '';

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $token = $_GET["token"] ?? '';

        $stmt = $db_connection->prepare("SELECT email FROM password_resets WHERE token = ? AND expires_at > NOW()");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($email);
            $stmt->fetch();
        } else {
            echo "Enlace inválido o caducado.";
            exit;
        }
    }
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <script src="https://kit.fontawesome.com/5bcc3d727d.js" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
            <link rel="stylesheet" href="css/style.css" />
            <link rel="stylesheet" href="css/alert.css" />
            <link rel="stylesheet" href="css/main.css" />
            <title>Premio 17 de octubre | IEEH</title>
        </head>

        <body>
            <div class="theme-switch" id="themeSwitch">
                <i class="fas fa-sun light-icon" id="lightIcon"></i>
                <i class="fas fa-moon dark-icon" id="darkIcon" style="display: none;"></i>
            </div>
            <div class="container">
                <div class="forms-container">
                    <div class="signin-signup">
                        <form id="resetPasswordForm" method="POST">
                            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>" />
                            <h2>Nueva Contraseña</h2>
                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" id="password" placeholder="Nueva contraseña" />
                                <span id="togglePassword" class="toggle-password">
                                    <i class="far fa-eye"></i> <!-- Ícono inicial -->
                                </span>
                            </div>
                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    placeholder="Confirma tu contraseña" />
                                <span id="toggleConfirmPassword" class="toggle-password">
                                    <i class="far fa-eye"></i> <!-- Ícono inicial -->
                                </span>
                            </div>
                            <input type="submit" value="Restablecer" class="btn solid" />
                        </form>
                    </div>
                </div>
                <div class="panels-container">
                    <div class="panel left-panel">
                        <div class="content">
                            <h1>Premio 17 de octubre | IEEH</h1>
                            <p style="font-size: 20px;">
                                La seguridad comienza contigo: protege tu contraseña, mantén tus datos seguros.
                            </p>
                        </div>
                        <img src="img/undraw_fingerprint-login_19qv.svg" class="image" alt="" />
                    </div>
                </div>
            </div>
            <script src="js/darkLight.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.getElementById("resetPasswordForm").addEventListener("submit", function (event) {
                    event.preventDefault();

                    var password = document.getElementById("password").value;
                    var confirm_password = document.getElementById("confirm_password").value;
                    var formData = new FormData(this);

                    if (!password || !confirm_password) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Por favor, completa ambos campos de contraseña.',
                        });
                        return;
                    }

                    if (password !== confirm_password) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Las contraseñas no coinciden.',
                        });
                        return;
                    }

                    fetch("controlador/update_password.php", {
                        method: "POST",
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Éxito',
                                    text: data.message,
                                }).then(() => {
                                    window.location.href = "index.php";
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
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ocurrió un error al procesar tu solicitud.',
                            });
                        });
                });
            </script>
            <script>
                function togglePasswordVisibility(inputId, toggleId) {
                    const passwordField = document.getElementById(inputId);
                    const togglePassword = document.getElementById(toggleId);

                    togglePassword.addEventListener('click', function () {
                        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordField.setAttribute('type', type);

                        this.querySelector('i').classList.toggle('fa-eye');
                        this.querySelector('i').classList.toggle('fa-eye-slash');
                    });
                }

                togglePasswordVisibility('password', 'togglePassword');

                togglePasswordVisibility('confirm_password', 'toggleConfirmPassword');
            </script>
        </body>

        </html>
    <?php
}
?>