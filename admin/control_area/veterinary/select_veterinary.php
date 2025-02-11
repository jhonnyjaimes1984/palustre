<?php include_once "../../../conf/Config.php";
include_once BASE_URL . "/paginas/cabecera_tercer_nivel.php";
?>

<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/album/">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
            margin-top: 50px;
        }
        .card {
            transition: transform 0.3s;
            cursor: pointer;
            height: 100%;
        }
        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1 class="mb-4 text-primary">Welcome to the Veterinary Area</h1>
        <p class="lead">This section allows you to manage veterinary records, including health assessments, treatments, and medical history tracking. Click on each option to navigate to its functionalities.</p>
        
        <div class="row mt-5">
            <div class="col-md-3 mb-4">
                <div class="card border-primary" onclick="location.href='select_veterinary.php';">
                    <div class="card-body">
                        <h3 class="card-title text-primary">View</h3>
                        <p class="card-text">Review veterinary records, past treatments, and ongoing health assessments.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-success" onclick="location.href='insert_veterinary.php';">
                    <div class="card-body">
                        <h3 class="card-title text-success">Insert</h3>
                        <p class="card-text">Add new medical records, register treatments veterinary assessments.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-warning" onclick="location.href='update_veterinary.php';">
                    <div class="card-body">
                        <h3 class="card-title text-warning">Update</h3>
                        <p class="card-text">Edit existing veterinary records, including new diagnoses and treatment changes.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-danger" onclick="location.href='delete_veterinary.php';">
                    <div class="card-body">
                        <h3 class="card-title text-danger">Delete</h3>
                        <p class="card-text">Remove outdated or unnecessary veterinary records from the database.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php  include_once BASE_URL . "/paginas/pie_3.php";   ?>
