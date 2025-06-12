<?php
use controlador\phpmailer\PHPMailer;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

include "../modelo/conexion.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el registro está abierto
    $control = $db_connection->query("SELECT abierto FROM control_registros ORDER BY id DESC LIMIT 1")->fetch_assoc();
    if (!$control || $control['abierto'] == 0) {
        echo json_encode(["status" => "error", "message" => "La convocatoria ha concluido. Actualmente no se permiten nuevos registros de usuarios.."]);
        exit;
    }

    $email = $_POST["email"] ?? '';
    $nombre = $_POST["nombre"] ?? '';
    $apellidoP = $_POST["apellidoP"] ?? '';
    $apellidoM = $_POST["apellidoM"] ?? '';

    // Verificar campos vacíos
    if (empty($email) || empty($nombre) || empty($apellidoP)) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios."]);
        exit;
    }

    // Validar formato de correo
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Correo electrónico inválido."]);
        exit;
    }

    /* // Validar que el correo sea de Gmail
    if (!preg_match('/@gmail\.com$/i', $email)) {
        echo json_encode(["status" => "error", "message" => "Solo se permiten correos de Gmail."]);
        exit;
    } */

    // Verificar si el correo ya está registrado
    $stmt = $db_connection->prepare("SELECT COUNT(*) FROM usuario WHERE email = ?");
    if (!$stmt) {
        die("Error en la consulta SQL: " . $db_connection->error);
    }
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

    // Insertar usuario
    $stmt = $db_connection->prepare("INSERT INTO usuario (email, nombre, apellidoP, apellidoM, password, rol, fecha_creacion, activo, `delete`) VALUES (?, ?, ?, ?, ?, '2', ?, 1, 1)");
    if (!$stmt) {
        die("Error en la consulta SQL: " . $db_connection->error);
    }
    $stmt->bind_param("ssssss", $email, $nombre, $apellidoP, $apellidoM, $password, $fecha_creacion);

    if ($stmt->execute()) {
        $idusuario = $db_connection->insert_id;

        // Insertar permisos predeterminados
        $dashboard = 0; // Deshabilitado
        $usuarios = 0;  // Deshabilitado
        $formulario = 1; // Habilitado
        $inicio = 1;     // Habilitado
        $reportes = 0;   // Deshabilitado
        $descarga = 1;   // Habilitado

        $stmt_permisos = $db_connection->prepare("
            INSERT INTO permisos (
                idusuario, dashboard, usuarios, formulario, inicio, reportes, descarga
            ) VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        if (!$stmt_permisos) {
            die("Error en la consulta SQL de permisos: " . $db_connection->error);
        }
        $stmt_permisos->bind_param(
            "iiiiiii",
            $idusuario,
            $dashboard,
            $usuarios,
            $formulario,
            $inicio,
            $reportes,
            $descarga
        );

        if ($stmt_permisos->execute()) {
            // Preparar y enviar correo
            $template = file_get_contents('../template/index.html');
            $template = str_replace('{email}', $email, $template);
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

            $mail->setFrom('reclutanotifi23@gmail.com', 'Premio 17 de octubre | IEEH');
            $mail->addAddress($email);
            $mail->Subject = 'Registro Exitoso';
            $mail->isHTML(true);
            $mail->Body = $template;

            if (!$mail->send()) {
                echo json_encode(["status" => "error", "message" => "Error al enviar el correo: " . $mail->ErrorInfo]);
            } else {
                echo json_encode(["status" => "success", "message" => "Registro exitoso. Se ha enviado un correo con tu contraseña."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Error al registrar los permisos del usuario."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar el usuario."]);
    }

    $stmt->close();
}
?>