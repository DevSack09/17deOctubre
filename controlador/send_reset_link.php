<?php
use controlador\phpmailer\PHPMailer;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

include "../modelo/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? '';

    $stmt = $db_connection->prepare("SELECT idusuario FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $token = bin2hex(random_bytes(50));
        $stmt->bind_result($idusuario);
        $stmt->fetch();
        $stmt_insert = $db_connection->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR)) ON DUPLICATE KEY UPDATE token=?, expires_at=DATE_ADD(NOW(), INTERVAL 1 HOUR)");
        $stmt_insert->bind_param("sss", $email, $token, $token);
        $stmt_insert->execute();

        $template = file_get_contents("../template/resetPassword.html");
        /** 
         * ! cambiar liga por la del servidor
         */
        $reset_link = "http://localhost/17deoctubre/reset_password.php?token=" . $token;

        $template = str_replace("{reset_link}", $reset_link, $template);

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
        $mail->Subject = 'Restablecimiento de contraseña';
        $mail->Body = $template;
        $mail->isHTML(true);

        if (!$mail->send()) {
            echo json_encode(["status" => "error", "message" => "Error al enviar el correo: " . $mail->ErrorInfo]);
        } else {
            echo json_encode(["status" => "success", "message" => "Hemos enviado un enlace para restablecer tu contraseña a $email."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "El correo electrónico no está registrado."]);
    }
    $stmt->close();
}

?>