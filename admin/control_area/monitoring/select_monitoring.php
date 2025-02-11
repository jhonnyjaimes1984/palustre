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
                        <h3 class="card-title text-primary">View</h3>
                        <p class="card-text">View all breeding pairs, their compatibility, and reproductive history.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4 card border-primary">
                <br>
                <div class="card border-success" onclick="location.href='select_individuals.php';">
                    <div class="card-body">
                        <h3 class="card-title text-success">Insert - Individuals</h3>
                        <p class="card-text">View existing records in the stock. This allows you to see and review all the birds that are currently listed.</p>
                    </div>
                </div>
                <div class="card border-success" onclick="location.href='select_pairs.php';">
                    <div class="card-body">
                        <h3 class="card-title text-success">Insert - Pairs</h3>
                        <p class="card-text">Add new entries to the stock database. Use this option to register new birds and update relevant details.</p>
                    </div>
                </div>
                
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-warning" onclick="location.href='update.php';">
                    <div class="card-body">
                        <h3 class="card-title text-warning">Update</h3>
                        <p class="card-text">Modify pair data, including status, success rates, and separation details.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-danger" onclick="location.href='delete.php';">
                    <div class="card-body">
                        <h3 class="card-title text-danger">Delete</h3>
                        <p class="card-text">Remove outdated or incorrect pair records from the system.</p>
                    </div>
                </div>
            </div>
        </div>

	</div>  

	<div class="row">
	

			 <div class="col-md-6 mb-6">
                
            </div>
            <div class="col-md-6 mb-6">
                
            </div>
        </div>

<br>



<script src="https://es.windfinder.com/widget/forecast/js/el_pollo?unit_wave=m&unit_rain=mm&unit_temperature=c&unit_wind=kmh&unit_pressure=hPa&days=4&show_day=0&show_waves=0"></script><noscript><a rel="nofollow" href="https://www.windfinder.com/forecast/el_pollo?utm_source=forecast&utm_medium=web&utm_campaign=homepageweather&utm_content=noscript-forecast">Wind forecast for El Pollo</a> provided by <a rel="nofollow" href="https://www.windfinder.com?utm_source=forecast&utm_medium=web&utm_campaign=homepageweather&utm_content=noscript-logo">windfinder.com</a></noscript>



<?php  include_once BASE_URL . "/paginas/pie_3.php";   ?>