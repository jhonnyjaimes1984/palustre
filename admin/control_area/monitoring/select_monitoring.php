<?php 
include_once "../../../conf/Config.php"; 

require_once BASE_URL . "/paginas/cabecera_tercer_nivel.php"; 
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




<main role="main" class="content-wrapper">
	<div class="container text-center">
		<h1 class="mb-4 text-primary">Welcome to the Monitoring Area</h1>
<p class="lead">This section allows you to systematically track the health, behavior, and overall condition of birds. Through detailed observations, users can record physical conditions, activity levels, and potential health concerns to ensure early detection of issues and proper management. Use the options below to manage records efficiently.</p>

<div class="row mt-5">
            <div class="col-md-3 mb-4">
                <div class="card border-primary" onclick="location.href='view.php';">
                    <div class="card-body">
                        <h3 class="card-title text-primary">View All</h3>
                        <p class="card-text">Access all monitoring records generated over time. This section allows you to review all recorded observations, including health assessments, activity levels, and other key indicators.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4 card border-primary">
                <br>
                <div class="card border-success" onclick="location.href='select_individuals.php';">
                    <div class="card-body">
                        <h3 class="card-title text-success">Insert - Individuals</h3>
                        <p class="card-text">Register individual birds from stock by assigning them unique monitoring IDs. This ensures that each bird's health, behavior, and other critical data can be tracked separately..</p>
                    </div>
                </div>
                <div class="card border-success" onclick="location.href='select_pairs.php';">
                    <div class="card-body">
                        <h3 class="card-title text-success">Insert - Pairs</h3>
                        <p class="card-text">Create monitoring records for breeding pairs by assigning a joint ID. This helps track the health and interactions of paired birds, improving data consistency and reproductive monitoring.</p>
                    </div>
                </div>
                
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-warning" onclick="location.href='update.php';">
                    <div class="card-body">
                        <h3 class="card-title text-warning">Update All</h3>
                        <p class="card-text">Review and edit all generated monitoring IDs. This function allows you to correct errors, update bird status, and ensure that all records remain accurate and up to date.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-danger" onclick="location.href='delete.php';">
                    <div class="card-body">
                        <h3 class="card-title text-danger">Delete</h3>
                        <p class="card-text">Remove incorrect or outdated monitoring records. This function ensures that only relevant and accurate data is maintained in the system.</p>
                    </div>
                </div>
            </div>
        </div>

	</div>  

	

<br>



<script src="https://es.windfinder.com/widget/forecast/js/el_pollo?unit_wave=m&unit_rain=mm&unit_temperature=c&unit_wind=kmh&unit_pressure=hPa&days=4&show_day=0&show_waves=0"></script><noscript><a rel="nofollow" href="https://www.windfinder.com/forecast/el_pollo?utm_source=forecast&utm_medium=web&utm_campaign=homepageweather&utm_content=noscript-forecast">Wind forecast for El Pollo</a> provided by <a rel="nofollow" href="https://www.windfinder.com?utm_source=forecast&utm_medium=web&utm_campaign=homepageweather&utm_content=noscript-logo">windfinder.com</a></noscript>



<?php  include_once BASE_URL . "/paginas/pie_3.php";   ?>