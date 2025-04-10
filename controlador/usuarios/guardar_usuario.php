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
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $apellidoP = $_POST['apellidoP'];
    $apellidoM = $_POST['apellidoM'];
    $area = $_POST['area'];
    $rol = $_POST['rol'];
    $activo = isset($_POST['activo']) ? 1 : 0;
    $password = $_POST['password']; // Contraseña

    $stmt = $conn->prepare("UPDATE usuario SET email = ?, nombre = ?, apellidoP = ?, apellidoM = ?, area = ?, rol = ?, activo = ?, password = ? WHERE idusuario = ?");
    $stmt->bind_param("ssssssisi", $email, $nombre, $apellidoP, $apellidoM, $area, $rol, $activo, $password, $idusuario);

    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
            "message" => "Cambios guardados correctamente."
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Error al guardar los cambios: " . $stmt->error
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        "success" => false,
        "message" => "ID de usuario no proporcionado."
    ]);
}

$conn->close();
?>