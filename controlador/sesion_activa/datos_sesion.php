<?php
include "../modelo/conexion.php";

$nombreCompleto = "";
$nombreArea = ""; 
$rolDescripcion = ""; 

if (isset($_SESSION['idusuario']) && is_numeric($_SESSION['idusuario'])) {
    $idusuario = $_SESSION['idusuario'];

    $query = "
        SELECT 
            CONCAT(u.nombre, ' ', u.apellidoP, ' ', u.apellidoM) AS nombre_completo,
            a.nombre_area,
            r.descripcion AS rol_descripcion
        FROM usuario u
        LEFT JOIN area a ON u.area = a.idarea  -- Cambio a LEFT JOIN
        INNER JOIN rol r ON u.rol = r.idrol
        WHERE u.idusuario = $idusuario
    ";
    $result = mysqli_query($db_connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $nombreCompleto = $row['nombre_completo'];
        $nombreArea = $row['nombre_area'] ?? 'Sin área'; 
        $rolDescripcion = $row['rol_descripcion'];
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_error($db_connection);
    }
} else {
    echo "No has iniciado sesión o el idusuario no es válido.";
}
?>