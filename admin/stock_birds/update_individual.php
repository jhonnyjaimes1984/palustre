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
      <h3><STRONG>DATABASE PALUSTRE</STRONG></h3>

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
           <td><strong>Measurement Date:</strong><input class="form-control" name="Measurement" type="text" id="Measurement" placeholder="Insert Measurement Date" value="<?php echo !empty($data_biometry->measurement_date) ? $data_biometry->measurement_date : ''; ?>"> </td>
         </tr>
         <tr>
           <td><strong>Staff:</strong>
             <?php if (!empty($data_biometry->staff)){
              $staff = $base_de_datos->prepare("SELECT * FROM staff where id_staff= ?");
              $staff->execute([$data_biometry->staff]);
              $staff_1 = $staff->fetch(PDO::FETCH_OBJ); 
            }else{} ?>

                  <select name="staff" id="staff" class="form-control" required>
                    <option value="<?php echo !empty($staff_1->id_staff ) ? $staff_1->id_staff  : ''; ?>"><?php echo !empty($staff_1->first_name) ? $staff_1->first_name.' '.$staff_1->last_name  : 'Select Staff'; ?></option>
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
           <td><strong>Wing Lenght:</strong><input class="form-control" name="wing_lenght" type="text" id="wing_lenght" placeholder="Insert Wing Lenght" value="<?php echo !empty($data_biometry->wing_lenght) ? $data_biometry->wing_lenght : ''; ?>"></td>
         </tr>
         <tr>
           <td><strong>F8:</strong><input class="form-control" name="f8" type="text" id="f8" placeholder="Insert F8" value="<?php echo !empty($data_biometry->F8) ? $data_biometry->F8 : ''; ?>"></td>
         </tr>
         <tr>
           <td><strong>Tail:</strong><input class="form-control" name="tail" type="text" id="tail" placeholder="Insert Tail" value="<?php echo !empty($data_biometry->tail) ? $data_biometry->tail : ''; ?>"></td>
         </tr>
         <tr>
           <td><strong>Tarsus:</strong><input class="form-control" name="tarsus" type="text" id="tarsus" placeholder="Insert Tarsus" value="<?php echo !empty($data_biometry->tarsus) ? $data_biometry->tarsus : ''; ?>"></td>
         </tr>
       </tbody>
     </table>
          </div>

   <div class="col-12 col-lg-6"> 
    <table >
     <tbody>


         <tr>
           <td><strong>Beak Length:</strong><input class="form-control" name="beak_length" type="text" id="beak_length" placeholder="Insert Beak Lenght" value="<?php echo !empty($data_biometry->beak_length) ? $data_biometry->beak_length : ''; ?>"></td>
         </tr>
         <tr>
           <td><strong>Beak Head:</strong><input class="form-control" name="beak_head" type="text" id="beak_head" placeholder="Insert Beak Head" value="<?php echo !empty( $data_biometry->beak_head) ?  $data_biometry->beak_head : ''; ?>"></td>
         </tr>
         <tr>
           <td><strong>Beak Height:</strong><input class="form-control" name="beak_height" type="text" id="beak_height" placeholder="Insert Beak Height" value="<?php echo !empty($data_biometry->beak_height) ? $data_biometry->beak_height : ''; ?>"></td>
         </tr>
         <tr>
           <td><strong>Beak Width:</strong><input class="form-control" name="beak_width" type="text" id="beak_width" placeholder="Insert Beak Width" value="<?php echo !empty($data_biometry->beak_width) ? $data_biometry->beak_width : ''; ?>"></td>
         </tr>
         <tr>
           <td><strong>Grease:</strong><input class="form-control" name="grease" type="text" id="grease" placeholder="Insert Grease" value="<?php echo !empty( $data_biometry->grease) ?  $data_biometry->grease : ''; ?>"> </td>
         </tr>
         <tr>
           <td><strong>Muscle:</strong><input class="form-control" name="muscle" type="text" id="muscle" placeholder="Insert Muscle" value="<?php echo !empty($data_biometry->muscle) ? $data_biometry->muscle : ''; ?>"> </td>
         </tr>
         <tr>
           <td><strong>Weight:</strong><input class="form-control" name="weight" type="text" id="weight" placeholder="Insert Weight" value="<?php echo !empty($data_biometry->weight ) ? $data_biometry->weight  : ''; ?>"></td>
         </tr>
       </tbody>
     </table>
     </div>
     <!-- aqui es el detalle -->

    <!-- aqui es el detalle -->
    <!-- aqui es el detalle -->
    <!-- aqui es el detalle -->
    <!-- aqui es el detalle -->
    <!-- aqui es el detalle -->
    <!-- aqui es el detalle -->
    <!-- aqui es el detalle -->
    <!-- aqui es el detalle -->

    <!-- aqui es el detalle -->
    <!-- aqui es el detalle -->
    <!-- aqui es el detalle -->
    <!-- aqui es el detalle -->
    <!-- aqui es el detalle -->
    <!-- aqui es el detalle -->
    <!-- aqui es el detalle -->
    <!-- aqui es el detalle -->

     <label for="notes_bio"><strong>Notes Biometry:</strong></label>
    <textarea id="notes_bio" name="notes_bio"  rows="3" class="form-control"><?php echo !empty($data_biometry->notes_bio) ? $data_biometry->notes_bio : ''; ?></textarea>
  
   
   
</div>
<br>

<center><h4><font color="black">HISTORIC</font></h4></center><hr>
<div class="row">
  <label for="notes_histo"><strong>Notes Historic:</strong></label>
  <textarea id="notes_histo" name="notes_histo" rows="3" class="form-control"><?php echo !empty($producto->notes) ? $producto->notes : ''; ?></textarea>

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
$sentencia_assi = $base_de_datos->query("SELECT id_assignment, assignment_date, id_facility_name, notes_assig  FROM facility_assignment where   id_individual_assi='".$producto->id_individual."'");
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
      <td width="40%"><center><?php echo $individual_assi->notes_assig; ?> </center></td> 
     
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

       
<hr> <center><h4><font color="black">Fotografias</font></h4></center><hr>


<div class="container">
    <div class="d-flex flex-wrap justify-content-start" style="gap: 20px;">
        <?php 
        $consulta_photos = $base_de_datos->query("SELECT * FROM individuals_photos WHERE id_individual='".$id."' ");
        $respuesta_photo = $consulta_photos->fetchAll(PDO::FETCH_OBJ);

        foreach ($respuesta_photo as $res_photo) { 
            // Obtener información del staff
            $id_staff_photo = $base_de_datos->prepare("SELECT first_name, last_name FROM staff WHERE id_staff = ?;");
            $id_staff_photo->execute([$res_photo->id_staff]);
            $res_id_staff = $id_staff_photo->fetch(PDO::FETCH_OBJ);
        ?>
        <div class="card shadow-sm p-3 mb-4" 
             style="flex: 1 1 calc(32% - 20px); max-width: calc(32% - 20px); 
                    border-radius: 10px; margin-right: 10px; background-color: #fff; border: 1px solid #ddd;">
            <img src="../../img_individuals/<?php echo htmlspecialchars($res_photo->name_photo_ind); ?>" 
                 class="card-img-top img-fluid" 
                 style="max-width: 100%; height: 200px; object-fit: cover; border-radius: 8px; padding: 5px;" 
                 alt="Photo of <?php echo htmlspecialchars($res_id_staff->first_name . ' ' . $res_id_staff->last_name); ?>">

            <div class="card-body">
                <p class="card-text">
                    <strong>Name Staff:</strong> 
                    <?php echo htmlspecialchars($res_id_staff->first_name . " " . $res_id_staff->last_name); ?>
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <!-- BOTÓN VIEW (ABRE EL MODAL) -->
                        <button type="button" class="btn btn-sm btn-outline-secondary" 
                                data-bs-toggle="modal" data-bs-target="#modal_<?php echo $res_photo->id_photos_ind; ?>">
                            View
                        </button>

                        <!-- BOTÓN DELETE (CONFIRMA BORRADO) -->
                        <?php if($_SESSION['privilegio']==="Administrator"){ ?>
                          <button type="button" class="btn btn-sm btn-outline-danger" 
                                onclick="confirmDelete(<?php echo $res_photo->id_photos_ind; ?>, <?php echo $id; ?>, '<?php echo $_SESSION['privilegio']; ?>')">
                            Delete Photo
                        </button>

                        <?php } ?>

                        
                    </div>
                    <small class="text-body-secondary"><?php echo htmlspecialchars($res_photo->date_photo_ind); ?></small>
                </div>
            </div>
        </div>

        <!-- MODAL PARA AMPLIAR IMAGEN -->
        <div class="modal fade" id="modal_<?php echo $res_photo->id_photos_ind; ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">View Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="../../img_individuals/<?php echo htmlspecialchars($res_photo->name_photo_ind); ?>" 
                             class="img-fluid" style="max-width: 100%; height: auto; border-radius: 10px;">
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>
    </div>
</div>

<!-- SCRIPT PARA CONFIRMAR ELIMINACIÓN -->
<script>
    function confirmDelete(photoId, id_individuals, privilegioStaff) {
        if (confirm("¿Estás seguro de que quieres eliminar esta foto? Esta acción no se puede deshacer.")) {
            window.location.href = "delete_photo.php?id_photo=" + photoId + "&id_individuals=" + id_individuals + "&privilegioStaff=" + encodeURIComponent(privilegioStaff);
        }
    }
</script>



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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php  include_once BASE_URL . "/paginas/pie_2.php";   ?>
