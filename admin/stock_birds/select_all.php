<?php include_once "../../conf/Config.php"; 

include_once BASE_URL . "/paginas/cabecera_segundo_nivel.php"; 

if(!isset($_GET["id"])) exit();
$id = $_GET["id"];

$sentencia = $base_de_datos->prepare("SELECT * FROM individuals, species WHERE id_individual = ? and species.id_species = individuals.specie;");
$sentencia->execute([$id]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
if($producto === FALSE){
  echo "¡No existe algún producto con ese ID!";
  exit();} ?>

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
    $pairs_1 = $base_de_datos->prepare("SELECT max(pair_id) as new_id FROM pairs 
      where finish_pairing_date is null AND male_individual1= ? or male_individual2= ? or male_individual3= ? or female_individual1= ? or female_individual2= ? or female_individual3= ?");
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
<div class="row">


  <div class="col-12 col-lg-6"> 
    <table>
     <tbody>
       <tr>
         <td><strong>Specie:</strong> <?php echo $producto->scientific_name;  ?></td>
       </tr>
       <tr>
         <td><strong>Nickname:</strong> <?php echo $producto->nickname  ?></td>
       </tr>
       <tr>
         <td><strong>Genetic Code:</strong> <?php echo $producto->genetic_code ?></td>
       </tr>
       <tr>
         <td><strong>Origin:</strong> <a href="<?php echo "../select_origin.php?id=" . $producto->origin."&id_individual=".$id; ?>"><?php
         $sentencia_origin = $base_de_datos->query("SELECT * FROM cod_locality WHERE id_locality = '".$producto->origin."'");
         $origin_4 = $sentencia_origin->fetch(PDO::FETCH_OBJ);
         echo $origin_4->name?></a> </td>
       </tr>
       <tr>
         <td><strong>Sex:</strong> <?php switch ($producto->sex) {
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
         }   ?></td>
       </tr>
       <tr>
         <td><strong>Entry Date:</strong> <?php echo $producto->entry_date ?></td>
       </tr>
       <tr>
         <td><strong>Year:</strong> <?php echo $producto->year ?></td>
       </tr>
       <tr>
         <td><strong>Status:</strong> <?php echo $producto->status ?></td>
       </tr>
     </tbody>
   </table>
 </div>

 <div class="col-12 col-lg-6"> 
  <table >
   <tbody>
     <tr>
       <td><strong>Left leg:</strong> <?php if($producto->left_leg > 0){ echo "Ring"; }else{ echo "Don't Ring"; };  ?></td>
       <td width="5%"></td>
       <td><strong>Right leg:</strong> <?php if($producto->right_leg > 0){ echo "Ring"; }else{ echo "Don't Ring"; };  ?></td>

     </tr>
     <tr>
       <td><strong>Left Ring Type:</strong> <?php echo $producto->left_ring_type  ?></td>
       <td width="5%"></td>
       <td><strong>Right Ring Type:</strong> <?php echo $producto->right_ring_type  ?></td>

     </tr>
     <tr>
       <td><strong>Left Ring Color:</strong> <?php echo $producto->left_ring_color?></td>
       <td width="5%"></td>
       <td><strong>Right Ring Color:</strong> <?php echo $producto->right_ring_color?></td>

     </tr>
     <tr>
       <td><strong>Left Letter Color:</strong> <?php echo $producto->left_letter_color?></td>
       <td width="5%"></td>
       <td><strong>Right Letter Color:</strong> <?php echo $producto->right_letter_color?></td>

     </tr>
     <tr>
       <td><strong>Left Ring Numer:</strong> <?php echo $producto->left_ring_numer ?></td>
       <td width="5%"></td>
       <td><strong>Right Ring Numer:</strong> <?php echo $producto->right_ring_numer ?></td>

     </tr>

   </tbody>
 </table>
</div>
</div>





<hr>
<h4  align="center"><font color="black"> Individual Biometry </font></h4><hr>

<?php 
$biometry = $base_de_datos->prepare("SELECT * FROM biometry WHERE id_individual = ?;");
$biometry->execute([$id]);
$data_biometry = $biometry->fetch(PDO::FETCH_OBJ);?>
<div class="row">


  <div class="col-12 col-lg-6"> 
    <table>
     <tbody>
       <tr>
         <td><strong>Measurement Date:</strong> <?php echo $data_biometry->measurement_date;  ?></td>
       </tr>
       <tr>
         <td><strong>Staff:</strong> <?php echo $data_biometry->staff  ?></td>
       </tr>
       <tr>
         <td><strong>Wing Lenght:</strong> <?php echo $data_biometry->wing_lenght ?> mm</td>
       </tr>
       <tr>
         <td><strong>F8:</strong> <?php echo $data_biometry->F8 ?> mm</td>
       </tr>
       <tr>
         <td><strong>Tail:</strong> <?php echo $data_biometry->tail ?> mm</td>
       </tr>
       <tr>
         <td><strong>Tarsus:</strong> <?php echo $data_biometry->tarsus ?> mm</td>
       </tr>
     </tbody>
   </table>
 </div>

 <div class="col-12 col-lg-6"> 
  <table >
   <tbody>


     <tr>
       <td><strong>Beak Length:</strong> <?php echo $data_biometry->beak_length ?> mm</td>
     </tr>
     <tr>
       <td><strong>Beak Head:</strong> <?php echo $data_biometry->beak_head ?> mm</td>
     </tr>
     <tr>
       <td><strong>Beak Height:</strong> <?php echo $data_biometry->beak_height ?> mm</td>
     </tr>
     <tr>
       <td><strong>Beak Width:</strong> <?php echo $data_biometry->beak_width ?> mm</td>
     </tr>
     <tr>
       <td><strong>Grease:</strong> <?php echo $data_biometry->grease ?> </td>
     </tr>
     <tr>
       <td><strong>Muscle:</strong> <?php echo $data_biometry->muscle ?> </td>
     </tr>
     <tr>
       <td><strong>Weight:</strong> <?php echo $data_biometry->weight ?> gr</td>
     </tr>
   </tbody>
 </table>
</div>
<label for="obser"><strong>Notes:</strong></label>
<textarea id="obser" name="obser"  rows="3" class="form-control" disabled=""> <?php echo $data_biometry->notes_bio ?></textarea>

<div class="col-12 col-lg-6"> 

</div>
</div>





<hr><center><h4  align="col-lg-12"><font color="black">HISTORIC</font></h4></center>
<div class="form-group col-12">
  <label for="obser"><strong>Notes:</strong></label>
  <textarea id="obser" name="obser" rows="3" class="form-control" disabled=""> <?php echo $producto->notes?></textarea>



</div>


<hr>
<center><h4  align="col-lg-12"><font color="black">Monitoring</font></h4></center><hr>

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
$sentencia_vet = $base_de_datos->query("SELECT id_veterinary, consultation_date, vet_control_alive.diagnosis as diagnosis, notes FROM veterinary, vet_control_alive where veterinary.id_individual_vet='".$producto->id_individual."' AND vet_control_alive.id_vet_alive = veterinary.id_vet_control_alive");
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
      <th><center>Inicial date / Finish date</center></th>
      <th><center>Pair</center></th>
      <th><center>Facility</center></th> 
      <th><center>Notes</center></th> 
      <th><center>Select</center></th>
    </tr> 
  </thead> 
  <tbody>
    <?php foreach($cop as $individual_cop){ ?>
      <tr> 
        <td><center><?php echo $individual_cop->pair_id; ?></center></td>
        <td width="10%"><center><?php echo $individual_cop->pairing_date.' - '.$individual_cop->finish_pairing_date; ?></center></td>
        <td width="30%"><?php

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
              <center>
                <font color="<?php echo $male_1->left_letter_color ?>"><?php echo $male_1->left_ring_numer ?></font>
              </center>
            </div>
            <div class="col-2"><center><?php echo $male_1->id_individual ?></center></div>
            <div class="col-5" style="background-color:<?php echo $male_1->right_ring_color ?> ; border: 1px solid #000000">
              <center>
                <font color="<?php echo $male_1->right_letter_color ?>"><?php echo $male_1->right_ring_numer ?></font>
              </center>
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
          <div class="row"> 
            <div class="col-5" style="background-color:<?php echo $male_2->left_ring_color ?> ; border: 1px solid #000000">
              <center>
                <font color="<?php echo $male_2->left_letter_color ?>"><?php echo $male_2->left_ring_numer ?></font>
              </center>
            </div>
            <div class="col-2"><center><?php echo $male_2->id_individual ?></center></div>
            <div class="col-5" style="background-color:<?php echo $male_2->right_ring_color ?> ; border: 1px solid #000000">
              <center>
                <font color="<?php echo $male_2->right_letter_color ?>"><?php echo $male_2->right_ring_numer ?></font>
              </center>
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
        if ($individual_cop->male_individual3 != 0){?>
          <div class="row"> 
            <div class="col-5" style="background-color:<?php echo $male_3->left_ring_color ?> ; border: 1px solid #000000">
              <center>
                <font color="<?php echo $male_3->left_letter_color ?>"><?php echo $male_3->left_ring_numer ?></font>
              </center>
            </div>
            <div class="col-2"><center><?php echo $male_3->id_individual ?></center></div>
            <div class="col-5" style="background-color:<?php echo $male_3->right_ring_color ?> ; border: 1px solid #000000">
              <center>
                <font color="<?php echo $male_3->right_letter_color ?>"><?php echo $male_3->right_ring_numer ?></font>
              </center>
            </div>
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
          <div class="row"> 
            <div class="col-5" style="background-color:<?php echo $fame_1->left_ring_color ?> ; border: 1px solid #000000">
              <center>
                <font color="<?php echo $fame_1->left_letter_color ?>"><?php echo $fame_1->left_ring_numer ?></font>
              </center>
            </div>
            <div class="col-2"><center><?php echo $fame_1->id_individual ?></center></div>
            <div class="col-5" style="background-color:<?php echo $fame_1->right_ring_color ?> ; border: 1px solid #000000">
              <center>
                <font color="<?php echo $fame_1->right_letter_color ?>"><?php echo $fame_1->right_ring_numer ?></font>
              </center>
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
        if ($individual_cop->female_individual2 != 0){?>
          <div class="row">
            <div class="col-5" style="background-color:<?php echo $fame_2->left_ring_color ?> ; border: 1px solid #000000">
              <center>
                <font color="<?php echo $fame_2->left_letter_color ?>"><?php echo $fame_2->left_ring_numer ?></font>
              </center>
            </div>
            <div class="col-2"><center><?php echo $fame_2->id_individual ?></center></div>
            <div class="col-5" style="background-color:<?php echo $fame_2->right_ring_color ?> ; border: 1px solid #000000">
              <center>
                <font color="<?php echo $fame_2->right_letter_color ?>"><?php echo $fame_2->right_ring_numer ?></font>
              </center>
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
        if ($individual_cop->female_individual3 != 0){?>
          <div class="row"> 
            <div class="col-5" style="background-color:<?php echo $fame_3->left_ring_color ?> ; border: 1px solid #000000">
              <center>
                <font color="<?php echo $fame_3->left_letter_color ?>"><?php echo $fame_3->left_ring_numer ?></font>
              </center>
            </div>
            <div class="col-2"><center><?php echo $fame_3->id_individual ?></center></div>
            <div class="col-5" style="background-color:<?php echo $fame_3->right_ring_color ?> ; border: 1px solid #000000">
              <center
              ><font color="<?php echo $fame_3->right_letter_color ?>"><?php echo $fame_3->right_ring_numer ?></font>
            </center>
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
      <?php } ?>
    </td>
    <td width="20%"><center>
      <?php 
      $sentencia_fac = $base_de_datos->prepare("SELECT * FROM facilities WHERE id_facility  = ?;");
      $sentencia_fac->execute([$individual_cop->id_facility_assignment]);
      $fac = $sentencia_fac->fetch(PDO::FETCH_OBJ); 
      echo $fac->name_facility.' - '.$fac->type_facility.' - '.$fac->location.'<br><strong>Notes:</strong> '.$fac->notes ;?> 
    </center></td>
    <td width="30%"><center><?php echo $individual_cop->notes; ?> </center></td> 
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

<?php  include_once BASE_URL . "/paginas/pie_2.php";   ?>
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





