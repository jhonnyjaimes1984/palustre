<?php include_once "../../conf/Config.php"; 

include_once BASE_URL . "/paginas/cabecera_segundo_nivel.php"; 

// Check if the individual ID is provided via form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_individual'])) {
    $id_individual = $_POST['id_individual'];

    try {
        // Query to get the individual data
        $query = $db->prepare("SELECT * FROM individuals WHERE id_individual = ?");
        $query->execute([$id_individual]);
        $individual = $query->fetch(PDO::FETCH_ASSOC);

        if (!$individual) {
            $error = "No individual found with ID $id_individual.";
        }
    } catch (PDOException $e) {
        $error = "Error while querying the database: " . $e->getMessage();
    }
}
?>

<main role="main" class="content-wrapper">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Delete Individual</h1>
  </div>

  <div class="content-header">
    <div class="container-fluid">
      <!-- FORM TO ENTER THE ID -->
      <form method="post" id="id_form">
        <div class="card mb-4">
          <div class="card-header text-center">
            <h3><strong>Enter Individual ID</strong></h3>
          </div>
          <div class="card-body text-center">
            <div class="form-group">
              <label for="id_individual"><strong>ID of Individual:</strong></label>
              <input type="number" class="form-control" id="id_individual" name="id_individual" placeholder="Enter ID" required>
            </div>
            <button type="submit" class="btn btn-primary">Delete Individual</button>
          </div>
        </div>
      </form>

      <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php endif; ?>

      <!-- FORM TO UPDATE INDIVIDUAL DATA -->
      <?php if (isset($individual)): ?>
      <form method="post" action="save_update.php" enctype="multipart/form-data" id="form_update">
        <input type="hidden" name="id_individual" value="<?php echo $id_individual; ?>">

        <!-- ORIGIN TYPE -->
        <div class="card mb-4">
          <div class="card-header text-center">
            <h3><strong>Origin Type</strong></h3>
          </div>
          <div class="card-body text-center">
            <div class="d-flex justify-content-center">
              <div class="custom-control custom-radio mx-3">
                <input class="custom-control-input" type="radio" value="1" id="born_center" name="origin_type" <?php echo $individual['origin_type'] == '1' ? 'checked' : ''; ?>>
                <label for="born_center" class="custom-control-label">Born Center</label>
              </div>
              <div class="custom-control custom-radio mx-3">
                <input class="custom-control-input" type="radio" value="0" id="capture" name="origin_type" <?php echo $individual['origin_type'] == '0' ? 'checked' : ''; ?>>
                <label for="capture" class="custom-control-label">Capture</label>
              </div>
              <div class="custom-control custom-radio mx-3">
                <input class="custom-control-input" type="radio" value="2" id="transfer" name="origin_type" <?php echo $individual['origin_type'] == '2' ? 'checked' : ''; ?>>
                <label for="transfer" class="custom-control-label">Transfer</label>
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
                <input type="text" class="form-control" id="species" name="species" value="<?php echo $individual['species']; ?>" required>
              </div>
              <div class="form-group col-lg-4">
                <label for="nickname"><strong>Nickname:</strong></label>
                <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo $individual['nickname']; ?>" required>
              </div>
              <div class="form-group col-lg-4">
                <label for="genetic_code"><strong>Genetic Code:</strong></label>
                <input type="text" class="form-control" id="genetic_code" name="genetic_code" value="<?php echo $individual['genetic_code']; ?>" required>
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
                <label for="capture_date"><strong>Capture Date:</strong></label>
                <input class="form-control" id="capture_date" name="capture_date" type="date" value="<?php echo $individual['capture_date']; ?>" required>
              </div>
              <div class="form-group col-lg-3">
                <label for="sex"><strong>Sex:</strong></label>
                <select name="sex" id="sex" class="form-control" required>
                  <option value="Male" <?php echo $individual['sex'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                  <option value="Female" <?php echo $individual['sex'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                  <option value="Indeterminate" <?php echo $individual['sex'] == 'Indeterminate' ? 'selected' : ''; ?>>Indeterminate</option>
                </select>
              </div>
              <div class="form-group col-lg-3">
                <label for="year"><strong>Year:</strong></label>
                <input type="number" class="form-control" id="year" name="year" value="<?php echo $individual['year']; ?>" min="1900" max="2100" required>
              </div>
              <div class="form-group col-lg-3">
                <label for="status"><strong>Status:</strong></label>
                <select name="status" id="status" class="form-control" required>
                  <option value="Breeder" <?php echo $individual['status'] == 'Breeder' ? 'selected' : ''; ?>>Breeder</option>
                  <option value="Juvenile" <?php echo $individual['status'] == 'Juvenile' ? 'selected' : ''; ?>>Juvenile</option>
                  <option value="No_breeder" <?php echo $individual['status'] == 'No_breeder' ? 'selected' : ''; ?>>No Breeder</option>
                  <option value="Genetically_excluded" <?php echo $individual['status'] == 'Genetically_excluded' ? 'selected' : ''; ?>>Genetically Excluded</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-success">Update Individual</button>
        </div>
      </form>
      <?php endif; ?>
    </div>
  </div>
</main>
<?php  include_once BASE_URL . "/paginas/pie_2.php";   ?>