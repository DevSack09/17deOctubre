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

    // === DOMICILIO ===
    $calle = !empty($_POST['calle']) ? $_POST['calle'] : null;
    $numeroExterior = !empty($_POST['numeroExterior']) ? $_POST['numeroExterior'] : null;
    $numeroInterior = !empty($_POST['numeroInterior']) ? $_POST['numeroInterior'] : null;
    $colonia = !empty($_POST['colonia']) ? $_POST['colonia'] : null;
    $cp = !empty($_POST['cp']) ? $_POST['cp'] : null;
    $municipio = !empty($_POST['municipio']) ? $_POST['municipio'] : null;
    $localidad = !empty($_POST['localidad']) ? $_POST['localidad'] : null;

    $gradoEstudios = !empty($_POST['gradoEstudios']) ? $_POST['gradoEstudios'] : null;
    $ocupacionActual = !empty($_POST['ocupacionActual']) ? $_POST['ocupacionActual'] : null;

    $gradoActual = !empty($_POST['gradoActual']) ? $_POST['gradoActual'] : null;
    $estudiosActuales = !empty($_POST['estudiosActuales']) ? $_POST['estudiosActuales'] : null;
    $cargoActual = !empty($_POST['cargoActual']) ? $_POST['cargoActual'] : null;
    $centroEstudiosTrabajo = !empty($_POST['centroEstudiosTrabajo']) ? $_POST['centroEstudiosTrabajo'] : null;

    $correo = !empty($_POST['correo']) ? $_POST['correo'] : null;
    $numerofijo = !empty($_POST['numerofijo']) ? $_POST['numerofijo'] : null;
    $numeromovil = !empty($_POST['numeromovil']) ? $_POST['numeromovil'] : null;

    $facebook = !empty($_POST['facebook']) ? $_POST['facebook'] : null;
    $tiktok = !empty($_POST['tiktok']) ? $_POST['tiktok'] : null;
    $instagram = !empty($_POST['instagram']) ? $_POST['instagram'] : null;
    $otraRedSocial = !empty($_POST['otraRedSocial']) ? $_POST['otraRedSocial'] : null;

    $seudonimo = !empty($_POST['seudonimo']) ? $_POST['seudonimo'] : null;
    $titulo_ensayo = !empty($_POST['titulo_ensayo']) ? $_POST['titulo_ensayo'] : null;
    $categoria = !empty($_POST['categoria']) ? $_POST['categoria'] : null;


    $archivo_ensayo = null;

    // === ARCHIVOS ===
    $file_fields = [
        'archivo_ensayo',
        'credencial_votar',
        'declaracion_originalidad',
        'consentimiento_expreso_adultos',
        // CAMPOS PARA MENORES DE EDAD
        'identificacion_fotografia',
        'carta_autorizacion',
        'declaracion_originalidad_menores',
        'comprobante_domicilio_tutor',
        'consentimiento_expreso_menores',
        'ine_tutor'
    ];

    // Cambia la base de subida a una temporal
    $upload_base_dir = "../uploads/tmp/";
    $db_upload_base_dir = "uploads/tmp/";

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
            $dt_mexico = new DateTime('now', new DateTimeZone('America/Mexico_City'));
            $timestamp = $dt_mexico->format('dmYHis');
            $target_filename = $curp . "_" . $file_field . "_" . $timestamp . ".pdf";
            $target_path = $upload_base_dir . $target_filename;
            $db_file_path = $db_upload_base_dir . $target_filename;

            if (move_uploaded_file($file['tmp_name'], $target_path)) {
                $uploaded_files[$file_field] = [
                    'tmp_path' => $target_path,
                    'filename' => $target_filename
                ];
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
    $sql_check = "SELECT id, folio, archivo_ensayo, credencial_votar, declaracion_originalidad, consentimiento_expreso_adultos, identificacion_fotografia, carta_autorizacion, declaracion_originalidad_menores, comprobante_domicilio_tutor, consentimiento_expreso_menores, ine_tutor FROM registration WHERE curp = ?";
    $stmt_check = $db_connection->prepare($sql_check);

    if ($stmt_check) {
        $stmt_check->bind_param("s", $curp);
        $stmt_check->execute();
        $stmt_check->store_result();

        // Obtener los nombres actuales de los archivos para limpiar si se actualizan
        $current_files = [
            'credencial_votar' => null,
            'declaracion_originalidad' => null,
            'consentimiento_expreso_adultos' => null,
            'identificacion_fotografia' => null,
            'carta_autorizacion' => null,
            'declaracion_originalidad_menores' => null,
            'comprobante_domicilio_tutor' => null,
            'consentimiento_expreso_menores' => null,
            'ine_tutor' => null
        ];
        $folio = null;
        $registro_id = null;
        if ($stmt_check->num_rows > 0) {
            $stmt_check->bind_result(
                $id,
                $folio,
                $archivo_ensayo_actual,
                $credencial_votar,
                $declaracion_originalidad,
                $consentimiento_expreso_adultos,
                $identificacion_fotografia,
                $carta_autorizacion,
                $declaracion_originalidad_menores,
                $comprobante_domicilio_tutor,
                $consentimiento_expreso_menores,
                $ine_tutor
            );
            $stmt_check->fetch();
            $registro_id = $id;
            $current_files = [
                'archivo_ensayo' => $archivo_ensayo_actual,
                'credencial_votar' => $credencial_votar,
                'declaracion_originalidad' => $declaracion_originalidad,
                'consentimiento_expreso_adultos' => $consentimiento_expreso_adultos,
                'identificacion_fotografia' => $identificacion_fotografia,
                'carta_autorizacion' => $carta_autorizacion,
                'declaracion_originalidad_menores' => $declaracion_originalidad_menores,
                'comprobante_domicilio_tutor' => $comprobante_domicilio_tutor,
                'consentimiento_expreso_menores' => $consentimiento_expreso_menores,
                'ine_tutor' => $ine_tutor
            ];
        }

        if ($stmt_check->num_rows > 0) {
            // UPDATE
            // Recupera el id y folio del registro
            $sql_folio = "SELECT id, folio FROM registration WHERE curp = ?";
            $stmt_folio = $db_connection->prepare($sql_folio);
            $stmt_folio->bind_param("s", $curp);
            $stmt_folio->execute();
            $stmt_folio->bind_result($registro_id, $folio);
            $stmt_folio->fetch();
            $stmt_folio->close();

            if (!$folio) {
                $folio = "REGEQIEE-" . $registro_id;
                $sql_update_folio = "UPDATE registration SET folio = ? WHERE id = ?";
                $stmt_update_folio = $db_connection->prepare($sql_update_folio);
                $stmt_update_folio->bind_param("si", $folio, $registro_id);
                $stmt_update_folio->execute();
                $stmt_update_folio->close();
            }

            $user_folder = "../uploads/$folio/";
            $db_user_folder = "uploads/$folio/";

            if (!file_exists($user_folder)) {
                mkdir($user_folder, 0777, true);
            }

            // Mueve archivos nuevos a la carpeta personalizada
            foreach ($file_fields as $file_field) {
                if (isset($uploaded_files[$file_field])) {
                    $new_path = $user_folder . $uploaded_files[$file_field]['filename'];
                    $db_new_path = $db_user_folder . $uploaded_files[$file_field]['filename'];
                    rename($uploaded_files[$file_field]['tmp_path'], $new_path);
                    $uploaded_files[$file_field] = $db_new_path;
                    // Elimina archivo anterior si existía
                    if (!empty($current_files[$file_field])) {
                        $prev_file = "../" . $current_files[$file_field];
                        if (file_exists($prev_file)) {
                            @unlink($prev_file);
                        }
                    }
                }
            }

            $sql_update = "UPDATE registration 
    SET nombre = ?, apellidoP = ?, apellidoM = ?, fecha_nacimiento = ?, edad = ?, acepta_privacidad = ?, acepta_consentimiento = ?,
        calle = ?, numeroExterior = ?, numeroInterior = ?, colonia = ?, cp = ?, municipio = ?, localidad = ?, gradoEstudios = ?, ocupacionActual = ?,
        gradoActual = ?, estudiosActuales = ?, cargoActual = ?, centroEstudiosTrabajo = ?,
        correo = ?, numerofijo = ?, numeromovil = ?,
        facebook = ?, tiktok = ?, instagram = ?, otraRedSocial = ?,
        seudonimo = ?, titulo_ensayo = ?, categoria = ?";

            $update_params = [
                $nombre,
                $apellidoP,
                $apellidoM,
                $fecha_nacimiento,
                $edad,
                $acepta_privacidad,
                $acepta_consentimiento,
                $calle,
                $numeroExterior,
                $numeroInterior,
                $colonia,
                $cp,
                $municipio,
                $localidad,
                $gradoEstudios,
                $ocupacionActual,
                $gradoActual,
                $estudiosActuales,
                $cargoActual,
                $centroEstudiosTrabajo,
                $correo,
                $numerofijo,
                $numeromovil,
                $facebook,
                $tiktok,
                $instagram,
                $otraRedSocial,
                $seudonimo,
                $titulo_ensayo,
                $categoria
            ];

            if ($archivo_ensayo) {
                $sql_update .= ", archivo_ensayo = ?";
                $update_params[] = $archivo_ensayo;
            }

            $types = "ssssiiisssssssssssssssssssssss"; // Ajusta la cantidad de caracteres según los campos
            if ($archivo_ensayo) {
                $types .= "s";
            }

            // Agrega archivos si existen
            foreach ($file_fields as $file_field) {
                if (isset($uploaded_files[$file_field])) {
                    $sql_update .= ", $file_field = ?";
                    $update_params[] = $uploaded_files[$file_field];
                    $types .= "s";
                }
            }
            $sql_update .= " WHERE curp = ?";
            $update_params[] = $curp;
            $types .= "s";

            // Chequeo antes de bind_param
            if (strlen($types) !== count($update_params)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Desajuste entre tipos y parámetros en UPDATE',
                    'types_length' => strlen($types),
                    'params_count' => count($update_params),
                    'types' => $types,
                    'params' => $update_params
                ]);
                exit;
            }

            $stmt_update = $db_connection->prepare($sql_update);
            $stmt_update->bind_param($types, ...$update_params);

            if ($stmt_update->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Registro actualizado correctamente']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el registro', 'error' => $stmt_update->error]);
            }
            $stmt_update->close();
        } else {
            // INSERT
            $columns = [
                'usuario_id',
                'curp',
                'nombre',
                'apellidoP',
                'apellidoM',
                'fecha_nacimiento',
                'edad',
                'calle',
                'numeroExterior',
                'numeroInterior',
                'colonia',
                'cp',
                'municipio',
                'localidad',
                'gradoEstudios',
                'ocupacionActual',
                'gradoActual',
                'estudiosActuales',
                'cargoActual',
                'centroEstudiosTrabajo',
                'correo',
                'numerofijo',
                'numeromovil',
                'facebook',
                'tiktok',
                'instagram',
                'otraRedSocial',
                'seudonimo',
                'titulo_ensayo',
                'categoria',
                'archivo_ensayo',
                // ...archivos y otros campos...
                'credencial_votar',
                'declaracion_originalidad',
                'consentimiento_expreso_adultos',
                'identificacion_fotografia',
                'carta_autorizacion',
                'declaracion_originalidad_menores',
                'comprobante_domicilio_tutor',
                'consentimiento_expreso_menores',
                'ine_tutor',
                'acepta_privacidad',
                'acepta_consentimiento',
                'folio'
            ];

            $insert_params = [
                $usuario_id,
                $curp,
                $nombre,
                $apellidoP,
                $apellidoM,
                $fecha_nacimiento,
                $edad,
                $calle,
                $numeroExterior,
                $numeroInterior,
                $colonia,
                $cp,
                $municipio,
                $localidad,
                $gradoEstudios,
                $ocupacionActual,
                $gradoActual,
                $estudiosActuales,
                $cargoActual,
                $centroEstudiosTrabajo,
                $correo,
                $numerofijo,
                $numeromovil,
                $facebook,
                $tiktok,
                $instagram,
                $otraRedSocial,
                $seudonimo,
                $titulo_ensayo,
                $categoria,
                $archivo_ensayo,
                isset($uploaded_files['credencial_votar']) ? "" : null,
                isset($uploaded_files['declaracion_originalidad']) ? "" : null,
                isset($uploaded_files['consentimiento_expreso_adultos']) ? "" : null,
                isset($uploaded_files['identificacion_fotografia']) ? "" : null,
                isset($uploaded_files['carta_autorizacion']) ? "" : null,
                isset($uploaded_files['declaracion_originalidad_menores']) ? "" : null,
                isset($uploaded_files['comprobante_domicilio_tutor']) ? "" : null,
                isset($uploaded_files['consentimiento_expreso_menores']) ? "" : null,
                isset($uploaded_files['ine_tutor']) ? "" : null,
                $acepta_privacidad,
                $acepta_consentimiento,
                "" // Folio temporal
            ];
            $types = "isssssisssssssssssssssssssssssssssssssiiiss";

            if (strlen($types) !== count($insert_params)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Desajuste entre tipos y parámetros',
                    'types_length' => strlen($types),
                    'params_count' => count($insert_params),
                    'types' => $types,
                    'params' => $insert_params
                ]);
                exit;
            }

            $placeholders = array_fill(0, count($columns), '?');
            $sql_insert = "INSERT INTO registration (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $placeholders) . ")";

            $stmt_insert = $db_connection->prepare($sql_insert);

            if ($stmt_insert) {
                $stmt_insert->bind_param($types, ...$insert_params);

                if ($stmt_insert->execute()) {
                    $registro_id = $stmt_insert->insert_id;
                    $folio = "REGEQIEE-" . $registro_id;
                    $user_folder = "../uploads/$folio/";
                    $db_user_folder = "uploads/$folio/";

                    if (!file_exists($user_folder)) {
                        mkdir($user_folder, 0777, true);
                    }

                    // Mueve archivos a la carpeta personalizada y actualiza rutas
                    $update_file_paths = [];
                    foreach ($file_fields as $file_field) {
                        if (isset($uploaded_files[$file_field])) {
                            $new_path = $user_folder . $uploaded_files[$file_field]['filename'];
                            $db_new_path = $db_user_folder . $uploaded_files[$file_field]['filename'];
                            rename($uploaded_files[$file_field]['tmp_path'], $new_path);
                            $update_file_paths[$file_field] = $db_new_path;
                        }
                    }

                    // Actualiza las rutas y el folio en la base de datos
                    if (!empty($update_file_paths) || true) {
                        $set_files = [];
                        $params = [];
                        $types_update = "";
                        foreach ($update_file_paths as $field => $path) {
                            $set_files[] = "$field = ?";
                            $params[] = $path;
                            $types_update .= "s";
                        }
                        $set_files[] = "folio = ?";
                        $params[] = $folio;
                        $types_update .= "s";
                        $params[] = $registro_id;
                        $types_update .= "i";
                        $sql_update_files = "UPDATE registration SET " . implode(", ", $set_files) . " WHERE id = ?";
                        $stmt_update_files = $db_connection->prepare($sql_update_files);
                        if ($stmt_update_files) {
                            $stmt_update_files->bind_param($types_update, ...$params);
                            $stmt_update_files->execute();
                            $stmt_update_files->close();
                        }
                    }

                    echo json_encode(['status' => 'success', 'message' => 'Registro guardado correctamente', 'folio' => $folio]);
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