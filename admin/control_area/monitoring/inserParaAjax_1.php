<div class='custom-html'>
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



    <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'> 
        <h1 class='h2 text-center'>Insert Monitoring for individual N° 0000<?php echo $id ?></h1>
        <ol class='breadcrumb float-sm-right text-center'><h2>Monitoring Individual N° 0000<?php echo $id_insertado ?></h2></ol>
    </div>

            <div class='col-12'>
                
                    <!-- ORIGIN TYPE -->
                    <div class='card mb-12'>
                        <div class='card-header text-center'>
                            <h3><strong>Time <?php echo date('h:i:s a') ?></strong></h3>
                        </div>
                        
                    </div>
                    <input id='id_staff_<?php echo $id_insertado ?>' type='hidden' name='id_staff[]' value='<?php echo $id_staff ?>'>
                     <input id='species_<?php echo $id_insertado ?>' type='hidden' name='species[]' value='<?php echo $id ?>'>
                            

                    <div class='card mb-12'>
                        <div class='card-header text-center'>
                          <h3><strong>External Distutbance</strong></h3>
                      </div>
                      <div class='card-body'>
                          <div class='d-flex justify-content-center'>
                             <div class='row'>
                               <input id='id_individual_mon<?php echo $id_insertado ?>' type='hidden' value={$id} name='id_individual_mon[]' required>

                               <div class='custom-control custom-radio col-12 col-lg-2 offset-lg-1'>
                                <input class='custom-control-input' type='radio' value='1' id='external_1<?php echo $id_insertado ?>' name='id_external_distutbance[]' checked required>
                                <label for='external_1<?php echo $id_insertado ?>' class='custom-control-label' ondblclick="toggleTextarea(this)" data-text='Completely quiet environment, no nearby noises or movements. /  Ambiente completamente tranquilo, sin ruidos ni movimientos cercanos.'>1. No external disturbances</label>
                                <!-- Aquí aparecerá el textarea -->
                            </div>
                            <div class='custom-control custom-radio col-12 col-lg-2'>
                                <input class='custom-control-input' type='radio' value='2' id='external_2<?php echo $id_insertado ?>' name='id_external_distutbance[]' required>
                                <label for='external_2<?php echo $id_insertado ?>' class='custom-control-label' ondblclick="toggleTextarea(this)" data-text='Weak noises or human/animal activity in the distance, with no impact on bird behavior. / Ruidos o actividad humana/animal débil en la distancia, sin afectar el comportamiento de las aves.'>2. Slight distant disturbances</label>
                            </div>
                            <div class='custom-control custom-radio col-12 col-lg-2'>
                                <input class='custom-control-input' type='radio' value='3' id='external_3<?php echo $id_insertado ?>' name='id_external_distutbance[]' required>
                                <label for='external_3<?php echo $id_insertado ?>' class='custom-control-label' ondblclick="toggleTextarea(this)" data-text='Medium-intensity sounds or occasional movement near the facility (e.g., people passing by, occasional vehicle noise, nearby wildlife activity). Birds may show slight behavioral changes. / Sonidos de media intensidad o movimiento ocasional cerca de la instalación (ej. paso de personas, ruidos de vehículos no constantes, actividad de otras especies cerca). Puede haber leves cambios en el comportamiento de las aves.'>3. Moderate disturbances</label> 
                            </div>
                            <div class='custom-control custom-radio col-12 col-lg-2'>
                                <input class='custom-control-input' type='radio' value='4' id='external_4<?php echo $id_insertado ?>' name='id_external_distutbance[]' required>
                                <label for='external_4<?php echo $id_insertado ?>' class='custom-control-label' ondblclick="toggleTextarea(this)" data-text='Loud or constant noises (nearby construction, heavy traffic, frequent visitors), presence of predators, or close human activity causing stress in birds. Behavioral alterations are observed. / Molestias considerables. Ruidos fuertes o constantes (construcción cercana, tráfico intenso, visitas frecuentes), presencia de depredadores o actividad humana cercana que genera estrés en las aves. Se observan alteraciones en su conducta.'>4. Considerable disturbances</label>
                            </div>
                            <div class='custom-control custom-radio col-12 col-lg-2'>
                                <input class='custom-control-input' type='radio' value='5' id='external_5<?php echo $id_insertado ?>' name='id_external_distutbance[]' required>
                                <label for='external_5<?php echo $id_insertado ?>' class='custom-control-label' ondblclick="toggleTextarea(this)" data-text='Very high noise levels or constant movement near the facility (intense construction, direct predator presence, people within visual or physical proximity to enclosures). Observations may be interrupted, or birds may attempt to escape. /  Nivel de ruido muy alto o movimiento constante cerca de la instalación (obras intensas, presencia de depredadores directos, personas en contacto visual o físico con las jaulas). Puede interrumpir la observación o provocar reacciones de escape en las aves.'>5. Severe disturbances or extreme disruption</label>
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
                            <input class='form-check-input' type='radio' value='1' id='interior_1<?php echo $id_insertado ?>' name='id_observer_1[]' checked>
                            <label for='interior_1<?php echo $id_insertado ?>'  ondblclick="toggleTextarea(this)" data-text='Indicates that the monitoring is conducted from the interior corridor / 
                            Indica que el monitoreo se realiza desde el pasillo interior.'>1. Interior</label>
                        </div>
                    </div>
                    <div class='col-12 col-lg-6 d-flex justify-content-center'>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' value='2' id='exterior_2<?php echo $id_insertado ?>' name='id_observer_1[]' >
                            <label for='exterior_2<?php echo $id_insertado ?>'  ondblclick="toggleTextarea(this)" data-text=' Indicates that the monitoring is conducted from outside the cages / Indica que el monitoreo se realiza desde el exterior de las jaulas.'>2. Exterior</label>
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
                <input class='custom-control-input' type='radio' value='6' id='control_<?php echo $id_insertado ?>' name='id_control_type' required onclick="loadContent('routineControlAjax.php?id_insertado=<?php echo $id_insertado ?>')">
                <label for='control_<?php echo $id_insertado ?>' class='custom-control-label'>1. Routine Control</label>
            </div>
            <div class='custom-control custom-radio col-12 col-lg-4'>
                <input class='custom-control-input' type='radio' value='7' id='control_<?php echo $id_insertado ?>' name='id_control_type' required onclick="loadContent('reproductiveControl.php')">
                <label for='control_<?php echo $id_insertado ?>' class='custom-control-label'>2. Reproductive Control</label>
            </div>
            <div class='custom-control custom-radio col-12 col-lg-3'>
                <input class='custom-control-input' type='radio' value='8' id='control_<?php echo $id_insertado ?>' name='id_control_type' required onclick="loadContent('chickenControl.php')">
                <label for='control_<?php echo $id_insertado ?>' class='custom-control-label'>3. Chicken Control</label>
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
            <tbody id='controlContent_<?php echo $id_insertado ?>'>
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
            <label for='photo_upload<?php echo $id_insertado ?>'>Upload Monitoring Photos</label>
            <input type='file' class='form-control' id='photo_upload<?php echo $id_insertado ?>' name='photo_upload' multiple>
        </div>
        <div class='form-group'>
            <label for='document_upload<?php echo $id_insertado ?>'>Upload Monitoting Documents</label>
            <input type='file' class='form-control' id='document_upload<?php echo $id_insertado ?>' name='document_upload' multiple>
        </div>
    </div>
</div>

<div class='card mb-12'>
    <div class='card-header text-center'>
        <h3><strong>OBSERVATIONS</strong></h3>
    </div>
    <div class='card-body'>
        <div class='form-group'>
            <label for='conclusions_text_2<?php echo $id_insertado ?>'>Notes</label>
            <textarea class='form-control' id='conclusions_text_2<?php echo $id_insertado ?>' name='conclusions_text_2' rows='3'></textarea>
        </div>
    </div>
</div>
            </div>