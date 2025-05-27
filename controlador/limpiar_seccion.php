<?php
include "../modelo/conexion.php";
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
    exit;
}

$curp = $_POST['curp'] ?? null;
$seccion = $_POST['seccion'] ?? null;

if (!$curp || !$seccion) {
    echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros requeridos']);
    exit;
}

// Define los campos a limpiar según la sección
$campos_adultos = [
    'credencial_votar',
    'declaracion_originalidad',
    'consentimiento_expreso_adultos'
];
$campos_menores = [
    'identificacion_fotografia',
    'carta_autorizacion',
    'declaracion_originalidad_menores',
    'comprobante_domicilio_tutor',
    'consentimiento_expreso_menores',
    'ine_tutor'
];

$campos = [];
if ($seccion === 'adultos') {
    $campos = $campos_adultos;
} elseif ($seccion === 'menores') {
    $campos = $campos_menores;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Sección no válida']);
    exit;
}

// Buscar los archivos actuales para eliminarlos físicamente
$sql_select = "SELECT " . implode(',', $campos) . " FROM registration WHERE curp = ?";
$stmt_select = $db_connection->prepare($sql_select);
if ($stmt_select) {
    $stmt_select->bind_param("s", $curp);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    if ($row = $result->fetch_assoc()) {
        foreach ($campos as $campo) {
            if (!empty($row[$campo])) {
                $ruta = "../" . ltrim($row[$campo], "/");
                if (file_exists($ruta)) {
                    @unlink($ruta); // Elimina el archivo físico
                }
            }
        }
    }
    $stmt_select->close();
}

// Construye la consulta SQL para limpiar los campos
$set = [];
foreach ($campos as $campo) {
    $set[] = "$campo = NULL";
}
$set_sql = implode(', ', $set);

$sql = "UPDATE registration SET $set_sql WHERE curp = ?";
$stmt = $db_connection->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $curp);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se pudo limpiar la sección']);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error en la consulta']);
}

$db_connection->close();
?>