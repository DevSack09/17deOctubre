<?php
// Habilitar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar que el tipo sea válido
$tipo = $_GET['tipo'] ?? '';
if (!in_array($tipo, ['menores', 'mayores', 'todas'])) {
    header("HTTP/1.1 400 Bad Request");
    exit("Tipo de documento no válido");
}

// Definir rutas base (ajusta según tu estructura real)
$basePath = realpath(__DIR__ . '/../Docs');
$documentos = [];

switch ($tipo) {
    case 'menores':
        $documentos = [
            $basePath . '../data/Docs/Menores/CARTA DE AUTORIZACIÓN.docx',
            $basePath . '../data/Docs/Menores/DOCD PARA PERSONAS MENORES DE EDAD 2025.docx',
            $basePath . '../data/Docs/Menores/CONSENTIMIENTO EXPRESO MENORES 2025.docx'
        ];
        break;

    case 'mayores':
        $documentos = [
            $basePath . '../data/Docs/Mayores/DECLARACIÓN DE ORIGINALIDAD Y CESIÓN DE DERECHOS 2025.docx',
            $basePath . '../data/Docs/Mayores/CONSENTIMIENTO EXPRESO PREMIO 17 OCTUBRE.docx'
        ];
        break;

    case 'todas':
        $documentos = [

            // Documentos comunes
            $basePath . '../data/Docs/Todos/API 2025.pdf',
            $basePath . '../data/Docs/Todos/APS 2025.pdf',
            $basePath . '../data/Docs/Todos/CONVOCATORIA EXTENSA_VF_10.06.25.pdf',
            $basePath . '../data/Docs/Todos/Guía-Normas-APA-7ma-Edición.pdf',
            $basePath . '../data/Docs/Todos/Plantilla Ensayo 2025 APA 7.docx',
            $basePath . '../data/Docs/Todos/Rúbrica Letras con Trascendencia.pdf',
            $basePath . '../data/Docs/Todos/Rúbrica Letras Contemporáneas.pdf',
            $basePath . '../data/Docs/Todos/Rúbrica Letras Jóvenes.pdf'
        ];
        break;
}

// Verificar existencia de archivos
foreach ($documentos as $doc) {
    if (!file_exists($doc)) {
        header("HTTP/1.1 404 Not Found");
        exit("Archivo no encontrado: " . basename($doc));
    }
}

// Crear ZIP
$zip = new ZipArchive();
$zipFilename = tempnam(sys_get_temp_dir(), 'zip');

if ($zip->open($zipFilename, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
    exit("No se pudo crear el archivo ZIP");
}

foreach ($documentos as $doc) {
    // Usamos basename para evitar estructura de directorios en el ZIP
    $zip->addFile($doc, basename($doc));
}

if (!$zip->close()) {
    exit("Error al finalizar el archivo ZIP");
}

// Enviar headers
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="documentos_' . $tipo . '.zip"');
header('Content-Length: ' . filesize($zipFilename));
header('Pragma: no-cache');
header('Expires: 0');

readfile($zipFilename);
unlink($zipFilename); // Limpiar
exit;
?>