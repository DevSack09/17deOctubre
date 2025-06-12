<?php

if (!empty($_POST["btningresar"])) {
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Validar reCAPTCHA v3
        $recaptcha_secret = '6LcMXigqAAAAAPWofdJl2-L9H91qjPZ4uC2dLcbM';
        $recaptcha_response = $_POST['recaptcha_response'];

        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}");
        $response_keys = json_decode($response, true);

        if ($response_keys["success"] && $response_keys["score"] >= 0.5) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo '<div class="error-msg"><i class="fa fa-times-circle"></i> Por favor ingresa un correo electrónico válido.</div>';
            } else {
                $stmt = $db_connection->prepare("SELECT u.*, r.descripcion FROM usuario AS u INNER JOIN rol AS r ON u.rol = r.idrol WHERE u.email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $datos = $result->fetch_object();

                    if ($datos->activo == 1 && $datos->delete == 1) {
                        if ($datos->password === $password) {
                            $_SESSION["idusuario"] = $datos->idusuario;
                            $_SESSION["nombre"] = $datos->nombre;
                            $_SESSION["apellidoP"] = $datos->apellidoP;
                            $_SESSION["area"] = $datos->area;
                            $_SESSION['rol'] = $datos->descripcion;

                            if ($datos->rol == '1') { // Administrador
                                header("Location: data/index.php");
                            } elseif ($datos->rol == '2') { // Capturista
                                header("Location: data/inicio.php");
                            }
                            exit();
                        } else {
                            echo '<div class="error-msg"><i class="fa fa-times-circle"></i> Contraseña incorrecta.</div>';
                        }
                    } else {
                        if ($datos->activo == 0) {
                            echo '<div class="error-msg"><i class="fa fa-times-circle"></i> Tu cuenta está inactiva. Contacta al administrador.</div>';
                        } elseif ($datos->delete == 0) {
                            echo '<div class="error-msg"><i class="fa fa-times-circle"></i> Tu cuenta ha sido eliminada. Contacta al administrador.</div>';
                        }
                    }
                } else {
                    echo '<div class="error-msg"><i class="fa fa-times-circle"></i> El correo no está registrado.</div>';
                }

                $stmt->close();
            }
        } else {
            echo '<div class="error-msg"><i class="fa fa-times-circle"></i> Falló la verificación de reCAPTCHA. Por favor, inténtalo de nuevo.</div>';
        }
    } else {
        echo '<div class="error-msg"><i class="fa fa-times-circle"></i> Campos vacíos.</div>';
    }
}
?>