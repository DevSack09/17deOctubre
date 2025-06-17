<?php
$permisos_usuario = [];
if (isset($_SESSION['idusuario'])) {
    $idusuario = $_SESSION['idusuario'];
    $stmt = $db_connection->prepare("SELECT * FROM permisos WHERE idusuario = ?");
    $stmt->bind_param("i", $idusuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $permisos_usuario = $result->fetch_assoc();
    }
    $stmt->close();
}

function moduloHabilitado($modulo, $permisos)
{
    return isset($permisos[$modulo]) && $permisos[$modulo] == 1;
}
?>
<div class="sidebar py-3 shrink show" id="sidebar">
    <h6 class="sidebar-heading">Menú</h6>
    <ul class="list-unstyled">
        <?php if (moduloHabilitado('dashboard', $permisos_usuario)): ?>
            <li class="sidebar-list-item">
                <a class="sidebar-link text-muted <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>"
                    href="index.php">
                    <svg class="svg-icon svg-icon-md me-3">
                        <use xlink:href="icons/orion-svg-sprite.svg#mental-illness-1"> </use>
                    </svg>
                    <span class="sidebar-link-title">Dashboard</span>
                </a>
            </li>
        <?php endif; ?>
        <?php if (moduloHabilitado('usuarios', $permisos_usuario)): ?>
            <li class="sidebar-list-item">
                <a class="sidebar-link text-muted <?php echo basename($_SERVER['PHP_SELF']) == 'usuarios.php' ? 'active' : ''; ?>"
                    href="usuarios.php">
                    <svg class="svg-icon svg-icon-md me-3">
                        <use xlink:href="icons/orion-svg-sprite.svg#mental-illness-1"> </use>
                    </svg>
                    <span class="sidebar-link-title">Usuarios</span>
                </a>
            </li>
        <?php endif; ?>
        <?php if (moduloHabilitado('inicio', $permisos_usuario)): ?>
            <li class="sidebar-list-item">
                <a class="sidebar-link text-muted <?php echo basename($_SERVER['PHP_SELF']) == 'inicio.php' ? 'active' : ''; ?>"
                    href="inicio.php">
                    <svg class="svg-icon svg-icon-md me-3">
                        <use xlink:href="icons/orion-svg-sprite.svg#grid-1"> </use>
                    </svg>
                    <span class="sidebar-link-title">Inicio</span>
                </a>
            </li>
        <?php endif; ?>
        <?php if (moduloHabilitado('descarga', $permisos_usuario)): ?>
            <li class="sidebar-list-item">
                <a class="sidebar-link text-muted <?php echo basename($_SERVER['PHP_SELF']) == 'descarga.php' ? 'active' : ''; ?>"
                    href="descarga.php">
                    <svg class="svg-icon svg-icon-md me-3">
                        <use xlink:href="icons/orion-svg-sprite.svg#attachment-1"> </use>
                    </svg>
                    <span class="sidebar-link-title">Descarga de documentos</span>
                </a>
            </li>
        <?php endif; ?>
        <?php if (moduloHabilitado('formulario', $permisos_usuario)): ?>
            <li class="sidebar-list-item">
                <a class="sidebar-link text-muted <?php echo basename($_SERVER['PHP_SELF']) == 'formulario.php' ? 'active' : ''; ?>"
                    href="formulario.php">
                    <svg class="svg-icon svg-icon-md me-3">
                        <use xlink:href="icons/orion-svg-sprite.svg#survey-1"> </use>
                    </svg>
                    <span class="sidebar-link-title">Formulario</span>
                </a>
            </li>
        <?php endif; ?>
        <?php if (moduloHabilitado('reportes', $permisos_usuario)): ?>
            <li class="sidebar-list-item">
                <a class="sidebar-link text-muted <?php echo basename($_SERVER['PHP_SELF']) == 'reportes.php' ? 'active' : ''; ?>"
                    href="reportes.php">
                    <svg class="svg-icon svg-icon-md me-3">
                        <use xlink:href="icons/orion-svg-sprite.svg#survey-1"> </use>
                    </svg>
                    <span class="sidebar-link-title">Reportes</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>