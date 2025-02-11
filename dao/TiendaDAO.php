<?php

session_start();

include './MetodosDAO.php';
$op=$_REQUEST['op'];
switch ($op) {
	case  1:
		unset($_SESSION['lista']);
		$objMetodo=new MetodosDAO();
		$lista=$objMetodo->ListarProductos();
		$_SESSION['lista']=$lista;
		header("Location: ../inicio.php");
		break;
	
	case 2;
		
		break;
}

?>