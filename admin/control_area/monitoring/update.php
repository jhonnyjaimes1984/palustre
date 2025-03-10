<?php 
include_once "../../../conf/Config.php"; 

require_once BASE_URL . "/paginas/cabecera_tercer_nivel.php"; 
?>


    <main role="main" class="content-wrapper col-12">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update Monitoring</h1>
        
      </div>  

<?php
$sentencia = $base_de_datos->query("SELECT * FROM monitoring WHERE status_mon ='1'");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);
?> 

<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
    <div class="col-xs-12">
      
            <!-- /.card-header -->
            <div class="card-body">
              
              <center><table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                   <th><center>ID Monitoring</center></th>
                   <th><center>ID Individuals</center></th>
                   <th><center>Specie</center></th>
                   <th><center>Left Leg</center></th>
                   <th><center>Right Leg</center></th>
                   <th><center>Assignment</center> </th>
                   <th><center>Sex</center></th>
                   <th><center>Monitoring With Pair</center></th>
                   <th><center>Date</center></th>
                   <th><center>Star Monitoring</center></th>
                   <th><center>Finish Monitoring</center></th>
                  <!--- <th><center>Insert</center></th> 
                   <th><center>View</center></th> -->
                   <th><center>Update</center></th>
                   <!-- <th><center>Delete</center></th> -->
                   
                   
          
                </tr>
                </thead>
                <tbody>
                <?php foreach($usuario as $individuals){ ?>
            <?php if($individuals->pair_id=== 0){?>
              <tr>
            <?php }else{ ?>
              <tr class="table-warning">
            <?php } ?> 
          
          <td><center><?php echo $individuals->cont_id_real ?></center></td>
          <td><center><?php echo $individuals->id_individual_mon ?></center></td>
          <td width="20%"><center><?php echo $individuals->specie ?></center></td>
          <?php if($individuals->pair_id === 0){ 
            $consultaIndividuals = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?");
           $consultaIndividuals->execute([$individuals->id_individual_mon]);
           $resultadoIndividuals = $consultaIndividuals->fetch(PDO::FETCH_OBJ);?>

          <td><div class="col-12" style="background-color:<?php echo $resultadoIndividuals->left_ring_color ?> ; border: 1px solid #000000">
          <center><font color="<?php echo $resultadoIndividuals->left_letter_color ?>"><?php echo $resultadoIndividuals->left_ring_numer ?></font></center></div></td>

          <td><div class="col-12" style="background-color:<?php echo $resultadoIndividuals->right_ring_color ?> ; border: 1px solid #000000">
          <center><font color="<?php echo $resultadoIndividuals->right_letter_color ?>"><?php echo $resultadoIndividuals->right_ring_numer ?></font></center></div></td>
          <?php }else{ ?>
              <td></td><td></td>
          <?php } ?>

          

          <?php
          $sentencia_assi = $base_de_datos->prepare("SELECT id_assignment, assignment_date, id_facility_name, notes  FROM facility_assignment where id_individual_assi = ? AND assignment_date!='' AND finish_date is null");
          $sentencia_assi->execute([$individuals->id_individual_mon]);
          $assi = $sentencia_assi->fetch(PDO::FETCH_OBJ);?>
          <td width="50%"><center>

          <?php if(empty($assi->id_facility_name)){
            echo "Not have assignament";

          }else{
            $sentencia_fac = $base_de_datos->prepare("SELECT name_facility, type_facility, location, notes FROM facilities WHERE id_facility  = ?;");
          $sentencia_fac->execute([$assi->id_facility_name]);
          $fac = $sentencia_fac->fetch(PDO::FETCH_OBJ); 
          echo $fac->name_facility.' - '.$fac->type_facility.' - '.$fac->location.'<br><strong>Notes:</strong> '.$fac->notes ; } ?></center></td>
          <td><center><?php
          if($individuals->pair_id === 0){
           switch ($resultadoIndividuals->sex) {

            case '0':
              echo "Indeterminate";
              break;
            case '1':
              echo "Male";
              break;
              case '2':
              echo "Female";
              break;
            
           
          } } ?></center></td>
          <td><center><?php if($individuals->pair_id===0){ echo "No, monitoring pair"; }else{ echo " Yes, monitoring pair: ".$individuals->pair_id; }   ?></center></td>
          <td><center><?php echo $individuals->date ?></center></td>
          <td><center><?php echo $individuals->start_time_mon ?></center></td>
           <td><center><?php echo $individuals->finish_time_mon ?></center></td>
           <!-- <td>
             <center>
                <a class="btn btn-success btn-sm" href="<?php echo "select_monitoring.php";?>"><span data-feather="save"></span></a></center>
              </td>
               <td>
            <center><a class="btn btn-info btn-sm" href="<?php echo "view_monitoring.php?id=" .  $individuals->id_monitoring ?>"><span data-feather="eye"></span></a></center>
          </td> -->
           <td>
            <center><?php if($individuals->pair_id===0){ ?>
              <a class="btn btn-warning btn-sm" href="<?php echo "update_individual_monitoring.php?id=".$individuals->id_monitoring."&cont_id_real=".$individuals->cont_id_real?>"><span data-feather="edit"></span></a>
            <?php }else{ ?>
              <a class="btn btn-warning btn-sm" href="<?php echo "update_pair_monitoring.php?id=".$individuals->id_monitoring."&cont_id_real=".$individuals->cont_id_real?>"><span data-feather="edit"></span></a>
            <?php } ?>

              </center>
          </td>
          <!--  <td>
            <center><a class="btn btn-danger btn-sm" href="<?php echo "delete_individual_monitoring.php?id=" .$individuals->id_monitoring?>"><span data-feather="trash"></span></a></center>
          </td> -->
          
          
          
          
        </tr>
        <?php } ?>
                </tbody> 
            </table></center>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
</div>
   
    </main>
  </div>
</div>

  

<?php  include_once BASE_URL . "/paginas/pie_3.php";   ?>