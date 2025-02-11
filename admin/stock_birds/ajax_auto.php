<?php 
if(isset($_POST['id'])):

 include_once "../../conf/configuracion.php"; 

$peticion = $base_de_datos->query("SELECT * FROM cod_province WHERE cod_comauto_pro = '".$_POST['id']."' "); 
$provinces= $peticion->fetchAll(PDO::FETCH_OBJ); 


    $html="<option value=''></option>";
   
    	   
    foreach($provinces as $province){
    	
    	

    	$html.="<option value='".$province->cod_province."'>".$province->name_province."</option>";
    	


    } 
echo $html ;
endif;



 ?>
