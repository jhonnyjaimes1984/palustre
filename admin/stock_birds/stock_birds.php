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
        <h1 class="mb-4 text-primary">Welcome to the Stock Bird Area</h1>
        <p class="lead">This section allows you to manage stock birds, including viewing, inserting, updating, and deleting records. Click on each area to navigate to its functionalities.</p>
        
        <div class="row mt-5">
            <div class="col-md-3 mb-4">
                <div class="card border-primary" onclick="location.href='select.php';">
                    <div class="card-body">
                        <h3 class="card-title text-primary">View</h3>
                        <p class="card-text">View existing records in the stock. This allows you to see and review all the birds that are currently listed.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-success" onclick="location.href='insert_stockbirds.php';">
                    <div class="card-body">
                        <h3 class="card-title text-success">Insert</h3>
                        <p class="card-text">Add new entries to the stock database. Use this option to register new birds and update relevant details.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-warning" onclick="location.href='update_stockbirds.php';">
                    <div class="card-body">
                        <h3 class="card-title text-warning">Update</h3>
                        <p class="card-text">Edit existing records. This function allows you to update the details of any bird in the stock list.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-danger" onclick="location.href='delete_stockbirds.php';">
                    <div class="card-body">
                        <h3 class="card-title text-danger">Delete</h3>
                        <p class="card-text">Remove records from the database. Use this to delete any bird records that are no longer needed.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php  include_once BASE_URL . "/paginas/pie_2.php";   ?>