<?php
include "../../modelo/conexion.php";

// Consulta de estado actual
if (isset($_POST['consulta_estado'])) {
    $sql = "SELECT abierto FROM control_registros ORDER BY id DESC LIMIT 1";
    $res = $db_connection->query($sql);
    $control = $res->fetch_assoc();
    echo json_encode(['abierto' => $control ? $control['abierto'] : 1]);
    exit;
}

// Lógica para abrir/cerrar registros
$sql = "SELECT * FROM control_registros ORDER BY id DESC LIMIT 1";
$res = $db_connection->query($sql);
$control = $res->fetch_assoc();

if (!$control) {
    echo json_encode(['status' => 'error', 'message' => 'No se encontró configuración de control.']);
    exit;
}

$password = $_POST['password'] ?? '';
$accion = $_POST['accion'] ?? '';

if ($password !== $control['password']) {
    echo json_encode(['status' => 'error', 'message' => 'Contraseña incorrecta.']);
    exit;
}

if ($accion === 'cerrar') {
    $db_connection->query("UPDATE control_registros SET abierto=0, fecha_cierre=NOW() WHERE id={$control['id']}");
    $db_connection->query("UPDATE registration SET status=1 WHERE status=0");
    echo json_encode(['status' => 'success', 'message' => 'Registros cerrados y pendientes finalizados.']);
} elseif ($accion === 'abrir') {
    $db_connection->query("UPDATE control_registros SET abierto=1, fecha_apertura=NOW(), fecha_cierre=NULL WHERE id={$control['id']}");
    echo json_encode(['status' => 'success', 'message' => 'Registros abiertos nuevamente.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Acción no válida.']);
}
$db_connection->close();
?>