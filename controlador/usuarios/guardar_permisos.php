<?php
include "../../modelo/conexion.php";

$response = [
    'success' => false,
    'message' => 'No se pudieron guardar los permisos.'
];

if (isset($_POST['idusuario']) && isset($_POST['permisos'])) {
    $idusuario = intval($_POST['idusuario']);
    $permisos = $_POST['permisos'];

    // Lista de permisos requeridos según los módulos activos
    $requiredPermisos = ['dashboard', 'usuarios', 'formulario', 'inicio', 'reportes', 'descarga'];
    foreach ($requiredPermisos as $modulo) {
        if (!isset($permisos[$modulo])) {
            $response['message'] = "Falta el permiso para el módulo: $modulo";
            echo json_encode($response);
            exit;
        }
    }

    // Verificar si el usuario ya tiene permisos asignados
    $stmt = $db_connection->prepare("SELECT COUNT(*) AS count FROM permisos WHERE idusuario = ?");
    $stmt->bind_param("i", $idusuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $exists = $row['count'] > 0;
    $stmt->close();

    if ($exists) {
        // Actualizar permisos existentes
        $stmt = $db_connection->prepare("
            UPDATE permisos 
            SET dashboard = ?, usuarios = ?, formulario = ?, inicio = ?, reportes = ?, descarga = ?
            WHERE idusuario = ?
        ");
        $stmt->bind_param(
            "iiiiiii",
            $permisos['dashboard'],
            $permisos['usuarios'],
            $permisos['formulario'],
            $permisos['inicio'],
            $permisos['reportes'],
            $permisos['descarga'],
            $idusuario
        );
    } else {
        // Insertar un nuevo registro
        $stmt = $db_connection->prepare("
            INSERT INTO permisos (idusuario, dashboard, usuarios, formulario, inicio, reportes, descarga)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "iiiiiii",
            $idusuario,
            $permisos['dashboard'],
            $permisos['usuarios'],
            $permisos['formulario'],
            $permisos['inicio'],
            $permisos['reportes'],
            $permisos['descarga']
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