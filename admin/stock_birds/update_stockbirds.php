<?php include_once "../../conf/Config.php"; 

include_once BASE_URL . "/paginas/cabecera_segundo_nivel.php"; 
?>


  

<main role="main" class="content-wrapper">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Update Individual</h1>
  </div>

  <div class="content-header">
    <div class="container-fluid">
      <!-- FORM TO ENTER THE ID -->
      <form method="post" id="id_form" action="update_individual.php">
        <div class="card mb-4">
          <div class="card-header text-center">
            <h3><strong>Enter Individual ID</strong></h3>
          </div>
          <div class="card-body text-center">
            <div class="form-group">
              <label for="id_individual"><strong>ID of Individual:</strong></label>
              <input type="number" class="form-control" id="id_individual" name="id_individual" placeholder="Enter ID" required>
            </div>
            <button type="submit" class="btn btn-primary">Load Individual</button>
          </div>
        </div>
      </form>

    
      

<?php
$sentencia = $base_de_datos->query("SELECT * FROM individuals, species where individuals.specie = species.id_species;");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);
?> 

<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
   
            <!-- /.card-header -->
            <div class="card-body">
              
              <center><table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                   <th><center>ID</center></th>
                   <th><center>Nickname</center></th>
                   <th><center>Specie</center></th>
                   <th><center>Sex</center></th>
                   <th><center>Year</center></th>
                   <th><center>Status</center></th>
                   <th><center>Left Leg</center></th>
                   <th><center>Right Leg</center></th>
                   
                   <th><center>Update All Date</center></th>
                   
          
                </tr>
                </thead>
                <tbody>
                <?php foreach($usuario as $individuals){ ?>
        <tr>
          
          <td><center><?php echo $individuals->id_individual?></center></td>
          <td><center><?php echo $individuals->nickname ?></center></td>
          <td width="50%"><center><?php echo $individuals->scientific_name ?></center></td>
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


          

          
           <td width="10%"><center><a class="btn btn-warning btn-sm" href="<?php echo "update_individual.php?id=" .  $individuals->id_individual?>"><span data-feather="edit"></span></a></center></td>
          
          
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