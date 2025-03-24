<?php
date_default_timezone_set("Europe/Madrid");
//DB details
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '16612416301084Jh';
$dbName = 'bd_palustre';

//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
$db->query("set names utf8;");

if ($db->connect_error) {
    die("No hay Conexion con la base de datos: " . $db->connect_error);
} 


try{
	$base_de_datos = new PDO('mysql:host=localhost;dbname=' . $dbName, $dbUsername, $dbPassword);
	 $base_de_datos->query("set names utf8;");
    $base_de_datos->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $base_de_datos->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}catch(Exception $e){
	echo "Ocurrió algo con la base de datos: " . $e->getMessage();
}

?>