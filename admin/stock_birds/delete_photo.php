<?php include_once "../../conf/configuracion.php"; 

	$id_photo = $_GET['id_photo'];
	$id_individual = $_GET['id_individuals'];

 $query = $base_de_datos->prepare("DELETE FROM `individuals_photos` WHERE id_photos_ind = ?");
    $query->execute([$id_photo]);

    header('Location: update_individual.php?id='.$id_individual);

?>