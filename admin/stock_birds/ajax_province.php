<?php 
if(isset($_POST['id'])):

  include_once "../../conf/configuracion.php"; 

  $peticion = $base_de_datos->query("SELECT * FROM  cod_locality  WHERE cod_province = '".$_POST['id']."' "); 
  $localitys= $peticion->fetchAll(PDO::FETCH_OBJ); 


  $html="";


  foreach($localitys as $locality){



   $html.="<option value='".$locality->id_locality."'>".$locality->name."</option>";



} 
echo $html ;
endif;



?>
