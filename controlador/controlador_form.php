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
    // === DATOS DEL FORMULARIO ===
    $curp = $_POST['curp'] ?? null;
    $nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : null;
    $apellidoP = !empty($_POST['apellidopaterno']) ? $_POST['apellidopaterno'] : null;
    $apellidoM = !empty($_POST['apellidomaterno']) ? $_POST['apellidomaterno'] : null;
    $fecha_nacimiento = !empty($_POST['fechanacimiento']) ? $_POST['fechanacimiento'] : null;
    $edad = !empty($_POST['edad']) ? $_POST['edad'] : null;
    $acepta_privacidad = isset($_POST['terminos_privacidad']) ? 1 : 0;
    $acepta_consentimiento = isset($_POST['terminos_consentimiento']) ? 1 : 0;

    // === ARCHIVOS ===
    $file_fields = [
        'credencial_votar',
        'declaracion_originalidad',
        'consentimiento_expreso_adultos'
    ];

    $upload_base_dir = "../uploads/documentos/";
    $db_upload_base_dir = "uploads/documentos/"; // Para guardar la ruta relativa que usarás para mostrar o descargar

    if (!file_exists($upload_base_dir)) {
        mkdir($upload_base_dir, 0777, true);
    }

    $uploaded_files = [];

    foreach ($file_fields as $file_field) {
        if (
            isset($_FILES[$file_field]) &&
            $_FILES[$file_field]['error'] !== UPLOAD_ERR_NO_FILE
        ) {
            $file = $_FILES[$file_field];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            // Guardar la ruta completa relativa para la base de datos (sin validaciones adicionales)
            $target_filename = $curp . "_" . $file_field . "_" . time() . ".pdf";
            $target_path = $upload_base_dir . $target_filename;
            $db_file_path = $db_upload_base_dir . $target_filename;

            if (move_uploaded_file($file['tmp_name'], $target_path)) {
                $uploaded_files[$file_field] = $db_file_path;
            } else {
                echo json_encode(['status' => 'error', 'message' => "Error al subir el archivo '$file_field'."]);
                exit;
            }
        }
    }

    if (!$curp) {
        echo json_encode(['status' => 'error', 'message' => 'El campo CURP es obligatorio']);
        exit;
    }

    if ($db_connection->connect_error) {
        echo json_encode(['status' => 'error', 'message' => 'Error al conectar a la base de datos']);
        exit;
    }

    // Verificar si existe el registro
    $sql_check = "SELECT id, credencial_votar, declaracion_originalidad, consentimiento_expreso_adultos FROM registration WHERE curp = ?";
    $stmt_check = $db_connection->prepare($sql_check);

    if ($stmt_check) {
        $stmt_check->bind_param("s", $curp);
        $stmt_check->execute();
        $stmt_check->store_result();

        // Obtener los nombres actuales de los archivos para limpiar si se actualizan
        $current_files = [
            'credencial_votar' => null,
            'declaracion_originalidad' => null,
            'consentimiento_expreso_adultos' => null
        ];
        if ($stmt_check->num_rows > 0) {
            $stmt_check->bind_result($id, $credencial_votar, $declaracion_originalidad, $consentimiento_expreso_adultos);
            $stmt_check->fetch();
            $current_files = [
                'credencial_votar' => $credencial_votar,
                'declaracion_originalidad' => $declaracion_originalidad,
                'consentimiento_expreso_adultos' => $consentimiento_expreso_adultos
            ];
        }

        if ($stmt_check->num_rows > 0) {
            // UPDATE
            $sql_update = "UPDATE registration 
                SET nombre = ?, apellidoP = ?, apellidoM = ?, fecha_nacimiento = ?, edad = ?, acepta_privacidad = ?, acepta_consentimiento = ?";

            $update_params = [
                $nombre,
                $apellidoP,
                $apellidoM,
                $fecha_nacimiento,
                $edad,
                $acepta_privacidad,
                $acepta_consentimiento
            ];
            $types = "ssssiii";

            foreach ($file_fields as $file_field) {
                if (isset($uploaded_files[$file_field])) {
                    $sql_update .= ", $file_field = ?";
                    $update_params[] = $uploaded_files[$file_field];
                    $types .= "s";
                    // Eliminar archivo anterior si existía (opcional)
                    if (!empty($current_files[$file_field])) {
                        $prev_file = "../" . $current_files[$file_field]; // Añade ../ si guardaste ruta relativa
                        if (file_exists($prev_file)) {
                            @unlink($prev_file);
                        }
                    }
                }
            }
            $sql_update .= " WHERE curp = ?";
            $update_params[] = $curp;
            $types .= "s";

            $stmt_update = $db_connection->prepare($sql_update);
            if ($stmt_update) {
                $stmt_update->bind_param($types, ...$update_params);

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
            // INSERT
            $sql_insert = "INSERT INTO registration (usuario_id, curp, nombre, apellidoP, apellidoM, fecha_nacimiento, edad, acepta_privacidad, acepta_consentimiento";
            $insert_params = [
                $usuario_id,
                $curp,
                $nombre,
                $apellidoP,
                $apellidoM,
                $fecha_nacimiento,
                $edad,
                $acepta_privacidad,
                $acepta_consentimiento
            ];
            $types = "isssssiii";

            foreach ($file_fields as $file_field) {
                if (isset($uploaded_files[$file_field])) {
                    $sql_insert .= ", $file_field";
                    $insert_params[] = $uploaded_files[$file_field];
                    $types .= "s";
                }
            }
            $sql_insert .= ") VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?";
            foreach ($uploaded_files as $k => $v)
                $sql_insert .= ", ?";
            $sql_insert .= ")";

            $stmt_insert = $db_connection->prepare($sql_insert);

            if ($stmt_insert) {
                $stmt_insert->bind_param($types, ...$insert_params);

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