<?php 
include_once "../../../conf/configuracion.php"; 
session_start();
$id_monitoring = $_GET['id'];

 $sentencia = $base_de_datos->query("UPDATE `monitoring` SET `status_mon`= 2 WHERE id_monitoring='".$id_monitoring."'");

header("Location: select_monitoring.php");


?>