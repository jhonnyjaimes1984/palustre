<style>
  #example1 {
    width: 100%; /* Asegura que ocupe el 100% del contenedor */
    table-layout: auto; /* Permite que las columnas se ajusten automáticamente */
    margin: 0 auto; /* Centra la tabla si hay espacio sobrante */
  }

  .content-header, .card-body {
    width: 100%; /* Asegura que el contenedor también ocupe el 100% */
  }
</style>

<?php include_once "../paginas/cabecera_admin.php"; 
if (!isset($_GET["id"])) exit();
$id = $_GET["id"];

if (!isset($_GET["id_individual"])) exit();
$id_individual = $_GET["id_individual"];

 ?>

<main role="main" class="content-wrapper">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Origin</h1>
  </div>  

  <?php
  $sentencia = $base_de_datos->prepare("SELECT * FROM origin, individuals WHERE origin.id_cod_locality = ? and individuals.id_individual= ? and origin.id_individual=individuals.id_individual;");
  $sentencia->execute([$id,$id_individual]);
  $origin = $sentencia->fetch(PDO::FETCH_OBJ);
  ?> 

  <div class="content-header">
    <div class="container-fluid">
      <div class="col-xs-12">
        <div class="card">
          
              <h3 class="card-title">              
            
              <a class="btn btn-warning col-12" href="<?php echo "stock_birds/select_all.php?id=" .$id_individual; ?>">Return Select</a>
            
          </h3>
          
        
        </div>
      </div>
      <div class="card-body">
        <table id="example1" class="table  table-responsive">
          <thead>
            <tr>
              <th width="10%"><center>Origin Type</center></th>
              <th width="15%"><center>Date</center></th>
              <th width="15%"><center>Autonomous Region</center></th>
              <th width="15%"><center>Province</center></th>
              <th width="15%"><center>Locality</center></th>
              <th width="15%"><center><?php 
              if($origin->born_center !=''){
                echo "Born Center";
              }
              if($origin->{"P.N/Zepa"} !=''){
                echo "P.N/Zepa";
              }
              if($origin->Transfer_center !=''){
                echo "Transfer Center";
              }

                ?></center></th>

              <th width="80%"><center>Notes</center></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><center><?php switch($origin->origin_type) {
      case '0':
        echo "Capture";
        break;

      case '1':
        echo "Born Center";
        break;

      case '2':
        echo "Transfer";
        break;  
      
      
    } ?></center></td>
              <td><center><?php echo $origin->entry_date ?></center></td>
              <td><center><?php
              $sentencia_1 = $base_de_datos->query("SELECT * FROM cod_comauto WHERE id_comauto  = '".$origin->cod_comauto ."';");
              $origin_1 = $sentencia_1->fetch(PDO::FETCH_OBJ);
              echo $origin_1->nombre_comauto; ?></center></td>
              <td><center><?php 
              $sentencia_2 = $base_de_datos->query("SELECT * FROM cod_province WHERE cod_province ='".$origin->cod_province ."';");
              $origin_2 = $sentencia_2->fetch(PDO::FETCH_OBJ);
              echo $origin_2->name_province; ?></center></td>
              <td><center><?php 
              $sentencia_3 = $base_de_datos->query("SELECT * FROM cod_locality WHERE id_locality ='".$origin->id_cod_locality ."';");
              $origin_3 = $sentencia_3->fetch(PDO::FETCH_OBJ);
              echo $origin_3->name; ?></center></td>
              <td><center><?php 
              if($origin->born_center !=''){
                echo $origin->Born_center;
              }
              if($origin->{"P.N/Zepa"} !=''){
                echo $origin->{"P.N/Zepa"};
              }
              if($origin->Transfer_center !=''){
                echo $origin->Transfer_center;
              }

                ?></center> </td>
              <td><center><?php echo $origin->notes_origin ?></center></td>
            </tr>
          </tbody> 
        </table>
      </div>
    </div>
  </div>
</main>

<?php include_once "../paginas/pie_1.php"; ?>
