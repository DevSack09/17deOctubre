<?php
include "../../modelo/conexion.php";

$response = [
    'success' => false,
    'message' => 'No se pudieron cargar los permisos.',
    'data' => []
];

if ($db_connection->connect_error) {
    $response['message'] = "Error de conexión a la base de datos: " . $db_connection->connect_error;
    echo json_encode($response);
    exit;
}

if (isset($_POST['idusuario'])) {
    $idusuario = intval($_POST['idusuario']);

    // Log para depuración
    error_log("ID Usuario recibido: " . $idusuario);

    $stmt = $db_connection->prepare("SELECT dashboard, usuarios, formulario, inicio, reportes, descarga FROM permisos WHERE idusuario = ?");
    if (!$stmt) {
        $response['message'] = "Error en la consulta: " . $db_connection->error;
        echo json_encode($response);
        exit;
    }

    $stmt->bind_param("i", $idusuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $permisos = $result->fetch_assoc();
        $response['success'] = true;
        $response['data'] = $permisos;
    } else {
        $response['message'] = "No se encontraron permisos para este usuario.";
    }

    $stmt->close();
} else {
    $response['message'] = "ID de usuario no proporcionado.";
}

echo json_encode($response);
?>