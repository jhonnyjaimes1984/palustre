<?php

include_once "../../../conf/configuracion.php";

// Obtener los datos enviados por AJAX
$id = $_POST['id'] ?? '';
$specie = $_POST['specie'] ?? '';
$id_staff = $_POST['id_staff'] ?? '' ;
// Ejecutar la consulta de inserción
try {
    $sentencia_insert_indidual = $base_de_datos->query("INSERT INTO `monitoring`(
        `id_staff_mon`, `specie`, `id_individual_mon`, `status_mon`, `pair_id`, `id_external_distutbance`,
        `interior_mon`, `external_mon`, `date`, `start_time_mon`, `finish_time_mon`, `take_mon_photo_video`,
        `id_master_routine`, `id_master_reproductive`, `id_master_chicken`, `id_meteorology`, `notes`
    ) VALUES (
        '".$id_staff."', '".$specie."', '".$id."', '', '', '', '', '', '".date('Y-m-d')."',
        '".date('Y-m-d H:i:s a')."', '', '', '', '', '', '', ''
    )");


     $id_insertado = $base_de_datos->lastInsertId();

    // Generar el HTML que se mostrará en la página
    // include "inserParaAjax_1.php";

     $html = "$id_insertado";

    // Devolver el HTML generado
    echo $html;
} catch (Exception $e) {
    // Manejar errores
    echo "<div class='alert alert-danger'>Error al insertar el registro: " . $e->getMessage() . "</div>";
}
?>





