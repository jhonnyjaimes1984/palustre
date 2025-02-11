<?php
#Salir si alguno de los datos no está presente
if(
!isset($_POST["id_individual"]) ||
!isset($_POST["origin_type"]) ||
!isset($_POST["comauto"]) ||
!isset($_POST["province"]) ||
!isset($_POST["locality"]) ||
!isset($_POST["born"]) ||
!isset($_POST["zepa"]) ||
!isset($_POST["transfer"]) ||
!isset($_POST["species"]) ||
!isset($_POST["nickname"]) ||
!isset($_POST["Genetic_code"]) ||
!isset($_POST["id_egg"]) ||
!isset($_POST["id_pair"]) ||
!isset($_POST["capture_date"]) ||
!isset($_POST["sex"]) ||
!isset($_POST["year"]) ||
!isset($_POST["status"]) ||
!isset($_POST["left_ring"]) ||
!isset($_POST["left_type"]) ||
!isset($_POST["left_color"]) ||
!isset($_POST["left_letter"]) ||
!isset($_POST["left_number_code"]) ||
!isset($_POST["right_ring"]) ||
!isset($_POST["right_type"]) ||
!isset($_POST["right_color"]) ||
!isset($_POST["right_letter"]) ||
!isset($_POST["right_number_code"]) ||
!isset($_POST["notes"])) exit();

#Si todo va bien, se ejecuta esta parte del código...

$id_individual = $_POST["id_individual"];
$origin_type=$_POST["origin_type"];
$comauto=$_POST["comauto"];
$province=$_POST["province"];
$locality=$_POST["locality"];
$born=$_POST["born"];
$zepa=$_POST["zepa"];
$transfer=$_POST["transfer"];
$species=$_POST["species"];
$nickname=$_POST["nickname"];
$Genetic_code=$_POST["Genetic_code"];
$id_egg=$_POST["id_egg"];
$id_pair=$_POST["id_pair"];
$capture_date=$_POST["capture_date"];
$sex=$_POST["sex"];
$year=$_POST["year"];
$status=$_POST["status"];
$left_ring=$_POST["left_ring"];
$left_type=$_POST["left_type"];
$left_color=$_POST["left_color"];
$left_letter=$_POST["left_letter"];
$left_number_code=$_POST["left_number_code"];
$right_ring=$_POST["right_ring"];
$right_type=$_POST["right_type"];
$right_color=$_POST["right_color"];
$right_letter=$_POST["right_letter"];
$right_number_code=$_POST["right_number_code"];
$notes=$_POST["notes"];
$facility = $_POST['Facility'];
$facility_assi = $_POST['Facility_assi'];



 include_once "../../conf/configuracion.php";

 $peticion_facility = $db->query("INSERT INTO `facility_assignment`(`id_assignment`, `id_individual_assi`, `id_facility_name`, `assignment_date`, `finish_date`) VALUES 
 	('".$facility."','".$id_individual."','".$facility_assi."','".date("Y/m/d")."', NULL)");




 $peticion_1 = $db->query("INSERT INTO `origin`(`origin_type`, `entry_date`, `cod_comauto`, `cod_province`, `id_cod_locality`) VALUES 
 	('".$origin_type."', '".$capture_date."', '".$comauto."', '".$province."', '".$locality."')");

 	$last_id = $db->insert_id;


$peticion = $db->query("INSERT INTO `individuals`(`id_individual`, `id_parents`, `specie`, `origin`, `origin_type`, `born_center`, `P.N/Zepa`, `Transfer_center`, `sex`, `entry_date`, `year`, `nickname`, `genetic_code`, `status`, `left_leg`, `left_ring_type`, `left_ring_color`, `left_letter_color`, `left_ring_numer`, `right_leg`, `right_ring_type`, `right_ring_color`, `right_letter_color`, `right_ring_numer`, `notes`) VALUES 
	('".$id_individual."',
	'".$id_pair."',
	'".$species."',
	'".$locality."',
	'".$last_id."',
	'".$born."',
	'".$zepa."',
	'".$transfer."',
	'".$sex."',
	'".$capture_date."',
	'".$year."',
	'".$nickname."',
	'".$Genetic_code."',
	'".$status."',
	'".$left_ring."',
	'".$left_type."',
	'".$left_color."',
	'".$left_letter."',
	'".$left_number_code."',
	'".$right_ring."',
	'".$right_type."',
	'".$right_color."',
	'".$right_letter."',
	'".$right_number_code."',
	'".$notes."')");

if (!empty($_FILES['documents']['name'][0])) {
     $base_path = dirname(__FILE__) . '/'; // Ruta absoluta al directorio actual del script
     $destino_doc = $base_path . 'doc_individuals/';
     $date = date('Y/m/d');

    foreach ($_FILES['documents']['name'] as $index_doc => $nombre_doc) {
        $ruta_tmp = $_FILES['documents']['tmp_name'][$index_doc];
        $nombre_unico_doc = uniqid() . "_" . $nombre_doc;

        if (move_uploaded_file($ruta_tmp, $destino_doc . $nombre_unico_doc)) {
            $stmt = $db->prepare("INSERT INTO `documents`(`id_individual_doc`, `name_doc`, `date_doc`) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $id_individual, $nombre_unico_doc, $date);
            $stmt->execute();
        }
    }
}



// Subida de fotos
if (!empty($_FILES['photos']['name'][0])) {
	$base_path = dirname(__FILE__) . '/'; // Ruta absoluta al directorio actual del script
    $destino = $base_path . '/img_individuals/';
    $date = date('Y/m/d');

    foreach ($_FILES['photos']['name'] as $index => $nombre_img) {
        $ruta_tmp = $_FILES['photos']['tmp_name'][$index];
        $nombre_unico = uniqid() . "_" . $nombre_img;

        if (move_uploaded_file($ruta_tmp, $destino . $nombre_unico)) {
            $stmt = $db->prepare("INSERT INTO `photos`(`id_individual_photo`, `name_photo`, `date_photo`) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $id_individual, $nombre_unico, $date);
            $stmt->execute();
        }
    }
}



if($peticion === TRUE){
header("Location: insert_stockbirds.php");
exit;
}
else echo "";






?>