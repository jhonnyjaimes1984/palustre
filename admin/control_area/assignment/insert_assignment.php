<?php 
include_once "../../../conf/Config.php"; 

require_once BASE_URL . "/paginas/cabecera_tercer_nivel.php"; 

$sentencia_insert = $db->query("SELECT COUNT(*) as total FROM facility_assignment");
$row_insert = $sentencia_insert->fetch_assoc(); 
$itemData_insert = array('id_assignment' => $row_insert['total']);
$conteo = $itemData_insert['id_assignment'] + 1;


?>
<main role="main" class="content-wrapper">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <ol class="breadcrumb float-sm-right text-center">
            <h2>Id Assignment N° 0000<?php echo $conteo ?></h2>
        </ol>
        <ol class="breadcrumb float-sm-right text-center">
            <h5>Time <?php echo date('h:i:s a'); ?></h5>
        </ol>
    </div>
    <div class="col-12">
        <?php
$sentencia = $base_de_datos->query("SELECT * FROM individuals, species  where species.id_species = individuals.specie");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);
?> 
 <form method="post" action="new_monitoring.php" enctype="multipart/form-data" id="form_insert">
    <input type="hidden" value="<?php echo $_SESSION['id_staff']; ?>" name="id_staff">
      <div class="card-body">
        <center>
          <table id="example1" class="table table-bordered table-striped table-responsive">
            <thead>
              <tr>
                
                <th><center>ID</center></th>
                <th><center>Nickname</center></th>
                <th><center>Specie</center></th>
                <th><center>Assignment</center></th>
                <th><center>Sex</center></th>
                <th><center>Year</center></th>
                <th><center>Status</center></th>
                <th><center>Left Leg</center></th>
                <th><center>Right Leg</center></th>
                
              </tr>
            </thead>
            <tbody>
              <?php foreach($usuario as $individuals) { ?>
                <tr>
                  
                  <td><center><?php echo $individuals->id_individual ?></center></td>
                  <td><center><?php echo $individuals->nickname ?></center></td>
                  <td width="20%"><center><?php echo $individuals->scientific_name ?></center></td>

                  <?php
                  $sentencia_assi = $base_de_datos->prepare("SELECT id_assignment, assignment_date, id_facility_name, notes  FROM facility_assignment where id_individual_assi = ? AND assignment_date!='' AND finish_date is null");
                  $sentencia_assi->execute([$individuals->id_individual]);
                  $assi = $sentencia_assi->fetch(PDO::FETCH_OBJ);
                  ?>
                  
                  <td width="50%"><center>
                    <select name="id_facility" id="id_facility">
                    <?php if(empty($assi->id_facility_name)){ ?>
                     <option value=""><?php echo "Not have assignment"; ?></option>
                    <?php } else {
                      $sentencia_fac = $base_de_datos->prepare("SELECT name_facility, type_facility, location, notes FROM facilities WHERE id_facility  = ?;");
                      $sentencia_fac->execute([$assi->id_facility_name]);
                      $fac = $sentencia_fac->fetch(PDO::FETCH_OBJ);?>
                    <option value="<?php $assi->id_facility_name ?>"><?php echo $fac->name_facility.' - '.$fac->type_facility.' - '.$fac->location;?></option>
                    <?php } 

                     $consulta_facilites_2 = $base_de_datos->query("SELECT id_facility, name_facility, type_facility, location, notes FROM facilities WHERE 1");
                     $resultado_consulta_2 = $consulta_facilites_2->fetchAll(PDO::FETCH_OBJ); 

                    foreach($resultado_consulta_2 as $resultado_consulta_3) { ?>
                    
                        <option value="<?php echo $resultado_consulta_3->id_facility ?>"><?php echo $resultado_consulta_3->name_facility. ' - ' .$resultado_consulta_3->type_facility ?> </option>

                    <?php  } ?>
                    </select>
                  </center></td>

                  <td><center><?php 
                    switch ($individuals->sex) {
                      case '0': echo "Indeterminate"; break;
                      case '1': echo "Male"; break;
                      case '2': echo "Female"; break;
                    }
                  ?></center></td>
                  <td><center><?php echo $individuals->year ?></center></td>
                  <td><center><?php echo $individuals->status ?></center></td>

                  <td>
                    <div class="col-12" style="background-color:<?php echo $individuals->left_ring_color ?> ; border: 1px solid #000000">
                      <center><font color="<?php echo $individuals->left_letter_color ?>"><?php echo $individuals->left_ring_numer ?></font></center>
                    </div>
                  </td>

                  <td>
                    <div class="col-12" style="background-color:<?php echo $individuals->right_ring_color ?> ; border: 1px solid #000000">
                      <center><font color="<?php echo $individuals->right_letter_color ?>"><?php echo $individuals->right_ring_numer ?></font></center>
                    </div>
                  </td>
              </tr>
              <?php } ?>
            </tbody> 
          </table>
        </center>
    </div>
               
                   

               

<div class="card mb-12">
    <div class="card-header text-center">
        <h3><strong>OBSERVATIONS</strong></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="conclusions_text_2">Notes</label>
            <textarea class="form-control" id="conclusions_text_2" name="conclusions_text_2" rows="3"></textarea>
        </div>
    </div>
</div>
    <div class="row">
    <div class="form-group col-lg-6">
        <button type="submit" class="btn btn-primary col-lg-12" >Save Data</button>
    </div>
    <div class="form-group col-lg-6"> 
        <button type="button" class="btn btn-secondary col-lg-12" onclick="printReport()">Print Report</button>
    </div>
</div>
</form>

</main>


<script src="insert_monitoring.js"></script>


<?php include_once BASE_URL . "/paginas/pie_3.php"; ?>