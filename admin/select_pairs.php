<?php include_once "../paginas/cabecera_admin.php"; ?>

<main role="main" class="content-wrapper">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pairs</h1>
  </div>

<?php
// Conexión a la base de datos
$sentencia = $base_de_datos->query("SELECT * FROM pairs;");
$parejas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?> 

<div class="content-header">
  <div class="container-fluid">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <ol class="breadcrumb float-sm-right">
              <a class="btn btn-success" href="new_pair.php">New Pair <span data-feather="plus"></span></a>
            </ol>
          </h3>
        </div>
        <div class="card-body">
          <center>
            <table id="example1" class="table table-bordered table-striped table-responsive">
              <thead>
                <tr>
                  <th><center>ID</center></th>
                  <th><center>Male</center></th>
                  <th><center>Female</center></th>
                  <th><center>Year</center></th>
                  <th><center>Status</center></th>
                  <th><center>Actions</center></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($parejas as $pareja){ ?>
                <tr>
                  <td><center><?php echo $pareja->id_pair ?></center></td>
                  <td><center><?php echo $pareja->male_nickname ?></center></td>
                  <td><center><?php echo $pareja->female_nickname ?></center></td>
                  <td><center><?php echo $pareja->year ?></center></td>
                  <td><center><?php echo $pareja->status ?></center></td>
                  <td width="10%">
                    <center>
                      <a class="btn btn-warning btn-sm" href="<?php echo "edit_pair.php?id=" . $pareja->id_pair ?>">
                        <span data-feather="edit"></span>
                      </a>
                      <a class="btn btn-danger btn-sm" href="<?php echo "delete_pair.php?id=" . $pareja->id_pair ?>">
                        <span data-feather="trash-2"></span>
                      </a>
                    </center>
                  </td>
                </tr>
                <?php } ?>
              </tbody> 
            </table>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>

</main>

<?php include_once "../paginas/pie_1.php"; ?>
