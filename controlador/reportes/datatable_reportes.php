<?php
include "../../modelo/conexion.php";
session_start();

$requestData = $_REQUEST;
$action = isset($requestData['action']) ? $requestData['action'] : '';
$reporte = isset($requestData['reporte']) ? $requestData['reporte'] : '';
$tipo_entrada = isset($requestData['tipo_entrada']) ? $requestData['tipo_entrada'] : '';
$info_entrada = isset($requestData['info_entrada']) ? $requestData['info_entrada'] : '';
$area = isset($requestData['area']) ? $requestData['area'] : '';
$fecha_inicio = isset($requestData['fecha_inicio']) ? $requestData['fecha_inicio'] : '';
$fecha_fin = isset($requestData['fecha_fin']) ? $requestData['fecha_fin'] : '';

if ($action === 'get_areas') {
    $sql = "SELECT idarea as id, nombre_area as nombre FROM area WHERE activo = 1";
    $query = mysqli_query($db_connection, $sql) or die("No se pudo obtener la información de las áreas: " . mysqli_error($db_connection));
    $result = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    echo json_encode($result);
    exit;
}

if ($action === 'get_info') {
    getInfo($tipo_entrada, $db_connection);
    exit;
}

$columns = array(
    'entradas_articulo' => array(
        'fecha_tipo_pago',
        'orden_compra',
        'factura_codigo',
        'descripcion_articulo',
        'razon',
        'cantidad_recibida',
        'precio',
        'iva',
        'total_articulo'
    ),
    'entradas_proveedor' => array(
        'fecha_tipo_pago',
        'orden_compra',
        'factura_codigo',
        'descripcion_articulo',
        'razon',
        'cantidad_recibida',
        'precio',
        'iva',
        'total_articulo'
    ),
    'stock' => array(
        'descripcion_articulo',
        'partida',
        'unidad',
        'stock'
    ),
    'articulos_por_area' => array(
        'folio_vale',
        'nombre_area',
        'nombre_departamento',
        'descripcion_articulo',
        'unidad',
        'cantidad',
        'fecha_salida'
    ),
    'cancelacion_vales' => array(
        'idsalida',
        'folio_vale',
        'nombre_area',
        'descripcion_articulo',
        'cantidad',
        'fecha_salida',
        'update_time'
    ),
    'entrada_facturas_registradas' => array(
        'factura_codigo',
        'total'
    ),
    'salida_vales' => array(
        'folio',
        'nombre_area',
        'fecha_vale'
    )
);

if ($reporte === 'entradas') {
    $reporte_key = 'entradas_' . $tipo_entrada;
} else if ($reporte === 'articulos_por_area') {
    $reporte_key = 'articulos_por_area';
} else if ($reporte === 'cancelacion_vales') {
    $reporte_key = 'cancelacion_vales';
} else {
    $reporte_key = $reporte;
}

if (!array_key_exists($reporte_key, $columns)) {
    echo json_encode(array(
        "draw" => intval($requestData['draw']),
        "recordsTotal" => 0,
        "recordsFiltered" => 0,
        "data" => array()
    ));
    exit;
}

switch ($reporte) {
    case 'entradas':
        switch ($tipo_entrada) {
            case 'articulo':
                $sql = "SELECT c.fecha_tipo_pago, c.orden_compra, c.factura_codigo, a.descripcion_articulo, pr.razon, c.cantidad_recibida, c.precio, c.iva, c.total_articulo
                        FROM compra as c
                        LEFT JOIN articulo as a ON c.idarticulo = a.idarticulo
                        LEFT JOIN proveedor as pr ON c.idproveedor = pr.idproveedor
                        WHERE 1=1";
                if (!empty($info_entrada)) {
                    $sql .= " AND c.idarticulo = '$info_entrada'";
                }
                break;
            case 'proveedor':
                $sql = "SELECT c.fecha_tipo_pago, c.orden_compra, c.factura_codigo, a.descripcion_articulo, pr.razon, c.cantidad_recibida, c.precio, c.iva, c.total_articulo
                        FROM compra as c
                        LEFT JOIN articulo as a ON c.idarticulo = a.idarticulo
                        LEFT JOIN proveedor as pr ON c.idproveedor = pr.idproveedor
                        WHERE 1=1";
                if (!empty($info_entrada)) {
                    $sql .= " AND c.idproveedor = '$info_entrada'";
                }
                break;
        }
        if ($fecha_inicio != '' && $fecha_fin != '') {
            $sql .= " AND c.fecha_tipo_pago BETWEEN '$fecha_inicio' AND '$fecha_fin'";
        }
        break;

    case 'stock':
        $sql = "SELECT 
                    a.descripcion_articulo, 
                    CONCAT(IFNULL(p.num_partida, 'Sin Partida'), ' - ', IFNULL(p.nombre_partida, 'Sin Nombre')) AS partida, 
                    a.unidad, 
                    a.stock
                FROM articulo AS a 
                INNER JOIN partida AS p ON a.idpartida = p.idpartida -- Cambiado de LEFT JOIN a INNER JOIN
                WHERE a.eliminado = 0";
        if ($fecha_inicio != '' && $fecha_fin != '') {
            $sql .= " AND a.create_time BETWEEN '$fecha_inicio' AND '$fecha_fin'";
        }
        break;

    case 'articulos_por_area':
        $sql = "SELECT 
                            v.folio AS folio_vale,
                            ar.nombre_area,
                            dp.nombre_departamento,
                            a.descripcion_articulo,
                            a.unidad,
                            sv.cantidad,
                            sv.fecha_salida
                        FROM vale v
                        JOIN area ar ON v.idarea = ar.idarea
                        JOIN departamento dp ON v.iddepartamento = dp.iddepartamento
                        JOIN salida_vale sv ON v.idvale = sv.idvale
                        JOIN articulo a ON sv.idarticulo = a.idarticulo
                        WHERE v.eliminado = 0
                        AND sv.eliminado = 0
                        AND a.eliminado = 0";
        if (!empty($area)) {
            $sql .= " AND ar.idarea = '" . mysqli_real_escape_string($db_connection, $area) . "'";
        }
        if (!empty($departamento)) {
            $sql .= " AND dp.iddepartamento = '" . mysqli_real_escape_string($db_connection, $departamento) . "'";
        }
        if ($fecha_inicio != '' && $fecha_fin != '') {
            $sql .= " AND sv.fecha_salida BETWEEN '" . mysqli_real_escape_string($db_connection, $fecha_inicio) . "' AND '" . mysqli_real_escape_string($db_connection, $fecha_fin) . "'";
        }
        break;

    case 'cancelacion_vales':
        $sql = "SELECT DISTINCT
                    sv.idsalida, 
                    v.folio AS folio_vale, 
                    ar.nombre_area, 
                    a.descripcion_articulo, 
                    sv.cantidad, 
                    sv.fecha_salida, 
                    sv.create_time AS update_time
                FROM salida_vale sv
                INNER JOIN vale v ON sv.folio = v.folio AND YEAR(sv.fecha_salida) = YEAR(v.fecha_vale)
                INNER JOIN area ar ON v.idarea = ar.idarea
                INNER JOIN articulo a ON sv.idarticulo = a.idarticulo
                WHERE sv.eliminado = 1";
        if ($fecha_inicio != '' && $fecha_fin != '') {
            $sql .= " AND sv.fecha_salida BETWEEN '$fecha_inicio' AND '$fecha_fin'";
        }
        break;

    case 'entrada_facturas_registradas':
        $sql = "SELECT factura_codigo, COUNT(*) AS total 
                FROM compra 
                WHERE factura_codigo IS NOT NULL AND eliminado = 0 
                GROUP BY factura_codigo";
        if ($fecha_inicio != '' && $fecha_fin != '') {
            $sql .= " AND fecha_tipo_pago BETWEEN '$fecha_inicio' AND '$fecha_fin'";
        }
        break;

    case 'salida_vales':
        $sql = "SELECT 
    v.idvale,
    v.folio,
    a.nombre_area, -- Solo incluir el nombre del área
    v.fecha_vale
FROM vale AS v
LEFT JOIN area AS a ON v.idarea = a.idarea
WHERE v.activo = 1 AND v.eliminado = 0";
        if ($fecha_inicio != '' && $fecha_fin != '') {
            $sql .= " AND v.fecha_vale BETWEEN '$fecha_inicio' AND '$fecha_fin'";
        }
        break;
}

$query = mysqli_query($db_connection, $sql) or die("No se pudieron obtener los datos de la tabla: " . mysqli_error($db_connection));
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;

if (!empty($requestData['search']['value'])) {
    $sql .= " AND (";
    foreach ($columns[$reporte_key] as $col) {
        $sql .= "$col LIKE '%" . $requestData['search']['value'] . "%' OR ";
    }
    $sql = substr($sql, 0, -4) . ")";
    $query = mysqli_query($db_connection, $sql) or die("Error en la búsqueda general: " . mysqli_error($db_connection));
    $totalFiltered = mysqli_num_rows($query);
}

$orderColumnIndex = $requestData['order'][0]['column'];
$orderColumn = $columns[$reporte_key][$orderColumnIndex];
$orderDir = $requestData['order'][0]['dir'];
$sql .= " ORDER BY $orderColumn $orderDir LIMIT " . $requestData['start'] . ", " . $requestData['length'];

$query = mysqli_query($db_connection, $sql) or die("Error al ordenar y limitar: " . mysqli_error($db_connection));

$data = array();
$cont = 1;
while ($row = mysqli_fetch_assoc($query)) {
    $nestedData = array();
    $nestedData[] = $cont + $requestData['start'];
    foreach ($columns[$reporte_key] as $col) {
        $nestedData[] = $row[$col];
    }
    $data[] = $nestedData;
    $cont++;
}

$json_data = array(
    "draw" => intval($requestData['draw']),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $data
);

echo json_encode($json_data);

function getInfo($tipoEntrada, $db_connection)
{
    $result = array();
    switch ($tipoEntrada) {
        case 'articulo':
            $sql = "SELECT idarticulo as id, descripcion_articulo as nombre FROM articulo";
            break;
        case 'proveedor':
            $sql = "SELECT idproveedor as id, razon as nombre FROM proveedor";
            break;
        default:
            echo json_encode($result);
            exit;
    }
    $query = mysqli_query($db_connection, $sql) or die("No se pudo obtener la información: " . mysqli_error($db_connection));
    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    echo json_encode($result);
}
?>