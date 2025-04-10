<?php
include '../../modelo/conexion.php'; 


$conn = new mysqli($db_host, $db_user, $db_password, $db_name, $db_port);

if ($conn->connect_error) {
    die(json_encode([
        "error" => "Error al conectar con la base de datos: " . $conn->connect_error
    ]));
}


$draw = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
$start = isset($_POST['start']) ? intval($_POST['start']) : 0;
$length = isset($_POST['length']) ? intval($_POST['length']) : 10;
$searchValue = isset($_POST['search']['value']) ? $conn->real_escape_string($_POST['search']['value']) : "";


$whereClause = "WHERE u.`delete` = 1"; 

if (!empty($searchValue)) {
    $whereClause .= " AND (u.email LIKE '%$searchValue%' 
                    OR u.nombre LIKE '%$searchValue%' 
                    OR u.apellidoP LIKE '%$searchValue%' 
                    OR u.apellidoM LIKE '%$searchValue%' 
                    OR u.rol LIKE '%$searchValue%'
                    OR a.nombre_area LIKE '%$searchValue%')"; 
}


$totalQuery = "SELECT COUNT(*) as total FROM usuario u WHERE u.`delete` = 1";
$totalResult = $conn->query($totalQuery);
$totalRecords = $totalResult->fetch_assoc()['total'];

$filteredQuery = "SELECT COUNT(*) as total 
                  FROM usuario u 
                  LEFT JOIN area a ON u.area = a.idarea 
                  $whereClause";
$filteredResult = $conn->query($filteredQuery);
$totalFiltered = $filteredResult->fetch_assoc()['total'];

$dataQuery = "SELECT u.idusuario, u.email, u.nombre, u.apellidoP, u.apellidoM, u.password, 
                     u.area, a.nombre_area, u.rol, u.activo, u.fecha_creacion 
              FROM usuario u 
              LEFT JOIN area a ON u.area = a.idarea 
              $whereClause 
              LIMIT $start, $length";
$dataResult = $conn->query($dataQuery);

$data = [];
while ($row = $dataResult->fetch_assoc()) {
    $activo = ($row['activo'] == 1) ? 'Activo' : 'Inactivo';
    $nombre_area = $row['nombre_area'] ?? 'Sin área'; 
    
    $acciones = "
        <button class='btn btn-warning btn-sm editBtn' data-id='{$row['idusuario']}'></button>
        <button class='btn btn-danger btn-sm deleteBtn' data-id='{$row['idusuario']}'></button>
        <button class='btn btn-info btn-sm modulosBtn' data-id='{$row['idusuario']}' data-bs-toggle='modal' data-bs-target='#modalModulos'></button>
    ";
    
    $data[] = [
        "idusuario" => $row['idusuario'],
        "email" => $row['email'],
        "nombre" => $row['nombre'],
        "apellidoP" => $row['apellidoP'],
        "apellidoM" => $row['apellidoM'],
        "password" => $row['password'], 
        "area" => $nombre_area, 
        "rol" => $row['rol'],
        "activo" => $row['activo'],  
        "fecha_creacion" => $row['fecha_creacion'],
        "acciones" => $acciones  
    ];
}

$response = [
    "draw" => $draw,
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalFiltered,
    "data" => $data
];

header('Content-Type: application/json');
echo json_encode($response);

// Cerrar conexión
$conn->close();
?>