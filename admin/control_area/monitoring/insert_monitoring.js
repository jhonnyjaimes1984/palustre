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

//  Ahora `loadContent()` recibe `tableNumber` y lo usa correctamente
function loadContent(file, tableCounter) {
    let contentDiv = document.getElementById(`controlContent_${tableCounter}`);
    if (!contentDiv) {
        console.error("No se encontró el div:", `controlContent_${tableCounter}`);
        return;
    }

    let xhr = new XMLHttpRequest();
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            contentDiv.innerHTML = xhr.responseText;
        }
    };
    
    xhr.open("GET", `${file}?idTable=${tableCounter}`, true);
    xhr.send();
}

    // 🔹 Ahora `toggleBehaviorOptions()` recibe `tableNumber` y lo usa correctamente
function toggleBehaviorOptions(tableCounter) {
    let checkbox = document.getElementById(`basic_behavioral_${tableCounter}`);
    let behaviorOptions = document.getElementById(`behavior_options_${tableCounter}`);

    if (checkbox.checked) {
        behaviorOptions.innerHTML = `
                <ul>
                    <li>
                        <input type="checkbox" id="normal_${tableCounter}" name="normal"> 
                        <label class="form-check-label" for="normal" ondblclick="toggleTextarea(this)" data-text="ESP/ Normal. The specimen exhibits expected behavior for its species (e.g., feeding, resting, exploring). El ejemplar muestra comportamientos esperados para la especie (e.g., alimentación, descanso, exploración)."> Normal</label>
                    </li>
                    <li>
                        <input type="checkbox" id="lethargic_${tableCounter}" name="lethargic">
                        <label class="form-check-label" for="lethargic" ondblclick="toggleTextarea(this)" data-text="ESP/ Letargico. Limited movement, lack of energy, or disinterest in the surroundings. Movimiento limitado, falta de energía o poco interés en el entorno."> Lethargic</label>
                    </li>
                    <li>
                        <input type="checkbox" id="aggressive_${tableCounter}" name="aggressive">
                        <label class="form-check-label" for="aggressive" ondblclick="toggleTextarea(this)" data-text="ESP/ Agresivo. Behaviors like pecking, attacking, or fighting with others. Conductas como picoteos, ataques o enfrentamientos con otros ejemplares."> Aggressive</label>
                    </li>
                    <li>
                        <input type="checkbox" id="evasive_${tableCounter}" name="evasive">
                        <label class="form-check-label" for="evasive" ondblclick="toggleTextarea(this)" data-text="ESP/Evasivo. Avoids visual or physical contact with caretakers or other animals. Evita el contacto visual o físico con cuidadores u otros animales."> Evasive</label>
                    </li>
                </ul>
            `;
        } else {
            behaviorOptions.innerHTML = ""; // Si se desmarca, borra el contenido
        }
    }

     function toggleSocialOptions(tableCounter) {
        let checkbox = document.getElementById(`social_interactions_${tableCounter}`);
        let socialOptions = document.getElementById(`social_options_${tableCounter}`);

        if (checkbox.checked) {
            socialOptions.innerHTML = `
                <ul>
                    <li>
                        <input type="checkbox" id="vocalizing_${tableCounter}" name="vocalizing"> 
                        <label class="form-check-label" for="vocalizing_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Vocalizaciones. Displays vocal behaviors such as singing, territorial calls, or attracting a mate. Muestra comportamientos vocales como canto, llamadas territoriales o atracción de pareja."> Vocalizing</label>
                    </li>
                    <li>
                        <input type="checkbox" id="sociable" name="sociable_${tableCounter}"> 
                        <label class="form-check-label" for="sociable_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Sociable. Positive interaction with other specimens in the enclosure. Interacción positiva con otros ejemplares en la jaula."> Sociable</label>
                    </li>
                    <li>
                        <input type="checkbox" id="dominant_${tableCounter}" name="dominant"> 
                        <label class="form-check-label" for="dominant_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Dominante. Displays controlling behavior over others (e.g., monopolizing food or space). Conductas de control sobre otros ejemplares (e.g., monopolización del alimento o territorio)."> Dominant</label>
                    </li>
                    <li>
                        <input type="checkbox" id="submissive_${tableCounter}" name="submissive"> 
                        <label class="form-check-label" for="submissive" ondblclick="toggleTextarea(this)" data-text="ESP/Sumiso. Displays submission behaviors toward dominant individuals. Conductas que indican sumisión hacia ejemplares dominantes."> Submissive</label>
                    </li>
                    <li>
                        <input type="checkbox" id="isolated_${tableCounter}" name="isolated"> 
                        <label class="form-check-label" for="isolated_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Aislado. The specimen voluntarily separates from the group. El ejemplar se separa voluntariamente del grupo."> Isolated</label>
                    </li>
                </ul>
            `;
        } else {
            socialOptions.innerHTML = ""; // Si se desmarca, borra el contenido
        }
    }

    function toggleEnvironmentResponses(tableCounter) {
        let checkbox = document.getElementById(`responses_environment_${tableCounter}`);
        let environmentOptions = document.getElementById(`environment_options_${tableCounter}`);

        if (checkbox.checked) {
            environmentOptions.innerHTML = `
                <ul>
                    <li>
                        <input type="checkbox" id="alert_${tableCounter}" name="alert"> 
                        <label class="form-check-label" for="alert_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Alerta. Displays a heightened state of vigilance due to fear, often in response to unfamiliar caretakers, sudden noises, or perceived threats. Muestra un estado elevado de vigilancia debido al miedo, a menudo en respuesta a cuidadores desconocidos, ruidos repentinos o amenazas percibidas."> Alert</label>
                    </li> 
                    <li>
                        <input type="checkbox" id="curious_${tableCounter}" name="curious"> 
                        <label class="form-check-label" for="curious_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Curioso. Actively investigates new objects or changes in the environment. Explora activamente nuevos objetos o cambios en el entorno."> Curious</label>
                    </li> 
                    <li>
                        <input type="checkbox" id="stressed_${tableCounter}" name="stressed"> 
                        <label class="form-check-label" for="stressed_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Estresado. Signs of stress such as excessive vocalizations, repetitive movements, or feather loss. Signos de estrés como vocalizaciones excesivas, movimientos repetitivos o pérdida de plumaje."> Stressed</label>
                    </li> 
                    <li>
                        <input type="checkbox" id="adaptive_${tableCounter}" name="adaptive"> 
                        <label class="form-check-label" for="adaptive_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Adaptado. Quickly adjusts to changes in the environment (e.g., new enclosure or companions). Se ajusta rápidamente a cambios en el ambiente (e.g., nueva jaula o compañía)."> Adaptive</label>
                    </li>
                    <li>
                        <div>
                            <label for="time_birds_movements"_${tableCounter}>Time Birds Movements:</label>
                            <input type="text" id="time_birds_movements_${tableCounter}" name="time_birds_movements" value="00:00:00" readonly>
                            <button type="button" onclick="startTimer('time_birds_movements')">Start</button>
                            <button type="button" onclick="stopTimer('time_birds_movements')">Stop</button>
                            <button type="button" onclick="resetTimer('time_birds_movements')">Reset</button>
                        </div>
                    </li>
                    <li>
                        <label for="num_movements">Number Movements</label>
                        <input type="number" class="form-control" placeholder="Number Movements" id="num_movements" name="num_movements">
                    </li>
                </ul>
            `;
        } else {
            environmentOptions.innerHTML = ""; // Si se desmarca, borra el contenido
        }
    }

     function toggleFeedingBehaviors(tableCounter) {
        let checkbox = document.getElementById(`feeding_behaviors_${tableCounter}`);
        let feedingOptions = document.getElementById(`feeding_options_${tableCounter}`);

        if (checkbox.checked) {
            feedingOptions.innerHTML = `
                <ul>
                    <li>
                        <input type="checkbox" id="search_wall_${tableCounter}" name="search_wall">  
                        <label class="form-check-label" for="search_wall_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Busca comida por las paredes y techo. The bird searches for food along the walls and ceiling of the enclosure, possibly pecking at insects or debris."> Search for Food on Walls and Ceiling</label>
                    </li>
                    <li>
                        <input type="checkbox" id="search_fliying_${tableCounter}_${tableCounter}" name="search_fliying"> 
                        <label class="form-check-label" for="search_fliying_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Busca comida cazando en vuelo. The bird captures food while flying, showing aerial hunting or catching insects in midair."> Search for Food While Flying</label>
                    </li>
                    <li>
                        <input type="checkbox" id="search_ground_${tableCounter}" name="search_ground"> Search for Feeding on the Ground
                    </li>
                    <li>
                        <input type="checkbox" id="search_cladium_${tableCounter}" name="search_cladium"> Search for Feeding in Cladium mariscus
                    </li>
                    <li>
                        <input type="checkbox" id="search_phragmites_${tableCounter}" name="search_phragmites"> Search for Feeding in Phragmites australis
                    </li>
                    <li>
                        <input type="checkbox" id="feed_at_feeder_${tableCounter}" name="feed_at_feeder"> 
                        <label class="form-check-label" for="feed_at_feeder" ondblclick="toggleTextarea(this)" data-text="ESP/Alimentarse en el comedero. Indicates that the bird feeds at a feeder during the observation period."> Feed at Feeder</label>
                    </li>
                    <li>
                        <input type="checkbox" id="food_dipping_${tableCounter}" name="food_dipping"> 
                        <label class="form-check-label" for="food_dipping_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Remojo alimento. Indicates that the bird picks up food items and immerses them in water before consumption."> Food Dipping</label>
                    </li>
                    <li>
                        <input type="checkbox" id="grif_smallstone_${tableCounter}" name="grif_smallstone"> 
                        <label class="form-check-label" for="grif_smallstone_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Grit o piedras pequeñas. Indicates that the bird is consuming grit or small stones from the ground."> Grif or Small Stone</label>
                    </li>
                    <li>
                        <input type="checkbox" id="seed_${tableCounter}" name="seed"> Seed
                    </li>
                    <li>
                        <input type="checkbox" id="insect_paste_${tableCounter}" name="insect_paste"> Insectivorous Paste
                    </li>
                    <li>
                        <input type="checkbox" id="insect_feeding_${tableCounter}" name="insect_feeding"> Insectivorous Feeding (asticot, tenebrio)
                    </li>
                    <li>
                        <input type="checkbox" id="breeding_paste_${tableCounter}" name="breeding_paste"> Breeding Paste
                    </li>
                    <li>
                        <input type="checkbox" id="perle_morbide_${tableCounter}" name="perle_morbide"> Perle Morbide
                    </li>
                    <li>
                        <input type="checkbox" id="millet_spray_${tableCounter}" name="millet_spray"> 
                        <label class="form-check-label" for="millet_spray_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Espigas de mijo. Indicates that the bird is feeding on millet sprays."> Millet Spray</label>
                    </li>
                    <li>
                        <label class="form-check-label" for="time_spent_foraging_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Tiempo dedicado a la búsqueda de alimento. Indicates the amount of time the animal spends moving and searching for food. ">Time spent foraging:</label>
                    </li>
                            <input type="text" id="time_spent_foraging_${tableCounter}" name="time_spent_foraging" value="00:00:00" readonly>
                            <button type="button" onclick="startTimer('time_spent_foraging')">Start</button>
                            <button type="button" onclick="stopTimer('time_spent_foraging')">Stop</button>
                            <button type="button" onclick="resetTimer('time_spent_foraging')">Reset</button>
                    <li>
                        <label class="form-check-label" for="time_spent_inactive_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Tiempo de inactividad. Indicates the amount of time the animal is neither moving nor searching for food. ">Time spent inactive:</label>
                    </li>
                            <input type="text" id="time_spent_inactive_${tableCounter}" name="time_spent_inactive" value="00:00:00" readonly>
                            <button type="button" onclick="startTimer('time_spent_inactive')">Start</button>
                            <button type="button" onclick="stopTimer('time_spent_inactive')">Stop</button>
                            <button type="button" onclick="resetTimer('time_spent_inactive')">Reset</button>
                        
                    

                </ul>
            `;
        } else {
            feedingOptions.innerHTML = ""; // Borra el contenido si se desmarca
        }
    }

    function togglePathologicalBehaviors(tableCounter) {
        let checkbox = document.getElementById(`pathological_behaviors_${tableCounter}`);
        let pathologicalOptions = document.getElementById(`pathological_options_${tableCounter}`);

        if (checkbox.checked) {
            pathologicalOptions.innerHTML = `
                <ul>
                    <li>
                        <input type="checkbox" id="hyperactivity_${tableCounter}" name="hyperactivity"> 
                        <label class="form-check-label" for="hyperactivity_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Hiperactivo. Excessive movement without a clear goal."> Hyperactivity</label>
                    </li>
                    <li>
                        <input type="checkbox" id="complete_inactivity_${tableCounter}" name="complete_inactivity"> 
                        <label class="form-check-label" for="complete_inactivity_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Inactividad Completa. Lack of movement or response for prolonged periods."> Complete Inactivity</label>
                    </li>
                    <li>
                        <input type="checkbox" id="vocalization_unusual_${tableCounter}" name="vocalization_unusual"> 
                        <label class="form-check-label" for="vocalization_unusual_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Vocalización inusual. Unusual or excessive vocalizations compared to the normal baseline."> Vocalization Unusual</label>
                    </li>
                    <li>
                        <input type="checkbox" id="self_harm_${tableCounter}" name="self_harm"> 
                        <label class="form-check-label" for="self_harm_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Autolesión. Behaviors such as feather plucking or self-injury."> Self-Harm</label>
                    </li>   
                    <li>
                        <input type="checkbox" id="stereotypic_behavior_${tableCounter}" name="stereotypic_behavior"> 
                        <label class="form-check-label" for="stereotypic_behavior_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Comportamiento estereotipado. Repetitive movements without an apparent purpose."> Stereotypic Behavior</label>
                    </li>
                </ul>
            `;
        } else {
            pathologicalOptions.innerHTML = ""; // Borra el contenido si se desmarca
        }
    }

     function toggleSexualBehaviors(tableCounter) {
        let checkbox = document.getElementById(`sexual_behaviors_${tableCounter}`);
        let container = document.getElementById(`sexual_behaviors_options_${tableCounter}`);

        if (checkbox.checked) {
            container.innerHTML = `
                <ul>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="courtship_display_${tableCounter}" name="courtship_display">
                            <label class="form-check-label" for="courtship_display_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Exhibición de cortejo. Behaviors like dances, vocalizations, or plumage displays to attract a mate. Conductas como danzas, vocalizaciones o exhibición de plumaje para atraer a una pareja."> Courtship Display</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="mate_acceptance_${tableCounter}" name="mate_acceptance">
                            <label class="form-check-label" for="mate_acceptance_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Aceptación de pareja. When an individual accepts or allows mating behavior from another. Cuando un individuo acepta o permite el comportamiento de apareamiento de otro."> Mate Acceptance</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="mate_rejection_${tableCounter}" name="mate_rejection">
                            <label class="form-check-label" for="mate_rejection_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Rechazo de pareja. When an individual rejects mating attempts from another (e.g., moving away, aggression). Cuando un individuo rechaza intentos de apareamiento (e.g., alejarse, agresión)."> Mate Rejection</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="food_provisioning_${tableCounter}" name="food_provisioning">
                            <label class="form-check-label" for="food_provisioning_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Suministro de alimento por la pareja. When the male brings food to the female, often as part of courtship or bonding. Cuando el macho lleva comida a la hembra, frecuentemente como parte del cortejo o para reforzar el vínculo."> Food Provisioning by Mate</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="mate_guarding_${tableCounter}" name="mate_guarding">
                            <label class="form-check-label" for="mate_guarding_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Vigilancia de la pareja. One individual actively protects its mate, preventing other potential competitors from approaching through defensive or territorial behavior. Un individuo protege activamente a su pareja, evitando que otros posibles competidores se acerquen mediante un comportamiento defensivo o territorial."> Mate Guarding</label>
                        </div>
                    </li>
                </ul>
            `;
        } else {
            container.innerHTML = ""; // Vacía el TD si se deselecciona
        }
    }

     function toggleCopulationBehaviors(tableCounter) {
        let checkbox = document.getElementById(`copulation_behaviors_${tableCounter}`);
        let container = document.getElementById(`copulation_behaviors_options_${tableCounter}`);

        if (checkbox.checked) {
            container.innerHTML = `
                <ul>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="no_Copulation_observed_${tableCounter}" name="no_Copulation_observed">
                            <label class="form-check-label" for="no_Copulation_observed_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/No se observa copula. Copulation was not observed during the monitoring session. La cópula no fue observada durante la sesión de monitoreo."> No Copulation Observed</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="successful_copulation_${tableCounter}_${tableCounter}" name="successful_copulation">
                            <label class="form-check-label" for="successful_copulation_${tableCounter}_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Copula exitosa. A mating event that appears to have been completed successfully. Un evento de apareamiento que parece haberse completado con éxito."> Successful Copulation</label>
                        </div>
                    </li>
                    <li>
                        <label for="number_copulations_${tableCounter}">Number of Copulations</label>
                        <input type="number_${tableCounter}" class="form-control" placeholder="Enter number of copulations" id="number_copulations" name="number_copulations">
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="post_copulatory_${tableCounter}" name="post_copulatory">
                            <label class="form-check-label" for="post_copulatory_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Comportamiento post-cópula. Behaviors observed after mating, such as grooming, resting, or distancing. Conductas observadas después del apareamiento, como acicalarse, descansar o distanciarse."> Post Copulatory Behavior</label>
                        </div>
                    </li>
                </ul>
            `;
        } else {
            container.innerHTML = ""; // Vacía el TD si se deselecciona
        }
    }

    function toggleNestBehaviors(tableCounter) {
        let checkbox = document.getElementById(`nest_behaviors_${tableCounter}`);
        let container = document.getElementById(`nest_behaviors_options_${tableCounter}`);

        if (checkbox.checked) {
            container.innerHTML = `
                <ul>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="nesting_behavior_${tableCounter}" name="nesting_behavior">
                            <label class="form-check-label" for="nesting_behavior_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Comportamiento nido. Preparing a nest as part of the reproductive process."> Nesting Behavior</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="nest_material_male_${tableCounter}" name="nest_material_male">
                            <label class="form-check-label" for="nest_material_male_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Macho material nido. When the male brings material to the nest."> Nest Material Male</label>
                        </div>
                    </li>
                    <li>
                        <label for="nest_material_male_count_${tableCounter}">Nest Material Male Count</label>
                        <input type="number" class="form-control" id="nest_material_male_count_${tableCounter}" name="nest_material_male_count">
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="nest_material_female_${tableCounter}" name="nest_material_female">
                            <label class="form-check-label" for="nest_material_female_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Hembra material nido. When the female brings material to the nest."> Nest Material Female</label>
                        </div>
                    </li>
                    <li>
                        <label for="nest_material_female_count_${tableCounter}">Nest Material Female Count</label>
                        <input type="number" class="form-control" id="nest_material_female_count_${tableCounter}" name="nest_material_female_count">
                    </li>
                </ul>
            `;
        } else {
            container.innerHTML = ""; // Vacía el TD si se deselecciona
        }
    }

    function toggleIncubationBehaviors(tableCounter) {
        let checkbox = document.getElementById(`incubation_behaviors_${tableCounter}`);
        let container = document.getElementById(`incubation_behaviors_options_${tableCounter}`);

        if (checkbox.checked) {
            container.innerHTML = `
                <ul>
                    <li>
                        <div>
                            <label for="incubating_male_${tableCounter}">Incubating Male:</label>
                            <input type="text" id="incubating_male_${tableCounter}" name="incubating_male" value="00:00:00" readonly>
                            <button type="button" onclick="startTimer('incubating_male')">Start</button>
                            <button type="button" onclick="stopTimer('incubating_male')">Stop</button>
                            <button type="button" onclick="resetTimer('incubating_male')">Reset</button>
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="incubating_female_${tableCounter}">Incubating Female:</label>
                            <input type="text" id="incubating_female_${tableCounter}" name="incubating_female" value="00:00:00" readonly>
                            <button type="button" onclick="startTimer('incubating_female')">Start</button>
                            <button type="button" onclick="stopTimer('incubating_female')">Stop</button>
                            <button type="button" onclick="resetTimer('incubating_female')">Reset</button>
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="both_incubation_${tableCounter}">Both Incubating:</label>
                            <input type="text" id="both_incubation_${tableCounter}" name="both_incubation" value="00:00:00" readonly>
                            <button type="button" onclick="startTimer('both_incubation')">Start</button>
                            <button type="button" onclick="stopTimer('both_incubation')">Stop</button>
                            <button type="button" onclick="resetTimer('both_incubation')">Reset</button>
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="no_incubation_${tableCounter}">No Incubating:</label>
                            <input type="text" id="no_incubation_${tableCounter}" name="no_incubation" value="00:00:00" readonly>
                            <button type="button" onclick="startTimer('no_incubation')">Start</button>
                            <button type="button" onclick="stopTimer('no_incubation')">Stop</button>
                            <button type="button" onclick="resetTimer('no_incubation')">Reset</button>
                        </div>
                    </li>
                    <li>
                        <label for="clutch_number_${tableCounter}">Clutch Number</label>
                        <input type="number" class="form-control" id="clutch_number_${tableCounter}" name="clutch_number">
                    </li>
                    <li>
                        <label for="number_eggs_nest_${tableCounter}">Number of Eggs in the Nest</label>
                        <input type="number" class="form-control" id="number_eggs_nest_${tableCounter}" name="number_eggs_nest">
                    </li>
                    <li>
                        <label for="number_aborted_eggs_${tableCounter}">Number Aborted Eggs</label>
                        <input type="number" class="form-control" id="number_aborted_eggs_${tableCounter}" name="number_aborted_eggs">
                    </li>
                    <li>
                     <label  for="egg_removal_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Retirada de huevos. Indicates that the eggs have been manually removed from the nest for artificial incubation or management purposes. Indica que los huevos han sido retirados manualmente del nido para incubación artificial o manejo.">Egg Removal</label>
                     </li>
                     <input class="form-control" type="number" id="egg_removal_${tableCounter}" name="egg_removal">
                    <li>
                        <input type="checkbox" id="abandoned_clutch_${tableCounter}" name="abandoned_clutch">
                        <label class="form-check-label" for="abandoned_clutch_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Puesta abandonada. Indicates that the nest has been deserted by the parents, with no signs of incubation or parental care. Indica que el nido ha sido abandonado por los progenitores, sin señales de incubación o cuidado parental.">Abandoned Clutch</label>
                    </li>
                </ul>
            `;
        } else {
            container.innerHTML = ""; // Vacía el TD si se deselecciona
        }
    }


      function toggleChickenNestBehaviors(tableCounter) {
        let checkbox = document.getElementById(`chicken_nest_behaviors_${tableCounter}`);
        let container = document.getElementById(`chicken_nest_behaviors_options_${tableCounter}`);

        if (checkbox.checked) {
            container.innerHTML = `
                <ul>
                    <li>
                        <input type="checkbox" id="no_feed_nest_parents_${tableCounter}" name="no_feed_nest_parents">
                        <label class="form-check-label" for="no_feed_nest_parents_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/No alimentación de los progenitores en el nido. No feeding behavior from either parent has been observed in the nest during the observation period."> No Feed Nest Parents</label>
                    </li>
                    <li>
                        <input type="checkbox" id="feding_nest_confirmed_${tableCounter}" name="feding_nest_confirmed"> 
                        <label class="form-check-label" for="feding_nest_confirmed_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Alimentación de polluelos en el nido confirmada. Feeding behavior from at least one parent to the chicks in the nest has been observed during the observation period."> Feeding Nest Confirmed</label>
                    </li>
                    <li>
                        <label for="number_feed_nest_male_${tableCounter}">Number Feed Nest Male</label>
                        <input type="number" class="form-control" placeholder="Number Feed Nest Male" id="number_feed_nest_male_${tableCounter}" name="number_feed_nest_male">
                    </li>
                    <li>
                        <label for="number_feed_nest_female_${tableCounter}">Number Feed Nest Female</label>
                        <input type="number" class="form-control" placeholder="Number Feed Nest Female" id="number_feed_nest_female_${tableCounter}" name="number_feed_nest_female">
                    </li>
                    <li>
                        <input type="checkbox" id="predominant_feed_nest_type_${tableCounter}" name="predominant_feed_nest_type"> 
                        <label style="display: inline;" class="form-check-label" for="predominant_feed_nest_type_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/ Tipo de comida predominante. Predominant type of food provided by parents to chicks."> Predominant Feed Nest Type</label>
                    </li>
                    <li>
                        <select name="predominant_feed_nest_select" class="form-control" id="predominant_feed_nest_select_${tableCounter}">
                            <option value="">Select</option>
                            <option value="Tenebrio">Tenebrio</option>
                            <option value="Asticot">Asticot</option>
                            <option value="Natural Prey">Natural Prey</option>
                            <option value="Breeding Paste">Breeding Paste</option>
                            <option value="Insectivorous Paste">Insectivorous Paste</option>
                            <option value="Perle Morbide">Perle Morbide</option>
                            <option value="Seed">Seed</option>
                            <option value="Millet Spray">Millet Spray</option>
                        </select>
                    </li>
                    <li>
                        <label for="nestling_survival_count_${tableCounter}">Nestling Survival Count</label>
                        <input type="number" class="form-control" placeholder="Number Chicken Count" id="nestling_survival_count_${tableCounter}" name="nestling_survival_count">
                    </li>
                    <li>
                        <label for="number_dead_chicks_${tableCounter}">Number of Dead Chicks</label>
                        <input type="number" class="form-control" placeholder="Number of Dead Chicks" id="number_dead_chicks_${tableCounter}" name="number_dead_chicks">
                    </li>
                </ul>
            `;
        } else {
            container.innerHTML = ""; // Vacía el TD si se deselecciona
        }
    }

     function toggleChickenFledglingsBehaviors(tableCounter) {
        let checkbox = document.getElementById(`chicken_fledglings_behaviors_${tableCounter}`);
        let container = document.getElementById(`chicken_fledglings_behaviors_options_${tableCounter}`);

        if (checkbox.checked) {
            container.innerHTML = `
                <ul>
                    <li>
                        <input type="checkbox" id="no_feed_fledglings_parents_${tableCounter}" name="no_feed_fledglings_parents">
                        <label class="form-check-label" for="no_feed_fledglings_parents_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/No alimentación de los progenitores a los volantones. No feeding behavior from either parent has been observed for the fledglings during the observation period."> No Feed Fledglings Parents</label>
                    </li>
                    <li>
                        <input type="checkbox" id="parents_feed_fledglings_${tableCounter}" name="parents_feed_fledglings"> 
                        <label class="form-check-label" for="parents_feed_fledglings_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Padres alimentan volantontes confirmado. At least one parent has been observed feeding the fledglings during the observation period."> Parents Feed Fledglings Confirmed</label>
                    </li>
                    <li>
                        <label for="number_feed_fledglings_male_${tableCounter}">Number Feed Fledglings Male</label>
                        <input type="number" class="form-control" placeholder="Number Feed Fledglings Male" id="number_feed_fledglings_male_${tableCounter}" name="number_feed_fledglings_male">
                    </li>
                    <li>
                        <label for="number_feed_fledglings_female_${tableCounter}">Number Feed Fledglings Female</label>
                        <input type="number" class="form-control" placeholder="Number Feed Fledglings Female" id="number_feed_fledglings_female_${tableCounter}" name="number_feed_fledglings_female">
                    </li>
                    <li>
                        <input type="checkbox" id="predominant_feed_fledglings_type_${tableCounter}" name="predominant_feed_fledglings_type">
                        <label class="form-check-label" for="predominant_feed_fledglings_type_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Tipo de alimento predominante proporcionado a los volantones. Main type of food delivered by parents to fledglings during the observation period."> Predominant Feed Fledglings Type</label>
                    </li>
                    <li>
                        <select name="predominant_feed_fledglings_select" class="form-control" id="predominant_feed_fledglings_select_${tableCounter}">
                            <option value="">Select</option>
                            <option value="Tenebrio">Tenebrio</option>
                            <option value="Asticot">Asticot</option>
                            <option value="Natural Prey">Natural Prey</option>
                            <option value="Breeding Paste">Breeding Paste</option>
                            <option value="Insectivorous Paste">Insectivorous Paste</option>
                            <option value="Perle Morbide">Perle Morbide</option>
                            <option value="Seed">Seed</option>
                            <option value="Millet Spray">Millet Spray</option>
                        </select>
                    </li>
                    <li>
                        <input type="checkbox" id="male_warn_chicken_${tableCounter}" name="male_warn_chicken"> 
                        <label class="form-check-label" for="male_warn_chicken_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Macho cobijo pollos. Male keeps the chicks warm (brooding)."> Male Warn Chicken</label>
                    </li>
                    <li>
                        <input type="checkbox" id="female_warn_chicken_${tableCounter}" name="female_warn_chicken"> 
                        <label class="form-check-label" for="female_warn_chicken_${tableCounter}" ondblclick="toggleTextarea(this)" data-text="ESP/Hembra cobijo pollos. Female keeps the chicks warm (brooding)."> Female Warn Chicken</label>
                    </li>
                    <li>
                        <label for="number_live_fledglings_${tableCounter}">Number of Live Fledglings</label>
                        <input type="number" class="form-control" placeholder="Number of Live Fledglings" id="number_live_fledglings_${tableCounter}" name="number_live_fledglings">
                    </li>
                    <li>
                        <label for="number_dead_fledglings_${tableCounter}">Number of Dead Fledglings</label>
                        <input type="number" class="form-control" placeholder="Number of Dead Fledglings" id="number_dead_fledglings_${tableCounter}" name="number_dead_fledglings">
                    </li>
                </ul>
            `;
        } else {
            container.innerHTML = ""; // Vacía el TD si se deselecciona
        }
    }

     function toggleChickenAttackBehaviors(tableCounter) {
        let checkbox = document.getElementById(`chicken_attack_behaviors_${tableCounter}`);
        let container = document.getElementById(`chicken_attack_behaviors_options_${tableCounter}`);

        if (checkbox.checked) {
            container.innerHTML = `
                <ul>
                    <li>
                        <input type="checkbox" id="male_attacks_the_chicks_${tableCounter}" name="male_attacks_the_chicks">
                        <label class="form-check-label" for="male_attacks_the_chicks_${tableCounter}"> Male Attacks the Chicks</label>
                    </li>
                    <li>
                        <input type="checkbox" id="male_attacks_the_female_${tableCounter}" name="male_attacks_the_female">
                        <label class="form-check-label" for="male_attacks_the_female_${tableCounter}"> Male Attacks the Female</label>
                    </li>
                    <li>
                        <input type="checkbox" id="female_attacks_the_chicks_${tableCounter}" name="female_attacks_the_chicks">
                        <label class="form-check-label" for="female_attacks_the_chicks_${tableCounter}"> Female Attacks the Chicks</label>
                    </li>
                    <li>
                        <input type="checkbox" id="female_attacks_the_male_${tableCounter}" name="female_attacks_the_male">
                        <label class="form-check-label" for="female_attacks_the_male_${tableCounter}"> Female Attacks the Male</label>
                    </li>
                    <li>
                        <input type="checkbox" id="male_kills_the_chicks_${tableCounter}" name="male_kills_the_chicks">
                        <label class="form-check-label" for="male_kills_the_chicks_${tableCounter}"> Male Kills the Chicks</label>
                    </li>
                    <li>
                        <input type="checkbox" id="male_kills_the_female_${tableCounter}" name="male_kills_the_female">
                        <label class="form-check-label" for="male_kills_the_female_${tableCounter}"> Male Kills the Female</label>
                    </li>
                    <li>
                        <input type="checkbox" id="female_kills_the_chicks_${tableCounter}" name="female_kills_the_chicks">
                        <label class="form-check-label" for="female_kills_the_chicks_${tableCounter}"> Female Kills the Chicks</label>
                    </li>
                    <li>
                        <input type="checkbox" id="female_kills_the_male_${tableCounter}" name="female_kills_the_male">
                        <label class="form-check-label" for="female_kills_the_male_${tableCounter}"> Female Kills the Male</label>
                    </li>
                </ul>
            `;
        } else {
            container.innerHTML = ""; // Vacía el TD si se deselecciona
        }
    }

    function toggleJuvenilBehaviors(tableCounter) {
        let checkbox = document.getElementById(`juvenil_behaviors_${tableCounter}`);
        let container = document.getElementById(`juvenil_behaviors_options_${tableCounter}`);

        if (checkbox.checked) {
            container.innerHTML = `
               <ul>
    <li>
        <input class="form-check-input" type="checkbox" id="independent_feeding_${tableCounter}" name="independent_feeding">
        <label class="form-check-label" for="independent_feeding_${tableCounter}" ondblclick="toggleTextarea(this)" 
               data-text="ESP/Alimentacion independiente. The juvenile feeds itself / El juvenil se alimenta por sí mismo">
            Independent Feeding
        </label>
    </li>
    <li>
        <input class="form-check-input" type="checkbox" id="begging_behavior_${tableCounter}" name="begging_behavior">
        <label class="form-check-label" for="begging_behavior_${tableCounter}" ondblclick="toggleTextarea(this)" 
               data-text="ESP/Comportamiento de demanda de alimento. The juvenile actively begs for food. El juvenil pide alimento activamente.">
            Begging Behavior
        </label>
    </li>
    <li>
        <input class="form-check-input" type="checkbox" id="imprinting_on_caregivers_${tableCounter}" name="imprinting_on_caregivers">
        <label class="form-check-label" for="imprinting_on_caregivers_${tableCounter}" ondblclick="toggleTextarea(this)" 
               data-text="ESP/Impronta hacia cuidador. The juvenile develops a strong attachment to human caregivers. El juvenil desarrolla un fuerte apego hacia los cuidadores humanos">
            Imprinting on Caregivers
        </label>
    </li>
    <li>
        <input class="form-check-input" type="checkbox" id="establishing_hierarchies_${tableCounter}" name="establishing_hierarchies">
        <label class="form-check-label" for="establishing_hierarchies_${tableCounter}" ondblclick="toggleTextarea(this)" 
               data-text="ESP/Estableciendo jerarquías. The juvenile begins to form dominance orders within a group through social interactions. El juvenil empieza a establecer órdenes de dominancia dentro del grupo a través de interacciones sociales.">
            Establishing Hierarchies
        </label>
    </li>
    <li>
        <input class="form-check-input" type="checkbox" id="pair_association_${tableCounter}" name="pair_association">
        <label class="form-check-label" for="pair_association_${tableCounter}" ondblclick="toggleTextarea(this)" 
               data-text="ESP/Asociación Parejas. Indicates that juvenile birds are associating in pairs. Indica que las aves juveniles se están asociando en parejas">
            Pair Association
        </label>
    </li>
    <li>
        <input class="form-check-input" type="checkbox" id="development_of_predator_responses_${tableCounter}" name="development_of_predator_responses">
        <label class="form-check-label" for="development_of_predator_responses_${tableCounter}" ondblclick="toggleTextarea(this)" 
               data-text="ESP/Desarrollo de respuestas ante depredadores. The juvenile learns alert and evasion behaviors against potential threats, often through observation or adult instruction. El juvenil aprende comportamientos de alerta y evasión ante posibles amenazas, a menudo mediante la observación o instrucción de adultos.">
            Development of Predator Responses
        </label>
    </li>
    <li>
        <input class="form-check-input" type="checkbox" id="dead_juvenil_found_${tableCounter}" name="dead_juvenil_found">
        <label class="form-check-label" for="dead_juvenil_found_${tableCounter}" ondblclick="toggleTextarea(this)" 
               data-text="Hallazgo de una o varias aves juveniles muertas. One or more deceased juvenile birds have been found during the observation period. Se ha encontrado una o varias aves juveniles muertas durante el período de observación.">
            Dead Juvenil Found
        </label>
    </li>
    <li>
        <label for="dead_juvenile_count_${tableCounter}">Dead Juvenile Count</label>
        <input type="number" class="form-control" placeholder="Number Dead Juvenile" id="dead_juvenile_count_${tableCounter}" name="dead_juvenile_count">
    </li>
</ul>

            `;
        } else {
            container.innerHTML = ""; // Vacía el TD si se deselecciona
        }
    }
