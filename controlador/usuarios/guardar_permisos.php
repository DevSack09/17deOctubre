<?php
include "../../modelo/conexion.php";

$response = [
    'success' => false,
    'message' => 'No se pudieron guardar los permisos.'
];

if (isset($_POST['idusuario']) && isset($_POST['permisos'])) {
    $idusuario = intval($_POST['idusuario']);
    $permisos = $_POST['permisos'];

    $requiredPermisos = ['almacen', 'usuarios', 'areas', 'departamentos', 'proveedores', 'articulos', 'entrada', 'salidas', 'reportes', 'bitacora'];
    foreach ($requiredPermisos as $modulo) {
        if (!isset($permisos[$modulo])) {
            $response['message'] = "Falta el permiso para el módulo: $modulo";
            echo json_encode($response);
            exit;
        }
    }

    $stmt = $db_connection->prepare("SELECT COUNT(*) AS count FROM permisos WHERE idusuario = ?");
    $stmt->bind_param("i", $idusuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $exists = $row['count'] > 0;
    $stmt->close();

    if ($exists) {
        $stmt = $db_connection->prepare("
            UPDATE permisos 
            SET almacen = ?, usuarios = ?, areas = ?, departamentos = ?, proveedores = ?, articulos = ?, entrada = ?, salidas = ?, reportes = ?, bitacora = ?
            WHERE idusuario = ?
        ");
        $stmt->bind_param(
            "iiiiiiiiiii", 
            $permisos['almacen'],
            $permisos['usuarios'],
            $permisos['areas'],
            $permisos['departamentos'],
            $permisos['proveedores'],
            $permisos['articulos'],
            $permisos['entrada'],
            $permisos['salidas'],
            $permisos['reportes'],
            $permisos['bitacora'],
            $idusuario
        );
    } else {
        // Insertar un nuevo registro
        $stmt = $db_connection->prepare("
            INSERT INTO permisos (idusuario, almacen, usuarios, areas, departamentos, proveedores, articulos, entrada, salidas, reportes, bitacora)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "iiiiiiiiiii", 
            $idusuario,
            $permisos['almacen'],
            $permisos['usuarios'],
            $permisos['areas'],
            $permisos['departamentos'],
            $permisos['proveedores'],
            $permisos['articulos'],
            $permisos['entrada'],
            $permisos['salidas'],
            $permisos['reportes'],
            $permisos['bitacora']
        );
    }
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Permisos guardados correctamente.';
    } else {
        $response['message'] = 'Error al ejecutar la consulta: ' . $stmt->error;
    }

    $stmt->close();
}

echo json_encode($response);
?>