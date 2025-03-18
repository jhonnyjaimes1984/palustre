<?php 
include_once "../../../conf/Config.php"; 

require_once BASE_URL . "/paginas/cabecera_tercer_nivel.php"; 

$id_individual= $_GET['id_individual'];


?>

<main role="main" class="content-wrapper">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
  	<ol class="breadcrumb float-sm-right text-center">
      <h2>View All Assignamet with Id Assignment N° 0000<?php echo $id_individual?></h2>
    </ol>
    <ol class="breadcrumb float-sm-right text-center">
      <h5>Time <?php echo date('h:i:s a'); ?></h5>
    </ol>
    
  </div>

  <div class="col-12">
    <?php
    $sentencia = $base_de_datos->query("SELECT * FROM facility_assignment, individuals, species WHERE species.id_species = individuals.specie AND individuals.id_individual = facility_assignment.id_individual_assi AND facility_assignment.id_real_assig='".$id_individual."'  ORDER BY facility_assignment.id_assignment");
    $usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);
    ?> 

   
      <div class="card-body">
        <center>
          <table id="example1" class="table table-bordered table-striped table-responsive">
            <thead>
              <tr>
                <th><center>ID - Assignment</center></th>
                <th><center>ID - Nickname</center></th>
                <th><center>Left Leg</center></th>
                <th><center>Right Leg</center></th>
                <th><center>Specie</center></th>
                <th><center>Assignment</center></th>
                <th><center>Notes</center></th>
                <th><center>Start</center></th>
                <th><center>Finish</center></th>
                <th><center>View</center></th>
                
              </tr>
            </thead>
            <tbody>
              <?php foreach($usuario as $individuals) { ?>
                <tr>
                  <td>
                    <center>
                      
                      <?php echo $individuals->id_real_assig; ?>
                    </center>
                  </td>
                  <td ><center><?php echo $individuals->id_individual.' - '. $individuals->nickname ?></center></td>
                  
                  <td width="15%">
                  <div class="col-12" style="background-color:<?php echo $individuals->left_ring_color ?> ; border: 1px solid #000000">
                    <center><font color="<?php echo $individuals->left_letter_color ?>"><?php echo $individuals->left_ring_numer ?></font></center>
                  </div>
                </td>

                <td width="15%">
                  <div class="col-12" style="background-color:<?php echo $individuals->right_ring_color ?> ; border: 1px solid #000000">
                    <center><font color="<?php echo $individuals->right_letter_color ?>"><?php echo $individuals->right_ring_numer ?></font></center>
                  </div>
                </td>
                <td><center><?php echo $individuals->scientific_name ?></center></td>
                  <?php
                  $sentencia_assi = $base_de_datos->prepare("SELECT id_assignment, assignment_date, id_facility_name  FROM facility_assignment where id_individual_assi = ? AND assignment_date!='' AND finish_date is null");
                  $sentencia_assi->execute([$individuals->id_individual]);
                  $assi = $sentencia_assi->fetch(PDO::FETCH_OBJ);
                  ?>
                  

                  <td width="20%">
                    <center>
                      
                        <?php if(empty($assi->id_facility_name)){ ?>
                        <?php echo "Not have assignment"; ?>
                       <?php } else {
                        $sentencia_fac = $base_de_datos->prepare("SELECT name_facility, type_facility, location, notes FROM facilities WHERE id_facility  = ?;");
                        $sentencia_fac->execute([$assi->id_facility_name]);
                        $fac = $sentencia_fac->fetch(PDO::FETCH_OBJ);?>
                        <strong><?php echo $fac->name_facility.'</strong> - '.$fac->type_facility.' - '.$fac->location;?>
                      <?php } ?>
                    
                  </center>
                </td>

                <td width="30%">
                  <textarea  name="notes[]" class="form-control"  disabled><?php echo $individuals->notes_assig; ?></textarea> 
                </td>

                <td width="10%"><center><?php echo $individuals->assignment_date ?></center></td>
                <td width="10%"><center><?php echo $individuals->finish_date ?></center></td>
                <td><center><a class="btn btn-info btn-sm" href="<?php echo "view_assig_indivi.php?id_individual=" .  $individuals->id_real_assig?>"><span data-feather="eye"></span></a></center></td>

                
              </tr>
            <?php } ?>
          </tbody> 
        </table>
      </center>
    </div>

    
</div>
</main>

<?php include_once BASE_URL . "/paginas/pie_3.php"; ?>
