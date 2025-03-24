<?php include_once "../../conf/Config.php"; 

include_once BASE_URL . "/paginas/cabecera_segundo_nivel.php"; 

$id_individual ='';

// Check if the individual ID is provided via form submission
if (($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') && isset($_POST['id_individual']) || isset($_GET['id_individual'])) {
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $id_individual = $_POST['id_individual'];
    }else{
      $id_individual = $_GET['id_individual'];
    }
    

    try {
        // Query to get the individual data
        $query = $base_de_datos->prepare("UPDATE `individuals` SET `status_bd`= 1, `id_staff_delete`=null, `date_delete`= '', `nota_delete`= '' WHERE id_individual = ?");
        $query->execute([$id_individual]);

        $individual = $query->fetch(PDO::FETCH_ASSOC);

        if (!$individual) {
            $error = "No individual found with ID $id_individual.";
        }
    } catch (PDOException $e) {
        $error = "Error while querying the database: " . $e->getMessage();
    }
}
?>

<main role="main" class="content-wrapper">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">All Individual Delete</h1>

    <ol class="breadcrumb float-sm-right">
              <a class="btn btn-success" href="delete_stockbirds.php">Back</a>
            </ol>
  </div>

  <div class="content-header">
    <div class="container-fluid">
      <!-- FORM TO ENTER THE ID -->
      <form method="post" id="id_form">
        <div class="card mb-4">
          <div class="card-header text-center">
            <h3><strong>Enter Individual ID</strong></h3>
          </div>
          <div class="card-body text-center">
            <div class="form-group">
              <label for="id_individual"><strong>ID of Individual:</strong></label>
              <input type="number" class="form-control" id="id_individual" name="id_individual" placeholder="Enter ID" required>
            </div>
            <button type="submit" class="btn btn-primary" onclick="return confirm('Desea borrar el individual?')">Delete Individual</button>
          </div>
        </div>
      </form>

      <?php
$sentencia = $base_de_datos->query("SELECT * FROM individuals, species  where species.id_species = individuals.specie and individuals.status_bd ='0'");
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
                   <th><center>ID</center></th>
                   <th><center>Nickname</center></th>
                   <th><center>Specie</center></th>
                   <th><center>Assignment</center> </th>
                   <th><center>Sex</center></th>
                   <th><center>Year</center></th>
                   <th><center>Status</center></th>
                   <th><center>Left Leg</center></th>
                   <th><center>Right Leg</center></th>
                   <th><center>Name Staff</center></th>
                   <th><center>Date Delete</center></th>
                   <th><center>Note Delete</center></th>
                   
                   <th><center>Recovery</center></th>
                   
          
                </tr>
                </thead>
                <tbody>
                <?php foreach($usuario as $individuals){ ?>
        <tr>
          
          <td><center><?php echo $individuals->id_individual ?></center></td>
          <td><center><?php echo $individuals->nickname ?></center></td>
          <td width="20%"><center><?php echo $individuals->scientific_name ?></center></td>
          <?php
          $sentencia_assi = $base_de_datos->prepare("SELECT id_assignment, assignment_date, id_facility_name  FROM facility_assignment where id_individual_assi = ? AND assignment_date!='' AND finish_date is null");
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
          <td><center><?php 
          $query_staff = $base_de_datos->prepare("SELECT first_name, last_name FROM staff where id_staff = ?");
           $query_staff->execute([$individuals->id_staff_delete]);
          $res = $query_staff->fetch(PDO::FETCH_OBJ);
          echo $res->first_name." ".$res->last_name;
        ?></center></td>
          <td><center><?php echo $individuals->date_delete ?></center></td>
          <td><center><?php echo $individuals->nota_delete ?></center></td>

          

          
           <td width="10%"><center><a class="btn btn-success btn-sm" href="<?php echo "show_all_delete.php?id_individual=" .  $individuals->id_individual?>" onclick="return confirm('Would you like to restore individual <?php echo $individuals->id_individual; ?> that was deleted earlier ?')">
          <span data-feather="corner-up-left"></span></a></center></td>
          
          
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

</main>
<?php  include_once BASE_URL . "/paginas/pie_2.php";   ?>