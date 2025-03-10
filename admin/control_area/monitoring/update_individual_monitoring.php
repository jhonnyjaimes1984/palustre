<?php 
include_once "../../../conf/Config.php"; 

require_once BASE_URL . "/paginas/cabecera_tercer_nivel.php"; 
$cont_id_real = $_GET['cont_id_real'];
$id_monitoring = $_GET['id'];

$conMon = $base_de_datos->prepare("SELECT * FROM monitoring WHERE id_monitoring = ?");
$conMon->execute([$id_monitoring]);
$resuMon = $conMon->fetch(PDO::FETCH_OBJ); ?>

  <link rel="stylesheet" href="../../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../../plugins/datatables/jquery.dataTables.js"></script>
    <script src="../../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="../../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

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





    <main role="main" class="content-wrapper">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> 
            <h1 class="h2 text-center">Update Monitoring for individual <?php echo 'N° 0000' . $resuMon->id_individual_mon ?></h1>
            <ol class="breadcrumb float-sm-right text-center"><h2>Monitoring Individual N° 0000<?php echo $cont_id_real ?></h2></ol>
        </div>

        <div class="col-12">
            <form method="post" action="new_monitoring.php" enctype="multipart/form-data" id="form_insert">
                <!-- ORIGIN TYPE -->
                <div class="card mb-12">
                    <div class="card-header text-center">
                        <h3><strong>Time start: <?php echo  date('h:i:s a',strtotime($resuMon->date));?></strong></h3>
                    </div>
                    
                </div>
                
                


                <div class="card mb-12">
                    <div class="card-header text-center">
                      <h3><strong>External Distutbance</strong></h3>
                  </div>
                  <div class="card-body">
                      <div class="d-flex justify-content-center">
                       <div class="row">
                         <input type="hidden" value="<?php echo $id_monitoring ?>" name="id_monitoring" required>

                         <div class="custom-control custom-radio col-12 col-lg-2 offset-lg-1">
                            <?php if($resuMon->id_external_distutbance == 1){ ?>
                              <input class="custom-control-input" type="radio" value="1" id="external_1" name="id_external_distutbance" checked required>
                            <?php }else{ ?>
                              <input class="custom-control-input" type="radio" value="1" id="external_1" name="id_external_distutbance" required>
                            <?php } ?>

                            
                            <label for="external_1" class="custom-control-label" ondblclick="toggleTextarea(this)" data-text="Completely quiet environment, no nearby noises or movements. /  Ambiente completamente tranquilo, sin ruidos ni movimientos cercanos.">1. No external disturbances</label>
                            <!-- Aquí aparecerá el textarea -->
                        </div>
                        <div class="custom-control custom-radio col-12 col-lg-2">
                          <?php if($resuMon->id_external_distutbance == 2){ ?>
                            <input class="custom-control-input" type="radio" value="2" id="external_2" name="id_external_distutbance" checked required>
                            <?php }else{ ?>
                              <input class="custom-control-input" type="radio" value="2" id="external_2" name="id_external_distutbance" required>
                            <?php } ?>
                            
                            <label for="external_2" class="custom-control-label" ondblclick="toggleTextarea(this)" data-text="Weak noises or human/animal activity in the distance, with no impact on bird behavior. / Ruidos o actividad humana/animal débil en la distancia, sin afectar el comportamiento de las aves.">2. Slight distant disturbances</label>
                        </div>
                        <div class="custom-control custom-radio col-12 col-lg-2">
                          <?php if($resuMon->id_external_distutbance == 3){ ?>
                               <input class="custom-control-input" type="radio" value="3" id="external_3" name="id_external_distutbance" checked required>
                            <?php }else{ ?>
                                 <input class="custom-control-input" type="radio" value="3" id="external_3" name="id_external_distutbance" required>
                            <?php } ?>
                           
                            <label for="external_3" class="custom-control-label" ondblclick="toggleTextarea(this)" data-text="Medium-intensity sounds or occasional movement near the facility (e.g., people passing by, occasional vehicle noise, nearby wildlife activity). Birds may show slight behavioral changes. / Sonidos de media intensidad o movimiento ocasional cerca de la instalación (ej. paso de personas, ruidos de vehículos no constantes, actividad de otras especies cerca). Puede haber leves cambios en el comportamiento de las aves.">3. Moderate disturbances</label> 
                        </div>
                        <div class="custom-control custom-radio col-12 col-lg-2">
                          <?php if($resuMon->id_external_distutbance == 4){ ?>
                              <input class="custom-control-input" type="radio" value="4" id="external_4" name="id_external_distutbance" checked required>
                            <?php }else{ ?>
                                <input class="custom-control-input" type="radio" value="4" id="external_4" name="id_external_distutbance" required>
                            <?php } ?>
                            
                            <label for="external_4" class="custom-control-label" ondblclick="toggleTextarea(this)" data-text="Loud or constant noises (nearby construction, heavy traffic, frequent visitors), presence of predators, or close human activity causing stress in birds. Behavioral alterations are observed. / Molestias considerables. Ruidos fuertes o constantes (construcción cercana, tráfico intenso, visitas frecuentes), presencia de depredadores o actividad humana cercana que genera estrés en las aves. Se observan alteraciones en su conducta.">4. Considerable disturbances</label>
                        </div>
                        <div class="custom-control custom-radio col-12 col-lg-2">
                          <?php if($resuMon->id_external_distutbance == 5){ ?>
                              <input class="custom-control-input" type="radio" value="5" id="external_5" name="id_external_distutbance" checked required>
                            <?php }else{ ?>
                                <input class="custom-control-input" type="radio" value="5" id="external_5" name="id_external_distutbance" required>
                            <?php } ?>
                            
                            <label for="external_5" class="custom-control-label" ondblclick="toggleTextarea(this)" data-text="Very high noise levels or constant movement near the facility (intense construction, direct predator presence, people within visual or physical proximity to enclosures). Observations may be interrupted, or birds may attempt to escape. /  Nivel de ruido muy alto o movimiento constante cerca de la instalación (obras intensas, presencia de depredadores directos, personas en contacto visual o físico con las jaulas). Puede interrumpir la observación o provocar reacciones de escape en las aves.">5. Severe disturbances or extreme disruption</label>
                        </div>

                    </div>
                </div>
            </center>
        </div>
    </div>
    <div class="card mb-12">
        <div class="card-header text-center">
            <h3><strong>Monitoring Location</strong></h3>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-12 col-lg-6  d-flex justify-content-center">
                    <div class="form-check">
                       <?php if($resuMon->interior_mon !=0){ ?>
                             <input class="form-check-input" type="radio" value="1" id="interior_1_100" name="id_observer_1" checked>
                            <?php }else{ ?>
                              <input class="form-check-input" type="radio" value="1" id="interior_1_100" name="id_observer_1" >
                            <?php } ?>
                        
                        <label for="interior_1_100"  ondblclick="toggleTextarea(this)" data-text="Indicates that the monitoring is conducted from the interior corridor / 
                        Indica que el monitoreo se realiza desde el pasillo interior.">1. Interior</label>
                    </div>
                </div>
                <div class="col-12 col-lg-6 d-flex justify-content-center">
                    <div class="form-check">
                      <?php if($resuMon->external_mon !=0){ ?>
                             <input class="form-check-input" type="radio" value="2" id="exterior_2_100" name="id_observer_1" checked >
                            <?php }else{ ?>
                                <input class="form-check-input" type="radio" value="2" id="exterior_2_100" name="id_observer_1" >
                            <?php } ?>
                        
                        <label for="exterior_2_100"  ondblclick="toggleTextarea(this)" data-text=" Indicates that the monitoring is conducted from outside the cages / Indica que el monitoreo se realiza desde el exterior de las jaulas.">2. Exterior</label>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="card mb-12">
        <div class="card-header text-center">
            <h3><strong>Control Type</strong></h3>
        </div>
        <div class="card-body">
            <div class="justify-content-center">
                <div class="row">
                    <div class="custom-control custom-radio offset-lg-1 col-12 col-lg-4">
                        <input class="custom-control-input" type="radio" value="6" id="control_1_1000" name="id_control_type" required onclick="loadContent('routineControl.php', 1000)">
                        <label for="control_1_1000" class="custom-control-label">1. Routine Control</label>
                    </div>
                    <div class="custom-control custom-radio col-12 col-lg-4">
                        <input class="custom-control-input" type="radio" value="7" id="control_2_1000" name="id_control_type[]" required onclick="loadContent('reproductiveControl.php', 1000)">
                        <label for="control_2_1000" class="custom-control-label">2. Reproductive Control</label>
                    </div>
                    <div class="custom-control custom-radio col-12 col-lg-3">
                        <input class="custom-control-input" type="radio" value="8" id="control_3_1000" name="id_control_type[]" required onclick="loadContent('chickenControl.php', 1000)">
                        <label for="control_3_1000" class="custom-control-label">3. Chicken Control</label>
                    </div>
                </div>
                <div class="invalid-feedback">Select an option.</div>
                <br>
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th class="col-2 col-ms-2">Behavior Type</th>
                            <th class="col-10 col-ms-10">Action</th>
                        </tr>
                    </thead>
                    <tbody id="controlContent_1000">
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
                <input type="file" class="form-control" id="photo_upload" name="photo_upload[]" multiple>
            </div>
            <div class="form-group">
                <label for="document_upload">Upload Monitoting Documents</label>
                <input type="file" class="form-control" id="document_upload" name="document_upload[]" multiple>
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
                <textarea class="form-control" id="conclusions_text_2" name="conclusions_text_2[]" rows="3"></textarea>
            </div>
        </div>
    </div>
    <div id="tablesContainer" class="col-12"></div>
    <br><br>
    <div class="d-flex justify-content-center">
        <div class="row w-100 justify-content-between">
            <button type="button" class="btn btn-success col-5" onclick="confirmAndAddTable('individuals')">
                Insert - Individuals
            </button>
            <button type="button" class="btn btn-success col-5" onclick="confirmAndAddTable('pairs')">
                Insert - Pairs
            </button>
        </div>
    </div>

    <br><br>
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

<?php  include_once BASE_URL . "/paginas/pie_3.php";   ?>