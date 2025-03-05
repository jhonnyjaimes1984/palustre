<?php

include_once "../../../conf/configuracion.php";

// Obtener los datos enviados por AJAX
$id = $_POST['id'] ?? '';
$specie = $_POST['specie'] ?? '';
$id_staff = $_POST['id_staff'] ?? '' ;


if($specie == 'Sin_especie'){

    // hacemos una consulta para saber el ultimo conteo
$cont_real = $db->query("SELECT max(cont_id_real) as total FROM monitoring");
$row_real = $cont_real->fetch_assoc(); 
// guardamos los resultados en un array
$itemData_id_real = array('id_cont_real' => $row_real['total']);
$id_cont_real = $itemData_id_real['id_cont_real'] + 1;

// Ejecutar la consulta de inserción
try {
    $sentencia_insert_indidual = $base_de_datos->query("INSERT INTO `monitoring`(
        `cont_id_real`,`id_staff_mon`, `specie`, `id_individual_mon`, `status_mon`, `pair_id`, `id_external_distutbance`,
        `interior_mon`, `external_mon`, `date`, `start_time_mon`, `finish_time_mon`, `take_mon_photo_video`,
        `id_master_routine`, `id_master_reproductive`, `id_master_chicken`, `id_meteorology`, `notes`
    ) VALUES (
        '".$id_cont_real."','".$id_staff."', '".$specie."', '', '', '".$id."', '', '', '', '".date('Y-m-d')."',
        '".date('Y-m-d H:i:s a')."', '', '', '', '', '', '', ''
    )");


     
    $id_monitoring_insert = $base_de_datos->lastInsertId();
    // Generar el HTML que se mostrará en la página
    // include "insert_monitoring.php";

     $html = "$id_cont_real"."-"."$id_monitoring_insert";

    // Devolver el HTML generado
    echo $html;
} catch (Exception $e) {
    // Manejar errores
    echo "<div class='alert alert-danger'>Error al insertar el registro: " . $e->getMessage() . "</div>";
}


}else{

    // hacemos una consulta para saber el ultimo conteo
$cont_real = $db->query("SELECT max(cont_id_real) as total FROM monitoring");
$row_real = $cont_real->fetch_assoc(); 
// guardamos los resultados en un array
$itemData_id_real = array('id_cont_real' => $row_real['total']);
$id_cont_real = $itemData_id_real['id_cont_real'] + 1;

// Ejecutar la consulta de inserción
try {
    $sentencia_insert_indidual = $base_de_datos->query("INSERT INTO `monitoring`(
        `cont_id_real`,`id_staff_mon`, `specie`, `id_individual_mon`, `status_mon`, `pair_id`, `id_external_distutbance`,
        `interior_mon`, `external_mon`, `date`, `start_time_mon`, `finish_time_mon`, `take_mon_photo_video`,
        `id_master_routine`, `id_master_reproductive`, `id_master_chicken`, `id_meteorology`, `notes`
    ) VALUES (
        '".$id_cont_real."','".$id_staff."', '".$specie."', '".$id."', '', '', '', '', '', '".date('Y-m-d')."',
        '".date('Y-m-d H:i:s a')."', '', '', '', '', '', '', ''
    )");


     
    $id_monitoring_insert = $base_de_datos->lastInsertId();
    // Generar el HTML que se mostrará en la página
    // include "insert_monitoring.php";

     $html = "$id_cont_real"."-"."$id_monitoring_insert";

    // Devolver el HTML generado
    echo $html;
} catch (Exception $e) {
    // Manejar errores
    echo "<div class='alert alert-danger'>Error al insertar el registro: " . $e->getMessage() . "</div>";
}


}




?>





