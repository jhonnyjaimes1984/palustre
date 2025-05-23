<?php include_once "../../conf/Config.php"; 

include_once BASE_URL . "/paginas/cabecera_segundo_nivel.php"; 
?>



    <main role="main" class="content-wrapper">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Individuals</h1>
        
      </div>  

<?php
$sentencia = $base_de_datos->query("SELECT * FROM individuals, species  where species.id_species = individuals.specie");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);
?> 

<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
    <div class="col-xs-12">
       <div class="card">
            <div class="card-header">
              <h3 class="card-title">              
            <ol class="breadcrumb float-sm-right">
              <a class="btn btn-success" href="insert_stockbirds.php">New<span data-feather="plus"></span> </a>
            </ol>
          </h3>
          
        </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
              <center><table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                   <th><center>ID</center></th>
                   <th><center>Nickname</center></th>
                   <th><center>Specie</center></th>
                   <th><center>Assignment</center> </th>
                   <th><center>Sex</center></th>
                   <th><center>Year</center></th>
                   <th><center>Status</center></th>
                   <th><center>Left Leg</center></th>
                   <th><center>Right Leg</center></th>
                   
                   <th><center>Select All Date</center></th>
                   
          
                </tr>
                </thead>
                <tbody>
                <?php foreach($usuario as $individuals){ ?>
        <tr>
          
          <td><center><?php echo $individuals->id_individual ?></center></td>
          <td><center><?php echo $individuals->nickname ?></center></td>
          <td width="20%"><center><?php echo $individuals->scientific_name ?></center></td>
          <?php
          $sentencia_assi = $base_de_datos->prepare("SELECT id_assignment, assignment_date, id_facility_name, notes_assig  FROM facility_assignment where id_individual_assi = ? AND assignment_date!='' AND finish_date is null");
          $sentencia_assi->execute([$individuals->id_individual]);
          $assi = $sentencia_assi->fetch(PDO::FETCH_OBJ);?>
          <td width="50%"><center>

          <?php if(empty($assi->id_facility_name)){
            echo "Not have assignament";

          }else{
            $sentencia_fac = $base_de_datos->prepare("SELECT name_facility, type_facility, location, notes FROM facilities WHERE id_facility  = ?;");
          $sentencia_fac->execute([$assi->id_facility_name]);
          $fac = $sentencia_fac->fetch(PDO::FETCH_OBJ); 
          echo $fac->name_facility.' - '.$fac->type_facility.' - '.$fac->location.'<br><strong>Notes:</strong> '.$fac->notes ; } ?></center></td>
          <td><center><?php switch ($individuals->sex) {

            case '0':
              echo "Indeterminate";
              break;
            case '1':
              echo "Male";
              break;
              case '2':
              echo "Female";
              break;
            
           
          } ?></center></td>
          <td><center><?php echo $individuals->year ?></center></td>
          <td><center><?php echo $individuals->status ?></center></td>

          <td><div class="col-12" style="background-color:<?php echo $individuals->left_ring_color ?> ; border: 1px solid #000000">
          <center><font color="<?php echo $individuals->left_letter_color ?>"><?php echo $individuals->left_ring_numer ?></font></center></div></td>

          <td><div class="col-12" style="background-color:<?php echo $individuals->right_ring_color ?> ; border: 1px solid #000000">
          <center><font color="<?php echo $individuals->right_letter_color ?>"><?php echo $individuals->right_ring_numer ?></font></center></div></td>


          

          
           <td width="10%"><center><a class="btn btn-info btn-sm" href="<?php echo "select_all.php?id=" .  $individuals->id_individual?>"><span data-feather="edit"></span></a></center></td>
          
          
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

  


<?php  include_once BASE_URL . "/paginas/pie_2.php";   ?>