<?php $idTable = $_GET['idTable']; ?>
<tr>
   <td>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="basic_behavioral_<?php echo $idTable ?>" name="basic_behavioral[<?php echo $idTable ?>]" onclick="toggleBehaviorOptions(<?php echo $idTable ?>)">
        <label class="form-check-label" for="basic_behavioral_<?php echo $idTable ?>">Basic Behavioral</label>
    </div>
</td>
<!-- Aquí aparecerán las opciones de comportamiento -->
<td id="behavior_options_<?php echo $idTable ?>"></td>

</tr>
<!-- Social Interactions -->
<tr>
    <td>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="social_interactions_<?php echo $idTable ?>" name="social_interactions[<?php echo $idTable ?>]" onclick="toggleSocialOptions(<?php echo $idTable ?>)">
            <label class="form-check-label" for="social_interactions_<?php echo $idTable ?>">Social Interactions</label>
        </div>
    </td>
    <!-- Aquí aparecerán las opciones de interacción social -->
    <td id="social_options_<?php echo $idTable ?>"></td>
</tr>
<!-- Responses to Environment -->
<tr>
 <td>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="responses_environment_<?php echo $idTable ?>" name="responses_environment[<?php echo $idTable ?>]" onclick="toggleEnvironmentResponses(<?php echo $idTable ?>)">
        <label class="form-check-label" for="responses_environment_<?php echo $idTable ?>">Responses to Environment</label>
    </div>
</td>
<!-- Aquí aparecerán las opciones de respuestas al ambiente -->
<td id="environment_options_<?php echo $idTable ?>"></td>
</tr>
<!-- Feeding Behaviors -->
<tr>
   <td>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="feeding_behaviors_<?php echo $idTable ?>" name="feeding_behaviors[<?php echo $idTable ?>]" onclick="toggleFeedingBehaviors(<?php echo $idTable ?>)">
        <label class="form-check-label" for="feeding_behaviors_<?php echo $idTable ?>">Feeding Behaviors</label>
    </div>
</td>
<!-- Aquí aparecerán las opciones de alimentación -->
<td id="feeding_options_<?php echo $idTable ?>"></td>
</tr>
<tr>
    <td>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="pathological_behaviors_<?php echo $idTable ?>" name="pathological_behaviors[<?php echo $idTable ?>]" onclick="togglePathologicalBehaviors(<?php echo $idTable ?>)">
            <label class="form-check-label" for="pathological_behaviors_<?php echo $idTable ?>">Pathological Behaviors</label>
        </div>
    </td>
    <!-- Aquí aparecerán las opciones de comportamientos patológicos -->
    <td id="pathological_options_<?php echo $idTable ?>"></td>
</tr>

