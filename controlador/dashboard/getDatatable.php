<?php
session_start();
include "../../modelo/conexion.php";

// Columnas para DataTable (deben coincidir con el frontend)
$columns = array(
    0 => 'id',
    1 => 'nombre',
    2 => 'apellidoP',
    3 => 'apellidoM',
    4 => 'municipio',
    5 => 'edad',
    6 => 'encuesta',
    7 => 'status',
    8 => 'folio'
);

$requestData = $_REQUEST;

// Consulta base: solo registros NO eliminados
$sql_base = "FROM registration WHERE eliminado = 0";

// Filtros por columna
$searchSql = "";
foreach ($columns as $i => $col) {
    if (!empty($requestData['columns'][$i]['search']['value'])) {
        $valor = mysqli_real_escape_string($db_connection, $requestData['columns'][$i]['search']['value']);
        if ($col == 'encuesta') {
            if (stripos($valor, 'realizada') !== false) {
                $searchSql .= " AND status = 1";
            } elseif (stripos($valor, 'no') !== false) {
                $searchSql .= " AND status = 0";
            }
        } else {
            $searchSql .= " AND $col LIKE '%$valor%'";
        }
    }
}

// Total de registros sin filtros
$sql_total = "SELECT COUNT(*) as total $sql_base";
$resTotal = $db_connection->query($sql_total);
$totalData = $resTotal ? intval($resTotal->fetch_assoc()['total']) : 0;

// Total de registros filtrados
$sql_filtered = "SELECT COUNT(*) as total $sql_base $searchSql";
$resFiltered = $db_connection->query($sql_filtered);
$totalFiltered = $resFiltered ? intval($resFiltered->fetch_assoc()['total']) : 0;

// Orden y paginación
$start = isset($requestData['start']) ? intval($requestData['start']) : 0;
$length = isset($requestData['length']) ? intval($requestData['length']) : 10;
$orderColumn = isset($requestData['order'][0]['column']) ? intval($requestData['order'][0]['column']) : 0;
$orderDir = isset($requestData['order'][0]['dir']) ? $requestData['order'][0]['dir'] : 'asc';

$orderBy = $columns[$orderColumn];
$sql_data = "SELECT id, nombre, apellidoP, apellidoM, municipio, edad, status, folio $sql_base $searchSql ORDER BY $orderBy $orderDir LIMIT $start, $length";
$query = $db_connection->query($sql_data);

$data = array();
while ($row = $query->fetch_assoc()) {
    $nestedData = array();
    $nestedData['id'] = $row["id"];
    $nestedData['nombres'] = $row["nombre"];
    $nestedData['primer_apellido'] = $row["apellidoP"];
    $nestedData['segundo_apellido'] = $row["apellidoM"];
    $nestedData['municipio'] = $row["municipio"];
    $nestedData['edad'] = $row["edad"];
    $nestedData['encuesta'] = ($row["status"] == 1) ? "Realizada" : "No finalizada";
    $nestedData['estatus'] = ($row["status"] == 1) ? "Activo" : "Pendiente";
    $nestedData['folio'] = $row["folio"];
    $data[] = $nestedData;
}

$json_data = array(
    "draw" => isset($requestData['draw']) ? intval($requestData['draw']) : 1,
    "recordsTotal" => $totalData,
    "recordsFiltered" => $totalFiltered,
    "data" => $data
);

echo json_encode($json_data);
?>