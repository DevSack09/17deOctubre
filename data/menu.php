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
        <li class="sidebar-list-item">
            <a class="sidebar-link text-muted <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>"
                href="index.php">
                <svg class="svg-icon svg-icon-md me-3">
                    <use xlink:href="icons/orion-svg-sprite.svg#real-estate-1"> </use>
                </svg>
                <span class="sidebar-link-title">Dashboard</span>
            </a>
        </li>
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
        <?php if (moduloHabilitado('areas', $permisos_usuario)): ?>
            <li class="sidebar-list-item">
                <a class="sidebar-link text-muted <?php echo basename($_SERVER['PHP_SELF']) == 'areas.php' ? 'active' : ''; ?>"
                    href="areas.php">
                    <svg class="svg-icon svg-icon-md me-3">
                        <use xlink:href="icons/orion-svg-sprite.svg#portfolio-grid-1"> </use>
                    </svg>
                    <span class="sidebar-link-title">Áreas</span>
                </a>
            </li>
        <?php endif; ?>
        <?php if (moduloHabilitado('departamentos', $permisos_usuario)): ?>
            <li class="sidebar-list-item">
                <a class="sidebar-link text-muted <?php echo basename($_SERVER['PHP_SELF']) == 'departamentos.php' ? 'active' : ''; ?>"
                    href="departamentos.php">
                    <svg class="svg-icon svg-icon-md me-3">
                        <use xlink:href="icons/orion-svg-sprite.svg#grid-1"> </use>
                    </svg>
                    <span class="sidebar-link-title">Subáreas</span>
                </a>
            </li>
        <?php endif; ?>
        <?php if (moduloHabilitado('proveedores', $permisos_usuario)): ?>
            <li class="sidebar-list-item">
                <a class="sidebar-link text-muted <?php echo basename($_SERVER['PHP_SELF']) == 'proveedores.php' ? 'active' : ''; ?>"
                    href="proveedores.php">
                    <svg class="svg-icon svg-icon-md me-3">
                        <use xlink:href="icons/orion-svg-sprite.svg#man-1"> </use>
                    </svg>
                    <span class="sidebar-link-title">Proveedores</span>
                </a>
            </li>
        <?php endif; ?>
        <?php if (moduloHabilitado('articulos', $permisos_usuario)): ?>
            <li class="sidebar-list-item">
                <a class="sidebar-link text-muted <?php echo basename($_SERVER['PHP_SELF']) == 'articulos.php' ? 'active' : ''; ?>"
                    href="articulos.php">
                    <svg class="svg-icon svg-icon-md me-3">
                        <use xlink:href="icons/orion-svg-sprite.svg#shopping-bag-1"> </use>
                    </svg>
                    <span class="sidebar-link-title">Artículos</span>
                </a>
            </li>
        <?php endif; ?>
        <?php if (moduloHabilitado('entrada', $permisos_usuario)): ?>
            <li class="sidebar-list-item">
                <a class="sidebar-link text-muted <?php echo basename($_SERVER['PHP_SELF']) == 'entrada.php' ? 'active' : ''; ?>"
                    href="entrada.php">
                    <svg class="svg-icon svg-icon-md me-3">
                        <use xlink:href="icons/orion-svg-sprite.svg#delivery-truck-1"> </use>
                    </svg>
                    <span class="sidebar-link-title">Entrada de Artículos</span>
                </a>
            </li>
        <?php endif; ?>
        <?php if (moduloHabilitado('salidas', $permisos_usuario)): ?>
            <li class="sidebar-list-item">
                <a class="sidebar-link text-muted <?php echo basename($_SERVER['PHP_SELF']) == 'salidas.php' ? 'active' : ''; ?>"
                    href="salidas.php">
                    <svg class="svg-icon svg-icon-md me-3">
                        <use xlink:href="icons/orion-svg-sprite.svg#exit-1"> </use>
                    </svg>
                    <span class="sidebar-link-title">Salidas por Vale</span>
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
        <?php if (moduloHabilitado('bitacora', $permisos_usuario)): ?>
            <li class="sidebar-list-item">
                <a class="sidebar-link text-muted <?php echo basename($_SERVER['PHP_SELF']) == 'bitacora.php' ? 'active' : ''; ?>"
                    href="bitacora.php">
                    <svg class="svg-icon svg-icon-md me-3">
                        <use xlink:href="icons/orion-svg-sprite.svg#table-content-1"> </use>
                    </svg>
                    <span class="sidebar-link-title">Bitácora</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>