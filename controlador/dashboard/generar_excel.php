<?php
include "../../modelo/conexion.php";


$sql = "SELECT 
    r.*,
    e.pregunta1,
    e.pregunta2,
    e.pregunta3,
    e.sugerencia,
    e.fecha as fecha_encuesta
FROM registration AS r
LEFT JOIN encuesta_satisfaccion AS e ON r.usuario_id = e.usuario_id
ORDER BY r.id;";

$result = $db_connection->query($sql);

if ($result && $result->num_rows > 0) {
    $filename = "REGISTRO_ENCUESTA_SATISFACCION_" . date("Ymd_His") . ".csv";

    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment;filename="' . $filename . '"');

    $output = fopen('php://output', 'w');

    $header = array(
        "id",
        "folio",
        "usuario_id",
        "curp",
        "nombre",
        "apellidoP",
        "apellidoM",
        "fecha_nacimiento",
        "edad",
        "calle",
        "numeroExterior",
        "numeroInterior",
        "colonia",
        "cp",
        "municipio",
        "localidad",
        "gradoEstudios",
        "ocupacionActual",
        "gradoActual",
        "estudiosActuales",
        "cargoActual",
        "centroEstudiosTrabajo",
        "correo",
        "numerofijo",
        "numeromovil",
        "facebook",
        "tiktok",
        "instagram",
        "otraRedSocial",
        "seudonimo",
        "titulo_ensayo",
        "categoria",
        "archivo_ensayo",
        "credencial_votar",
        "declaracion_originalidad",
        "consentimiento_expreso_adultos",
        "identificacion_fotografia",
        "carta_autorizacion",
        "declaracion_originalidad_menores",
        "comprobante_domicilio_tutor",
        "consentimiento_expreso_menores",
        "ine_tutor",
        "discapacidad",
        "discapacidad_cual",
        "tipo_discapacidad",
        "lengua_indigena",
        "lengua_cual",
        "auto_indigena",
        "comunidad_indigena",
        "comunidad_cual",
        "diversidad",
        "diversidad_cual",
        "medio_convocatoria",
        "acepta_privacidad",
        "acepta_consentimiento",
        "fecha_registro",
        "status",
        // Campos de encuesta_satisfaccion
        "pregunta1",
        "pregunta2",
        "pregunta3",
        "sugerencia",
        "fecha_encuesta"
    );

    fwrite($output, "\xEF\xBB\xBF");

    fputcsv($output, $header);

    while ($row = $result->fetch_assoc()) {
        $data = array();
        foreach ($header as $col) {
            if ($col === "acepta_privacidad" || $col === "acepta_consentimiento") {
                $data[] = (isset($row[$col]) && $row[$col] == 1) ? "Sí" : "No";
            } elseif ($col === "status") {
                if (!isset($row[$col])) {
                    $data[] = "";
                } else {
                    $data[] = ($row[$col] == 1) ? "Finalizado" : "Pendiente";
                }
            } else {
                $data[] = isset($row[$col]) ? $row[$col] : '';
            }
        }
        fputcsv($output, $data);
    }

    fclose($output);
} else {
    echo "No se encontraron datos en la tabla.";
}

$db_connection->close();
?>