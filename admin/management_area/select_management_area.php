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
        <h1 class="mb-4 text-primary">Welcome to the Management Area</h1>
        <p class="lead">This section is exclusively for administrators and IT managers to configure the database, manage access privileges, and oversee system settings. Click on each area to manage its functionalities.</p>
        
        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <div class="card border-primary" onclick="location.href='species/select_species.php';">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Species</h3>
                        <p class="card-text">Manage the list of species, add new entries, and modify existing ones.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-success" onclick="location.href='origin/select_origin.php';">
                    <div class="card-body">
                        <h3 class="card-title text-success">Origin</h3>
                        <p class="card-text">Edit and correct the origin details of birds in the database.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-warning" onclick="location.href='facilities/select_facilities.php';">
                    <div class="card-body">
                        <h3 class="card-title text-warning">Facilities</h3>
                        <p class="card-text">Manage and update the list of installations used in the program.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card border-danger" onclick="location.href='nest/select_nest.php';">
                    <div class="card-body">
                        <h3 class="card-title text-danger">Nest</h3>
                        <p class="card-text">Track all nest locations and characteristics used for the birds.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card border-info" onclick="location.href='staff/select_staff.php';">
                    <div class="card-body">
                        <h3 class="card-title text-info">Staff</h3>
                        <p class="card-text">Register and manage all personnel involved in the program.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card border-dark" onclick="location.href='privileges/select_privileges.php';">
                    <div class="card-body">
                        <h3 class="card-title text-dark">Privileges</h3>
                        <p class="card-text">Assign and manage user access privileges within the web application.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php  include_once BASE_URL . "/paginas/pie_2.php";   ?>