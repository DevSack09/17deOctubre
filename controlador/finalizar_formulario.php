<?php
include "../modelo/conexion.php";
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

$sql_check = "SELECT id FROM registration WHERE curp = ? AND usuario_id = ?";
$stmt_check = $db_connection->prepare($sql_check);

if ($stmt_check) {
    $stmt_check->bind_param("si", $curp, $usuario_id);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        // Actualizar el estado del formulario a "finalizado"
        $sql_update = "UPDATE registration SET status = 1 WHERE curp = ? AND usuario_id = ?";
        $stmt_update = $db_connection->prepare($sql_update);

        if ($stmt_update) {
            $stmt_update->bind_param("si", $curp, $usuario_id);

            if ($stmt_update->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Formulario finalizado correctamente']);
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