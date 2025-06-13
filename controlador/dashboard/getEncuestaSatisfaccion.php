<?php
include "../../modelo/conexion.php";
header('Content-Type: application/json');
$usuario_id = $_POST['usuario_id'] ?? '';
if (!$usuario_id) {
    echo json_encode(['status' => 'error', 'message' => 'usuario_id requerido']);
    exit;
}
$stmt = $db_connection->prepare("SELECT pregunta1, pregunta2, pregunta3, sugerencia, fecha FROM encuesta_satisfaccion WHERE usuario_id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
if ($data) {
    echo json_encode(['status' => 'success', 'data' => $data]);
} else {
    echo json_encode(['status' => 'success', 'data' => null]);
}
$stmt->close();
$db_connection->close();
?>