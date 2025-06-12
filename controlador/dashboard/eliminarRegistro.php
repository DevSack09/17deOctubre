<?php
session_start();
include "../../modelo/conexion.php";

if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = intval($_POST['id']);

    // Cambia la bandera "eliminado" a 1 en lugar de borrar el registro
    $sql = "UPDATE registration SET eliminado = 1 WHERE id = ?";
    $stmt = $db_connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Registro ocultado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo ocultar el registro.']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID inválido.']);
}
?>