<?php
include '../../modelo/conexion.php'; 

$response = [
    'success' => false,
    'message' => 'No se pudo procesar la solicitud.'
];

if (isset($_POST['idusuario'])) {
    $idusuario = intval($_POST['idusuario']); 

    if ($idusuario > 0) {
        $sql = "UPDATE usuario SET `delete` = 0 WHERE idusuario = ?";
        $stmt = $db_connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idusuario);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $response['success'] = true;
                    $response['message'] = 'Usuario marcado como eliminado correctamente.';
                } else {
                    $response['message'] = 'No se encontró el usuario con el ID proporcionado.';
                }
            } else {
                $response['message'] = 'Error al ejecutar la consulta: ' . $stmt->error;
            }

            $stmt->close();
        } else {
            $response['message'] = 'Error al preparar la consulta: ' . $db_connection->error;
        }
    } else {
        $response['message'] = 'ID de usuario no válido.';
    }
} else {
    $response['message'] = 'No se recibió el ID del usuario.';
}

$db_connection->close();

header('Content-Type: application/json');
echo json_encode($response);
?>