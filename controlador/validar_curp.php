<?php
include "../modelo/conexion.php";

header('Content-Type: application/json; charset=utf-8');

try {
    $data = json_decode(file_get_contents("php://input"), true);
    $curp = strtoupper(trim($data['curp'] ?? ''));

    if (empty($curp)) {
        throw new Exception('No se recibió el CURP');
    }

    if (strlen($curp) !== 18) {
        throw new Exception('El CURP debe tener exactamente 18 caracteres');
    }

    if (!preg_match("/^[A-Z]{4}\d{6}[HM][A-Z]{5}[A-Z\d]{2}$/", $curp)) {
        throw new Exception('El CURP no tiene un formato válido');
    }

    if ($db_connection->connect_error) {
        throw new Exception('Error al conectar a la base de datos');
    }

    $sql = "SELECT id FROM registration WHERE curp = ?";
    $stmt = $db_connection->prepare($sql);

    if (!$stmt) {
        throw new Exception('Error en la preparación de la consulta: ' . $db_connection->error);
    }

    $stmt->bind_param("s", $curp);
    $stmt->execute();
    $stmt->store_result();

    echo json_encode([
        'success' => true,
        'exists' => $stmt->num_rows > 0,
        'message' => $stmt->num_rows > 0 ? 'CURP ya registrada' : 'CURP válida'
    ]);

    $stmt->close();
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'exists' => false,
        'message' => $e->getMessage()
    ]);
} finally {
    $db_connection->close();
}
?>