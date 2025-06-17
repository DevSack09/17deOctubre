<?php
include "../../modelo/conexion.php";
header('Content-Type: application/json');

if (!isset($_POST['usuario_id']) || !is_numeric($_POST['usuario_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Parámetro usuario_id inválido.'
    ]);
    exit;
}

$usuario_id = intval($_POST['usuario_id']);

$sql = "SELECT * FROM registration WHERE id = ? AND eliminado = 0 LIMIT 1";
$stmt = $db_connection->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $row = $result->fetch_assoc()) {
    echo json_encode([
        'status' => 'success',
        'data' => $row
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'No se encontró el registro solicitado.'
    ]);
}
$stmt->close();
?>