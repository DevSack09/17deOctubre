<?php 
    require '../../modelo/conexion.php';
    session_start();
    //Numero de Articulos Registrados
    $sql_1 = "SELECT COUNT(*) AS total
                FROM articulo AS a
                INNER JOIN partida AS part ON a.idpartida = part.idpartida
                WHERE a.activo = 1 AND a.eliminado = 0";
    $articulos = mysqli_fetch_assoc(mysqli_query($db_connection, $sql_1));

    //Numero de Vales Registrados
    $sql_2 = "SELECT Count(*) as total FROM vale WHERE activo = 1 AND eliminado = 0";
    $vales = mysqli_fetch_assoc(mysqli_query($db_connection, $sql_2));

    //Numero de Proveedores Registrados
    $sql_3 = "SELECT Count(*) as total FROM proveedor WHERE activo = 1 AND eliminado = 0";
    $provee = mysqli_fetch_assoc(mysqli_query($db_connection, $sql_3));

    //Ultimos 7 Vales Registrados
    $valesRegis = [];
    $sql_4 = "SELECT v.*, a.nombre_area, d.responsable FROM vale as v 
			LEFT JOIN area as a ON v.idarea = a.idarea
			LEFT JOIN departamento as d ON v.iddepartamento = d.iddepartamento
			WHERE v.activo = 1 AND v.eliminado = 0 
            ORDER BY v.idvale DESC, v.create_time DESC LIMIT 0 , 7";
	$result = mysqli_query($db_connection, $sql_4);
	while ($row = mysqli_fetch_assoc($result)){ array_push($valesRegis, $row); }

    //Numero de Entradas Registrados
    $sql_5 = "SELECT factura_codigo, count(*) as total FROM compra WHERE factura_codigo is not null AND eliminado = 0 GROUP BY factura_codigo";
    $compras = mysqli_num_rows(mysqli_query($db_connection, $sql_5));

    //Datos para Grafica principal
    $data = [];
    $cont = 0;
    $sql_6 = "CALL data_grafica('2024-12%', 10);";
    $grafica = mysqli_query($db_connection, $sql_6);
    while ($row = mysqli_fetch_assoc($grafica) ){
        $data[] = $row;
        $data[$cont] += ["color" => generarColor()];
        $cont++;
    }

	echo json_encode([
        'response' => 'success',
        'articulos' => $articulos['total'],
        'vales' => $vales['total'],
        'provee' => $provee['total'],
        'facturasRegistradas' => $compras,
        'valesRegistrados' => $valesRegis,
        'grafica' => $data], JSON_UNESCAPED_UNICODE); 


    function generarColor(){
        $simbolos = "0123456789ABCDEF";
        $color = "#";

        for ($i = 0; $i < 6; $i++) {$color .= $simbolos[rand(0, 15)];}
        return $color;
    }
?>