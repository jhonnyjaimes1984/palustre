<?php
include_once "../../../conf/configuracion.php";
session_start();

try {
    // 🔹 Eliminar registros temporales con `status_mon = 0`
    $borradoTemp = $base_de_datos->query("DELETE FROM `monitoring` WHERE status_mon = '0'");

    // 🔹 Redireccionar según la sesión
    if (isset($_SESSION['id_staff'])) {
        header("Location: select_monitoring.php");
        exit; // Detiene la ejecución del script
    } else {
        header("Location: ../../salir.php");
        exit; // Detiene la ejecución del script
    }

} catch (Exception $e) {
    // 🔹 Manejo de errores seguro (guarda en log en lugar de mostrarlo)
    error_log("Error en eliminación de monitoreo: " . $e->getMessage(), 3, "/var/log/app_errors.log");
    
    // Opcional: Redirigir a una página de error
    header("Location: error.php?msg=database_error");
    exit;
}
?>
