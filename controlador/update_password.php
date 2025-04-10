<?php
include "../modelo/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"] ?? '';
    $new_password = $_POST["password"] ?? '';

    $stmt = $db_connection->prepare("SELECT email FROM password_resets WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($email);
        $stmt->fetch();

        $stmt_update = $db_connection->prepare("UPDATE usuario SET password = ? WHERE email = ?");
        $stmt_update->bind_param("ss", $new_password, $email);
        if ($stmt_update->execute()) {
            $stmt_delete = $db_connection->prepare("DELETE FROM password_resets WHERE token = ?");
            $stmt_delete->bind_param("s", $token);
            $stmt_delete->execute();

            echo json_encode(["status" => "success", "message" => "Tu contraseña ha sido actualizada exitosamente."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al actualizar la contraseña."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Enlace inválido."]);
    }
    $stmt->close();
}
?>
