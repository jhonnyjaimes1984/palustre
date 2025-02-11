<?php 
include '../utils/conexiondb.php';

class MetodosDAO{
	
	public function ListarProductos(){
		$cnx=new conexiondb();
		$cn=$cnx->getConexion();
		$res=$cn->prepare("SELECT * FROM productos ORDER BY nombrep ASC");
		$res->execute();

		foreach ($res as $row) { 

		$lista[]=$row;
			
		}
		return $lista;
	}


	public function ListarProductosCod($cod){
		$cnx=new conexiondb();
		$cn=$cnx->getConexion();
		$res=$cn->prepare("SELECT * FROM productos WHERE id=$cod");
		$res->execute();

		foreach ($res as $row) {

		$lista[]=$row;			
		}
		return $lista;
	}

}





?>