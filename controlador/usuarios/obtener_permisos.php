<?php
include "../../modelo/conexion.php";

$response = [
    'success' => false,
    'message' => 'No se pudieron cargar los permisos.',
    'data' => []
];

if (isset($_POST['idusuario'])) {
    $idusuario = intval($_POST['idusuario']);

    $stmt = $db_connection->prepare("SELECT * FROM permisos WHERE idusuario = ?");
    $stmt->bind_param("i", $idusuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $permisos = $result->fetch_assoc();
        $response['success'] = true;
        $response['data'] = $permisos;
    }

    $stmt->close();
}

echo json_encode($response);
?>