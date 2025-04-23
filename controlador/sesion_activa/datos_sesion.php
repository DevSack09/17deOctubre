<?php
include "../modelo/conexion.php";

$nombreCompleto = "";
$rolDescripcion = "";

if (isset($_SESSION['idusuario']) && is_numeric($_SESSION['idusuario'])) {
    $idusuario = $_SESSION['idusuario'];

    $query = "
        SELECT 
            CONCAT(u.nombre, ' ', u.apellidoP, ' ', u.apellidoM) AS nombre_completo,
            r.descripcion AS rol_descripcion
        FROM usuario u
        INNER JOIN rol r ON u.rol = r.idrol
        WHERE u.idusuario = $idusuario
    ";
    $result = mysqli_query($db_connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $nombreCompleto = $row['nombre_completo'];
        $rolDescripcion = $row['rol_descripcion'];
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_error($db_connection);
    }
} else {
    echo "No has iniciado sesión o el idusuario no es válido.";
}
?>