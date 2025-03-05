<?php 
include_once "../../../conf/Config.php"; 

require_once BASE_URL . "/paginas/cabecera_tercer_nivel.php"; 
// aqui guardamos varibales enviadas por get
    $id_pairs= $_GET['id'];
    $especie_individual = $_GET['specie'];
// hacemos una consulta para saber el ultimo conteo
$sentencia_insert = $db->query("SELECT max(cont_id_real) as total FROM monitoring");
$row_insert = $sentencia_insert->fetch_assoc(); 
// guardamos los resultados en un array
$itemData_insert = array('n_monitoring' => $row_insert['total']);
// aqui comprobamos que la vairable no esta vacia
$conteo = (empty($itemData_insert['n_monitoring'])) ? 1 : $itemData_insert['n_monitoring'] + 1;
// aqui hacemos una condicional para saber si temos $conteo =  1
if($conteo == 1){
//aqui hacemos una insercion para hacer una insert temporal
    $sentencia_insert_pairs = $base_de_datos->query("INSERT INTO `monitoring`(`cont_id_real`,`id_staff_mon`, `specie`, `id_individual_mon`, `status_mon`, `pair_id`, `id_external_distutbance`, `interior_mon`, `external_mon`, `date`, `start_time_mon`, `finish_time_mon`, `take_mon_photo_video`, `id_master_routine`, `id_master_reproductive`, `id_master_chicken`, `id_meteorology`, `notes`) VALUES ('".$conteo."','".$_SESSION['id_staff']."','','','','".$id_pairs."','','','','".date('Y-m-d')."','".date('Y-m-d H:i:s a')."','','','','','','','')");
}else{ ?>
    <script type="text/javascript">
        setTimeout(function () {
                window.location.href = "eliminarTempMonitoring.php"; // Reemplaza con tu URL de destino
            }, 50)
        </script>
    <?php }

    $id_monitoring_insert = $base_de_datos->lastInsertId();


// esta variable es para las tablas raiz esto para diferenciar de las dinamicas
    $tableCounter = 1000; 
    ?>
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
            <h1 class="h2 text-center">Insert Monitoring for pairs <?php echo 'N° 0000' . $id_pairs ?></h1>
            <ol class="breadcrumb float-sm-right text-center"><h2>Monitoring Pairs N° 0000<?php echo $conteo ?></h2></ol>
        </div>

        <div class="col-12">
            <form method="post" action="new_monitoring.php" enctype="multipart/form-data" id="form_insert">
                <!-- ORIGIN TYPE -->
                <div class="card mb-12">
                    <div class="card-header text-center">
                        <h3><strong>Time <?php echo date('h:i:s a');?></strong></h3>
                    </div>
                    <div class="card-body">
                        <center>
                            <div class="col-12 col-lg-6">
                                <script src="https://www.windfinder.com/widget/forecast/js/el_pollo?unit_wave=m&unit_rain=mm&unit_temperature=c&unit_wind=kmh&unit_pressure=hPa&days=1&show_day=0&show_waves=0"></script><noscript><a rel="nofollow" href="https://www.windfinder.com/forecast/el_pollo?utm_source=forecast&utm_medium=web&utm_campaign=homepageweather&utm_content=noscript-forecast">Wind forecast for El Pollo</a> provided by <a rel="nofollow" href="https://www.windfinder.com?utm_source=forecast&utm_medium=web&utm_campaign=homepageweather&utm_content=noscript-logo">windfinder.com</a></noscript>
                            </div>
                        </center>
                    </div>
                </div>
                <input type="hidden" name="id_monitoring_insert[]" value="<?php echo $id_monitoring_insert ?>">
                <input type="hidden" name="id_staff[]" value="<?php echo $_SESSION['id_staff'] ?>">
                <input type="hidden" name="species[]" value="Sin_especie">


                <div class="card mb-12">
                    <div class="card-header text-center">
                      <h3><strong>External Distutbance</strong></h3>
                  </div>
                  <div class="card-body">
                      <div class="d-flex justify-content-center">
                       <div class="row">
                         <input type="hidden" value="<?php echo $id_pairs ?>" name="id_individual_mon[]" required>

                         <div class="custom-control custom-radio col-12 col-lg-2 offset-lg-1">
                            <input class="custom-control-input" type="radio" value="1" id="external_1" name="id_external_distutbance[]" checked required>
                            <label for="external_1" class="custom-control-label" ondblclick="toggleTextarea(this)" data-text="Completely quiet environment, no nearby noises or movements. /  Ambiente completamente tranquilo, sin ruidos ni movimientos cercanos.">1. No external disturbances</label>
                            <!-- Aquí aparecerá el textarea -->
                        </div>
                        <div class="custom-control custom-radio col-12 col-lg-2">
                            <input class="custom-control-input" type="radio" value="2" id="external_2" name="id_external_distutbance[]" required>
                            <label for="external_2" class="custom-control-label" ondblclick="toggleTextarea(this)" data-text="Weak noises or human/animal activity in the distance, with no impact on bird behavior. / Ruidos o actividad humana/animal débil en la distancia, sin afectar el comportamiento de las aves.">2. Slight distant disturbances</label>
                        </div>
                        <div class="custom-control custom-radio col-12 col-lg-2">
                            <input class="custom-control-input" type="radio" value="3" id="external_3" name="id_external_distutbance[]" required>
                            <label for="external_3" class="custom-control-label" ondblclick="toggleTextarea(this)" data-text="Medium-intensity sounds or occasional movement near the facility (e.g., people passing by, occasional vehicle noise, nearby wildlife activity). Birds may show slight behavioral changes. / Sonidos de media intensidad o movimiento ocasional cerca de la instalación (ej. paso de personas, ruidos de vehículos no constantes, actividad de otras especies cerca). Puede haber leves cambios en el comportamiento de las aves.">3. Moderate disturbances</label> 
                        </div>
                        <div class="custom-control custom-radio col-12 col-lg-2">
                            <input class="custom-control-input" type="radio" value="4" id="external_4" name="id_external_distutbance[]" required>
                            <label for="external_4" class="custom-control-label" ondblclick="toggleTextarea(this)" data-text="Loud or constant noises (nearby construction, heavy traffic, frequent visitors), presence of predators, or close human activity causing stress in birds. Behavioral alterations are observed. / Molestias considerables. Ruidos fuertes o constantes (construcción cercana, tráfico intenso, visitas frecuentes), presencia de depredadores o actividad humana cercana que genera estrés en las aves. Se observan alteraciones en su conducta.">4. Considerable disturbances</label>
                        </div>
                        <div class="custom-control custom-radio col-12 col-lg-2">
                            <input class="custom-control-input" type="radio" value="5" id="external_5" name="id_external_distutbance[]" required>
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
                        <input class="form-check-input" type="radio" value="1" id="interior_1_100" name="id_observer_1[]" checked>
                        <label for="interior_1_100"  ondblclick="toggleTextarea(this)" data-text="Indicates that the monitoring is conducted from the interior corridor / 
                        Indica que el monitoreo se realiza desde el pasillo interior.">1. Interior</label>
                    </div>
                </div>
                <div class="col-12 col-lg-6 d-flex justify-content-center">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="2" id="exterior_2_100" name="id_observer_1[]" >
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
                        <input class="custom-control-input" type="radio" value="6" id="control_1_1000" name="id_control_type[]" required onclick="loadContent('routineControl.php', 1000)">
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
<?php
$sentencia = $base_de_datos->query("SELECT * FROM individuals, species  where species.id_species = individuals.specie");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<?php
// Conexión a la base de datos
$sentencia_pairs = $base_de_datos->query("SELECT * FROM pairs where finish_pairing_date is null ");
$parejas = $sentencia_pairs->fetchAll(PDO::FETCH_OBJ);
?>
<script>

    function confirmAndAddTable(type) {
    const userConfirmed = confirm("¿Estás seguro de insertar una nueva tabla en el monitoring?");
    if (userConfirmed) {
        addTable(type);
    }
}
    let tableCounter = 0;


    function initializeDataTable(tableId) {

       if (!tableId || tableId.trim() === "") {
        console.error("Error: tableId es inválido o está vacío.");
        return;
    }

    // Verifica si la tabla realmente existe en el DOM antes de inicializar DataTable
    if (!$(`#${tableId}`).length) {
        console.error(`Error: No se encontró la tabla con ID '${tableId}' en el DOM.`);
        return;
    }

    console.log(`✅ Inicializando DataTable en #${tableId}`);
    $(`#${tableId}`).DataTable({
                order: [[0, "asc"]], // Orden ascendente por la primera columna
                language: {
                    "emptyTable": "No hay datos para mostrar",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "search": "Buscar:",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "lengthMenu": 'Mostrando <select>' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="-1">Todos</option>' +
                    '</select> Entradas',
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Next",
                        "previous": "Anterior"
                    }
                }
            });
}

function addTable(type) {
    tableCounter++;
    const container = document.getElementById("tablesContainer");
    const div = document.createElement("div");
    div.className = "table-container";
    div.id = `tableDiv${tableCounter}`;
    const tableId = `dynamicTable${tableCounter}`;


    let tableHTML = type === 'individuals' ? `
                <h3>Individuals Table (${tableCounter})</h3>
                <table id="${tableId}" class="table table-bordered table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nickname</th>
                            <th>Specie</th>
                            <th>Assignment</th>
                            <th>Sex</th>
                            <th>Year</th>
                            <th>Status</th>
                            <th>Left Leg</th>
                            <th>Right Leg</th>
                            <th>Insert</th>

                        </tr>
                    </thead>
                    <tbody>
                <?php foreach($usuario as $individuals){ ?>
          <td><center><?php echo $individuals->id_individual ?></center></td>
          <td><center><?php echo $individuals->nickname ?></center></td>
          <td><center><?php echo $individuals->scientific_name ?></center></td>
          <?php
          $sentencia_assi = $base_de_datos->prepare("SELECT id_assignment, assignment_date, id_facility_name, notes  FROM facility_assignment where id_individual_assi = ? AND assignment_date!='' AND finish_date is null");
          $sentencia_assi->execute([$individuals->id_individual]);
          $assi = $sentencia_assi->fetch(PDO::FETCH_OBJ);?>
          <td><center>

          <?php if(empty($assi->id_facility_name)){
            echo "Not have assignament";

        }else{
            $sentencia_fac = $base_de_datos->prepare("SELECT name_facility, type_facility, location, notes FROM facilities WHERE id_facility  = ?;");
            $sentencia_fac->execute([$assi->id_facility_name]);
            $fac = $sentencia_fac->fetch(PDO::FETCH_OBJ); 
            echo $fac->name_facility.'<br>'.$fac->type_facility.'<br>'.$fac->location; } ?></center></td>
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
          <td>
<a class="btn btn-success btn-sm" href="#${tableCounter}" id="table${tableCounter}" onclick="replaceTableWithHTML1('<?php echo $individuals->id_individual; ?>', '<?php echo $individuals->scientific_name; ?>', ${tableCounter})">
    <span data-feather="save"></span>
</a>

              </td>
        </tr>
        <?php } ?>
                </tbody> 
        </table>`
        : `
                <h3>Pairs Table (${tableCounter})</h3>
                <table id="${tableId}" class="table table-bordered table-striped table-responsive">
                    <thead>
                  <tr>
                   <th><center>Id Pair</center></th> 
                   <th><center>Date</center></th>
                   <th><center style="padding-left: 50px; padding-right: 50px;">Pair</center></th>
                   <th><center>Facility</center></th> 
                   <th><center>Notes</center></th>
                    <th><center>Insert</center></th>

                 </tr>
               </thead>
               <tbody>
                <?php foreach($parejas as $individual_cop){ ?>
                  <tr> 
                    <td width="20%"><center><?php echo $individual_cop->pair_id; ?></center></td>
                    <td width="10%"><center><?php echo $individual_cop->pairing_date; ?></center></td>
                    <td><?php

                    $male_individual1 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
                    $male_individual1->execute([$individual_cop->male_individual1]);
                    $male_1 = $male_individual1->fetch(PDO::FETCH_OBJ);

                    $male_individual2 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
                    $male_individual2->execute([$individual_cop->male_individual2]);
                    $male_2 = $male_individual2->fetch(PDO::FETCH_OBJ);

                    $male_individual3 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
                    $male_individual3->execute([$individual_cop->male_individual3]);
                    $male_3 = $male_individual3->fetch(PDO::FETCH_OBJ);

                    $female_individual1 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
                    $female_individual1->execute([$individual_cop->female_individual1]);
                    $fame_1 = $female_individual1->fetch(PDO::FETCH_OBJ);

                    $female_individual2 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
                    $female_individual2->execute([$individual_cop->female_individual2]);
                    $fame_2 = $female_individual2->fetch(PDO::FETCH_OBJ);

                    $female_individual3 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
                    $female_individual3->execute([$individual_cop->female_individual3]);
                    $fame_3 = $female_individual3->fetch(PDO::FETCH_OBJ);



                    if ($individual_cop->male_individual1 != 0){?>
                      <div class="row"> 
                        <div class="col-5" style="background-color:<?php echo $male_1->left_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $male_1->left_letter_color ?>"><?php echo $male_1->left_ring_numer ?></font>
                          </center>
                        </div>
                        <div class="col-2"><center><?php echo $male_1->id_individual ?></center></div>
                        <div class="col-5" style="background-color:<?php echo $male_1->right_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $male_1->right_letter_color ?>"><?php echo $male_1->right_ring_numer ?></font>
                          </center>
                        </div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php }else{ ?>
                      <div class="row"> 
                        <div class="col-5"></div>
                        <div class="col-2"></div>
                        <div class="col-5"></div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php } 
                    if ($individual_cop->male_individual2 != 0){?>
                      <div class="row"> 
                        <div class="col-5" style="background-color:<?php echo $male_2->left_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $male_2->left_letter_color ?>"><?php echo $male_2->left_ring_numer ?></font>
                          </center>
                        </div>
                        <div class="col-2"><center><?php echo $male_2->id_individual ?></center></div>
                        <div class="col-5" style="background-color:<?php echo $male_2->right_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $male_2->right_letter_color ?>"><?php echo $male_2->right_ring_numer ?></font>
                          </center>
                        </div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php }else{ ?>
                      <div class="row"> 
                        <div class="col-5"></div>
                        <div class="col-2"></div>
                        <div class="col-5"></div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php } 
                    if ($individual_cop->male_individual3 != 0){?>
                      <div class="row"> 
                        <div class="col-5" style="background-color:<?php echo $male_3->left_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $male_3->left_letter_color ?>"><?php echo $male_3->left_ring_numer ?></font>
                          </center>
                        </div>
                        <div class="col-2"><center><?php echo $male_3->id_individual ?></center></div>
                        <div class="col-5" style="background-color:<?php echo $male_3->right_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $male_3->right_letter_color ?>"><?php echo $male_3->right_ring_numer ?></font>
                          </center>
                        </div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php }else{ ?>
                      <div class="row"> 
                        <div class="col-5"></div>
                        <div class="col-2"></div>
                        <div class="col-5" ></div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php }
                    if ($individual_cop->female_individual1 != 0){?>
                      <div class="row"> 
                        <div class="col-5" style="background-color:<?php echo $fame_1->left_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $fame_1->left_letter_color ?>"><?php echo $fame_1->left_ring_numer ?></font>
                          </center>
                        </div>
                        <div class="col-2"><center><?php echo $fame_1->id_individual ?></center></div>
                        <div class="col-5" style="background-color:<?php echo $fame_1->right_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $fame_1->right_letter_color ?>"><?php echo $fame_1->right_ring_numer ?></font>
                          </center>
                        </div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php }else{ ?>
                      <div class="row"> 
                        <div class="col-5"></div>
                        <div class="col-2"></div>
                        <div class="col-5"></div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php }
                    if ($individual_cop->female_individual2 != 0){?>
                      <div class="row">
                        <div class="col-5" style="background-color:<?php echo $fame_2->left_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $fame_2->left_letter_color ?>"><?php echo $fame_2->left_ring_numer ?></font>
                          </center>
                        </div>
                        <div class="col-2"><center><?php echo $fame_2->id_individual ?></center></div>
                        <div class="col-5" style="background-color:<?php echo $fame_2->right_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $fame_2->right_letter_color ?>"><?php echo $fame_2->right_ring_numer ?></font>
                          </center>
                        </div>
                      </div>
                      <div class="w-100"><br></div>

                    <?php }else{ ?>
                      <div class="row"> 
                        <div class="col-5"></div>
                        <div class="col-2"></div>
                        <div class="col-5"></div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php }  
                    if ($individual_cop->female_individual3 != 0){?>
                      <div class="row"> 
                        <div class="col-5" style="background-color:<?php echo $fame_3->left_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $fame_3->left_letter_color ?>"><?php echo $fame_3->left_ring_numer ?></font>
                          </center>
                        </div>
                        <div class="col-2"><center><?php echo $fame_3->id_individual ?></center></div>
                        <div class="col-5" style="background-color:<?php echo $fame_3->right_ring_color ?> ; border: 1px solid #000000">
                          <center
                          ><font color="<?php echo $fame_3->right_letter_color ?>"><?php echo $fame_3->right_ring_numer ?></font>
                        </center>
                      </div>
                    </div>
                    <div class="w-100"><br></div>
                  <?php }else{ ?>
                    <div class="row"> 
                      <div class="col-5"></div>
                      <div class="col-2"></div>
                      <div class="col-5"></div>
                    </div>
                    <div class="w-100"><br></div> 
                  <?php } ?>
                </td>
                <td width="20%"><center>
                  <?php 
                  $sentencia_fac_pairs = $base_de_datos->prepare("SELECT * FROM facilities WHERE id_facility  = ?;");
                  $sentencia_fac_pairs->execute([$individual_cop->id_facility_assignment]);
                  $fac_pairs = $sentencia_fac_pairs->fetch(PDO::FETCH_OBJ); 
                  echo $fac_pairs->name_facility.' - '.$fac_pairs->type_facility.' - '.$fac_pairs->location.'<br><strong>Notes:</strong> '.$fac_pairs->notes ;?> 
                </center></td>
                <td width="20%"><center><?php echo $individual_cop->notes; ?> </center></td> 
                <td>

<a class="btn btn-success btn-sm" href="#${tableCounter}" id="table${tableCounter}" onclick="replaceTableWithHTML2('<?php echo $individual_cop->pair_id; ?>', 'Sin_especie', ${tableCounter})">
    <span data-feather="save"></span>
</a>

              
             </td>

              </tr>
            <?php } ?>
          </tbody> 
            </table>`;

            tableHTML += `<button type="button" class=" btn btn-danger remove-btn" onclick="removeTable('tableDiv${tableCounter}')">Remove Table</button>`;

            div.innerHTML = tableHTML;
            container.appendChild(div);
             // Esperamos a que el elemento se renderice antes de inicializar DataTable
            setTimeout(() => {
                initializeDataTable(tableId);
            }, 100);
            feather.replace();
        }

        function removeTable(divId) {
            const div = document.getElementById(divId);
            if (div) div.remove();
        }

        $(document).ready(function() {
            $('#form_insert').on('submit', function (event) {
                event.preventDefault();
                alert("Form submitted successfully!");
            });
        });



        let id_staff = <?php echo $_SESSION['id_staff'];  ?>
// a partir de aqui se coloca toda la logica de individuals
        // a partir de aqui se coloca toda la logica de individuals
        // a partir de aqui se coloca toda la logica de individuals
        // a partir de aqui se coloca toda la logica de individuals
        // a partir de aqui se coloca toda la logica de individuals
        // a partir de aqui se coloca toda la logica de individuals

        // a partir de aqui se coloca toda la logica de individuals

        // a partir de aqui se coloca toda la logica de individuals


        // a partir de aqui se coloca toda la logica de individuals

        // a partir de aqui se coloca toda la logica de individuals

        // a partir de aqui se coloca toda la logica de individuals

        // a partir de aqui se coloca toda la logica de individuals

        // a partir de aqui se coloca toda la logica de individuals


        // a partir de aqui se coloca toda la logica de individuals
        async function replaceTableWithHTML1(id, specie, idTables) {

    isAjaxNavigation = true; // Marcamos la navegación como AJAX

    // Cambiar la URL sin activar "Atrás"
    history.pushState(null, null, window.location.href);


    // Función para realizar la consulta AJAX
            async function ajax() {
                const parametros = {
        id: id, // ID del individuo
        specie: specie, // Especie del individuo
        id_staff: id_staff
    };

    try {
        const resultado = await $.ajax({
            data: parametros,
            url: 'insertarAjax.php',
            type: 'post',
            beforeSend: function () {
                console.log("Enviando solicitud...");
            }
        });

        console.log("Resultado de la consulta AJAX:", resultado); // Muestra el valor recibido

        // Separar los valores usando split("-")
        const valores = resultado.split("-");
        let id_cont_real = valores[0];  // Primer valor (antes del "-")
        let id_monitoring_insert = valores[1]; // Segundo valor (después del "-")

        console.log("ID Cont Real:", id_cont_real);
        console.log("ID Monitoring Insert:", id_monitoring_insert);

        return { id_cont_real, id_monitoring_insert }; // Devuelve los valores como un objeto

    } catch (error) {
        console.error("Error en la solicitud AJAX:", error);
        return { id_cont_real: null, id_monitoring_insert: null }; // Retorna valores nulos en caso de error
    }
}


let resultado = await ajax();
let id_cont_real = resultado.id_cont_real;
let id_monitoring_insert = resultado.id_monitoring_insert;
setTimeout(() => { isAjaxNavigation = false; }, 100);







    // Generar el HTML con `tableNumber`
const htmlContent = `


<div class="custom-html">
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



    <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom' id="${tableCounter}"> 
        <h1 class='h2 text-center'>Insert Monitoring for individuals N° 0000${id}</h1>
        <ol class='breadcrumb float-sm-right text-center'><h2>Monitoring individuals N° 0000${id_cont_real}</h2></ol>
    </div>

    <div class='col-12'>

        <!-- ORIGIN TYPE -->
        <div class='card mb-12'>
            <div class='card-header text-center'>
                <h3><strong>Time <?php echo date('h:i:s a');?></strong></h3>
            </div>

        </div>
        <input type="hidden" name="id_monitoring_insert[]" value=${id_monitoring_insert}">

        <input type='hidden' name='id_staff[${idTables}]' value='<?php echo $_SESSION['id_staff'] ?>'>
        <input type='hidden' name='species[${idTables}]' value='${id}'>


        <div class='card mb-12'>
            <div class='card-header text-center'>
              <h3><strong>External Distutbance</strong></h3>
          </div>
          <div class='card-body'>
              <div class='d-flex justify-content-center'>
               <div class='row'>
                 <input type='hidden' value='${id}' name='id_individual_mon[${idTables}]' required>

                 <div class='custom-control custom-radio col-12 col-lg-2 offset-lg-1'>
                    <input class='custom-control-input' type='radio' value='1' id='external_1_${idTables}' name='id_external_distutbance[${idTables}]' >
                    <label for='external_1_${idTables}' class='custom-control-label' ondblclick='toggleTextarea(this)' data-text='Completely quiet environment, no nearby noises or movements. /  Ambiente completamente tranquilo, sin ruidos ni movimientos cercanos.'>1. No external disturbances</label>
                    <!-- Aquí aparecerá el textarea -->
                </div>
                <div class='custom-control custom-radio col-12 col-lg-2'>
                    <input class='custom-control-input' type='radio' value='2' id='external_2_${idTables}' name='id_external_distutbance[${idTables}]' >
                    <label for='external_2_${idTables}' class='custom-control-label' ondblclick='toggleTextarea(this)' data-text='Weak noises or human/animal activity in the distance, with no impact on bird behavior. / Ruidos o actividad humana/animal débil en la distancia, sin afectar el comportamiento de las aves.'>2. Slight distant disturbances</label>
                </div>
                <div class='custom-control custom-radio col-12 col-lg-2'>
                    <input class='custom-control-input' type='radio' value='3' id='external_3_${idTables}' name='id_external_distutbance[${idTables}]' >
                    <label for='external_3_${idTables}' class='custom-control-label' ondblclick='toggleTextarea(this)' data-text='Medium-intensity sounds or occasional movement near the facility (e.g., people passing by, occasional vehicle noise, nearby wildlife activity). Birds may show slight behavioral changes. / Sonidos de media intensidad o movimiento ocasional cerca de la instalación (ej. paso de personas, ruidos de vehículos no constantes, actividad de otras especies cerca). Puede haber leves cambios en el comportamiento de las aves.'>3. Moderate disturbances</label> 
                </div>
                <div class='custom-control custom-radio col-12 col-lg-2'>
                    <input class='custom-control-input' type='radio' value='4' id='external_4_${idTables}' name='id_external_distutbance[${idTables}]' >
                    <label for='external_4_${idTables}' class='custom-control-label' ondblclick='toggleTextarea(this)' data-text='Loud or constant noises (nearby construction, heavy traffic, frequent visitors), presence of predators, or close human activity causing stress in birds. Behavioral alterations are observed. / Molestias considerables. Ruidos fuertes o constantes (construcción cercana, tráfico intenso, visitas frecuentes), presencia de depredadores o actividad humana cercana que genera estrés en las aves. Se observan alteraciones en su conducta.'>4. Considerable disturbances</label>
                </div>
                <div class='custom-control custom-radio col-12 col-lg-2'>
                    <input class='custom-control-input' type='radio' value='5' id='external_5_${idTables}' name='id_external_distutbance[${idTables}]' >
                    <label for='external_5_${idTables}' class='custom-control-label' ondblclick='toggleTextarea(this)' data-text='Very high noise levels or constant movement near the facility (intense construction, direct predator presence, people within visual or physical proximity to enclosures). Observations may be interrupted, or birds may attempt to escape. /  Nivel de ruido muy alto o movimiento constante cerca de la instalación (obras intensas, presencia de depredadores directos, personas en contacto visual o físico con las jaulas). Puede interrumpir la observación o provocar reacciones de escape en las aves.'>5. Severe disturbances or extreme disruption</label>
                </div>

            </div>
        </div>
    </center>
</div>
</div>
<div class='card mb-12'>
    <div class='card-header text-center'>
        <h3><strong>Monitoring Location</strong></h3>
    </div>
    <div class='card-body'>

        <div class='row'>
            <div class='col-12 col-lg-6  d-flex justify-content-center'>
                <div class='form-check'>
                    <input class='form-check-input' type='radio' value='1' id='interior_1_${idTables}' name='id_observer_1[${idTables}]' checked>
                    <label for='interior_1_${idTables}'  ondblclick='toggleTextarea(this)' data-text='Indicates that the monitoring is conducted from the interior corridor / 
                    Indica que el monitoreo se realiza desde el pasillo interior.'>1. Interior (Tabla ${idTables})</label>
                </div>
            </div>
            <div class='col-12 col-lg-6 d-flex justify-content-center'>
                <div class='form-check'>
                    <input class='form-check-input' type='radio' value='2' id='exterior_2_${idTables}' name='id_observer_1[${idTables}]' >
                    <label for='exterior_2_${idTables}'  ondblclick='toggleTextarea(this)' data-text=' Indicates that the monitoring is conducted from outside the cages / Indica que el monitoreo se realiza desde el exterior de las jaulas.'>2. Exterior (Tabla ${idTables})</label>
                </div>
            </div>
        </div>
    </div>
</div>



<div class='card mb-12'>
    <div class='card-header text-center'>
        <h3><strong>Control Type</strong></h3>
    </div>
    <div class='card-body'>
        <div class='justify-content-center'>
            <div class='row'>
                <div class='custom-control custom-radio offset-lg-1 col-12 col-lg-4'>
                    <input class='custom-control-input' type='radio' value='6' id='control_1_${idTables}' name='id_control_type[${idTables}]' onclick="loadContent('routineControl.php', ${idTables})">
                    <label for='control_1_${idTables}' class='custom-control-label'>1. Routine Control </label>
                </div>
                <div class='custom-control custom-radio col-12 col-lg-4'>
                    <input class='custom-control-input' type='radio' value='7' id='control_2_${idTables}' name='id_control_type[${idTables}]' onclick="loadContent('reproductiveControl.php', ${idTables})">
                    <label for='control_2_${idTables}' class='custom-control-label'>2. Reproductive Control </label>
                </div>
                <div class='custom-control custom-radio col-12 col-lg-3'>
                    <input class='custom-control-input' type='radio' value='8' id='control_3_${idTables}' name='id_control_type[${idTables}]' onclick="loadContent('chickenControl.php', ${idTables})">
                    <label for='control_3_${idTables}' class='custom-control-label'>3. Chicken Control </label>
                </div>
            </div>
            <div class='invalid-feedback'>Select an option.</div>
            <br>
            <table class='table table-bordered table-responsive'>
                <thead>
                    <tr>
                        <th class='col-2 col-ms-2'>Behavior Type</th>
                        <th class='col-10 col-ms-10'>Action</th>
                    </tr>
                </thead>
                <tbody id='controlContent_${idTables}'> (Tabla ${idTables})
                    <!-- Aquí se cargará dinámicamente el contenido -->
                </tbody>
            </table>
        </div>
    </div>



</div>
<div class='card mb-12'>
    <div class='card-header text-center'>
        <h3><strong>PHOTO DOCUMENTATION</strong></h3>
    </div>
    <div class='card-body'>
        <div class='form-group'>
            <label for='photo_upload'>Upload Monitoring Photos</label>
            <input type='file' class='form-control' id='photo_upload_${idTables}' name='photo_upload[${idTables}]' multiple>
        </div>
        <div class='form-group'>
            <label for='document_upload'>Upload Monitoting Documents</label>
            <input type='file' class='form-control' id='document_upload_${idTables}' name='document_upload[${idTables}]' multiple>
        </div>
    </div>
</div>

<div class='card mb-12'>
    <div class='card-header text-center'>
        <h3><strong>OBSERVATIONS</strong></h3>
    </div>
    <div class='card-body'>
        <div class='form-group'>
            <label for='conclusions_text_2'>Notes</label>
            <textarea class='form-control' id='conclusions_text_2_${idTables}' name='conclusions_text_2[${idTables}]' rows='3'></textarea>
        </div>
    </div>
</div>
</div>


`;

        // Reemplazar la tabla por el nuevo contenido HTML
const tableDiv = document.getElementById(`tableDiv${idTables}`);
if (tableDiv) {
    tableDiv.innerHTML = htmlContent;
}

    // Pequeño retraso para evitar que popstate se active por error
setTimeout(() => { isAjaxNavigation = false; }, 100);


}


// a partir de aqui se coloca toda la logica de pairs

// a partir de aqui se coloca toda la logica de pairs

// a partir de aqui se coloca toda la logica de pairs

// a partir de aqui se coloca toda la logica de pairs

// a partir de aqui se coloca toda la logica de pairs

// a partir de aqui se coloca toda la logica de pairs

// a partir de aqui se coloca toda la logica de pairs

// a partir de aqui se coloca toda la logica de pairs

// a partir de aqui se coloca toda la logica de pairs

// a partir de aqui se coloca toda la logica de pairs

// a partir de aqui se coloca toda la logica de pairs


async function replaceTableWithHTML2(id, specie, idTables) {
      
    isAjaxNavigation = true; // Marcamos la navegación como AJAX

    // Cambiar la URL sin activar "Atrás"
    history.pushState(null, null, window.location.href);


    // Función para realizar la consulta AJAX
            async function ajax() {
                const parametros = {
        id: id, // ID del individuo
        specie: specie, // Especie del individuo
        id_staff: id_staff
    };

    try {
        const resultado = await $.ajax({
            data: parametros,
            url: 'insertarAjax.php',
            type: 'post',
            beforeSend: function () {
                console.log("Enviando solicitud...");
            }
        });

        console.log("Resultado de la consulta AJAX:", resultado); // Muestra el valor recibido

        // Separar los valores usando split("-")
        const valores = resultado.split("-");
        let id_cont_real = valores[0];  // Primer valor (antes del "-")
        let id_monitoring_insert = valores[1]; // Segundo valor (después del "-")

        console.log("ID Cont Real:", id_cont_real);
        console.log("ID Monitoring Insert:", id_monitoring_insert);

        return { id_cont_real, id_monitoring_insert }; // Devuelve los valores como un objeto

    } catch (error) {
        console.error("Error en la solicitud AJAX:", error);
        return { id_cont_real: null, id_monitoring_insert: null }; // Retorna valores nulos en caso de error
    }
}


let resultado = await ajax();
let id_cont_real = resultado.id_cont_real;
let id_monitoring_insert = resultado.id_monitoring_insert;
setTimeout(() => { isAjaxNavigation = false; }, 100);

    const htmlContent = `



<div class="custom-html">
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



    <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom' id="${tableCounter}"> 
        <h1 class='h2 text-center'>Insert Monitoring for pairs N° 0000${id}</h1>
        <ol class='breadcrumb float-sm-right text-center'><h2>Monitoring Pairs N° 0000${id_cont_real}</h2></ol>
    </div>

    <div class='col-12'>

        <!-- ORIGIN TYPE -->
        <div class='card mb-12'>
            <div class='card-header text-center'>
                <h3><strong>Time <?php echo date('h:i:s a');?></strong></h3>
            </div>

        </div>
        <input type="hidden" name="id_monitoring_insert[]" value=${id_monitoring_insert}">

        <input type='hidden' name='id_staff[${idTables}]' value='<?php echo $_SESSION['id_staff'] ?>'>
        <input type='hidden' name='species[${idTables}]' value='${id}'>


        <div class='card mb-12'>
            <div class='card-header text-center'>
              <h3><strong>External Distutbance</strong></h3>
          </div>
          <div class='card-body'>
              <div class='d-flex justify-content-center'>
               <div class='row'>
                 <input type='hidden' value='${id}' name='id_individual_mon[${idTables}]' required>

                 <div class='custom-control custom-radio col-12 col-lg-2 offset-lg-1'>
                    <input class='custom-control-input' type='radio' value='1' id='external_1_${idTables}' name='id_external_distutbance[${idTables}]' >
                    <label for='external_1_${idTables}' class='custom-control-label' ondblclick='toggleTextarea(this)' data-text='Completely quiet environment, no nearby noises or movements. /  Ambiente completamente tranquilo, sin ruidos ni movimientos cercanos.'>1. No external disturbances</label>
                    <!-- Aquí aparecerá el textarea -->
                </div>
                <div class='custom-control custom-radio col-12 col-lg-2'>
                    <input class='custom-control-input' type='radio' value='2' id='external_2_${idTables}' name='id_external_distutbance[${idTables}]' >
                    <label for='external_2_${idTables}' class='custom-control-label' ondblclick='toggleTextarea(this)' data-text='Weak noises or human/animal activity in the distance, with no impact on bird behavior. / Ruidos o actividad humana/animal débil en la distancia, sin afectar el comportamiento de las aves.'>2. Slight distant disturbances</label>
                </div>
                <div class='custom-control custom-radio col-12 col-lg-2'>
                    <input class='custom-control-input' type='radio' value='3' id='external_3_${idTables}' name='id_external_distutbance[${idTables}]' >
                    <label for='external_3_${idTables}' class='custom-control-label' ondblclick='toggleTextarea(this)' data-text='Medium-intensity sounds or occasional movement near the facility (e.g., people passing by, occasional vehicle noise, nearby wildlife activity). Birds may show slight behavioral changes. / Sonidos de media intensidad o movimiento ocasional cerca de la instalación (ej. paso de personas, ruidos de vehículos no constantes, actividad de otras especies cerca). Puede haber leves cambios en el comportamiento de las aves.'>3. Moderate disturbances</label> 
                </div>
                <div class='custom-control custom-radio col-12 col-lg-2'>
                    <input class='custom-control-input' type='radio' value='4' id='external_4_${idTables}' name='id_external_distutbance[${idTables}]' >
                    <label for='external_4_${idTables}' class='custom-control-label' ondblclick='toggleTextarea(this)' data-text='Loud or constant noises (nearby construction, heavy traffic, frequent visitors), presence of predators, or close human activity causing stress in birds. Behavioral alterations are observed. / Molestias considerables. Ruidos fuertes o constantes (construcción cercana, tráfico intenso, visitas frecuentes), presencia de depredadores o actividad humana cercana que genera estrés en las aves. Se observan alteraciones en su conducta.'>4. Considerable disturbances</label>
                </div>
                <div class='custom-control custom-radio col-12 col-lg-2'>
                    <input class='custom-control-input' type='radio' value='5' id='external_5_${idTables}' name='id_external_distutbance[${idTables}]' >
                    <label for='external_5_${idTables}' class='custom-control-label' ondblclick='toggleTextarea(this)' data-text='Very high noise levels or constant movement near the facility (intense construction, direct predator presence, people within visual or physical proximity to enclosures). Observations may be interrupted, or birds may attempt to escape. /  Nivel de ruido muy alto o movimiento constante cerca de la instalación (obras intensas, presencia de depredadores directos, personas en contacto visual o físico con las jaulas). Puede interrumpir la observación o provocar reacciones de escape en las aves.'>5. Severe disturbances or extreme disruption</label>
                </div>

            </div>
        </div>
    </center>
</div>
</div>
<div class='card mb-12'>
    <div class='card-header text-center'>
        <h3><strong>Monitoring Location</strong></h3>
    </div>
    <div class='card-body'>

        <div class='row'>
            <div class='col-12 col-lg-6  d-flex justify-content-center'>
                <div class='form-check'>
                    <input class='form-check-input' type='radio' value='1' id='interior_1_${idTables}' name='id_observer_1[${idTables}]' checked>
                    <label for='interior_1_${idTables}'  ondblclick='toggleTextarea(this)' data-text='Indicates that the monitoring is conducted from the interior corridor / 
                    Indica que el monitoreo se realiza desde el pasillo interior.'>1. Interior (Tabla ${idTables})</label>
                </div>
            </div>
            <div class='col-12 col-lg-6 d-flex justify-content-center'>
                <div class='form-check'>
                    <input class='form-check-input' type='radio' value='2' id='exterior_2_${idTables}' name='id_observer_1[${idTables}]' >
                    <label for='exterior_2_${idTables}'  ondblclick='toggleTextarea(this)' data-text=' Indicates that the monitoring is conducted from outside the cages / Indica que el monitoreo se realiza desde el exterior de las jaulas.'>2. Exterior (Tabla ${idTables})</label>
                </div>
            </div>
        </div>
    </div>
</div>



<div class='card mb-12'>
    <div class='card-header text-center'>
        <h3><strong>Control Type</strong></h3>
    </div>
    <div class='card-body'>
        <div class='justify-content-center'>
            <div class='row'>
                <div class='custom-control custom-radio offset-lg-1 col-12 col-lg-4'>
                    <input class='custom-control-input' type='radio' value='6' id='control_1_${idTables}' name='id_control_type[${idTables}]' onclick="loadContent('routineControl.php', ${idTables})">
                    <label for='control_1_${idTables}' class='custom-control-label'>1. Routine Control </label>
                </div>
                <div class='custom-control custom-radio col-12 col-lg-4'>
                    <input class='custom-control-input' type='radio' value='7' id='control_2_${idTables}' name='id_control_type[${idTables}]' onclick="loadContent('reproductiveControl.php', ${idTables})">
                    <label for='control_2_${idTables}' class='custom-control-label'>2. Reproductive Control </label>
                </div>
                <div class='custom-control custom-radio col-12 col-lg-3'>
                    <input class='custom-control-input' type='radio' value='8' id='control_3_${idTables}' name='id_control_type[${idTables}]' onclick="loadContent('chickenControl.php', ${idTables})">
                    <label for='control_3_${idTables}' class='custom-control-label'>3. Chicken Control </label>
                </div>
            </div>
            <div class='invalid-feedback'>Select an option.</div>
            <br>
            <table class='table table-bordered table-responsive'>
                <thead>
                    <tr>
                        <th class='col-2 col-ms-2'>Behavior Type</th>
                        <th class='col-10 col-ms-10'>Action</th>
                    </tr>
                </thead>
                <tbody id='controlContent_${idTables}'> (Tabla ${idTables})
                    <!-- Aquí se cargará dinámicamente el contenido -->
                </tbody>
            </table>
        </div>
    </div>



</div>
<div class='card mb-12'>
    <div class='card-header text-center'>
        <h3><strong>PHOTO DOCUMENTATION</strong></h3>
    </div>
    <div class='card-body'>
        <div class='form-group'>
            <label for='photo_upload'>Upload Monitoring Photos</label>
            <input type='file' class='form-control' id='photo_upload_${idTables}' name='photo_upload[${idTables}]' multiple>
        </div>
        <div class='form-group'>
            <label for='document_upload'>Upload Monitoting Documents</label>
            <input type='file' class='form-control' id='document_upload_${idTables}' name='document_upload[${idTables}]' multiple>
        </div>
    </div>
</div>

<div class='card mb-12'>
    <div class='card-header text-center'>
        <h3><strong>OBSERVATIONS</strong></h3>
    </div>
    <div class='card-body'>
        <div class='form-group'>
            <label for='conclusions_text_2'>Notes</label>
            <textarea class='form-control' id='conclusions_text_2_${idTables}' name='conclusions_text_2[${idTables}]' rows='3'></textarea>
        </div>
    </div>
</div>
</div>


    `;

        // Reemplazar la tabla por el nuevo contenido HTML
    const tableDiv = document.getElementById(`tableDiv${idTables}`);
    if (tableDiv) {
        tableDiv.innerHTML = htmlContent;
    }
    // Pequeño retraso para evitar que popstate se active por error
setTimeout(() => { isAjaxNavigation = false; }, 100);
    
}


</script>

<script src="insert_monitoring.js"></script>


<script>
    window.addEventListener("beforeunload", function (event) {
        const message = "¿Quieres salir del Monitoring?\nEs posible que los cambios no se guarden.";

    // Muestra la alerta del navegador
        event.returnValue = message;
        return message;
    });

// Capturar el evento `unload` solo si el usuario confirmó la salida
    window.addEventListener("unload", function (event) {
        navigator.sendBeacon("eliminarTempMonitoring.php");
    });

window.addEventListener("popstate", function (event) {
    if (isAjaxNavigation) {
        console.log("⚠ Cambio de URL por AJAX, ignorando popstate.");
        return;
    }

    const message = "¿Deseas ir atrás?";
    if (confirm(message)) {
        window.location.href = "eliminarTempMonitoring.php";
    } else {
        history.pushState(null, null, window.location.href);
    }
});







// Evita problemas de doble ejecución al presionar "Atrás"
history.pushState(null, null, window.location.href);

</script>





<?php include_once BASE_URL . "/paginas/pie_3.php"; ?>