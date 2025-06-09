<?php
// Habilitar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar que el tipo sea válido
$tipo = $_GET['tipo'] ?? '';
if (!in_array($tipo, ['menores', 'mayores'])) {
    header("HTTP/1.1 400 Bad Request");
    exit("Tipo de documento no válido");
}

// Definir rutas base (ajusta según tu estructura real)
$basePath = realpath(__DIR__ . '/../Docs');
$documentos = [];

if ($tipo === 'menores') {
    $documentos = [
        $basePath . '../data/Docs/Menores/Carta de autorización.docx',
        $basePath . '../data/Docs/Menores/Declaración de originalidad.docx',
        $basePath . '../data/Docs/Menores/Formato de consentimiento.docx'
    ];
} else {
    $documentos = [
        $basePath . '../data/Docs/Mayores/Declaración de originalidad.docx',
        $basePath . '../data/Docs/Mayores/Formato Consentimiento Expreso.docx'
    ];
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