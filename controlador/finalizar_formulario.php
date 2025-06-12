<?php
include "../modelo/conexion.php";
use controlador\phpmailer\PHPMailer;
require '../controlador/phpmailer/Exception.php';
require '../controlador/phpmailer/PHPMailer.php';
require '../controlador/phpmailer/SMTP.php';
session_start();

if (!isset($_SESSION["idusuario"])) {
    echo json_encode(['status' => 'error', 'message' => 'No se ha iniciado sesión.']);
    exit;
}

$usuario_id = $_SESSION["idusuario"];
$curp = $_POST['curp'] ?? null;

if (!$curp) {
    echo json_encode(['status' => 'error', 'message' => 'El campo CURP es obligatorio']);
    exit;
}

if ($db_connection->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Error al conectar a la base de datos']);
    exit;
}

$sql_check = "SELECT id, folio, categoria, fecha_registro FROM registration WHERE curp = ? AND usuario_id = ?";
$stmt_check = $db_connection->prepare($sql_check);

if ($stmt_check) {
    $stmt_check->bind_param("si", $curp, $usuario_id);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $stmt_check->bind_result($id, $folio, $categoria, $fecha_registro);
        $stmt_check->fetch();

        // Actualizar el estado del formulario a "finalizado"
        $sql_update = "UPDATE registration SET status = 1 WHERE curp = ? AND usuario_id = ?";
        $stmt_update = $db_connection->prepare($sql_update);

        if ($stmt_update) {
            $stmt_update->bind_param("si", $curp, $usuario_id);

            if ($stmt_update->execute()) {
                // Obtener el correo y nombre del usuario
                $sql_user = "SELECT email, nombre FROM usuario WHERE idusuario = ?";
                $stmt_user = $db_connection->prepare($sql_user);
                $stmt_user->bind_param("i", $usuario_id);
                $stmt_user->execute();
                $stmt_user->bind_result($email, $nombre);
                $stmt_user->fetch();
                $stmt_user->close();

                // Preparar y enviar correo
                $template = file_get_contents('../template/succes.html');
                $template = str_replace('{nombre}', $nombre, $template);
                $template = str_replace('{folio}', $folio, $template);
                $template = str_replace('{categoria}', $categoria, $template);
                $template = str_replace('{fecha_registro}', $fecha_registro, $template);
                $template = str_replace('{usuario_id}', $usuario_id, $template);

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
                $mail->addAddress($email, $nombre);
                $mail->Subject = 'Confirmación de registro - Premio 17 de Octubre';
                $mail->isHTML(true);
                $mail->Body = $template;

                // Enviar correo y responder según resultado
                try {
                    $mail->send();
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Formulario finalizado correctamente. Se ha enviado un correo de confirmación.',
                        'usuario_id' => $usuario_id
                    ]);
                } catch (Exception $e) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Formulario finalizado correctamente, pero no se pudo enviar el correo de confirmación.',
                        'usuario_id' => $usuario_id
                    ]);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el estado del formulario']);
            }

            $stmt_update->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al preparar la consulta de actualización']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se encontró el registro asociado al CURP proporcionado']);
    }

    $stmt_check->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error en la consulta de verificación']);
}

$db_connection->close();
?>