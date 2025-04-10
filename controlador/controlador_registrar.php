<?php
use controlador\phpmailer\PHPMailer;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

include "../modelo/conexion.php"; 

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? '';
    $nombre = $_POST["nombre"] ?? '';
    $apellidoP = $_POST["apellidoP"] ?? '';
    $apellidoM = $_POST["apellidoM"] ?? '';
    $area = ''; 

    if (empty($email) || empty($nombre) || empty($apellidoP) || empty($apellidoM)) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios."]);
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Correo electrónico inválido."]);
        exit;
    }

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

    $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);

    $fecha_creacion = date('Y-m-d H:i:s');

    $stmt = $db_connection->prepare("INSERT INTO usuario (email, nombre, apellidoP, apellidoM, area, password, rol, fecha_creacion, activo, `delete`) VALUES (?, ?, ?, ?, ?, ?, '2', ?, 1, 1)");
    $stmt->bind_param("sssssss", $email, $nombre, $apellidoP, $apellidoM, $area, $password, $fecha_creacion);
    
    if ($stmt->execute()) {
        $idusuario = $db_connection->insert_id;

        // Insertar permisos para el módulo de "almacén"
        $almacen = 1; 
        $usuarios = 0; 
        $areas = 0; 
        $departamentos = 0; 
        $proveedores = 0; 
        $articulos = 0; 
        $entrada = 0; 
        $salidas = 0; 
        $reportes = 0; 
        $bitacora = 0; 

        $stmt_permisos = $db_connection->prepare("
            INSERT INTO permisos (
                idusuario, almacen, usuarios, areas, departamentos, proveedores, articulos, entrada, salidas, reportes, bitacora
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt_permisos->bind_param(
            "iiiiiiiiiii",
            $idusuario, $almacen, $usuarios, $areas, $departamentos, $proveedores, $articulos, $entrada, $salidas, $reportes, $bitacora
        );

        if ($stmt_permisos->execute()) {
            // Preparar el correo con la contraseña generada
            $template = file_get_contents('../template/index.html');
            
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
            
            $mail->setFrom('reclutanotifi23@gmail.com', 'Sistema Control de Almacén | IEEH');
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