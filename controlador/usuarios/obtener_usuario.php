<?php
include '../../modelo/conexion.php'; 

$conn = new mysqli($db_host, $db_user, $db_password, $db_name, $db_port);

if ($conn->connect_error) {
    die(json_encode([
        "success" => false,
        "message" => "Error al conectar con la base de datos: " . $conn->connect_error
    ]));
}

if (isset($_POST['idusuario'])) {
    $idusuario = intval($_POST['idusuario']);

    $stmt = $conn->prepare("SELECT * FROM usuario WHERE idusuario = ?");
    $stmt->bind_param("i", $idusuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        header('Content-Type: application/json');
        echo json_encode([
            "success" => true,
            "data" => $usuario
        ]);
    } else {
        header('Content-Type: application/json');
        echo json_encode([
            "success" => false,
            "message" => "Usuario no encontrado."
        ]);
    }

    $stmt->close();
} else {
    header('Content-Type: application/json');
    echo json_encode([
        "success" => false,
        "message" => "ID de usuario no proporcionado."
    ]);
}

$conn->close();
?>