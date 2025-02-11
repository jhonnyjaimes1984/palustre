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
        <h1 class="mb-4 text-primary">Welcome to the Preventive Care Area</h1>
        <p class="lead">This section allows you to manage preventive health measures, ensuring the well-being of birds through prophylactic treatments, nutritional supplementation, parasite control, and enclosure hygiene. Use the options below to manage records.</p>
        
        <div class="row mt-5">
            <div class="col-md-3 mb-4">
                <div class="card border-primary" onclick="location.href='view.php';">
                    <div class="card-body">
                        <h3 class="card-title text-primary">View</h3>
                        <p class="card-text">View all existing preventive care records. Review previously recorded health measures and interventions.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-success" onclick="location.href='insert.php';">
                    <div class="card-body">
                        <h3 class="card-title text-success">Insert</h3>
                        <p class="card-text">Register new preventive care records. Add information on treatments, supplements, and other health measures.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-warning" onclick="location.href='update.php';">
                    <div class="card-body">
                        <h3 class="card-title text-warning">Update</h3>
                        <p class="card-text">Modify existing preventive care records. Ensure the database remains accurate and up to date.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-danger" onclick="location.href='delete.php';">
                    <div class="card-body">
                        <h3 class="card-title text-danger">Delete</h3>
                        <p class="card-text">Remove outdated or incorrect preventive care records from the system.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php  include_once BASE_URL . "/paginas/pie_3.php";   ?>
