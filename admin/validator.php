<?php
if(!isset($_POST["email"]) || !isset($_POST["password"])) exit();


$email = $_POST["email"];
$pass = $_POST["password"];

include_once "../conf/configuracion.php";
$sentencia = $db->query("SELECT count(id_staff) FROM staff WHERE email = '".$email."' and password = '".$pass."';");
$row = $sentencia->fetch_assoc(); 
$itemData = array('id' => $row['count(id_staff)']);
if(($itemData['id'] < 0 ) or ($itemData['id'] =='')){
	header("Location: alerta.php");
	
}else{


$query = $db->query("SELECT * FROM staff WHERE  email ='".$email."' and password = '".$pass."' "); 
$row = $query->fetch_assoc(); 
$itemData = array('id_staff'=> $row['id_staff'], 'nombre' => $row['first_name'], 'apellido' => $roW['last_name'], 'rol'=> $row['role'] ,'privilegio'=> $row['access_level'] , 'compania'=> $row['company']);

	session_start();
	$_SESSION['id_staff'] = $itemData['id_staff'];
	$_SESSION['nombre'] = $itemData['nombre'];
	$_SESSION['apellido'] = $itemData['apellido'];
	$_SESSION['rol'] = $itemData['rol'];
	$_SESSION['privilegio'] = $itemData['privilegio'];
	$_SESSION['compania'] = $itemData['compania'];

	if(!isset($_SESSION['nombre']) && !isset($_SESSION['privilegio'])){ header("Location: singin.php?urdt=400");}else{

		$op=$_SESSION['privilegio'];

		switch ($op) {
			case 'Administrator':
				header("Location: admin.php");
				break;

			case 'principal_investigator':
				header("Location: ../investigator/admin.php");
				break;

			case 'veterinary':
				header("Location: ../veterinary/admin.php");
				break;	
			
			case 'ornithologist':
				header("Location: ../ornitholagist/admin.php");
				break;

			case 'breeding_technician':
				header("Location: ../technician/admin.php");
				break;

			case 'wildlife_caretaker':
				header("Location: ../caretaker/admin.php");
				break;

			case 'external_collaborator':
				header("Location: ../collaborator/admin.php");
				break;

			case 'visitor':
				header("Location: ../visitor/admin.php");
				break;

			default:
				// code...
			header("Location: singin.php?urdt=400");
				break;
		}
	}
		
} ?>