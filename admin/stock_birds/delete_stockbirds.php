<?php include_once "../../conf/Config.php"; 

include_once BASE_URL . "/paginas/cabecera_segundo_nivel.php"; 

$id_individual ='';
$nota_delete ='';
// Check if the individual ID is provided via form submission
if (($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') && isset($_POST['id_individual']) || isset($_GET['id_individual'])) {

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id_individual = $_POST['id_individual'];
    $id_staff = $_SESSION['id_staff'];
    $date_delete = date('d-m-Y h:i:s a');
    $nota_delete = $_POST['note'];
  }else{
    $id_individual = $_GET['id_individual'];
    $id_staff = $_SESSION['id_staff'];
    $date_delete = date('d-m-Y h:i:s a');
    $nota_delete = $_GET['note'];

  }


  try {
        // Query to get the individual data
    $query = $base_de_datos->prepare("UPDATE `individuals` SET `status_bd`= 0,`id_staff_delete`=?,`date_delete`= ?,`nota_delete`= ? WHERE id_individual = ?");
    $query->execute([$id_staff, $date_delete, $nota_delete, $id_individual]);

    $individual = $query->fetch(PDO::FETCH_ASSOC);
    unset($_GET['id_individual']);
    unset($_GET['note']);
    unset($_POST['id_individual']);
    unset($_POST['note']);


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
    <h1 class="h2">Delete Individual</h1>

    <ol class="breadcrumb float-sm-right">
      <a class="btn btn-success" href="show_all_delete.php">View Delete</span> </a>
    </ol>
  </div>

  <div class="content-header">
    <div class="container-fluid">
      <!-- FORM TO ENTER THE ID -->
      <form method="post" id="id_form" onsubmit="return confirm('Are you sure you want to delete this individual?')">
        <div class="card mb-4">
          <div class="card-header text-center">
            <h3><strong>Enter Individual ID</strong></h3>
          </div>
          <div class="card-body text-center">
            <div class="form-group">
              <label for="id_individual"><strong>ID of Individual:</strong></label>
              <input type="number" class="form-control" id="id_individual" name="id_individual" placeholder="Enter ID" required>
            </div>
            <div class="form-group">
              <label for="note">Add a note (optional):</label>
              <textarea class="form-control" id="note" name="note" rows="3" placeholder="Write a note..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Delete Individual</button>
          </div>
        </div>
      </form>

      <?php
      $sentencia = $base_de_datos->query("SELECT * FROM individuals, species  where species.id_species = individuals.specie and individuals.status_bd!='0'");
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

             <th><center>Delete</center></th>


           </tr>
         </thead>
         <tbody>
          <?php foreach($usuario as $individuals){ ?>
            <tr>

              <td><center><?php echo $individuals->id_individual ?></center></td>
              <td><center><?php echo $individuals->nickname ?></center></td>
              <td width="20%"><center><?php echo $individuals->scientific_name ?></center></td>
              <?php
              $sentencia_assi = $base_de_datos->prepare("SELECT id_assignment, assignment_date, id_facility_name, notes  FROM facility_assignment where id_individual_assi = ? AND assignment_date!='' AND finish_date is null");
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
                      <td width="10%">
                        <center>
                          <a class="btn btn-danger btn-sm" 
                          href="#" 
                          onclick="deleteWithNote(<?php echo $individuals->id_individual; ?>); return false;">
                          <span data-feather="trash"></span>
                        </a>
                      </center>
                    </td>


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
<script>
function deleteWithNote(id) {
    let note = prompt("Enter a note before deleting this individual:");
    
    if (note !== null) { // Si el usuario no canceló el prompt
        let confirmDelete = confirm(`Are you sure you want to delete this individual ${id}?`);
        
        if (confirmDelete) {
            // Redireccionar con el ID y la nota en la URL
            window.location.href = `delete_stockbirds.php?id_individual=${id}&note=${encodeURIComponent(note)}`;
        }
    }
}
</script>
<?php  include_once BASE_URL . "/paginas/pie_2.php";   ?>