<?php
include '../../modelo/conexion.php';

$response = [];
try {
    if (!$db_connection) {
        throw new Exception("Error al conectar con la base de datos.");
    }

    $sql = "SELECT idarea, nombre_area FROM area WHERE activo = 1 AND eliminado = 0";
    $result = mysqli_query($db_connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $areas = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $areas[] = $row;
        }
        $response = [
            'success' => true,
            'areas' => $areas
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'No se encontraron áreas.'
        ];
    }
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => 'Error en la consulta: ' . $e->getMessage()
    ];
} finally {
    mysqli_close($db_connection);
}

header('Content-Type: application/json');

echo json_encode($response);
?>