<?php include_once "../../conf/Config.php"; 

include_once BASE_URL . "/paginas/cabecera_segundo_nivel.php"; 
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
        <h1 class="mb-4 text-primary">Welcome to the Ex-situ Area</h1>
        <p class="lead">This section focuses on monitoring released birds and tracking their behavior and survival in the wild. It provides tools for ornithologists to systematically collect data and conduct scientific studies.</p>
        
        <div class="row mt-5">
            <div class="col-md-6 mb-4">
                <div class="card border-primary" onclick="location.href='release/select_release.php';">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Release</h3>
                        <p class="card-text">Manage and review all bird releases conducted by the program.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card border-success" onclick="location.href='tracking/select_tracking.php';">
                    <div class="card-body">
                        <h3 class="card-title text-success">Tracking</h3>
                        <p class="card-text">Systematically track released birds, record field observations, and analyze survival rates.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php  include_once BASE_URL . "/paginas/pie_2.php";   ?>