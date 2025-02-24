<?php $id_insertado = $_GET['id_insertado'] ?>
<tr>
   <td>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="basic_behavioral_<?php echo $id_insertado ?>" name="basic_behavioral" onclick="toggleBehaviorOptions()_<?php echo $id_insertado ?>">
        <label class="form-check-label" for="basic_behavioral_<?php echo $id_insertado ?>">Basic Behavioral</label>
    </div>
</td>
<!-- Aquí aparecerán las opciones de comportamiento -->
<td id="behavior_options_<?php echo $id_insertado ?>"></td>

</tr>
<!-- Social Interactions -->
<tr>
    <td>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="social_interactions_<?php echo $id_insertado ?>" name="social_interactions" onclick="toggleSocialOptions()_<?php echo $id_insertado ?>">
            <label class="form-check-label" for="social_interactions_<?php echo $id_insertado ?>">Social Interactions</label>
        </div>
    </td>
    <!-- Aquí aparecerán las opciones de interacción social -->
    <td id="social_options_<?php echo $id_insertado ?>"></td>
</tr>
<!-- Responses to Environment -->
<tr>
 <td>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="responses_environment_<?php echo $id_insertado ?>_<?php echo $id_insertado ?>" name="responses_environment" onclick="toggleEnvironmentResponses()_<?php echo $id_insertado ?>">
        <label class="form-check-label" for="responses_environment_<?php echo $id_insertado ?>_<?php echo $id_insertado ?>">Responses to Environment</label>
    </div>
</td>
<!-- Aquí aparecerán las opciones de respuestas al ambiente -->
<td id="environment_options_<?php echo $id_insertado ?>"></td>
</tr>
<!-- Feeding Behaviors -->
<tr>
   <td>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="feeding_behaviors_<?php echo $id_insertado ?>" name="feeding_behaviors" onclick="toggleFeedingBehaviors()_<?php echo $id_insertado ?>">
        <label class="form-check-label" for="feeding_behaviors_<?php echo $id_insertado ?>">Feeding Behaviors</label>
    </div>
</td>
<!-- Aquí aparecerán las opciones de alimentación -->
<td id="feeding_options_<?php echo $id_insertado ?>"></td>
</tr>
<tr>
    <td>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="pathological_behaviors_<?php echo $id_insertado ?>" name="pathological_behaviors" onclick="togglePathologicalBehaviors()_<?php echo $id_insertado ?>">
            <label class="form-check-label" for="pathological_behaviors_<?php echo $id_insertado ?>">Pathological Behaviors</label>
        </div>
    </td>
    <!-- Aquí aparecerán las opciones de comportamientos patológicos -->
    <td id="pathological_options_<?php echo $id_insertado ?>"></td>
</tr>

