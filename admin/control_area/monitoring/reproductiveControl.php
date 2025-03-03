<?php $idTable = $_GET['idTable']; ?>
<tr>
    <td>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="sexual_behaviors_<?php echo $idTable ?>" name="sexual_behaviors[<?php echo $idTable ?>]" onchange="toggleSexualBehaviors(<?php echo $idTable ?>)">
            <label class="form-check-label" for="sexual_behaviors_<?php echo $idTable ?>">Sexual Behaviors</label>
        </div>
    </td>

    <td id="sexual_behaviors_options_<?php echo $idTable ?>">
        <!-- Aquí se cargarán dinámicamente las opciones -->
    </td>
    
</tr>
<tr>
 <td>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="copulation_behaviors_<?php echo $idTable ?>" name="copulation_behaviors[<?php echo $idTable ?>]" onchange="toggleCopulationBehaviors(<?php echo $idTable ?>)">
        <label class="form-check-label" for="copulation_behaviors_<?php echo $idTable ?>">Copulation Behaviors</label>
    </div>
</td>

<td id="copulation_behaviors_options_<?php echo $idTable ?>">
    <!-- Aquí se cargarán dinámicamente las opciones -->
</td>

</tr>
<tr>
    <td>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="nest_behaviors_<?php echo $idTable ?>" name="nest_behaviors[<?php echo $idTable ?>]" onchange="toggleNestBehaviors(<?php echo $idTable ?>)">
            <label class="form-check-label" for="nest_behaviors_<?php echo $idTable ?>">Nest Behaviors</label>
        </div>
    </td>
    <td id="nest_behaviors_options_<?php echo $idTable ?>"></td>
</tr>

<tr>
    <td>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="incubation_behaviors_<?php echo $idTable ?>" name="incubation_behaviors[<?php echo $idTable ?>]" onchange="toggleIncubationBehaviors(<?php echo $idTable ?>)">
            <label class="form-check-label" for="incubation_behaviors_<?php echo $idTable ?>">Incubation Behaviors</label>
        </div>
    </td>
    <td id="incubation_behaviors_options_<?php echo $idTable ?>"></td>
</tr>
