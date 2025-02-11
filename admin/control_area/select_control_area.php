<?php include_once "../../conf/Config.php"; 

include_once BASE_URL . "/paginas/cabecera_segundo_nivel.php"; 
?>

<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/album/">
<!-- Bootstrap core CSS -->
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
        }
        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1 class="mb-4 text-primary">Welcome to the Control Area</h1>
        <p class="lead">This section allows you to manage and monitor different aspects related to bird health, monitoring, and assignment. Click on each area to navigate to its functionalities.</p>
        
        <div class="row mt-5">
            <div class="col-md-6 mb-4">
                <div class="card border-primary text-center" onclick="location.href='monitoring/select_monitoring.php';">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Monitoring</h3>
                        <p class="card-text">Track the status and behavior of each bird, record observations, and analyze patterns.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card border-success" onclick="location.href='veterinary/select_veterinary.php';">
                    <div class="card-body">
                        <h3 class="card-title text-success">Veterinary</h3>
                        <p class="card-text">Manage health records, treatments, and necropsy reports to ensure proper care.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card border-warning" onclick="location.href='preventive_care/select_preventive_care.php';">
                    <div class="card-body">
                        <h3 class="card-title text-warning">Preventive Care</h3>
                        <p class="card-text">Implement prophylactic treatments and nutrition plans to maintain bird health.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card border-danger" onclick="location.href='assignment/select_assignment.php';">
                    <div class="card-body">
                        <h3 class="card-title text-danger">Assignment</h3>
                        <p class="card-text">Manage personnel and task assignments for efficient workflow.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php  include_once BASE_URL . "/paginas/pie_2.php";   ?>