<?php
require_once '../../modelo/conexion.php'; 

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'get_articulos_bajo_stock':
            getArticulosBajoStock();
            break;

        default:
            echo json_encode(['error' => 'Acción no válida']);
            break;
    }
}

function getArticulosBajoStock() {
    global $db_connection; 

    try {
        $sql = "
            SELECT 
                idarticulo, 
                descripcion_articulo, 
                stock, 
                stock_minimo 
            FROM 
                articulo 
            WHERE 
                activo = 1 
                AND stock <= stock_minimo
                AND stock_minimo > 0 -- Excluir artículos con stock_minimo = 0
        ";
        $stmt = $db_connection->prepare($sql);
        $stmt->execute();

        $articulos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        echo json_encode($articulos);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>