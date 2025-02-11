<?php

class Conexiondb{

	public function getConexion(){
		$cnx=new PDO("mysql:host=localhost;dbname=mangosga_mangos","mangosga_root","16612416301084Jh");
		$cnx->query("set names utf8;");
		return $cnx;
	}
}

?>


