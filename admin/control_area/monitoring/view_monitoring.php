<?php 
include_once "../../../conf/Config.php"; 

require_once BASE_URL . "/paginas/cabecera_tercer_nivel.php"; 


$id_individual= $_GET['id'];

$consulta_mon_gen = $base_de_datos->prepare("SELECT * FROM monitoring WHERE id_individual_mon = ?");
$consulta_mon_gen->execute([$id_individual]);
$resultado_mon_gen = $consulta_mon_gen->fetch(PDO::FETCH_OBJ);

?>
 <style>
    .custom-textarea {
        width: 100%;
        max-width: 350px; /* Evita que sea demasiado ancho en pantallas grandes */
        height: 150px; /* Aumenta el tamaño para mejor legibilidad */
        margin-top: 10px;
        display: none; /* Oculto por defecto */
        resize: none;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        background-color: #f8f9fa;
        overflow-y: auto; /* Permite desplazamiento vertical */
    }


   

   
</style>

<script type="text/javascript" src="../validator/vendor/jquery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../validator/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../validator/dist/js/bootstrapValidator.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<main role="main" class="content-wrapper">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> 
        <h1 class="h2 text-center">Monitoring for individual <?php echo 'N° 0000' . $id_individual ?></h1>
        <div class="row">
          <div class="col-12">
        <li class="breadcrumb float-sm-right text-center">
          <strong>Star Time: <?php echo !empty($resultado_mon_gen->start_time_mon) ?  date('Y/m/d h:i a ',strtotime($resultado_mon_gen->start_time_mon)) : ''; ?></strong> 
          </li>
        </div>
        <div class="col-12"> 
          <li class="breadcrumb float-sm-right text-center">
          <br>
          <strong>Finish Time: <?php echo !empty($resultado_mon_gen->finish_time_mon) ? "Star Time:  ". date('Y/m/d h:i a ',strtotime($resultado_mon_gen->finish_time_mon)) : ''; ?></strong>
        </li>
      </div>
      <div class="col-12 ">
        <li class="breadcrumb float-sm-right text-center">
        <strong>NAME STAFF MONITORING:
          <?php if (!empty($rerultado_mon_gen->id_staff_mon)){

            $consulta_staff = $base_de_datos->prepare("SELECT * FROM staff WHERE id_staff = ?");
          $consulta_staff->execute([$rerultado_mon_gen->id_staff_mon]);
          $resultado_staff = $consulta_staff->fetch(PDO::FETCH_OBJ);
          echo $resultado_staff->first_name. ' - ' . $resultado_staff->last_name ;

          }else{

          }
          ?>
           </strong>
          </li>
        
      </div>
      </div>
        
    </div>

    <div class="col-12">
      <form method="post" action="new_monitoring.php" enctype="multipart/form-data" id="form_insert">
        <!-- ORIGIN TYPE -->
        <div class="card mb-12">
          <div class="card-body">
            <center>
              <div class="col-12 col-lg-6">
               aqui el API rest del tiempo 
             </div>
           </center>
         </div>
       </div>
       <div class="card mb-12">
        <div class="card-header text-center">
          <h3><strong>External Distutbance</strong></h3>
          <center>
              <?php if (!empty($resultado_mon_gen->id_external_distutbance)){
                switch ($resultado_mon_gen->id_external_distutbance) {
                case '1': ?>
                <p for="external_1"  ondblclick="toggleTextarea(this)" data-text="Completely quiet environment, no nearby noises or movements. /  Ambiente completamente tranquilo, sin ruidos ni movimientos cercanos.">No external disturbances</p>
                <?php break;
                case '2': ?>

                <p for="external_2"  ondblclick="toggleTextarea(this)" data-text="Weak noises or human/animal activity in the distance, with no impact on bird behavior. / Ruidos o actividad humana/animal débil en la distancia, sin afectar el comportamiento de las aves.">Slight distant disturbances</p>

                <?php break; 
                case '3': ?>

                <p for="external_3"  ondblclick="toggleTextarea(this)" data-text="Medium-intensity sounds or occasional movement near the facility (e.g., people passing by, occasional vehicle noise, nearby wildlife activity). Birds may show slight behavioral changes. / Sonidos de media intensidad o movimiento ocasional cerca de la instalación (ej. paso de personas, ruidos de vehículos no constantes, actividad de otras especies cerca). Puede haber leves cambios en el comportamiento de las aves.">Moderate disturbances</p> 

                <?php break; 
                case '4': ?>

                <p for="external_4"  ondblclick="toggleTextarea(this)" data-text="Loud or constant noises (nearby construction, heavy traffic, frequent visitors), presence of predators, or close human activity causing stress in birds. Behavioral alterations are observed. / Molestias considerables. Ruidos fuertes o constantes (construcción cercana, tráfico intenso, visitas frecuentes), presencia de depredadores o actividad humana cercana que genera estrés en las aves. Se observan alteraciones en su conducta.">Considerable disturbances</p>

                <?php break; 
                case '5': ?>

                <p for="external_5"  ondblclick="toggleTextarea(this)" data-text="Very high noise levels or constant movement near the facility (intense construction, direct predator presence, people within visual or physical proximity to enclosures). Observations may be interrupted, or birds may attempt to escape. /  Nivel de ruido muy alto o movimiento constante cerca de la instalación (obras intensas, presencia de depredadores directos, personas en contacto visual o físico con las jaulas). Puede interrumpir la observación o provocar reacciones de escape en las aves.">Severe disturbances or extreme disruption</p>

                <?php 

                break;
                default:
                                   // code...
                break;
              }

              }else{

              }
               ?>
            </center>
          </div>
        </div>
        <div class="card mb-12">
            <div class="card-header text-center">
                <h3><strong>Monitoring Location</strong></h3>
            </div>
            <div class="card-body">
                <center>
                <?php
              if (!empty($resultado_mon_gen->interior_mon)) { ?>
                        
                            <p  ondblclick="toggleTextarea(this)" data-text="Indicates that the monitoring is conducted from the interior corridor / Indica que el monitoreo se realiza desde el pasillo interior.">Interior</p>
                       
                  <?php  }else{

                  }
              if (!empty($resultado_mon_gen->external_mon)) { ?>

                        
                            <p   ondblclick="toggleTextarea(this)" data-text=" Indicates that the monitoring is conducted from outside the cages / Indica que el monitoreo se realiza desde el exterior de las jaulas.">Exterior</p>
                       
                      <?php  }else{} ?>
                    </center>
                    </div>
                </div>
            


        <div class="card mb-12">
            <div class="card-header text-center">
                <h3><strong>Control Type</strong></h3>
            </div>
           <div class="card-body">
    <div class="justify-content-center">
      <center>
       <?php 
       $consulta_control_type = $base_de_datos->prepare("SELECT id_master_routine,id_master_reproductive, id_master_chicken FROM monitoring WHERE id_individual_mon = ?");
       $consulta_control_type->execute([$id_individual]);
       $resultado_control_type = $consulta_control_type->fetch(PDO::FETCH_OBJ);

       if (!empty($resultado_control_type->id_master_routine)) { ?>
        <p>Routine Control</p>
       <?php  }  
       if (!empty($resultado_control_type->id_master_reproductive)) { ?>
        <p>Reproductive Control</p>
         <?php  }  
       if (!empty($resultado_control_type->id_master_chicken)) { ?>
        <p>Chicken Control</p>
          <?php } ?>
          
     </center>
        </div>
        <br>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="col-2 col-ms-2">Behavior Type</th>
                    <th class="col-10 col-ms-10">Action</th>
                </tr>
            </thead>
            <tbody id="controlContent">
                <!-- Aquí se cargará dinámicamente el contenido -->
            </tbody>
        </table>
    </div>
</div>


     
</div>
<div class="card mb-12">
    <div class="card-header text-center">
        <h3><strong>PHOTO DOCUMENTATION</strong></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="photo_upload">Upload Monitoring Photos</label>
            <input type="file" class="form-control" id="photo_upload" name="photo_upload" multiple>
        </div>
        <div class="form-group">
            <label for="document_upload">Upload Monitoting Documents</label>
            <input type="file" class="form-control" id="document_upload" name="document_upload" multiple>
        </div>
    </div>
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
