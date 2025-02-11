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
        <h1 class="mb-4 text-primary">Welcome to the Breeding Area</h1>
        <p class="lead">This section allows you to manage the breeding process of birds, including pairs, clutches, egg tracking, incubation, and chick monitoring. Click on each area to navigate to its functionalities.</p>
        
        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <div class="card border-primary" onclick="location.href='pairs/select_pairs.php';">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Pairs</h3>
                        <p class="card-text">Manage breeding pairs, their history, and compatibility.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-success" onclick="location.href='clutches/select_clutches.php';">
                    <div class="card-body">
                        <h3 class="card-title text-success">Clutches</h3>
                        <p class="card-text">Track the formation of clutches, their size, and health status.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-warning" onclick="location.href='egg/select_egg.php';">
                    <div class="card-body">
                        <h3 class="card-title text-warning">Eggs</h3>
                        <p class="card-text">Monitor individual eggs, their condition, and viability.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card border-danger" onclick="location.href='incubation/select_incubation.php';">
                    <div class="card-body">
                        <h3 class="card-title text-danger">Incubation</h3>
                        <p class="card-text">Control incubation parameters and optimize hatching success.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card border-info" onclick="location.href='chickens/select_chickens.php';">
                    <div class="card-body">
                        <h3 class="card-title text-info">Chickens</h3>
                        <p class="card-text">Monitor chick development, health, and growth stages.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php  include_once BASE_URL . "/paginas/pie_2.php";   ?>
