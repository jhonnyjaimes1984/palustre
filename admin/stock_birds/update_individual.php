<?php include_once "../../conf/Config.php"; 

include_once BASE_URL . "/paginas/cabecera_segundo_nivel.php"; 


$id = 0;

if(isset($_POST['id_individual'])){

  $id = $_POST['id_individual'];

}else{
   $id = $_GET['id']; 
}


$sentencia = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
$sentencia->execute([$id]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
if($producto === FALSE){
  echo "¡No existe algún producto con ese ID!";
  exit();} ?>
<script type="text/javascript" src="../validator/vendor/jquery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../validator/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../validator/dist/js/bootstrapValidator.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
  .form-group {
    display: flex;
    align-items: center; /* Alinea verticalmente */
    gap: 10px; /* Espacio entre label y select */
  }

  .form-group label {
    margin: 0;
  }

  .form-group select {
    flex-grow: 1; /* Hace que el select ocupe el espacio restante */
  }
</style>

  <main role="main" class="content-wrapper">
   <div class="row">
    <div class='col-12 col-lg-6'>
      <h3><STRONG>BASE DE DATOS PALUSTRE</STRONG></h3>

    </div>




    <div class='col-12 col-lg-6'>
      <h3 class="text-right">ID INDIVIDUALS  <?php echo  'N°: 0000'.$producto->id_individual; ?></h3> 
      <h5 class="text-right">FACILITY: <?php 
$sentencia_cons_fac = $base_de_datos->prepare("SELECT * FROM facility_assignment fa WHERE fa.Id_assignment = (SELECT MAX(Id_assignment) FROM facility_assignment WHERE id_individual_assi = ?) ORDER BY fa.Id_assignment DESC");
$sentencia_cons_fac->execute([$id]);
$cons_fac = $sentencia_cons_fac->fetch(PDO::FETCH_OBJ);

if ($cons_fac && isset($cons_fac->id_facility_name) && $cons_fac->id_facility_name != null && $cons_fac->id_facility_name != 0) {
    $facilities = $base_de_datos->prepare("SELECT name_facility FROM facilities WHERE id_facility = ?");
    $facilities->execute([$cons_fac->id_facility_name]);
    $res_fac = $facilities->fetch(PDO::FETCH_OBJ);

    if ($res_fac) {
        // Mostrar el enlace si existe un resultado válido
        echo '<a href="facility_assignment.php?id=' . $cons_fac->id_facility_name . '">' . htmlspecialchars($res_fac->name_facility) . '</a>';
    } else {
        // Manejar el caso en que no se encuentra la instalación
        echo 'Facility not found.';
    }
} else {
    // Manejar el caso en que no hay asignación para el individuo
    echo 'No assignments found.';
}
?>
</a></h5>

      <h5 class="text-right">PAIR: <?php 
      $pairs_1 = $base_de_datos->prepare("SELECT max(pair_id) as new_id FROM pairs where male_individual1= ? or male_individual2= ? or male_individual3= ? or female_individual1= ? or female_individual2= ? or female_individual3= ?");
          $pairs_1->execute([$id, $id, $id, $id, $id, $id]);
          $res_fac_1 = $pairs_1->fetch(PDO::FETCH_OBJ);

          if($res_fac_1->new_id == null or $res_fac_1->new_id == 0){

              echo 'No assignment pair.';
          }else{

          $pairs = $base_de_datos->prepare("SELECT * FROM pairs where pair_id= ?");
          $pairs->execute([$res_fac_1->new_id]);
          $nombre_pair = $pairs->fetch(PDO::FETCH_OBJ); ?>

          <?php if ($nombre_pair->male_individual1 !=0) { ?>
            <a href="<?php echo "select_all.php?id=" .  $nombre_pair->male_individual1 ?>"><?php echo $nombre_pair->male_individual1 ?></a>
          <?php } ?>

          <?php if ($nombre_pair->male_individual2 !=0) { ?>
            <a href="<?php echo "select_all.php?id=" .  $nombre_pair->male_individual2 ?>"><?php echo $nombre_pair->male_individual2 ?></a>
          <?php } ?>

          <?php if ($nombre_pair->male_individual3 !=0) { ?>
            <a href="<?php echo "select_all.php?id=" .  $nombre_pair->male_individual3 ?>"><?php echo $nombre_pair->male_individual3 ?></a>
          <?php } ?>

          <?php if ($nombre_pair->female_individual1 !=0) { ?>
            <a href="<?php echo "select_all.php?id=" .  $nombre_pair->female_individual1 ?>"><?php echo $nombre_pair->female_individual1 ?></a>
          <?php } ?>

          <?php if ($nombre_pair->female_individual2 !=0) { ?>
            <a href="<?php echo "select_all.php?id=" .  $nombre_pair->female_individual2 ?>"><?php echo $nombre_pair->female_individual2 ?></a>
          <?php } ?>

          <?php if ($nombre_pair->female_individual3 !=0) { ?>
            <a href="<?php echo "select_all.php?id=" .  $nombre_pair->female_individual3 ?>"><?php echo $nombre_pair->female_individual3 ?></a>
          <?php } }?>

        </h5>
      <h5 class="text-right">PARENTS: <?php

      if($producto->id_parents !=0 ){

          $parents = $base_de_datos-> query("SELECT pair_id as new_id_parents FROM pairs where pair_id = '".$producto->id_parents."'" );
          
          $parents_con = $parents->fetch(PDO::FETCH_OBJ);

          if($parents_con->new_id_parents == null or $parents_con->new_id_parents == 0){

              echo 'No assignment parents.';
          }else{

          $pairs_2 = $base_de_datos->prepare("SELECT * FROM pairs where pair_id= ?");
          $pairs_2->execute([$parents_con->new_id_parents]);
          $nombre_pair_2 = $pairs_2->fetch(PDO::FETCH_OBJ); 

           if ($nombre_pair_2->male_individual1 !=0) { 
         ?>
            <a href="<?php echo "select_all.php?id=" .  $nombre_pair_2->male_individual1 ?>"><?php echo $nombre_pair_2->male_individual1 ?></a>
          <?php } ?>

          <?php if ($nombre_pair_2->male_individual2 !=0) { ?>
            <a href="<?php echo "select_all.php?id=" .  $nombre_pair_2->male_individual2 ?>"><?php echo $nombre_pair_2->male_individual2 ?></a>
          <?php } ?>

          <?php if ($nombre_pair_2->male_individual3 !=0) { ?>
            <a href="<?php echo "select_all.php?id=" .  $nombre_pair_2->male_individual3 ?>"><?php echo $nombre_pair_2->male_individual3 ?></a>
          <?php } ?>

          <?php if ($nombre_pair_2->female_individual1 !=0) { ?>
            <a href="<?php echo "select_all.php?id=" .  $nombre_pair_2->female_individual1 ?>"><?php echo $nombre_pair_2->female_individual1 ?></a>
          <?php } ?>

          <?php if ($nombre_pair_2->female_individual2 !=0) { ?>
            <a href="<?php echo "select_all.php?id=" .  $nombre_pair_2->female_individual2 ?>"><?php echo $nombre_pair_2->female_individual2 ?></a>
          <?php } ?>

          <?php if ($nombre_pair_2->female_individual3 !=0) { ?>
            <a href="<?php echo "select_all.php?id=" .  $nombre_pair_2->female_individual3 ?>"><?php echo $nombre_pair_2->female_individual3 ?></a>
          <?php } } }else{
             echo 'No assignment parents.';
          }

        ?>
</h5>
    </div> 
  </div>

  <br><br>
  <h4  align="center"><font color="black"> Individual Data </font></h4><hr>
  <form method="post" action="new_individual.php" enctype="multipart/form-data" id="form_insert">
  <div class="row">


    <div class="col-12"> 
      <table>
       <tbody>
         <tr>
           <td>
            <div class="form-group">
            <div class="col-3 col-lg-2"><label for="species">Specie</label></div>
            <select name="species" class="form-control" required>
             <?php $species = $base_de_datos->prepare("SELECT * FROM species where id_species= ?");
             $species->execute([$producto->specie]);
             $specie_1 = $species->fetch(PDO::FETCH_OBJ); ?>
             <option value="<?php echo $specie_1->id_species ?>"><?php echo $specie_1->scientific_name ?></option>
             <?php 
             $sentencia_species = $base_de_datos->query("SELECT * FROM species");
             $species = $sentencia_species->fetchAll(PDO::FETCH_OBJ);
             foreach($species as $specie) { ?>
              <option value='<?php echo $specie->id_species ?>'><?php echo $specie->scientific_name ?></option>
            <?php } ?>
          </select></div></td>
         </tr>
         <tr>
           <td>
            <div class="form-group">
            <div class="col-3 col-lg-2">  <label>Nickname</label>  </div> 
            <input class="form-control" name="nickname"  type="text" placeholder="Insert nickname" value="<?php echo $producto->nickname  ?>"></div></td>
         </tr>
         <tr>
           <td>
            <div class="form-group">
            <div class="col-3 col-lg-2"> 
            <label>Genetic Code</label>  </div> 
            <input class="form-control" name="Genetic_code"  type="text" placeholder="Insert Genetic Code" value="<?php echo $producto->genetic_code  ?>"></div></td>
         </tr>
         <tr>
           <td><div class="form-group">
            <div class="col-3 col-lg-2"> 
            <label>ORIGIN</label> </div> 
              <div class="row">
                
                  <label for="comauto"><strong>Autonomous Community:</strong></label>
                  <?php $origen = $base_de_datos->prepare("SELECT * FROM origin where id_cod_locality= ?");
                    $origen->execute([$producto->origin]);
                    $origen_1 = $origen->fetch(PDO::FETCH_OBJ); 

                    $origen_2 = $base_de_datos->prepare("SELECT * FROM  cod_comauto where id_comauto= ?");
                    $origen_2->execute([$origen_1->cod_comauto]);
                    $origen_2_1 = $origen_2->fetch(PDO::FETCH_OBJ);


                    ?>
                  <select name="comauto" id="comauto" class="form-control" required>
                    <option value="<?php echo $origen_2_1->id_comauto?>"><?php echo $origen_2_1->nombre_comauto?></option>
                    <?php 
                    $peticion = $base_de_datos->query("SELECT * FROM cod_comauto");
                    $tipos = $peticion->fetchAll(PDO::FETCH_OBJ);
                    foreach($tipos as $tipo) { ?>
                      <option value="<?php echo $tipo->id_comauto ?>"><?php echo $tipo->nombre_comauto ?></option>
                    <?php } ?>
                  </select>
               
                  <label for="province"><strong>Province/Isle:</strong></label>
                   <?php $origen_3 = $base_de_datos->prepare("SELECT * FROM cod_province where cod_province= ?");
                    $origen_3->execute([$origen_1->cod_province]);
                    $origen_3_1 = $origen_3->fetch(PDO::FETCH_OBJ);?>


                  <select name="province" id="province" class="form-control" required>
                     <?php $origen_3 = $base_de_datos->prepare("SELECT * FROM cod_province where cod_province= ?");
                    $origen_3->execute([$origen_1->cod_province]);
                    $origen_3_1 = $origen_3->fetch(PDO::FETCH_OBJ);?>
                    <option value="<?php echo $origen_3_1->cod_province ?>"><?php echo $origen_3_1->name_province ?></option>
                  </select>
               
                  <label for="locality"><strong>Locality:</strong></label>
                  <?php $origen_4 = $base_de_datos->prepare("SELECT * FROM cod_locality where id_locality= ?");
                    $origen_4->execute([$origen_1->id_cod_locality]);
                    $origen_4_1 = $origen_4->fetch(PDO::FETCH_OBJ);?>
                  <select name="locality" id="locality" class="form-control" required>
                    <option value="<?php echo $origen_4_1->id_locality ?>"><?php echo $origen_4_1->name ?></option>
                  </select>

                  <script>
                          $(document).ready(function(e){
                            $("#comauto").change(function(){
                              var parametros= "id="+$("#comauto").val();
                              $.ajax({
                                data: parametros,
                                url: 'ajax_auto.php',
                                type: 'post',
                                beforeSend: function (){},
                                success: function(response){
                                  $("#province").html(response);

                                }
                              });

                            }) 

                            $("#province").change(function(){
                              var parametros= "id="+$("#province").val();
                              $.ajax({
                                data: parametros,
                                url: 'ajax_province.php',
                                type: 'post',
                                beforeSend: function (){},
                                success: function(response){
                                  $("#locality").html(response);

                                }
                              });

                            }) 
                          }) 

                        </script>

                </div>
              </div>
                 <div class="form-group ">
                      <div class="col-3 col-lg-2"> 
  <label for="born" id="msgid12"><strong>Born Center:</strong></label> </div>
  <input class="form-control" name="born" type="text" placeholder="Insert Born Center" id="msgid13" value="<?php echo $producto->born_center ?>">
 
</div>

<div class="form-group ">
  <div class="col-3 col-lg-2"> 
  <label for="zepa" id="msgid16"><strong>P.N/Zepa:</strong></label></div>
  <input class="form-control" name="zepa" type="text" placeholder="Insert P.N/zepa" id="msgid17" value="<?php echo $producto->{'P.N/Zepa'}; ?>">

  
</div>

<div class="form-group ">
  <div class="col-3 col-lg-2"> 
  <label for="transfer" id="msgid14"><strong>Transfer Center:</strong></label> </div>
  <input class="form-control" name="transfer" type="text" placeholder="Insert Transfer Center" id="msgid15" value="<?php echo $producto->Transfer_center ?>">
 
</div>



              </div>
            </div>


           </div></td>
         </tr>
         <tr>
           <td><div class="form-group">
             <div class="col-3 col-lg-2"> 
            <label>Sex:</label> </div>
             <select name="province" id="province" class="form-control" required>

            <option value="<?php echo $producto->sexe ?>"><?php switch ($producto->sex) {
             case '1':
               // code...
              echo "Male";
               break;

                case '2':
               // code...
              echo "Female";
               break;
             
             default:
               // code...
             echo "Indeterminate";
               break;
           }   ?></option>
           <option value='0'>Indeterminate</option>
                    <option value='1'>Male</option>
                    <option value='2'>Female</option>
                  </select>

            </td>
         </tr>
         <tr>
           <td><div class="form-group">
             <div class="col-3 col-lg-2"> 
            <label>Capture/Entry Date:</label> </div>
            <input class="form-control" id="capture_date" name="capture_date" type="date" placeholder="YYYY-MM-DD" value="<?php echo $producto->entry_date ?>" required> </td>
         </tr>
         <tr>
           <td><div class="form-group">
            <div class="col-3 col-lg-2"> 
            <label>Year:</label> </div>
            <input class="form-control" id="year" name="year" type="number" placeholder="YYYY" min="1900" max="2100" value="<?php echo $producto->year ?>" required></td>
         </tr>
         <tr>
           <td><div class="form-group">
            <div class="col-3 col-lg-2">
            <label>Status:</label> </div>
             <select name="status" id="status" class="form-control" required>
                    <option value='<?php echo $producto->status ?>'><?php echo $producto->status ?></option>
                    <option value='Breeder'>Breeder</option>
                    <option value='Juvenile'>Juvenile</option>
                    <option value='No_breeder'>No Breeder</option>
                    <option value='Forest'>Forest</option>
                    <option value='Genetically_excluded'>Genetically excluded</option>
                    <option value='Die'>Die</option>
                    <option value='Released'>Released</option>
                  </select>

            </td>
         </tr>
       </tbody>
     </table>
   </div>

   <div class="col-12"> 

    <div class="row">
  <!-- Información de la pata izquierda -->
  <div class="col-lg-6 text-center">
    <h5><strong>Left Leg</strong></h5>
     <label for="left_ring"><strong>Does it have a ring?:</strong></label>
    <div class="form-group">
     
      <select name="left_ring" id="left_ring" class="form-control">
        <option value="<?php echo $producto->left_leg ?>"><?php if($producto->left_leg > 0){ echo "Yes"; }else{ echo "Don't Ring"; };  ?></option>
        <option value="0">No</option>
        <option value="1">Yes</option>
      </select>
    </div>

    <div id="left_leg_questions" >
      <label for="left_type"><strong>Type:</strong></label>
      <select name="left_type" id="left_type" class="form-control">
        <option value='<?php echo $producto->left_ring_type ?>'><?php echo $producto->left_ring_type ?></option>
        <option value='Steel'>Steel</option>
        <option value='PVC'>PVC</option>
        <option value='Aluminium'>Aluminium</option>
      </select>

      <label for="left_color"><strong>Ring Color:</strong></label>
      <select name="left_color" id="left_color" class="form-control">
        <option value='<?php echo $producto->left_ring_color ?>'><?php echo $producto->left_ring_color ?></option>
        <option value='Red'>Red</option>
        <option value='White'>White</option>
        <option value='Dark Green'>Dark Green</option>
        <option value='Pistachio Green'>Pistachio Green</option>
        <option value='Black'>Black</option>
        <option value='Metal'>Metal</option>
        <option value='Yellow'>Yellow</option>
        <option value='Light Blue'>Light Blue</option>
        <option value='Orange'>Orange</option>
        <option value='Pink'>Pink</option>
        <option value='Light Pink'>Light Pink</option>
        <option value='Blue'>Blue</option>
        <option value='Violet'>Violet</option>
        <option value='Gray'>Gray</option>
        <option value='Brown'>Brown</option>
        <option value='Other Color'>Other Color</option>
 </select>
      <label for="left_letter"><strong>Letter Color:</strong></label>
      <select name="left_letter" id="left_letter" class="form-control">
        <option value='<?php echo $producto->left_letter_color ?>'><?php echo $producto->left_letter_color ?></option>
        <option value='black'>Black</option>
        <option value='white'>White</option>
      </select>

      <label for="left_number_code"><strong>Number Code:</strong></label>
      <input class="form-control" name="left_number_code" pattern="^(?=.*[A-Za-z0-9ñÑ]).{1,}$" type="text" id="left_number_code" placeholder="Insert Number Code" value="<?php echo $producto->left_ring_numer ?>">
      <div class="valid-feedback">True</div>
      <div class="invalid-feedback">False</div>
    </div>
  </div>

  <!-- Información de la pata derecha -->
  <div class="col-lg-6 text-center">
    <h5><strong>Right Leg</strong></h5>
    <label for="right_ring"><strong>Does it have a ring?:</strong></label>
    <div class="form-group">
      
      <select name="right_ring" id="right_ring" class="form-control">
        <option value="<?php echo $producto->right_leg ?>"><?php if($producto->right_leg > 0){ echo "Yes"; }else{ echo "Don't Ring"; };  ?></option>
        <option value="0">No</option>
        <option value="1">Yes</option>
      </select>
    </div>

    <div id="right_leg_questions">
      <label for="right_type"><strong>Type:</strong></label>
      <select name="right_type" id="right_type" class="form-control">
        <option value='<?php echo $producto->right_ring_type ?>'><?php echo $producto->right_ring_type ?></option>
        <option value='Steel'>Steel</option>
        <option value='PVC'>PVC</option>
        <option value='Aluminium'>Aluminium</option>
      </select>

      <label for="right_color"><strong>Ring Color:</strong></label>
      <select name="right_color" id="right_color" class="form-control">
        <option value='<?php echo $producto->right_ring_color ?>'><?php echo $producto->right_ring_color ?></option>
        <option value='Red'>Red</option>
        <option value='White'>White</option>
        <option value='Dark Green'>Dark Green</option>
        <option value='Pistachio Green'>Pistachio Green</option>
        <option value='Black'>Black</option>
        <option value='Metal'>Metal</option>
        <option value='Yellow'>Yellow</option>
        <option value='Light Blue'>Light Blue</option>
        <option value='Orange'>Orange</option>
        <option value='Pink'>Pink</option>
        <option value='Light Pink'>Light Pink</option>
        <option value='Blue'>Blue</option>
        <option value='Violet'>Violet</option>
        <option value='Gray'>Gray</option>
        <option value='Brown'>Brown</option>
        <option value='Other Color'>Other Color</option>
      </select>

      <label for="right_letter"><strong>Letter Color:</strong></label>
      <select name="right_letter" id="right_letter" class="form-control">
        <option value='<?php echo $producto->right_letter_color ?>'><?php echo $producto->right_letter_color ?></option>
        <option value='black'>Black</option>
        <option value='white'>White</option>
      </select>

      <label for="right_number_code"><strong>Number Code:</strong></label>
      <input class="form-control" name="right_number_code" pattern="^(?=.*[A-Za-z0-9ñÑ]).{1,}$" type="text" id="right_number_code" placeholder="Insert Number Code" value="<?php echo $producto->right_ring_numer  ?>">
      <div class="valid-feedback">True</div>
      <div class="invalid-feedback">False</div>
    </div>
  </div>
</div>


 </div>
</div>
    







<br>
<h4  align="center"><font color="black"> Individual Biometry </font></h4><hr>

<?php 
$biometry = $base_de_datos->prepare("SELECT * FROM biometry, individuals WHERE individuals.id_individual = ? and biometry.id_individual=individuals.id_individual ");
$biometry->execute([$id]);
$data_biometry = $biometry->fetch(PDO::FETCH_OBJ);?>
  <div class="row">


    <div class="col-12 col-lg-6"> 
      <table>
       <tbody>
         <tr>
           <td><strong>Measurement Date:</strong><input class="form-control" name="Measurement" type="text" id="Measurement" placeholder="Insert Measurement Date" value="<?php echo $data_biometry->measurement_date  ?>"> </td>
         </tr>
         <tr>
           <td><strong>Staff:</strong>
             <?php $staff = $base_de_datos->prepare("SELECT * FROM staff where id_staff= ?");
                    $staff->execute([$data_biometry->staff]);
                    $staff_1 = $staff->fetch(PDO::FETCH_OBJ); ?>

                  <select name="staff" id="staff" class="form-control" required>
                    <option value="<?php echo $staff_1->id_staff ?>"><?php echo $staff_1->first_name.' '.$staff_1->last_name ?></option>
                    <?php 
                    $staff_1_1 = $base_de_datos->query("SELECT * FROM staff");
                    $staff_2 = $staff_1_1->fetchAll(PDO::FETCH_OBJ);
                    foreach($staff_2 as $staff_2_1) { ?>
                      <option value="<?php echo $staff_2_1->id_staff?>"><?php echo $staff_2_1->first_name.' '.$staff_2_1->last_name ?></option>
                    <?php } ?>
                  </select>

           </td>
         </tr>
         <tr>
           <td><strong>Wing Lenght:</strong><input class="form-control" name="wing_lenght" type="text" id="wing_lenght" placeholder="Insert Wing Lenght" value="<?php echo $data_biometry->wing_lenght ?>"></td>
         </tr>
         <tr>
           <td><strong>F8:</strong><input class="form-control" name="f8" type="text" id="f8" placeholder="Insert F8" value="<?php echo $data_biometry->F8 ?>"></td>
         </tr>
         <tr>
           <td><strong>Tail:</strong><input class="form-control" name="tail" type="text" id="tail" placeholder="Insert Tail" value="<?php echo $data_biometry->tail ?>"></td>
         </tr>
         <tr>
           <td><strong>Tarsus:</strong><input class="form-control" name="tarsus" type="text" id="tarsus" placeholder="Insert Tarsus" value="<?php echo $data_biometry->tarsus ?>"></td>
         </tr>
       </tbody>
     </table>
          </div>

   <div class="col-12 col-lg-6"> 
    <table >
     <tbody>


         <tr>
           <td><strong>Beak Length:</strong><input class="form-control" name="beak_length" type="text" id="beak_length" placeholder="Insert Beak Lenght" value="<?php echo $data_biometry->beak_length ?>"></td>
         </tr>
         <tr>
           <td><strong>Beak Head:</strong><input class="form-control" name="beak_head" type="text" id="beak_head" placeholder="Insert Beak Head" value="<?php echo $data_biometry->beak_head ?>"></td>
         </tr>
         <tr>
           <td><strong>Beak Height:</strong><input class="form-control" name="beak_height" type="text" id="beak_height" placeholder="Insert Beak Height" value="<?php echo $data_biometry->beak_height ?>"></td>
         </tr>
         <tr>
           <td><strong>Beak Width:</strong><input class="form-control" name="beak_width" type="text" id="beak_width" placeholder="Insert Beak Width" value="<?php echo $data_biometry->beak_width ?>"></td>
         </tr>
         <tr>
           <td><strong>Grease:</strong><input class="form-control" name="grease" type="text" id="grease" placeholder="Insert Grease" value="<?php echo $data_biometry->grease ?>"> </td>
         </tr>
         <tr>
           <td><strong>Muscle:</strong><input class="form-control" name="muscle" type="text" id="muscle" placeholder="Insert Muscle" value="<?php echo $data_biometry->muscle ?>"> </td>
         </tr>
         <tr>
           <td><strong>Weight:</strong><input class="form-control" name="weight" type="text" id="weight" placeholder="Insert Weight" value="<?php echo $data_biometry->weight ?>"></td>
         </tr>
       </tbody>
     </table>
   </div>
   <label for="notes_bio"><strong>Notes Biometry:</strong></label>
    <textarea id="notes_bio" name="notes_bio"  rows="3" class="form-control"> <?php echo $data_biometry->notes_bio ?></textarea>
  
</div>
<br>

<center><h4><font color="black">HISTORIC</font></h4></center><hr>
<div class="row">
  <label for="notes_histo"><strong>Notes Historic:</strong></label>
  <textarea id="notes_histo" name="notes_histo" rows="3" class="form-control"> <?php echo $producto->notes?></textarea>

</div>


<br><h4  align="center"><font color="black">Monitoring</font></h4><hr>

<?php
$sentencia_mon = $base_de_datos->query("SELECT id_monitoring, date, notes FROM monitoring where id_individual_mon='".$producto->id_individual."'");
$mon = $sentencia_mon->fetchAll(PDO::FETCH_OBJ);
?> 
<center><table id="example1" class="table table-bordered table-striped table-responsive">
  <thead> 
    <tr> 
      <th><center>Id Monitory</center></th> 
      <th><center>Date</center></th> 
      <th><center>Notes</center></th> 
      <th><center>Select</center></th>
    </tr> 
  </thead> 
  <tbody> 
   <?php foreach($mon as $individual_mon){ ?>
    <tr> 
      <td width="10%"><center><?php echo $individual_mon->id_monitoring; ?></center></td> 
      <td width="10%"><center><?php echo $individual_mon->date; ?></center></td> 
      <td width="80%"><center><?php echo $individual_mon->notes; ?> </center></td> 
      <td width="10%"><center><a class="btn btn-warning btn-sm" href=""><span data-feather="edit"></span></a></center></td> 
    </tr>
  <?php } ?>

</tbody> 

</table>
</center>


<hr>
<center><h4  align="center col-lg-12"><font color="black">Veterinary</font></h4></center>
<hr>
<?php
$sentencia_vet = $base_de_datos->query("SELECT id_veterinary, consultation_date, vet_control_alive.diagnosis as diagnosis, notes  FROM veterinary, vet_control_alive where id_individual_vet='".$producto->id_individual."' AND veterinary.id_vet_control_alive=vet_control_alive.id_vet_alive");
$vet = $sentencia_vet->fetchAll(PDO::FETCH_OBJ);
?> 
<center><table id="example2" class="table table-bordered table-striped table-responsive">
  <thead> 
    <tr> 
      <th><center>Id Veterinary</center></th> 
      <th><center>Date</center></th>
      <th><center>Incidence reason</center></th> 
      <th><center>Notes</center></th> 
      <th><center>Select</center></th>
    </tr> 
  </thead> 
  <tbody> 
   <?php foreach($vet as $individual_vet){ ?>
    <tr> 
      <td width="10%"><center><?php echo $individual_vet->id_veterinary; ?></center></td> 
      <td width="10%"><center><?php echo $individual_vet->consultation_date; ?></center></td> 
      <td width="40%"><center><?php echo $individual_vet->diagnosis; ?> </center></td> 
      <td width="40%"><center><?php echo $individual_vet->notes; ?> </center></td> 
      <td width="10%"><center><a class="btn btn-warning btn-sm" href=""><span data-feather="edit"></span></a></center></td> 
    </tr>
  <?php } ?>

</tbody> 

</table>
</center>

<hr>
<center><h4  align="center col-lg-12"><font color="black">Facility Assignment</font></h4></center>
<hr>
<?php
$sentencia_assi = $base_de_datos->query("SELECT id_assignment, assignment_date, id_facility_name, notes  FROM facility_assignment where   id_individual_assi='".$producto->id_individual."'");
$assi = $sentencia_assi->fetchAll(PDO::FETCH_OBJ);
?> 
<center><table id="example3" class="table table-bordered table-striped table-responsive">
  <thead> 
    <tr> 
      <th><center>Id Assignment</center></th> 
      <th><center>Date</center></th>
      <th><center>Facility Name</center></th> 
      <th><center>Notes</center></th>
    </tr> 
  </thead> 
  <tbody> 
   <?php foreach($assi as $individual_assi){ ?>
    <tr> 
      <td width="10%"><center><?php echo $individual_assi->id_assignment; ?></center></td> 
      <td width="10%"><center><?php echo $individual_assi->assignment_date; ?></center></td> 
      <td width="80%"><center>
        <?php $sentencia_fac = $base_de_datos->prepare("SELECT name_facility, type_facility, location, notes FROM facilities WHERE id_facility  = ?;");
          $sentencia_fac->execute([$individual_assi->id_facility_name]);
          $fac = $sentencia_fac->fetch(PDO::FETCH_OBJ); 
          echo $fac->name_facility.' - '.$fac->type_facility.' - '.$fac->location.'<br><strong>Notes:</strong> '.$fac->notes ;?> </center></td> 
      <td width="40%"><center><?php echo $individual_assi->notes; ?> </center></td> 
     
    </tr>
  <?php } ?>

</tbody> 

</table>
</center>

<br>

<hr>
<center><h4  align="center col-lg-12"><font color="black">Couple History</font></h4></center>
<hr>
<?php
$sentencia_cop = $base_de_datos->query("SELECT * FROM pairs where male_individual1='".$producto->id_individual."' or male_individual2='".$producto->id_individual."' or male_individual3='".$producto->id_individual."' or female_individual1='".$producto->id_individual."' or female_individual2='".$producto->id_individual."' or female_individual3='".$producto->id_individual."'");
$cop = $sentencia_cop->fetchAll(PDO::FETCH_OBJ);
?> 
<center><table id="example4" class="table table-bordered table-striped table-responsive">
  <thead> 
    <tr> 
      <th><center>Id Pair</center></th> 
      <th><center>Date</center></th>
      <th><center>Pair</center></th> 
      <th><center>Notes</center></th> 
      <th><center>Select</center></th>
    </tr> 
  </thead> 
  <tbody> 
   <?php foreach($cop as $individual_cop){ ?>
    <tr> 
      <td><center><?php echo $individual_cop->pair_id; ?></center></td>
      <td><center><?php echo $individual_cop->pairing_date; ?></center></td>
      <td width="50%"><?php

$male_individual1 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
$male_individual1->execute([$individual_cop->male_individual1]);
$male_1 = $male_individual1->fetch(PDO::FETCH_OBJ);

$male_individual2 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
$male_individual2->execute([$individual_cop->male_individual2]);
$male_2 = $male_individual2->fetch(PDO::FETCH_OBJ);

$male_individual3 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
$male_individual3->execute([$individual_cop->male_individual3]);
$male_3 = $male_individual3->fetch(PDO::FETCH_OBJ);

$female_individual1 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
$female_individual1->execute([$individual_cop->female_individual1]);
$fame_1 = $female_individual1->fetch(PDO::FETCH_OBJ);

$female_individual2 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
$female_individual2->execute([$individual_cop->female_individual2]);
$fame_2 = $female_individual2->fetch(PDO::FETCH_OBJ);

$female_individual3 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
$female_individual3->execute([$individual_cop->female_individual3]);
$fame_3 = $female_individual3->fetch(PDO::FETCH_OBJ);



if ($individual_cop->male_individual1 != 0){?>

 <div class="row"> 
  <div class="col-5" style="background-color:<?php echo $male_1->left_ring_color ?> ; border: 1px solid #000000">
    <center><font color="<?php echo $male_1->left_letter_color ?>"><?php echo $male_1->left_ring_numer ?></font></center>
  </div>
  <div class="col-2"></div>
  <div class="col-5" style="background-color:<?php echo $male_1->right_ring_color ?> ; border: 1px solid #000000">
    <center><font color="<?php echo $male_1->right_letter_color ?>"><?php echo $male_1->right_ring_numer ?></font></center>
  </div>
</div>
<div class="w-100"><br></div>

<?php }else{ ?>
  <div class="row"> 
    <div class="col-5"></div>
    <div class="col-2"></div>
    <div class="col-5"></div>
  </div>
  <div class="w-100"><br></div>

<?php } 



if ($individual_cop->male_individual2 != 0){?>

 <div class="row"> <div class="col-5" style="background-color:<?php echo $male_2->left_ring_color ?> ; border: 1px solid #000000">
  <center><font color="<?php echo $male_2->left_letter_color ?>"><?php echo $male_2->left_ring_numer ?></font></center></div>
  <div class="col-2"></div>
  <div class="col-5" style="background-color:<?php echo $male_2->right_ring_color ?> ; border: 1px solid #000000">
    <center><font color="<?php echo $male_2->right_letter_color ?>"><?php echo $male_2->right_ring_numer ?></font></center></div>
  </div>
  <div class="w-100"><br></div>

<?php }else{ ?>
  <div class="row"> 
    <div class="col-5"></div>
    <div class="col-2"></div>
    <div class="col-5"></div>
  </div>
  <div class="w-100"><br></div>

<?php }  

if ($individual_cop->male_individual3 != 0){?>

 <div class="row"> <div class="col-5" style="background-color:<?php echo $male_3->left_ring_color ?> ; border: 1px solid #000000">
  <center><font color="<?php echo $male_3->left_letter_color ?>"><?php echo $male_3->left_ring_numer ?></font></center></div>
  <div class="col-2"></div>
  <div class="col-5" style="background-color:<?php echo $male_3->right_ring_color ?> ; border: 1px solid #000000">
    <center><font color="<?php echo $male_3->right_letter_color ?>"><?php echo $male_3->right_ring_numer ?></font></center></div>
  </div>
  <div class="w-100"><br></div>

<?php }else{ ?>
  <div class="row"> 
    <div class="col-5"></div>
    <div class="col-2"></div>
    <div class="col-5" ></div>
  </div>
  <div class="w-100"><br></div>

<?php }  

if ($individual_cop->female_individual1 != 0){?>

 <div class="row"> <div class="col-5" style="background-color:<?php echo $fame_1->left_ring_color ?> ; border: 1px solid #000000">
  <center><font color="<?php echo $fame_1->left_letter_color ?>"><?php echo $fame_1->left_ring_numer ?></font></center></div>
  <div class="col-2"></div>
  <div class="col-5" style="background-color:<?php echo $fame_1->right_ring_color ?> ; border: 1px solid #000000">
    <center><font color="<?php echo $fame_1->right_letter_color ?>"><?php echo $fame_1->right_ring_numer ?></font></center></div>
  </div>
  <div class="w-100"><br></div>

<?php }else{ ?>
  <div class="row"> 
    <div class="col-5"></div>
    <div class="col-2"></div>
    <div class="col-5"></div>
  </div>
  <div class="w-100"><br></div>

<?php }
if ($individual_cop->female_individual2 != 0){?>

 <div class="row"> <div class="col-5" style="background-color:<?php echo $fame_2->left_ring_color ?> ; border: 1px solid #000000">
  <center><font color="<?php echo $fame_2->left_letter_color ?>"><?php echo $fame_2->left_ring_numer ?></font></center></div>
  <div class="col-2"></div>
  <div class="col-5" style="background-color:<?php echo $fame_2->right_ring_color ?> ; border: 1px solid #000000">
    <center><font color="<?php echo $fame_2->right_letter_color ?>"><?php echo $fame_2->right_ring_numer ?></font></center></div>
  </div>
  <div class="w-100"><br></div>

<?php }else{ ?>
  <div class="row"> 
    <div class="col-5"></div>
    <div class="col-2"></div>
    <div class="col-5"></div>
  </div>
  <div class="w-100"><br></div> 


<?php }  
if ($individual_cop->female_individual3 != 0){?>

 <div class="row"> <div class="col-5" style="background-color:<?php echo $fame_3->left_ring_color ?> ; border: 1px solid #000000">
  <center><font color="<?php echo $fame_3->left_letter_color ?>"><?php echo $fame_3->left_ring_numer ?></font></center></div>
  <div class="col-2"></div>
  <div class="col-5" style="background-color:<?php echo $fame_3->right_ring_color ?> ; border: 1px solid #000000">
    <center><font color="<?php echo $fame_3->right_letter_color ?>"><?php echo $fame_3->right_ring_numer ?></font></center></div>
  </div>
  <div class="w-100"><br></div>

<?php }else{ ?>
  <div class="row"> 
    <div class="col-5"></div>
    <div class="col-2"></div>
    <div class="col-5"></div>
  </div>
  <div class="w-100"><br></div> 
<?php } ?>     

</td>   
      
      <td width="50%"><center><?php echo $individual_cop->notes; ?> </center></td> 
      <td><center><a class="btn btn-warning btn-sm" href=""><span data-feather="edit"></span></a></center></td> 
    </tr>
  <?php } ?>

</tbody> 

</table>
</center>

</div>       
<hr> <center><h4><font color="black">Fotografias</font></h4></center><hr>
<div class="col-12">
  <div class="row">
    <div class="col-lg-6"> 
      <a class=" form-control btn btn-info" id="foto" target="_blank">Fotos de equipos </a> 
    </div>
    <div class="col-lg-6"> 
      <a class=" form-control btn btn-success" id="foto1" >Foto Documento</a> 
    </div>
  </div>
  



  <br><br><br><br>









  <div class="col-12">

    <a class=" form-control btn btn-info" href="imprimir.php?id=<?php echo $id ?>" target="_blank">Imprimir</a>
  </div>
</div>
<!-- Content Wrapper. Contains page content <div id="map"></div>-->

</center>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php  include_once "../paginas/pie_1.php"; ?>
<script>
    //Variable que almacena el método window.open()
  var miVentana;

    //La función window_open crea el pop-up o ventana emergente
  function window_open(){
    miVentana = window.open( "<?php echo "foto_3.php?id_contrato=".$id?>", "nombrePop-Up", "width=500,height=650, top=30,left=500");
  }
  function window_open1(){
    miVentana = window.open( "<?php echo "foto_2.php?id_contrato=".$id?>", "nombrePop-Up", "width=500,height=650, top=30,left=500");
  }



    // Llamo a la función window_open en el evento click del botón con id = "botonWindowOpen"
  document.getElementById("foto").onclick = function() {window_open()};
  document.getElementById("foto1").onclick = function() {window_open1()};


</script>



























<main role="main" class="content-wrapper"> 
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> 
    <h1 class="h2">Update Individual</h1>
    <ol class="breadcrumb float-sm-right"><h2>Individual N° 0000<?php echo $conteo ?></h2></ol>
  </div>

  <div class="content-header">
    <div class="container-fluid">
      <div class="col-12">
        <form method="post" action="new_individual.php" enctype="multipart/form-data" id="form_insert">
          <!-- ORIGIN TYPE -->
          <div class="card mb-4">
            <div class="card-header text-center">
              <h3><strong>Origin Type</strong></h3>
            </div>
            <div class="card-body text-center">
              <div class="d-flex justify-content-center">
                <div class="custom-control custom-radio mx-3">
                  <input type="hidden" value="<?php echo $conteo ?>"  name="id_individual" required>
                  <input class="custom-control-input" type="radio" value="1" id="mostrar_1" name="origin_type" required>
                  <label for="mostrar_1" class="custom-control-label">Born Center</label>
                </div>
                <div class="custom-control custom-radio mx-3">
                  <input class="custom-control-input" type="radio" value="0" id="ocultar_1" name="origin_type" required>
                  <label for="ocultar_1" class="custom-control-label">Capture</label>
                </div>
                <div class="custom-control custom-radio mx-3">
                  <input class="custom-control-input" type="radio" value="2" id="ocultar_2" name="origin_type" required>
                  <label for="ocultar_2" class="custom-control-label">Transfer</label>
                </div>
              </div>
              <div class="invalid-feedback">Select an option.</div>
            </div>
          </div>

          <!-- ORIGIN -->
          <div class="card mb-4">
            <div class="card-header text-center">
              <h3><strong>Origin</strong></h3>
            </div>
            <div class="card-body">

              <div class="row">
                <div class="form-group col-lg-4">
                  <label for="comauto"><strong>Autonomous Community:</strong></label>
                  <select name="comauto" id="comauto" class="form-control" required>
                    <?php 
                    $peticion = $base_de_datos->query("SELECT * FROM origin WHERE id_cod_locality = ");
                    $tipos = $peticion->fetchAll(PDO::FETCH_OBJ);
                    foreach($tipos as $tipo) { ?>
                      <option value="<?php echo $tipo->id_comauto ?>"><?php echo $tipo->nombre_comauto ?></option>
                    <?php } ?>
                    <option value=" ">Select Autonomous Community</option>
                    <?php 
                    $peticion = $base_de_datos->query("SELECT * FROM cod_comauto");
                    $tipos = $peticion->fetchAll(PDO::FETCH_OBJ);
                    foreach($tipos as $tipo) { ?>
                      <option value="<?php echo $tipo->id_comauto ?>"><?php echo $tipo->nombre_comauto ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-lg-4">
                  <label for="province"><strong>Province/Isle:</strong></label>
                  <select name="province" id="province" class="form-control" required>
                    <option value="">Select Province/Isle</option>
                  </select>
                </div>
                <div class="form-group col-lg-4">
                  <label for="locality"><strong>Locality:</strong></label>
                  <select name="locality" id="locality" class="form-control" required>
                    <option value="">Select Locality</option>
                  </select>

                  <script>
                          $(document).ready(function(e){
                            $("#comauto").change(function(){
                              var parametros= "id="+$("#comauto").val();
                              $.ajax({
                                data: parametros,
                                url: 'ajax_auto.php',
                                type: 'post',
                                beforeSend: function (){},
                                success: function(response){
                                  $("#province").html(response);

                                }
                              });

                            }) 

                            $("#province").change(function(){
                              var parametros= "id="+$("#province").val();
                              $.ajax({
                                data: parametros,
                                url: 'ajax_province.php',
                                type: 'post',
                                beforeSend: function (){},
                                success: function(response){
                                  $("#locality").html(response);

                                }
                              });

                            }) 
                          }) 

                        </script>

                </div>
                 <div class="form-group col-lg-4">
  <label for="born" id="msgid12"><strong>Born Center:</strong></label>
  <input class="form-control" name="born" type="text" placeholder="Insert Born Center" id="msgid13" value="">
  <div class="valid-feedback">Valid</div>
  <div class="invalid-feedback">Invalid</div>
</div>

<div class="form-group col-lg-4">
  <label for="zepa" id="msgid16"><strong>P.N/Zepa:</strong></label>
  <input class="form-control" name="zepa" type="text" placeholder="Insert P.N/zepa" id="msgid17" value="">
  <div class="valid-feedback">Valid</div>
  <div class="invalid-feedback">Invalid</div>
</div>

<div class="form-group col-lg-4">
  <label for="transfer" id="msgid14"><strong>Transfer Center:</strong></label>
  <input class="form-control" name="transfer" type="text" placeholder="Insert Transfer Center" id="msgid15" value="">
  <div class="valid-feedback">Valid</div>
  <div class="invalid-feedback">Invalid</div>
</div>



              </div>
            </div>
          </div>

          <!-- INDIVIDUAL DETAILS -->
          <div class="card mb-4">
            <div class="card-header text-center">
              <h3><strong>Individual Details</strong></h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="form-group col-lg-4">
                  <label for="species"><strong>Species:</strong></label>
                  <select name="species" class="form-control" required>
                    <option value=''>Select Bird Specie</option>
                    <?php 
                    $sentencia_species = $base_de_datos->query("SELECT * FROM species;");
                    $species = $sentencia_species->fetchAll(PDO::FETCH_OBJ);
                    foreach($species as $specie) { ?>
                      <option value='<?php echo $specie->scientific_name ?>'><?php echo $specie->scientific_name ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group col-lg-4">
                  <label for="nickname"><strong>Nickname:</strong></label>
                  <input class="form-control" name="nickname" pattern="^(?=.*[A-Za-z0-9ñÑ]).{3,}$" type="text" placeholder="Insert nickname">
                  <div class="valid-feedback">Valid</div>
                  <div class="invalid-feedback">Invalid</div>
                </div>

                <div class="form-group col-lg-4">
                  <label for="Genetic_code"><strong>Genetic Code:</strong></label>
                  <input class="form-control" name="Genetic_code" pattern="^(?=.*[A-Za-z0-9ñÑ]).{1,}$" type="text" placeholder="Insert Genetic Code">
                  <div class="valid-feedback">Valid</div>
                  <div class="invalid-feedback">Invalid</div>
                </div>

<div class="form-group col-lg-6">
  <label for="id_egg" id="msgid01"><strong>Id Egg:</strong></label>
  <input class="form-control" name="id_egg" type="text" placeholder="Insert Id Egg" id="msgid0" value="--">
  <div class="valid-feedback">Valid</div>
  <div class="invalid-feedback">Invalid</div>
</div>

<div class="form-group col-lg-6">
  <label for="id_pair" id="msgid11"><strong>Id Parents:</strong></label>
  <input class="form-control" name="id_pair" type="text" placeholder="Insert Id Parents" id="msgid1" value="--">
  <div class="valid-feedback">Valid</div>
  <div class="invalid-feedback">Invalid</div>
</div>


              </div>
            </div>
          </div>

          <!-- ADDITIONAL DETAILS -->
          <div class="card mb-4">
            <div class="card-header text-center">
              <h3><strong>Additional Details</strong></h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="form-group col-lg-3">
                  <label for="capture_date"><strong>Capture/Entry Date:</strong></label>
                  <input class="form-control" id="capture_date" name="capture_date" type="date" placeholder="YYYY-MM-DD" required>
                </div>
                <div class="form-group col-lg-3">
                  <label for="sex"><strong>Sex:</strong></label>
                  <select name="sex" id="sex" class="form-control" required>
                    <option value='0'>Indeterminate</option>
                    <option value='1'>Male</option>
                    <option value='2'>Female</option>
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label for="year"><strong>Year:</strong></label>
                  <input class="form-control" id="year" name="year" type="number" placeholder="YYYY" min="1900" max="2100" required>
                </div>
                <div class="form-group col-lg-3">
                  <label for="status"><strong>Status:</strong></label>
                  <select name="status" id="status" class="form-control" required>
                    <option value=''>Select status</option>
                    <option value='Breeder'>Breeder</option>
                    <option value='Juvenile'>Juvenile</option>
                    <option value='No_breeder'>No Breeder</option>
                     <option value='No_breeder'>Forest</option>
                    <option value='Genetically_excluded'>Genetically excluded</option>
                  </select>
                </div>
            
        
      </div>
    </div>
  </div>



  <!-- LEG RINGS -->
          <div class="card mb-4">
            <div class="card-header text-center">
              <h3><strong>Data Ring</strong></h3>
            </div>
            <div class="card-body">
            
<div class="row">
  <!-- Información de la pata izquierda -->
  <div class="col-lg-6 text-center">
    <h5><strong>Left Leg</strong></h5>
    <div class="form-group">
      <label for="left_ring"><strong>Does it have a ring?:</strong></label>
      <select name="left_ring" id="left_ring" class="form-control"  onchange="toggleLeftLegQuestions()">
        
        <option value="">No</option>
        <option value="Yes">Yes</option>
      </select>
    </div>

    <div id="left_leg_questions" style="display: none;">
      <label for="left_type"><strong>Type:</strong></label>
      <select name="left_type" id="left_type" class="form-control">
        <option value=''></option>
        <option value='Steel'>Steel</option>
        <option value='PVC'>PVC</option>
        <option value='Aluminium'>Aluminium</option>
      </select>

      <label for="left_color"><strong>Ring Color:</strong></label>
      <select name="left_color" id="left_color" class="form-control">
        <option value=''></option>
        <option value='Red'>Red</option>
        <option value='White'>White</option>
        <option value='Dark Green'>Dark Green</option>
        <option value='Pistachio Green'>Pistachio Green</option>
        <option value='Black'>Black</option>
        <option value='Metal'>Metal</option>
        <option value='Yellow'>Yellow</option>
        <option value='Light Blue'>Light Blue</option>
        <option value='Orange'>Orange</option>
        <option value='Pink'>Pink</option>
        <option value='Light Pink'>Light Pink</option>
        <option value='Blue'>Blue</option>
        <option value='Violet'>Violet</option>
        <option value='Gray'>Gray</option>
        <option value='Brown'>Brown</option>
        <option value='Other Color'>Other Color</option>
 </select>
      <label for="left_letter"><strong>Letter Color:</strong></label>
      <select name="left_letter" id="left_letter" class="form-control">
        <option value=''></option>
        <option value='black'>Black</option>
        <option value='white'>White</option>
      </select>

      <label for="left_number_code"><strong>Number Code:</strong></label>
      <input class="form-control" name="left_number_code" pattern="^(?=.*[A-Za-z0-9ñÑ]).{1,}$" type="text" id="left_number_code" placeholder="Insert Number Code">
      <div class="valid-feedback">True</div>
      <div class="invalid-feedback">False</div>
    </div>
  </div>

  <!-- Información de la pata derecha -->
  <div class="col-lg-6 text-center">
    <h5><strong>Right Leg</strong></h5>
    <div class="form-group">
      <label for="right_ring"><strong>Does it have a ring?:</strong></label>
      <select name="right_ring" id="right_ring" class="form-control"  onchange="toggleRightLegQuestions()">
       
        <option value="">No</option>
        <option value="Yes">Yes</option>
      </select>
    </div>

    <div id="right_leg_questions" style="display: none;">
      <label for="right_type"><strong>Type:</strong></label>
      <select name="right_type" id="right_type" class="form-control">
        <option value=''></option>
        <option value='Steel'>Steel</option>
        <option value='PVC'>PVC</option>
        <option value='Aluminium'>Aluminium</option>
      </select>

      <label for="right_color"><strong>Ring Color:</strong></label>
      <select name="right_color" id="right_color" class="form-control">
        <option value=''></option>
        <option value='Red'>Red</option>
        <option value='White'>White</option>
        <option value='Dark Green'>Dark Green</option>
        <option value='Pistachio Green'>Pistachio Green</option>
        <option value='Black'>Black</option>
        <option value='Metal'>Metal</option>
        <option value='Yellow'>Yellow</option>
        <option value='Light Blue'>Light Blue</option>
        <option value='Orange'>Orange</option>
        <option value='Pink'>Pink</option>
        <option value='Light Pink'>Light Pink</option>
        <option value='Blue'>Blue</option>
        <option value='Violet'>Violet</option>
        <option value='Gray'>Gray</option>
        <option value='Brown'>Brown</option>
        <option value='Other Color'>Other Color</option>
      </select>

      <label for="right_letter"><strong>Letter Color:</strong></label>
      <select name="right_letter" id="right_letter" class="form-control">
        <option value=''></option>
        <option value='black'>Black</option>
        <option value='white'>White</option>
      </select>

      <label for="right_number_code"><strong>Number Code:</strong></label>
      <input class="form-control" name="right_number_code" pattern="^(?=.*[A-Za-z0-9ñÑ]).{1,}$" type="text" id="right_number_code" placeholder="Insert Number Code">
      <div class="valid-feedback">True</div>
      <div class="invalid-feedback">False</div>
    </div>
  </div>
</div>

<script>
  function toggleLeftLegQuestions() {
    const hasRing = document.getElementById("left_ring").value === "Yes";
    document.getElementById("left_leg_questions").style.display = hasRing ? "block" : "none";
  }

  function toggleRightLegQuestions() {
    const hasRing = document.getElementById("right_ring").value === "Yes";
    document.getElementById("right_leg_questions").style.display = hasRing ? "block" : "none";
  }
</script>
 </div>
</div>
<!-- NOTES SECTION -->
          <div class="card mb-4">
            <div class="card-header text-center">
    <h3><strong>Notes</strong></h3>
  </div>
  <div class="card-body">
    <div class="form-group">
      <label for="notes"><strong>Comments or Observations:</strong></label>
      <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Add any additional information or observations"></textarea>
    </div>
  </div>
</div>

<!-- ATTACHMENTS SECTION -->
 <div class="card mb-4">
  <div class="card-header text-center">
    <h3><strong>Attachments</strong></h3>
  </div>
  <div class="card-body">
    <div class="row">
      <!-- Campo para subir documentos -->
<div class="form-group col-lg-6 col-12">
  <label for="documents"><strong>Upload Documents</strong></label>
  <input type="file" class="form-control-file" id="documents" name="documents[]" accept=".pdf,.doc,.docx,.xls,.xlsx,.mdb,.accdb" multiple onchange="validateFiles(this, 'document')">
  <small class="form-text text-muted">You can upload multiple files. Accepted formats: PDF, DOC, DOCX, XLS, XLSX, MDB, ACCDB.</small>
</div>

<div class="form-group col-lg-6 col-12">
  <label for="photos"><strong>Upload Photos</strong></label>
  <input type="file" class="form-control-file" id="photos" name="photos[]" accept=".jpg,.jpeg,.png" multiple onchange="validateFiles(this, 'image')">
  <small class="form-text text-muted">You can upload multiple files. Accepted formats: JPG, JPEG, PNG.</small>
</div>

<script>
  function validateFiles(input, type) {
    const allowedExtensions = {
      document: ['.pdf', '.doc', '.docx', '.xls', '.xlsx', '.mdb', '.accdb'],
      image: ['.jpg', '.jpeg', '.png']
    };

    const files = input.files;
    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      const fileExtension = file.name.substring(file.name.lastIndexOf('.')).toLowerCase();
      if (!allowedExtensions[type].includes(fileExtension)) {
        alert(`The file "${file.name}" is not a valid ${type === 'document' ? 'document' : 'image'}. Please select files with the following extensions: ${allowedExtensions[type].join(', ')}`);
        input.value = ''; // Clear the input field
        return;
      }
    }
  }
</script>

    </div>
  </div>
</div>



</div>
</div>

              
          <div class="row">
          <div class="form-group col-lg-6">
          <input class="btn btn-info col-lg-12" type="submit" value="Save" onclick="return confirm('Do you confirm saving the entered record?')">
          </div>
          <div class="form-group col-lg-6">
          <a class="btn btn-warning col-lg-12" href="admin.php" >Cancel</a>
          </div>
        </div>
          <br>
 <main/>     
          
        </div>

        </form>
      </div>
    </div>


  <script>
$(document).ready(function () {
    // Ajustar visibilidad y validación al cargar la página
    const selectedValue = $("input[name='origin_type']:checked").val();
    toggleFields(selectedValue);

    // Cambiar visibilidad y validación al cambiar la opción seleccionada
    $("input[name='origin_type']").on("change", function () {
        const selectedValue = $(this).val();
        toggleFields(selectedValue);
    });

    function toggleFields(selectedValue) {
        // Lista de campos a controlar
        const fields = {
            born: "#msgid13", // Born Center
            zepa: "#msgid17", // P.N/Zepa
            transfer: "#msgid15", // Transfer Center
            id_egg: "#msgid0", // ID Egg
            id_parents: "#msgid1" // ID Parents
        };

        // Ocultar y desactivar todos los campos
        Object.values(fields).forEach(function (field) {
            $(field).parent().hide(); // Ocultar el contenedor
            $(field).val("").prop("required", false); // Valor predeterminado y sin validación
        });

        // Mostrar y activar campos según la opción seleccionada
        if (selectedValue == "1") {
            // Born Center: Mostrar y activar id_egg, id_parents, y born
            $(fields.born).parent().show().find("input").val("").prop("required", false);
            $(fields.id_egg).parent().show().find("input").val("").prop("required", false);
            $(fields.id_parents).parent().show().find("input").val("").prop("required", false);
        } else if (selectedValue == "0") {
            // Capture: Mostrar y activar zepa
            $(fields.zepa).parent().show().find("input").val("").prop("required", false);
        } else if (selectedValue == "2") {
            // Transfer: Mostrar y activar transfer
            $(fields.transfer).parent().show().find("input").val("").prop("required", false);
        }
    }
});



</script>

  
<script type="text/javascript">
  $(document).ready(function() {
    'use strict';
    window.addEventListener('load', function() {
    // fetch all the forms we want to apply custom style
    var inputs = document.getElementsByClassName('form-control')

    // loop over each input and watch blur event
    var validation = Array.prototype.filter.call(inputs, function(input) {

      input.addEventListener('blur', function(event) {
        // reset
        input.classList.remove('is-invalid')
        input.classList.remove('is-valid')

        if (input.checkValidity() === false) {
          input.classList.add('is-invalid')
        }
        else {
          input.classList.add('is-valid')
        }
    }, false);
    });
}, false);
  })()
</script>



<script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>

<script src="../dist/dashboard.js"></script>

<?php  include_once BASE_URL . "/paginas/pie_2.php";   ?>