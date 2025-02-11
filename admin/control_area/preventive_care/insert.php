<?php include_once "../../../conf/Config.php"; 

include_once BASE_URL . "/paginas/cabecera_tercer_nivel.php"; 

$sentencia_insert = $db->query("SELECT COUNT(*) as total FROM preventive_care");
$row_insert = $sentencia_insert->fetch_assoc(); 
$itemData_insert = array('id_preventi_care' => $row_insert['total']);
$conteo = $itemData_insert['id_preventi_care'] + 1;

$id_individual= $conteo;

?>

<style>
    .tooltip-container {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .tooltip-text {
        display: none;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        top: 100%;
        width: 300px;
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        text-align: center;
        padding: 10px;
        border-radius: 5px;
        font-size: 14px;
        z-index: 1000;
        margin-top: 5px;
    }
</style>

<script type="text/javascript" src="../validator/vendor/jquery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../validator/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../validator/dist/js/bootstrapValidator.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<main role="main" class="content-wrapper"> 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> 
        <h1 class="h2 text-center">Insert ID for Preventive Care <?php echo 'N° 0000' . $id_individual ?></h1>
        <ol class="breadcrumb float-sm-right text-center"><h5>Time <?php echo date('h:i:s a'); ?></h5></ol>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="col-12">
                <form method="post" action="new_preventive_care.php" enctype="multipart/form-data" id="form_insert">
                    <!-- ORIGIN TYPE -->

<?php
$sentencia = $base_de_datos->query("SELECT * FROM individuals, species  where species.id_species = individuals.specie");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);
?> 


      <div class="card-body">
        <center>
          <table id="example1" class="table table-bordered table-striped table-responsive">
            <thead>
              <tr>
                <th>
                  <input type="checkbox" id="select_all">   
                </th>
                <th><center>ID</center></th>
                <th><center>Nickname</center></th>
                <th><center>Specie</center></th>
                <th><center>Assignment</center></th>
                <th><center>Sex</center></th>
                <th><center>Year</center></th>
                <th><center>Status</center></th>
                <th><center>Left Leg</center></th>
                <th><center>Right Leg</center></th>
                
              </tr>
            </thead>
            <tbody>
              <?php foreach($usuario as $individuals) { ?>
                <tr>
                  <td>
                    <input type="checkbox" class="select-individual" name="selected_individuals[]" value="<?php echo $individuals->id_individual; ?>">
                  </td>
                  <td><center><?php echo $individuals->id_individual ?></center></td>
                  <td><center><?php echo $individuals->nickname ?></center></td>
                  <td width="20%"><center><?php echo $individuals->scientific_name ?></center></td>

                  <?php
                  $sentencia_assi = $base_de_datos->prepare("SELECT id_assignment, assignment_date, id_facility_name, notes  FROM facility_assignment where id_individual_assi = ? AND assignment_date!='' AND finish_date is null");
                  $sentencia_assi->execute([$individuals->id_individual]);
                  $assi = $sentencia_assi->fetch(PDO::FETCH_OBJ);
                  ?>
                  
                  <td width="50%"><center>
                    <?php if(empty($assi->id_facility_name)){
                      echo "Not have assignment";
                    } else {
                      $sentencia_fac = $base_de_datos->prepare("SELECT name_facility, type_facility, location, notes FROM facilities WHERE id_facility  = ?;");
                      $sentencia_fac->execute([$assi->id_facility_name]);
                      $fac = $sentencia_fac->fetch(PDO::FETCH_OBJ); 
                      echo $fac->name_facility.' - '.$fac->type_facility.' - '.$fac->location.'<br><strong>Notes:</strong> '.$fac->notes;
                    } ?>
                  </center></td>

                  <td><center><?php 
                    switch ($individuals->sex) {
                      case '0': echo "Indeterminate"; break;
                      case '1': echo "Male"; break;
                      case '2': echo "Female"; break;
                    }
                  ?></center></td>
                  <td><center><?php echo $individuals->year ?></center></td>
                  <td><center><?php echo $individuals->status ?></center></td>

                  <td>
                    <div class="col-12" style="background-color:<?php echo $individuals->left_ring_color ?> ; border: 1px solid #000000">
                      <center><font color="<?php echo $individuals->left_letter_color ?>"><?php echo $individuals->left_ring_numer ?></font></center>
                    </div>
                  </td>

                  <td>
                    <div class="col-12" style="background-color:<?php echo $individuals->right_ring_color ?> ; border: 1px solid #000000">
                      <center><font color="<?php echo $individuals->right_letter_color ?>"><?php echo $individuals->right_ring_numer ?></font></center>
                    </div>
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

                    
<div class="card mb-12">
    <div class="card-header text-center">
        <h3><strong>NAME STAFF PREVENTIVE CARE</strong></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="conclusions_text">AQUI SALGA EL NOMBRE SOLO</label>
            <textarea class="form-control" id="conclusions_text" name="conclusions_text" rows="3"></textarea>
        </div>
    </div>
<div class="card mb-12">
    <div class="card-header text-center">        
        <div class="tooltip-container" onclick="toggleTooltip(this)">
            <h3><strong>Preventive Treatments</strong></h3>
            <div class="tooltip-text">
                (ENG) Prophylactic medications and general health monitoring protocols.<br>
                <i>(ESP) Medicación profiláctica y protocolos de monitoreo de salud general.</i>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="preventive_treatments_text">Notes Preventive Treatments</label>
            <textarea class="form-control" id="preventive_treatments_text" name="preventive_treatments_text" rows="3"></textarea>
        </div>
    </div>
</div>

<div class="card mb-12">
    <div class="card-header text-center">        
        <div class="tooltip-container" onclick="toggleTooltip(this)">
            <h3><strong>Nutritional Supplementation</strong></h3>
            <div class="tooltip-text">
                (ENG) Use of vitamins, minerals, probiotics, and dietary adjustments.<br>
                <i>(ESP) Uso de vitaminas, minerales, probióticos y ajustes dietéticos.</i>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="nutricional_supplementation">Notes Nutritional Supplementation</label>
            <textarea class="form-control" id="nutricional_supplementation" name="nutricional_supplementation" rows="3"></textarea>
        </div>
    </div>
</div>

<div class="card mb-12">
    <div class="card-header text-center">        
        <div class="tooltip-container" onclick="toggleTooltip(this)">
            <h3><strong>Deworming & Parasite Control</strong></h3>
            <div class="tooltip-text">
                (ENG) Internal and external parasite control, including scheduled deworming, treatment for ectoparasites, and hygiene management in enclosures<br>
               <i>(ESP) Control de parásitos internos y externos, incluyendo desparasitaciones programadas, tratamiento de ectoparásitos y manejo sanitario en instalaciones.</i>
    </div>
    </div>
    </div>
    
    <div class="card-body">
        <div class="form-group">
            <label for="deworming_parasite_control">Notes Deworming & Parasite Control </label>
            <textarea class="form-control" id="deworming_parasite_control" name="deworming_parasite_control" rows="3" placeholder="Describe the treatment and dosage..."></textarea>
        </div>
    </div>
</div>

<div class="card mb-12">
    <div class="card-header text-center">        
        <div class="tooltip-container" onclick="toggleTooltip(this)">
            <h3><strong>Enclouse Cleaning & Disinfection</strong></h3>
            <div class="tooltip-text">
                (ENG) Label used to record cleaning and disinfection of enclosures, including date, responsible person, and applied products<br>
               <i>(ESP) Etiqueta utilizada para registrar la limpieza y desinfección de jaulas, incluyendo fecha, persona responsable y productos aplicados.</i>
    </div>
    </div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for=">enclosure_cleaning_disinfection">Notes Cleaning & Disinfection</label>
            <textarea class="form-control" id=">enclosure_cleaning_disinfection" name=">enclosure_cleaning_disinfection" rows="3" placeholder="Write additional follow-up notes..."></textarea>
        </div>
    </div>
</div>

<div class="card mb-12">
    <div class="card-header text-center">
        <h3><strong>NEXT CHECKUP</strong></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="next_checkup_date">Select Next Checkup Date</label>
            <input type="date" class="form-control" id="next_checkup_date" name="next_checkup_date">
        </div>
    </div>
</div>


<div class="card mb-12">
    <div class="card-header text-center">
        <h3><strong>PHOTO DOCUMENTATION</strong></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="photo_upload">Upload Necropsy Photos</label>
            <input type="file" class="form-control" id="photo_upload" name="photo_upload" multiple>
        </div>
        <div class="form-group">
            <label for="document_upload">Upload Necropsy Documents</label>
            <input type="file" class="form-control" id="document_upload" name="document_upload" multiple>
        </div>
    </div>
</div>

<div class="card mb-12">
    <div class="card-header text-center">
        <h3><strong>CONCLUSIONS</strong></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="conclusions_text">Final Conclusions</label>
            <textarea class="form-control" id="conclusions_text" name="conclusions_text" rows="3"></textarea>
        </div>
    </div>
</div>

<script>
    function toggleTooltip(element) {
        var tooltip = element.querySelector(".tooltip-text");
        var allTooltips = document.querySelectorAll(".tooltip-text");

        // Cerrar todos los tooltips antes de abrir el actual
        allTooltips.forEach(function(t) {
            if (t !== tooltip) {
                t.style.display = "none";
            }
        });

        // Alternar visibilidad del tooltip seleccionado
        tooltip.style.display = (tooltip.style.display === "block") ? "none" : "block";
    }
</script>
<script>
    function toggleTextarea(label) {
        let existingTextarea = label.nextElementSibling;

        if (existingTextarea && existingTextarea.tagName === "TEXTAREA") {
        // Si ya existe el textarea, alternar su visibilidad
            existingTextarea.style.display = existingTextarea.style.display === "none" ? "block" : "none";
        } else {
        // Crear un nuevo textarea si no existe
            let textarea = document.createElement("textarea");
            textarea.className = "custom-textarea";
        textarea.disabled = true; // Deshabilitado por defecto
        textarea.innerText = label.getAttribute("data-text"); // Obtener el texto del atributo data-text
        label.parentNode.appendChild(textarea);
        textarea.style.display = "block"; // Mostrarlo
    }
}

 let timers = {};
    let intervals = {};

    function startTimer(id) {
        if (!timers[id]) {
            timers[id] = 0;
        }
        if (!intervals[id]) {
            intervals[id] = setInterval(() => {
                timers[id]++;
                document.getElementById(id).value = formatTime(timers[id]);
            }, 1000);
        }
    }

    function stopTimer(id) {
        clearInterval(intervals[id]);
        intervals[id] = null;
    }

    function resetTimer(id) {
        stopTimer(id);
        timers[id] = 0;
        document.getElementById(id).value = "00:00:00";
    }

    function formatTime(seconds) {
        let hrs = Math.floor(seconds / 3600);
        let mins = Math.floor((seconds % 3600) / 60);
        let secs = seconds % 60;
        return `${String(hrs).padStart(2, '0')}:${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
    }
</script>


    <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary">Save Data</button>
        <button type="button" class="btn btn-secondary" onclick="printReport()">Print Report</button>
    </div>
</form>

<script>
    function printReport() {
        window.print();
    }

  
  document.getElementById("select_all").addEventListener("change", function() {
    let checkboxes = document.querySelectorAll(".select-individual");
    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
  });

</script>






</main>
<?php  include_once BASE_URL . "/paginas/pie_3.php";   ?>
