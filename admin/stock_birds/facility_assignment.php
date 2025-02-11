<?php include_once "../../conf/Config.php"; 

include_once BASE_URL . "/paginas/cabecera_segundo_nivel.php"; 
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
 ?>


    <main role="main" class="content-wrapper">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">facility_assignment</h1>
        
      </div>  

<?php
$sentencia = $base_de_datos->query("SELECT * FROM facility_assignment WHERE id_facility_name = '".$id."' AND (finish_date IS NULL OR finish_date = '');");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);
?> 

<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
    <div class="col-xs-12">
     
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
              <center><table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                   <th><center>Id Assignment</center></th>
                   <th><center>Individuals</center></th>
                   <th><center>Facility Name</center></th>
                   <th><center>Assignment Date</center></th>
                   <th><center>Finish Date</center></th>
                   <th><center>Notes</center></th>
                 </tr>
                </thead>
                <tbody>
                <?php foreach($usuario as $individuals){ ?>
        <tr>
          
          <td><center><?php echo $individuals->id_assignment; ?></center></td>
          <td><center><a href="<?php echo "stock_birds/select_all.php?id=" .$individuals->id_individual_assi; ?>"> <?php echo $individuals->id_individual_assi ?></a></center></td>
          <td width="50%"><center><?php
              $sentencia_1 = $base_de_datos->query("SELECT * FROM facilities WHERE id_facility  = '".$individuals->id_facility_name."';");
              $origin_1 = $sentencia_1->fetch(PDO::FETCH_OBJ);
              echo $origin_1->name_facility; ?></center></td>
          <td width="25%"><center><?php echo $individuals->assignment_date?></center></td>
          <td width="25%"><center><?php echo $individuals->finish_date ?></center></td>
          <td><center><?php echo $individuals->notes ?></center></td>
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