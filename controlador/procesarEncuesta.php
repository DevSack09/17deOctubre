<?php
include "../modelo/conexion.php";
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id'] ?? '';
    $pregunta1 = $_POST['q1'] ?? '';
    $pregunta2 = $_POST['q2'] ?? '';
    $pregunta3 = $_POST['q3'] ?? '';
    $sugerencia = $_POST['suggestion'] ?? '';

    // Verifica si ya existe una encuesta para este usuario
    $stmt = $db_connection->prepare("SELECT id FROM encuesta_satisfaccion WHERE usuario_id = ?");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Ya has respondido la encuesta. ¡Gracias!']);
        exit;
    }
    $stmt->close();

    // Si no existe, guarda la respuesta
    $stmt = $db_connection->prepare("INSERT INTO encuesta_satisfaccion (usuario_id, pregunta1, pregunta2, pregunta3, sugerencia) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $usuario_id, $pregunta1, $pregunta2, $pregunta3, $sugerencia);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => '¡Gracias por responder la encuesta!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al guardar la encuesta.']);
    }
    $stmt->close();
    $db_connection->close();
    exit;
}
?>