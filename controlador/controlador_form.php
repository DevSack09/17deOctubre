<?php
include "../modelo/conexion.php";
session_start();

if (!isset($_SESSION["idusuario"])) {
    echo json_encode(['status' => 'error', 'message' => 'No se ha iniciado sesión.']);
    exit;
}

$usuario_id = $_SESSION["idusuario"];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
    exit;
}

try {
    $curp = $_POST['curp'] ?? null;
    $nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : null;
    $apellidoP = !empty($_POST['apellidopaterno']) ? $_POST['apellidopaterno'] : null;
    $apellidoM = !empty($_POST['apellidomaterno']) ? $_POST['apellidomaterno'] : null;
    $fecha_nacimiento = !empty($_POST['fechanacimiento']) ? $_POST['fechanacimiento'] : null;
    $edad = !empty($_POST['edad']) ? $_POST['edad'] : null;
    $acepta_privacidad = isset($_POST['terminos_privacidad']) ? 1 : 0;
    $acepta_consentimiento = isset($_POST['terminos_consentimiento']) ? 1 : 0;

    if (!$curp) {
        echo json_encode(['status' => 'error', 'message' => 'El campo CURP es obligatorio']);
        exit;
    }

    if ($db_connection->connect_error) {
        echo json_encode(['status' => 'error', 'message' => 'Error al conectar a la base de datos']);
        exit;
    }

    $sql_check = "SELECT id FROM registration WHERE curp = ?";
    $stmt_check = $db_connection->prepare($sql_check);

    if ($stmt_check) {
        $stmt_check->bind_param("s", $curp);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $sql_update = "UPDATE registration 
                           SET nombre = ?, apellidoP = ?, apellidoM = ?, fecha_nacimiento = ?, edad = ?, acepta_privacidad = ?, acepta_consentimiento = ?
                           WHERE curp = ?";
            $stmt_update = $db_connection->prepare($sql_update);

            if ($stmt_update) {
                $stmt_update->bind_param(
                    "ssssiiis",
                    $nombre,
                    $apellidoP,
                    $apellidoM,
                    $fecha_nacimiento,
                    $edad,
                    $acepta_privacidad,
                    $acepta_consentimiento,
                    $curp
                );

                if ($stmt_update->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Registro actualizado correctamente']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el registro', 'error' => $stmt_update->error]);
                }

                $stmt_update->close();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al preparar la consulta de actualización', 'error' => $db_connection->error]);
            }
        } else {
            $sql_insert = "INSERT INTO registration (usuario_id, curp, nombre, apellidoP, apellidoM, fecha_nacimiento, edad, acepta_privacidad, acepta_consentimiento)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt_insert = $db_connection->prepare($sql_insert);

            if ($stmt_insert) {
                $stmt_insert->bind_param(
                    "isssssiii",
                    $usuario_id,
                    $curp,
                    $nombre,
                    $apellidoP,
                    $apellidoM,
                    $fecha_nacimiento,
                    $edad,
                    $acepta_privacidad,
                    $acepta_consentimiento
                );

                if ($stmt_insert->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Registro guardado correctamente']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al guardar el registro', 'error' => $stmt_insert->error]);
                }

                $stmt_insert->close();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al preparar la consulta de inserción', 'error' => $db_connection->error]);
            }
        }

        $stmt_check->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error en la consulta de verificación', 'error' => $db_connection->error]);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error inesperado: ' . $e->getMessage()]);
}

$db_connection->close();
?>