<?php 
include_once "../../../conf/Config.php"; 

require_once BASE_URL . "/paginas/cabecera_tercer_nivel.php"; 
$sentencia_insert = $db->query("SELECT COUNT(*) as total FROM veterinary");
$row_insert = $sentencia_insert->fetch_assoc(); 
$itemData_insert = array('n_veterinary' => $row_insert['total']);
$conteo = $itemData_insert['n_veterinary'] + 1;



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
        <ol class="breadcrumb float-sm-right text-center"><h2>ID Veterinary N° 0000<?php echo $conteo ?></h2></ol>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="col-12">
                <form method="post" action="new_veterinary.php" enctype="multipart/form-data" id="form_insert">
                    <!-- ORIGIN TYPE -->
                    <div class="card mb-12">
                        <div class="card-header text-center">
                            <h3><strong>Time <?php echo date('h:i:s a'); ?></strong></h3>
                        </div>
                    </div>

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
        <input type="hidden" name="name_user" value="<?php echo $_SESSION['nombre'] .' '. $_SESSION['apellido']; ?>">
         <div class="card mb-12">
            <div class="card-header text-center">
                <h3><strong>VETERINARY CARE</strong></h3>
            </div>
            <div class="card-body">
                <input type="hidden" value="<?php echo $id_individual ?>" name="id_individual_vet" required>
                <div class="row">
                    <div class="col-6 d-flex justify-content-center">
        <div class="form-check">
            <input class="form-check-input" type="radio" value="1" id="bird_live" name="bird" checked>
            <label for="bird_live" class="form-check-label fw-bold"><strong>BIRD LIVE</strong></label>
        </div>
    </div>
    <div class="col-6 d-flex justify-content-center">
        <div class="form-check">
            <input class="form-check-input" type="radio" value="2" id="bird_die" name="bird">
            <label for="bird_die" class="form-check-label fw-bold"><strong>BIRD DIE</strong></label>
        </div>
    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card mb-12">

    <div id="birdLiveContent">
        <?php include "bird_live.php"; ?> <!-- Archivo para ave viva -->
    </div>
    <div id="birdDieContent">
        <?php include "bird_die.php"; ?> <!-- Archivo para ave muerta -->
    </div>
</div>
  


    <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary">Save Data</button>
        <button type="button" class="btn btn-secondary" onclick="printReport()">Print Report</button>
    </div>
</form>

<script>
    function printReport() {
        window.print();
    }



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

     document.getElementById("select_all").addEventListener("change", function() {
    let checkboxes = document.querySelectorAll(".select-individual");
    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
  });

     document.addEventListener("DOMContentLoaded", function() {
    let birdLive = document.getElementById("bird_live");
    let birdDie = document.getElementById("bird_die");
    let birdLiveContent = document.getElementById("birdLiveContent");
    let birdDieContent = document.getElementById("birdDieContent");

    function toggleBirdContent() {
        if (birdLive.checked) {
            birdLiveContent.style.display = "block";
            birdDieContent.style.display = "none";
        } else {
            birdLiveContent.style.display = "none";
            birdDieContent.style.display = "block";
        }
    }

    // Agregar eventos para cambiar la visibilidad al seleccionar los radio buttons
    birdLive.addEventListener("change", toggleBirdContent);
    birdDie.addEventListener("change", toggleBirdContent);

    // Establecer visibilidad correcta al cargar la página
    toggleBirdContent();
});

</script>






</main>

<?php include_once BASE_URL . "/paginas/pie_3.php"; ?>