<?php
include "../../modelo/conexion.php";
header('Content-Type: application/json');

// Total de registros
$sql1 = "SELECT COUNT(*) as total FROM registration WHERE eliminado = 0";
$res1 = $db_connection->query($sql1);
$totalRegistros = $res1 ? $res1->fetch_assoc()['total'] : 0;

// Registros pendientes (status = 0)
$sql2 = "SELECT COUNT(*) as pendientes FROM registration WHERE status = 0 AND eliminado = 0";
$res2 = $db_connection->query($sql2);
$registrosPendientes = $res2 ? $res2->fetch_assoc()['pendientes'] : 0;

// Total encuestas de satisfacción
$sql3 = "SELECT COUNT(*) as totalEncuestas FROM encuesta_satisfaccion";
$res3 = $db_connection->query($sql3);
$totalEncuestas = $res3 ? $res3->fetch_assoc()['totalEncuestas'] : 0;

// Categoría
$sqlCat = "SELECT categoria, COUNT(*) as total FROM registration WHERE eliminado = 0 GROUP BY categoria";
$resCat = $db_connection->query($sqlCat);
$categorias = [];
if ($resCat) {
    while ($row = $resCat->fetch_assoc()) {
        $categorias[$row['categoria']] = (int) $row['total'];
    }
}

// Edad
$sqlEdad = "SELECT edad, COUNT(*) as total FROM registration WHERE eliminado = 0 GROUP BY edad ORDER BY edad";
$resEdad = $db_connection->query($sqlEdad);
$edades = [];
if ($resEdad) {
    while ($row = $resEdad->fetch_assoc()) {
        $edades[$row['edad']] = (int) $row['total'];
    }
}

// Escolaridad
$sqlEsc = "SELECT gradoEstudios, COUNT(*) as total FROM registration WHERE eliminado = 0 GROUP BY gradoEstudios";
$resEsc = $db_connection->query($sqlEsc);
$escolaridad = [];
if ($resEsc) {
    while ($row = $resEsc->fetch_assoc()) {
        $escolaridad[$row['gradoEstudios']] = (int) $row['total'];
    }
}

// Municipio
$sqlMun = "SELECT municipio, COUNT(*) as total FROM registration WHERE eliminado = 0 GROUP BY municipio";
$resMun = $db_connection->query($sqlMun);
$municipios = [];
if ($resMun) {
    while ($row = $resMun->fetch_assoc()) {
        $municipios[$row['municipio']] = (int) $row['total'];
    }
}

echo json_encode([
    'totalRegistros' => $totalRegistros,
    'registrosPendientes' => $registrosPendientes,
    'totalEncuestas' => $totalEncuestas,
    'categorias' => $categorias,
    'edades' => $edades,
    'escolaridad' => $escolaridad,
    'municipios' => $municipios
]);
?>