<?php
use \controlador\phpmailer\PHPMailer;
require '../phpmailer/Exception.php';
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';

include "../../modelo/conexion.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? '';
    $nombre = $_POST["nombre"] ?? '';
    $apellidoP = $_POST["apellidoP"] ?? '';
    $apellidoM = $_POST["apellidoM"] ?? '';
    $area = $_POST["area"] ?? '';
    $rol = $_POST["rol"] ?? '';
    $activo = isset($_POST["activo"]) ? 1 : 0; 

    // Validación de campos vacíos
    if (empty($email) || empty($nombre) || empty($apellidoP) || empty($apellidoM) || empty($area) || empty($rol)) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios."]);
        exit;
    }

    // Validación de correo
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Correo electrónico inválido."]);
        exit;
    }

    // Verificar si el correo ya está registrado
    $stmt = $db_connection->prepare("SELECT COUNT(*) FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo json_encode(["status" => "error", "message" => "El correo electrónico ya está registrado."]);
        exit;
    }

    // Generar contraseña aleatoria
    $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
    
    // Fecha de creación
    $fecha_creacion = date('Y-m-d H:i:s');

    // Insertar nuevo usuario
    $stmt = $db_connection->prepare("INSERT INTO usuario (email, nombre, apellidoP, apellidoM, area, password, rol, activo, fecha_creacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssis", $email, $nombre, $apellidoP, $apellidoM, $area, $password, $rol, $activo, $fecha_creacion);

    if ($stmt->execute()) {
        $template = file_get_contents('../../template/index.html');
        
        $template = str_replace('{nombre}', $nombre, $template);
        $template = str_replace('{password}', $password, $template);

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'reclutanotifi23@gmail.com';
        $mail->Password = 'wadoxputcllryfqf';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = "UTF-8";

        $mail->setFrom('tu-email@dominio.com', 'Almacén 2025 | IEEH');
        $mail->addAddress($email);
        $mail->Subject = 'Registro Exitoso';
        $mail->isHTML(true);
        $mail->Body = $template;

        if (!$mail->send()) {
            echo json_encode(["status" => "error", "message" => "Registro exitoso, pero no se pudo enviar el correo: " . $mail->ErrorInfo]);
        } else {
            echo json_encode(["status" => "success", "message" => "Usuario registrado correctamente y correo enviado."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar el usuario."]);
    }

    $stmt->close();
}
?>
