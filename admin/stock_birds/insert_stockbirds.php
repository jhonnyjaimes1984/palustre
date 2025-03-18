<?php include_once "../../conf/Config.php"; 

include_once BASE_URL . "/paginas/cabecera_segundo_nivel.php"; 


$sentencia_insert = $db->query("SELECT COUNT(*) as total FROM individuals");
$row_insert = $sentencia_insert->fetch_assoc(); 
$itemData_insert = array('n_individual' => $row_insert['total']);
$conteo = $itemData_insert['n_individual'] + 1;


?>

<script type="text/javascript" src="../validator/vendor/jquery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../validator/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../validator/dist/js/bootstrapValidator.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<main role="main" class="content-wrapper"> 
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> 
    <h1 class="h2">Insert Individual</h1>
    <ol class="breadcrumb float-sm-right"><h2>Individual N° 0000<?php echo $conteo ?></h2></ol>
  </div>

  <div class="content-header">
    <div class="container-fluid">
      <div class="col-12">
        <form method="post" action="new_individual.php" enctype="multipart/form-data" id="form_insert">
          <!-- ORIGIN TYPE -->
          <div class="card mb-4">
            <div class="card-header text-center">
              <h3><strong>Origin Type</strong></h3>
            </div>
            <div class="card-body text-center">
              <div class="row">
                <div class="custom-control custom-radio col-lg-4">
                  <input type="hidden" value="<?php echo $conteo ?>"  name="id_individual" required>
                  <input class="custom-control-input" type="radio" value="1" id="mostrar_1" name="origin_type" required>
                  <label for="mostrar_1" class="custom-control-label">Born Center</label>
                </div>
                <div class="custom-control custom-radio col-lg-4">
                  <input class="custom-control-input" type="radio" value="0" id="ocultar_1" name="origin_type" required>
                  <label for="ocultar_1" class="custom-control-label">Capture</label>
                </div>
                <div class="custom-control custom-radio col-lg-4">
                  <input class="custom-control-input" type="radio" value="2" id="ocultar_2" name="origin_type" required>
                  <label for="ocultar_2" class="custom-control-label">Transfer</label>
                </div>
              </div>
              <div class="invalid-feedback">Select an option.</div>
            </div>
          </div>

          <!-- ORIGIN -->
          <div class="card mb-4">
            <div class="card-header text-center">
              <h3><strong>Origin</strong></h3>
            </div>
            <div class="card-body">

              <div class="row">
                <div class="form-group col-lg-4">
                  <label for="comauto"><strong>Autonomous Community:</strong></label>
                  <select name="comauto" id="comauto" class="form-control" required>
                    <option value="">Select Autonomous Community</option>
                    <?php 
                    $peticion = $base_de_datos->query("SELECT * FROM cod_comauto");
                    $tipos = $peticion->fetchAll(PDO::FETCH_OBJ);
                    foreach($tipos as $tipo) { ?>
                      <option value="<?php echo $tipo->id_comauto ?>"><?php echo $tipo->nombre_comauto ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-lg-4">
                  <label for="province"><strong>Province/Isle:</strong></label>
                  <select name="province" id="province" class="form-control" required>
                    <option value="">Select Province/Isle</option>
                  </select>
                </div>
                <div class="form-group col-lg-4">
                  <label for="locality"><strong>Locality:</strong></label>
                  <select name="locality" id="locality" class="form-control" required>
                    <option value="">Select Locality</option>
                  </select>

                  <script>
                          $(document).ready(function(e){
                            $("#comauto").change(function(){
                              var parametros= "id="+$("#comauto").val();
                              $.ajax({
                                data: parametros,
                                url: 'ajax_auto.php',
                                type: 'post',
                                beforeSend: function (){},
                                success: function(response){
                                  $("#province").html(response);

                                }
                              });

                            }) 

                            $("#province").change(function(){
                              var parametros= "id="+$("#province").val();
                              $.ajax({
                                data: parametros,
                                url: 'ajax_province.php',
                                type: 'post',
                                beforeSend: function (){},
                                success: function(response){
                                  $("#locality").html(response);

                                }
                              });

                            }) 
                          }) 

                        </script>

                </div>
                 <div class="form-group col-lg-4">
  <label for="born" id="msgid12"><strong>Born Center:</strong></label>
  <input class="form-control" name="born" type="text" placeholder="Insert Born Center" id="msgid13" value="">
  <div class="valid-feedback">Valid</div>
  <div class="invalid-feedback">Invalid</div>
</div>

<div class="form-group col-lg-4">
  <label for="zepa" id="msgid16"><strong>P.N/Zepa:</strong></label>
  <input class="form-control" name="zepa" type="text" placeholder="Insert P.N/zepa" id="msgid17" value="">
  <div class="valid-feedback">Valid</div>
  <div class="invalid-feedback">Invalid</div>
</div>

<div class="form-group col-lg-4">
  <label for="transfer" id="msgid14"><strong>Transfer Center:</strong></label>
  <input class="form-control" name="transfer" type="text" placeholder="Insert Transfer Center" id="msgid15" value="">
  <div class="valid-feedback">Valid</div>
  <div class="invalid-feedback">Invalid</div>
</div>



              </div>
            </div>
          </div>

          <!-- INDIVIDUAL DETAILS -->
          <div class="card mb-4">
            <div class="card-header text-center">
              <h3><strong>Individual Details</strong></h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="form-group col-lg-4">
                  <label for="species"><strong>Species:</strong></label>
                  <select name="species" class="form-control" required>
                    <option value=''>Select Bird Specie</option>
                    <?php 
                    $sentencia_species = $base_de_datos->query("SELECT * FROM species;");
                    $species = $sentencia_species->fetchAll(PDO::FETCH_OBJ);
                    foreach($species as $specie) { ?>
                      <option value='<?php echo $specie->id_species ?>'><?php echo $specie->scientific_name ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group col-lg-4">
                  <label for="nickname"><strong>Nickname:</strong></label>
                  <input class="form-control" name="nickname" pattern="^(?=.*[A-Za-z0-9ñÑ]).{3,}$" type="text" placeholder="Insert nickname">
                  <div class="valid-feedback">Valid</div>
                  <div class="invalid-feedback">Invalid</div>
                </div>

                <div class="form-group col-lg-4">
                  <label for="Genetic_code"><strong>Genetic Code:</strong></label>
                  <input class="form-control" name="Genetic_code" pattern="^(?=.*[A-Za-z0-9ñÑ]).{1,}$" type="text" placeholder="Insert Genetic Code">
                  <div class="valid-feedback">Valid</div>
                  <div class="invalid-feedback">Invalid</div>
                </div>

<div class="form-group col-lg-6">
  <label for="id_egg" id="msgid01"><strong>Id Egg:</strong></label>
  <input class="form-control" name="id_egg" type="text" placeholder="Insert Id Egg" id="msgid0" value="--">
  <div class="valid-feedback">Valid</div>
  <div class="invalid-feedback">Invalid</div>
</div>

<div class="form-group col-lg-6">
  <label for="id_pair" id="msgid11"><strong>Id Parents:</strong></label>
  <input class="form-control" name="id_pair" type="text" placeholder="Insert Id Parents" id="msgid1" value="--">
  <div class="valid-feedback">Valid</div>
  <div class="invalid-feedback">Invalid</div>
</div>


              </div>
            </div>
          </div>

          <!-- ADDITIONAL DETAILS -->
          <div class="card mb-4">
            <div class="card-header text-center">
              <h3><strong>Additional Details</strong></h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="form-group col-lg-3">
                  <label for="capture_date"><strong>Capture/Entry Date:</strong></label>
                  <input class="form-control" id="capture_date" name="capture_date" type="date" placeholder="YYYY-MM-DD" required>
                </div>
                <div class="form-group col-lg-3">
                  <label for="sex"><strong>Sex:</strong></label>
                  <select name="sex" id="sex" class="form-control" required>
                    <option value='0'>Indeterminate</option>
                    <option value='1'>Male</option>
                    <option value='2'>Female</option>
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label for="year"><strong>Year:</strong></label>
                  <input class="form-control" id="year" name="year" type="number" placeholder="YYYY" min="1900" max="2100" required>
                </div>
                <div class="form-group col-lg-3">
                  <label for="status"><strong>Status:</strong></label>
                  <select name="status" id="status" class="form-control" required>
                    <option value=''>Select status</option>
                    <option value='Breeder'>Breeder</option>
                    <option value='Juvenile'>Juvenile</option>
                    <option value='No_breeder'>No Breeder</option>
                    <option value='Forest'>Forest</option>
                    <option value='Genetically_excluded'>Genetically excluded</option>
                    <option value='Die'>Die</option>
                    <option value='Released'>Released</option>

                  </select>
                </div>
            
        
      </div>
    </div>
  </div>


   <div class="card mb-4">
            <div class="card-header text-center">
              <h3><strong>Facility Assignment</strong></h3>
            </div>
            <div class="card-body">
              
                <div class="form-group col-12">
                  <label for="Facility"><strong>Facility:</strong></label>
                   <?php 
                    $s = 1;
                    $sentencia_assi = $base_de_datos->prepare("SELECT max(id_assignment) as max FROM facility_assignment where ?");
                    $sentencia_assi->execute([$s]);
                    $assi = $sentencia_assi->fetch(PDO::FETCH_OBJ);

                    $numero = $assi->max + 1; ?>
                     <input class="form-control" id="Facility" name="Facility" type="hidden" value="<?php echo $numero ?>">
                  <select name="Facility_assi" id="Facility_assi" class="form-control">
                    <?php
                    $sentencia_assi_1 = $base_de_datos->query("SELECT * FROM facilities");
                    $assi = $sentencia_assi_1->fetchAll(PDO::FETCH_OBJ);
                    ?>

                    <option value=''>Select Facility</option>
                     <?php foreach($assi as $individual_assi){ ?>
                    <option value='<?php echo $individual_assi->id_facility ?>'><?php echo $individual_assi->name_facility ?></option>
                    <?php  } ?>
                  </select>
                </div>
               
                
        
      </div>
    </div>
  </div>



  <!-- LEG RINGS -->
          <div class="card mb-4">
            <div class="card-header text-center">
              <h3><strong>Data Ring</strong></h3>
            </div>
            <div class="card-body">
            
<div class="row">
  <!-- Información de la pata izquierda -->
  <div class="col-lg-6 text-center">
    <h5><strong>Left Leg</strong></h5>
    <div class="form-group">
      <label for="left_ring"><strong>Does it have a ring?:</strong></label>
      <select name="left_ring" id="left_ring" class="form-control"  onchange="toggleLeftLegQuestions()">
        
        <option value="0">No</option>
        <option value="1">Yes</option>
      </select>
    </div>
    <div id="left_leg_questions" style="display: none;">
      <label for="left_type"><strong>Type:</strong></label>
      <select name="left_type" id="left_type" class="form-control">
        <option value=''></option>
        <option value='Steel'>Steel</option>
        <option value='PVC'>PVC</option>
        <option value='Aluminium'>Aluminium</option>
      </select>

      <label for="left_color"><strong>Ring Color:</strong></label>
      <select name="left_color" id="left_color" class="form-control">
        <option value=''></option>
        <option value='Red'>Red</option>
        <option value='White'>White</option>
        <option value='Dark Green'>Dark Green</option>
        <option value='Pistachio Green'>Pistachio Green</option>
        <option value='Black'>Black</option>
        <option value='Metal'>Metal</option>
        <option value='Yellow'>Yellow</option>
        <option value='Light Blue'>Light Blue</option>
        <option value='Orange'>Orange</option>
        <option value='Pink'>Pink</option>
        <option value='Light Pink'>Light Pink</option>
        <option value='Blue'>Blue</option>
        <option value='Violet'>Violet</option>
        <option value='Gray'>Gray</option>
        <option value='Brown'>Brown</option>
        <option value='Other Color'>Other Color</option>
 </select>
      <label for="left_letter"><strong>Letter Color:</strong></label>
      <select name="left_letter" id="left_letter" class="form-control">
        <option value=''></option>
        <option value='black'>Black</option>
        <option value='white'>White</option>
      </select>

      <label for="left_number_code"><strong>Number Code:</strong></label>
      <input class="form-control" name="left_number_code" pattern="^(?=.*[A-Za-z0-9ñÑ]).{1,}$" type="text" id="left_number_code" placeholder="Insert Number Code">
      <div class="valid-feedback">True</div>
      <div class="invalid-feedback">False</div>
    </div>
  </div>

  <!-- Información de la pata derecha -->
  <div class="col-lg-6 text-center">
    <h5><strong>Right Leg</strong></h5>
    <div class="form-group">
      <label for="right_ring"><strong>Does it have a ring?:</strong></label>
      <select name="right_ring" id="right_ring" class="form-control"  onchange="toggleRightLegQuestions()">
       
        <option value="0">No</option>
        <option value="1">Yes</option>
      </select>
    </div>
    <div id="right_leg_questions" style="display: none;">
      <label for="right_type"><strong>Type:</strong></label>
      <select name="right_type" id="right_type" class="form-control">
        <option value=''></option>
        <option value='Steel'>Steel</option>
        <option value='PVC'>PVC</option>
        <option value='Aluminium'>Aluminium</option>
      </select>

      <label for="right_color"><strong>Ring Color:</strong></label>
      <select name="right_color" id="right_color" class="form-control">
        <option value=''></option>
        <option value='Red'>Red</option>
        <option value='White'>White</option>
        <option value='Dark Green'>Dark Green</option>
        <option value='Pistachio Green'>Pistachio Green</option>
        <option value='Black'>Black</option>
        <option value='Metal'>Metal</option>
        <option value='Yellow'>Yellow</option>
        <option value='Light Blue'>Light Blue</option>
        <option value='Orange'>Orange</option>
        <option value='Pink'>Pink</option>
        <option value='Light Pink'>Light Pink</option>
        <option value='Blue'>Blue</option>
        <option value='Violet'>Violet</option>
        <option value='Gray'>Gray</option>
        <option value='Brown'>Brown</option>
        <option value='Other Color'>Other Color</option>
      </select>

      <label for="right_letter"><strong>Letter Color:</strong></label>
      <select name="right_letter" id="right_letter" class="form-control">
        <option value=''></option>
        <option value='black'>Black</option>
        <option value='white'>White</option>
      </select>

      <label for="right_number_code"><strong>Number Code:</strong></label>
      <input class="form-control" name="right_number_code" pattern="^(?=.*[A-Za-z0-9ñÑ]).{1,}$" type="text" id="right_number_code" placeholder="Insert Number Code">
      <div class="valid-feedback">True</div>
      <div class="invalid-feedback">False</div>
    </div>
  </div>
</div>

<script>
  function toggleLeftLegQuestions() {
    const hasRing = document.getElementById("left_ring").value === "1";
    document.getElementById("left_leg_questions").style.display = hasRing ? "block" : "none";
  }

  function toggleRightLegQuestions() {
    const hasRing = document.getElementById("right_ring").value === "1";
    document.getElementById("right_leg_questions").style.display = hasRing ? "block" : "none";
  }
</script>

</script>
 </div>
</div>
<!-- NOTES SECTION -->
          <div class="card mb-4">
            <div class="card-header text-center">
    <h3><strong>Notes</strong></h3>
  </div>
  <div class="card-body">
    <div class="form-group">
      <label for="notes"><strong>Comments or Observations:</strong></label>
      <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Add any additional information or observations"></textarea>
    </div>
  </div>
</div>

<!-- ATTACHMENTS SECTION -->
 <div class="card mb-4">
  <div class="card-header text-center">
    <h3><strong>Attachments</strong></h3>
  </div>
  <div class="card-body">
    <div class="row">
      <!-- Campo para subir documentos -->
<div class="form-group col-lg-6 col-12">
  <label for="documents"><strong>Upload Documents</strong></label>
  <input type="file" class="form-control-file" id="documents" name="documents[]" accept=".pdf,.doc,.docx,.xls,.xlsx,.mdb,.accdb" multiple onchange="validateFiles(this, 'document')">
  <small class="form-text text-muted">You can upload multiple files. Accepted formats: PDF, DOC, DOCX, XLS, XLSX, MDB, ACCDB.</small>
</div>

<div class="form-group col-lg-6 col-12">
  <label for="photos"><strong>Upload Photos</strong></label>
  <input type="file" class="form-control-file" id="photos" name="photos[]" accept=".jpg,.jpeg,.png, .pdf" multiple onchange="validateFiles(this, 'image')">
  <small class="form-text text-muted">You can upload multiple files. Accepted formats: JPG, JPEG, PNG.</small>
</div>

<script>
  function validateFiles(input, type) {
    const allowedExtensions = {
      document: ['.pdf', '.doc', '.docx', '.xls', '.xlsx', '.mdb', '.accdb'],
      image: ['.jpg', '.jpeg', '.png']
    };

    const files = input.files;
    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      const fileExtension = file.name.substring(file.name.lastIndexOf('.')).toLowerCase();
      if (!allowedExtensions[type].includes(fileExtension)) {
        alert(`The file "${file.name}" is not a valid ${type === 'document' ? 'document' : 'image'}. Please select files with the following extensions: ${allowedExtensions[type].join(', ')}`);
        input.value = ''; // Clear the input field
        return;
      }
    }
  }
</script>

    </div>
  </div>
</div>



</div>
</div>

              
          <div class="row">
          <div class="form-group col-lg-4">
          <input class="btn btn-info col-lg-12" type="submit" value="Save" onclick="return confirm('Do you confirm saving the entered record?')">
          </div>
          <div class="form-group col-lg-4">
          <a class="btn btn-warning col-lg-12" href="stock_birds.php" >Cancel</a>
        </div>
          <div class="form-group col-lg-4">
           <button type="button" class="btn btn-secondary  col-lg-12" onclick="printReport()">Print Report</button>
          </div>
        </div>
          <br>
 <main/>     
          
        </div>

        </form>
      </div>
    </div>


  <script>
$(document).ready(function () {
    // Ajustar visibilidad y validación al cargar la página
    const selectedValue = $("input[name='origin_type']:checked").val();
    toggleFields(selectedValue);

    // Cambiar visibilidad y validación al cambiar la opción seleccionada
    $("input[name='origin_type']").on("change", function () {
        const selectedValue = $(this).val();
        toggleFields(selectedValue);
    });

    function toggleFields(selectedValue) {
        // Lista de campos a controlar
        const fields = {
            born: "#msgid13", // Born Center
            zepa: "#msgid17", // P.N/Zepa
            transfer: "#msgid15", // Transfer Center
            id_egg: "#msgid0", // ID Egg
            id_parents: "#msgid1" // ID Parents
        };

        // Ocultar y desactivar todos los campos
        Object.values(fields).forEach(function (field) {
            $(field).parent().hide(); // Ocultar el contenedor
            $(field).val("").prop("required", false); // Valor predeterminado y sin validación
        });

        // Mostrar y activar campos según la opción seleccionada
        if (selectedValue == "1") {
            // Born Center: Mostrar y activar id_egg, id_parents, y born
            $(fields.born).parent().show().find("input").val("").prop("required", false);
            $(fields.id_egg).parent().show().find("input").val("").prop("required", false);
            $(fields.id_parents).parent().show().find("input").val("").prop("required", false);
        } else if (selectedValue == "0") {
            // Capture: Mostrar y activar zepa
            $(fields.zepa).parent().show().find("input").val("").prop("required", false);
        } else if (selectedValue == "2") {
            // Transfer: Mostrar y activar transfer
            $(fields.transfer).parent().show().find("input").val("").prop("required", false);
        }
    }
});



</script>

  
<script type="text/javascript">
  $(document).ready(function() {
    'use strict';
    window.addEventListener('load', function() {
    // fetch all the forms we want to apply custom style
    var inputs = document.getElementsByClassName('form-control')

    // loop over each input and watch blur event
    var validation = Array.prototype.filter.call(inputs, function(input) {

      input.addEventListener('blur', function(event) {
        // reset
        input.classList.remove('is-invalid')
        input.classList.remove('is-valid')

        if (input.checkValidity() === false) {
          input.classList.add('is-invalid')
        }
        else {
          input.classList.add('is-valid')
        }
    }, false);
    });
}, false);
  })()
</script>



<script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>

<script src="../dist/dashboard.js"></script>

<?php  include_once BASE_URL . "/paginas/pie_2.php";   ?>