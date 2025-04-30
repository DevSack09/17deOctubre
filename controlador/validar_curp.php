<?php
include "../modelo/conexion.php";

$data = json_decode(file_get_contents("php://input"), true);
$curp = $data['curp'] ?? '';

if (empty($curp)) {
    echo json_encode(['success' => false, 'message' => 'No se recibió el CURP']);
    exit;
}

if (strlen($curp) !== 18) {
    echo json_encode(['success' => false, 'message' => 'El CURP debe tener exactamente 18 caracteres']);
    exit;
}

if (!preg_match("/^[A-Z]{4}\d{6}[HM][A-Z]{5}[A-Z\d]{2}$/i", $curp)) {
    echo json_encode(['success' => false, 'message' => 'El CURP no tiene un formato válido']);
    exit;
}

if ($db_connection->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error al conectar a la base de datos']);
    exit;
}

$sql = "SELECT id FROM registration WHERE curp = ?";
$stmt = $db_connection->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $curp);
    $stmt->execute();
    $stmt->store_result();

    $response = [
        'success' => true,
        'exists' => $stmt->num_rows > 0,
    ];

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Error en la consulta a la base de datos']);
}

$db_connection->close();
?>