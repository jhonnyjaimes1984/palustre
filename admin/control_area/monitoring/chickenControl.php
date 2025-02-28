<?php $idTable = $_GET['idTable']; ?>
<tr>
    <td>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="chicken_nest_behaviors_<?php echo $idTable ?>" name="chicken_nest_behaviors" onchange="toggleChickenNestBehaviors(<?php echo $idTable ?>)">
            <label class="form-check-label" for="chicken_nest_behaviors_<?php echo $idTable ?>">Chicken Nest Behaviors</label>
        </div>
    </td>
    <td id="chicken_nest_behaviors_options_<?php echo $idTable ?>"></td>
</tr>

<tr>
    <td>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="chicken_fledglings_behaviors_<?php echo $idTable ?>" name="chicken_fledglings_behaviors" onchange="toggleChickenFledglingsBehaviors(<?php echo $idTable ?>)">
            <label class="form-check-label" for="chicken_fledglings_behaviors_<?php echo $idTable ?>">Chicken Fledglings Behaviors</label>
        </div>
    </td>
    <td id="chicken_fledglings_behaviors_option_<?php echo $idTable ?>"></td>
</tr>

<tr>
     <td>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="chicken_attack_behaviors_<?php echo $idTable ?>" name="chicken_attack_behaviors" onchange="toggleChickenAttackBehaviors(<?php echo $idTable ?>)">
            <label class="form-check-label" for="chicken_attack_behaviors_<?php echo $idTable ?>">Chicken Attack Behaviors</label>
        </div>
    </td>
    <td id="chicken_attack_behaviors_options_<?php echo $idTable ?>"></td>
</tr>
<tr>
   <td>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="juvenil_behaviors_<?php echo $idTable ?>" name="juvenil_behaviors" onchange="toggleJuvenilBehaviors(<?php echo $idTable ?>)">
            <label class="form-check-label" for="juvenil_behaviors_<?php echo $idTable ?>">Juvenil Behaviors</label>
        </div>
    </td>
    <td id="juvenil_behaviors_options_<?php echo $idTable ?>"></td>
</tr>