<div class="card mb-12">
    <div class="card-header text-center">
        <h3><strong>GENERAL INFORMATION</strong></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="date_of_death">Date of Death aprox</label>
            <input type="date" class="form-control" id="date_of_death" name="date_of_death">
        </div>
        <div class="form-group">
            <label for="identification">Identification (Ring Code)</label>
            <input type="text" class="form-control" id="identification" name="identification" placeholder="Ring Code">
        </div>
        <div class="form-group">
            <label for="year_of_birth">Year of Birth</label>
            <input type="number" class="form-control" id="year_of_birth" name="year_of_birth">
        </div>
        <div class="form-group">
            <label for="sex">Sex</label>
            <select class="form-control" id="sex" name="sex">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="origin">Origin</label>
            <textarea class="form-control" id="origin" name="origin" rows="2" placeholder="Enter origin details..."></textarea>
        </div>
    </div>
</div>

<div class="card mb-12">
    <div class="card-header text-center">
        <h3><strong>CLINICAL HISTORY AND CIRCUMSTANCES OF DEATH</strong></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="observations_before_death">Observations Before Death</label>
            <textarea class="form-control" id="observations_before_death" name="observations_before_death" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="environmental_conditions">Environmental Conditions at the Time of Discovery</label>
            <textarea class="form-control" id="environmental_conditions" name="environmental_conditions" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="time_of_discovery">Date and Time of Discovery</label>
            <input type="datetime-local" class="form-control" id="time_of_discovery" name="time_of_discovery">
        </div>
        <div class="form-group">
            <label for="person_found_cadaver">Person Who Found the Cadaver</label>
            <input type="text" class="form-control" id="person_found_cadaver" name="person_found_cadaver" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="condition_of_cadaver">Condition of the Cadaver</label>
            <textarea class="form-control" id="condition_of_cadaver" name="condition_of_cadaver" rows="3"></textarea>
        </div>
    </div>
</div>
<form action="save_veterinary_data.php" method="POST" enctype="multipart/form-data" id="necropsyForm">
<div class="card mb-12">
    <div class="card-header text-center">
        <h3><strong>EXTERNAL EXAMINATION</strong></h3>
    </div>
    <div class="card-body">
        <div class="card mb-3">
            <div class="card-header"><strong>1. General Body Condition</strong></div>
            <div class="card-body">
                <label for="body_condition">Body Condition</label>
                <textarea class="form-control" id="body_condition" name="body_condition" rows="2"></textarea>
                <label for="weight_2">Weight</label>
                <input type="number" class="form-control" id="weight_2" name="weight_2" placeholder="Enter weight in grams">
                <label for="hydration_status">Condition of Pectoral Musculature</label>
                <textarea class="form-control" id="hydration_status" name="hydration_status" rows="2"></textarea>
                <label for="muscle_mass">Skin and Plumage Condition</label>
                <textarea class="form-control" id="muscle_mass" name="muscle_mass" rows="2"></textarea>
                <label for="fat_reserves">Hydration of Mucous Membranes and Tissues</label>
                <textarea class="form-control" id="fat_reserves" name="fat_reserves" rows="2"></textarea>
                <label for="skin_plumage">Condition of the Extremities</label>
                <textarea class="form-control" id="skin_plumage" name="skin_plumage" rows="2"></textarea>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header"><strong>2. Oral Cavity and Respiratory System</strong></div>
            <div class="card-body">
                <label for="oral_cavity">Condition of the Oral Cavity and Beak</label>
                <textarea class="form-control" id="oral_cavity" name="oral_cavity" rows="2"></textarea>
                <label for="secretions_nasal">Presence of Secretions in  the Nasal or Tracheal Cavity</label>
                <textarea class="form-control" id="secretions_nasal" name="secretions_nasal" rows="2"></textarea>
                <label for="oral_masses">Appearance of Tongue and Oral Masses</label>
                <textarea class="form-control" id="oral_masses" name="oral_masses" rows="2"></textarea>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header"><strong>3. Eyes and Ears</strong></div>
            <div class="card-body">
                <label for="ocular_condition">Ocular Condition</label>
                <textarea class="form-control" id="ocular_condition" name="ocular_condition" rows="2"></textarea>
                <label for="ocular_secretions">Ocular Secretions</label>
                <textarea class="form-control" id="ocular_secretions" name="ocular_secretions" rows="2"></textarea>
                <label for="ear_condition">Condition of External Ear</label>
                <textarea class="form-control" id="ear_condition" name="ear_condition" rows="2"></textarea>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header"><strong>4. Cloacal Region</strong></div>
            <div class="card-body">
                <label for="cloacal_condition">Presence of Adherent Fecal Matter</label>
                <textarea class="form-control" id="cloacal_condition" name="cloacal_condition" rows="2"></textarea>
                <label for="cloacal_masses">Presence of Abnormal Cloacal Masses</label>
                <textarea class="form-control" id="cloacal_masses" name="cloacal_masses" rows="2"></textarea>
                <label for="cloacal_secretions">Abnormal Secretions</label>
                <textarea class="form-control" id="cloacal_secretions" name="cloacal_secretions" rows="2"></textarea>
            </div>
        </div>
    </div>
</div>

<div class="card mb-12">
    <div class="card-header text-center">
        <h3><strong>INTERNAL EXAMINATION (NECROPSY)</strong></h3>
    </div>
    <div class="card-body">
        <div class="card mb-3">
            <div class="card-header"><strong>1. Thoracic and Abdominal Cavity</strong></div>
            <div class="card-body">
                <label for="thoracic_abdominal">Observations</label>
                <textarea class="form-control" id="thoracic_abdominal" name="thoracic_abdominal" rows="2"></textarea>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header"><strong>2. Digestive System</strong></div>
            <div class="card-body">
                <label for="digestive_system">Observations</label>
                <textarea class="form-control" id="digestive_system" name="digestive_system" rows="2"></textarea>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header"><strong>3. Respiratory System</strong></div>
            <div class="card-body">
                <label for="respiratory_system">Observations</label>
                <textarea class="form-control" id="respiratory_system" name="respiratory_system" rows="2"></textarea>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header"><strong>4. Cardiovascular System</strong></div>
            <div class="card-body">
                <label for="cardiovascular_system">Observations</label>
                <textarea class="form-control" id="cardiovascular_system" name="cardiovascular_system" rows="2"></textarea>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header"><strong>5. Urogenital System</strong></div>
            <div class="card-body">
                <label for="urogenital_system">Observations</label>
                <textarea class="form-control" id="urogenital_system" name="urogenital_system" rows="2"></textarea>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header"><strong>6. Nervous System</strong></div>
            <div class="card-body">
                <label for="nervous_system">Observations</label>
                <textarea class="form-control" id="nervous_system" name="nervous_system" rows="2"></textarea>
            </div>
        </div>
    </div>
</div>

<div class="card mb-12">
    <div class="card-header text-center">
        <h3><strong>DIAGNOSIS AND COMPLEMENTARY ANALYSIS</strong></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="diagnosis_text">Diagnosis</label>
            <textarea class="form-control" id="diagnosis_text" name="diagnosis_text" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="complementary_analysis">Complementary Analysis</label>
            <textarea class="form-control" id="complementary_analysis" name="complementary_analysis" rows="3"></textarea>
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