<?php include_once "../paginas/cabecera_admin.php" ?>
<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/album/">
<!-- Bootstrap core CSS -->
<style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
}
</style>
<!-- Custom styles for this template -->
<link href="../css/album.css" rel="stylesheet">
</head>


<main role="main" class="content-wrapper">

  <div class="container-fluid text-center my-5" style="background-color: #e0f7fa; pcolor: white; padding: 20px; border-radius: 8px; ">
    <h1 class="display-4 text-primary font-weight-bold">Welcome DATABASE Palustres System</h1>
    <p class="lead text-dark">Manage all the birds, their pairs, rings, and more with ease.</p>
  </div>

  <div class="container-fluid text-center my-5">
    <h3 class="display-4 text-primary font-weight-bold mb-3">Description</h3>
    <p class="lead text-dark">
      This database is designed to manage and track various aspects of bird species, including individuals, breeding pairs, rings, and their incubation processes. It allows authorized personnel to efficiently store and access detailed information on each bird, including its ID, species, sex, year of birth, and status. The system also manages breeding pairs, clutches, and incubation data for proper monitoring and control.
    </p>

    <p class="lead text-dark">
      This database is exclusively available for authorized personnel. Any questions regarding its operation or to report errors should be directed to <strong>Daniel Mons Garcia</strong> at <a href="mailto:danielmons.granja@gmail.com">danielmons.granja@gmail.com</a>.
    </p>
  </div>

<!-- Field Observations Section -->
<div class="container-fluid text-center my-5" style="background-color: #e0f7fa; pcolor: white; padding: 20px; border-radius: 8px; ">
  <h1 class="display-4 text-primary font-weight-bold">Field Observations</h3>
    <p class="lead text-dark">
      In addition to managing bird data, this database is also used to record <strong>standardized bird sighting notes in the field</strong>. This functionality ensures that observations are documented consistently, facilitating the tracking and study of bird species in their natural habitats.
    </p>
  </div>
</div>
</div>

<?php  include_once "../paginas/pie_1.php";   ?>

<script >
  $(function () {
    'use strict'

    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    }

    var mode      = 'index'
    var intersect = true

    var $salesChart = $('#sales-chart')
    var salesChart  = new Chart($salesChart, {
      type   : 'bar',
      data   : {
        labels  : ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGOS', 'SEP', 'OCT', 'NOV', 'DIC'],
        datasets: [
          {
            backgroundColor: '#007bff',
            borderColor    : '#007bff',
            data           : [ <?php 


              $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '01' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id"); 
              $columna = $peticion->fetch_assoc(); 
              $itemmes = array('enero' => $columna['SUM(total_price)'] ); 
              printf("%.2f",$itemmes['enero']) ;?>,

              <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '02' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
              $columna = $peticion->fetch_assoc(); 
              $itemmes = array('febrero' => $columna['SUM(total_price)'] ); 
              printf("%.2f",$itemmes['febrero']) ;?>,

              <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '03' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
              $columna = $peticion->fetch_assoc(); 
              $itemmes = array('marzo' => $columna['SUM(total_price)'] ); 
              printf("%.2f",$itemmes['marzo']) ;?>,

              <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '04' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
              $columna = $peticion->fetch_assoc(); 
              $itemmes = array('abril' => $columna['SUM(total_price)'] ); 
              printf("%.2f",$itemmes['abril']) ;?>,

              <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '05' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
              $columna = $peticion->fetch_assoc(); 
              $itemmes = array('mayo' => $columna['SUM(total_price)'] ); 
              printf("%.2f",$itemmes['mayo']) ;?>,

              <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '06' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
              $columna = $peticion->fetch_assoc(); 
              $itemmes = array('junio' => $columna['SUM(total_price)'] ); 
              printf("%.2f",$itemmes['junio']) ;?>,

              <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '07' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
              $columna = $peticion->fetch_assoc(); 
              $itemmes = array('julio' => $columna['SUM(total_price)'] ); 
              printf("%.2f",$itemmes['julio']) ;?>,

              <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '08' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
              $columna = $peticion->fetch_assoc(); 
              $itemmes = array('agosto' => $columna['SUM(total_price)'] ); 
              printf("%.2f",$itemmes['agosto']) ;?>,

              <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '09' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
              $columna = $peticion->fetch_assoc(); 
              $itemmes = array('sep' => $columna['SUM(total_price)'] ); 
              printf("%.2f",$itemmes['sep']) ;?>,

              <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '10' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
              $columna = $peticion->fetch_assoc(); 
              $itemmes = array('oct' => $columna['SUM(total_price)'] ); 
              printf("%.2f",$itemmes['oct']) ;?>,

              <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '11' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
              $columna = $peticion->fetch_assoc(); 
              $itemmes = array('nov' => $columna['SUM(total_price)'] ); 
              printf("%.2f",$itemmes['nov']) ;?>,

              <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '12' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
              $columna = $peticion->fetch_assoc(); 
              $itemmes = array('dic' => $columna['SUM(total_price)'] ); 
              printf("%.2f",$itemmes['dic']) ;?>]
            },
            {
              backgroundColor: '#ced4da',
              borderColor    : '#ced4da',
              data           : [<?php

                $date = date("Y");
                $anio = $date - 1;


                $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '01' and year ='".$anio."' and status='0' AND clientes.orden = orden.id"); 
                $columna = $peticion->fetch_assoc(); 
                $itemmes = array('enero' => $columna['SUM(total_price)'] ); 
                if ($itemmes['enero'] <= 0){
                  $itemmes['enero'] = 0;
                  printf("%.2f",$itemmes['enero']);
                }else{
                printf("%.2f",$itemmes['enero']);} ?>,

                <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '02' and year ='".$anio."' and status='0' AND clientes.orden = orden.id");
                $columna = $peticion->fetch_assoc(); 
                $itemmes = array('febrero' => $columna['SUM(total_price)'] ); 
                if ($itemmes['febrero'] <= 0){
                  $itemmes['febrero'] = 0;
                  printf("%.2f",$itemmes['febrero'] );
                }else{
                printf("%.2f",$itemmes['febrero'] );} ?>,

                <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '03' and year ='".$anio."' and status='0' AND clientes.orden = orden.id");
                $columna = $peticion->fetch_assoc(); 
                $itemmes = array('marzo' => $columna['SUM(total_price)'] ); 
                if ($itemmes['marzo'] <= 0){
                  $itemmes['marzo'] = 0;
                  printf("%.2f",$itemmes['marzo']) ;
                }else{
                printf("%.2f",$itemmes['marzo'] );} ?>,

                <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '04' and year ='".$anio."' and status='0' AND clientes.orden = orden.id");
                $columna = $peticion->fetch_assoc(); 
                $itemmes = array('abril' => $columna['SUM(total_price)'] ); 
                if ($itemmes['abril'] <= 0){
                  $itemmes['abril'] = 0;
                  printf("%.2f",$itemmes['abril']) ;
                }else{
                printf("%.2f",$itemmes['abril']);} ?>,

                <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '05' and year ='".$anio."' and status='0' AND clientes.orden = orden.id");
                $columna = $peticion->fetch_assoc(); 
                $itemmes = array('mayo' => $columna['SUM(total_price)'] ); 
                if ($itemmes['mayo'] <= 0){
                  $itemmes['mayo'] = 0;
                  printf("%.2f",$itemmes['mayo'] );
                }else{
                printf("%.2f",$itemmes['mayo']);} ?>,

                <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '06' and year ='".$anio."' and status='0' AND clientes.orden = orden.id");
                $columna = $peticion->fetch_assoc(); 
                $itemmes = array('junio' => $columna['SUM(total_price)'] ); 
                if ($itemmes['junio'] <= 0){
                  $itemmes['junio'] = 0;
                  printf("%.2f",$itemmes['junio']) ;
                }else{
                printf("%.2f",$itemmes['junio']);} ?>,

                <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '07' and year ='".$anio."' and status='0' AND clientes.orden = orden.id");
                $columna = $peticion->fetch_assoc(); 
                $itemmes = array('julio' => $columna['SUM(total_price)'] ); 
                if ($itemmes['julio'] <= 0){
                  $itemmes['julio'] = 0;
                  printf("%.2f",$itemmes['julio'] );
                }else{
                printf("%.2f",$itemmes['julio']);} ?>,

                <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '08' and year ='".$anio."' and status='0' AND clientes.orden = orden.id");
                $columna = $peticion->fetch_assoc(); 
                $itemmes = array('agosto' => $columna['SUM(total_price)'] ); 
                if ($itemmes['agosto'] <= 0){
                  $itemmes['agosto'] = 0;
                  printf("%.2f",$itemmes['agosto'] );
                }else{
                printf("%.2f",$itemmes['agosto'] );} ?>,

                <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '09' and year ='".$anio."' and status='0' AND clientes.orden = orden.id");
                $columna = $peticion->fetch_assoc(); 
                $itemmes = array('sep' => $columna['SUM(total_price)'] ); 
                if ($itemmes['sep'] <= 0){
                  $itemmes['sep'] = 0;
                  printf("%.2f",$itemmes['sep'] );
                }else{
                printf("%.2f",$itemmes['sep'] );} ?>,

                <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '10' and year ='".$anio."' and status='0' AND clientes.orden = orden.id");
                $columna = $peticion->fetch_assoc(); 
                $itemmes = array('oct' => $columna['SUM(total_price)'] ); 
                if ($itemmes['oct'] <= 0){
                  $itemmes['oct'] = 0;
                  printf("%.2f",$itemmes['oct']) ;
                }else{
                printf("%.2f",$itemmes['oct'] );} ?>,

                <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '11' and year ='".$anio."' and status='0' AND clientes.orden = orden.id");
                $columna = $peticion->fetch_assoc(); 
                $itemmes = array('nov' => $columna['SUM(total_price)'] ); 
                if ($itemmes['nov'] <= 0){
                  $itemmes['nov'] = 0;
                  printf("%.2f",$itemmes['nov']) ;
                }else{
                printf("%.2f",$itemmes['nov']);} ?>,

                <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '12' and year ='".$anio."' and status='0' AND clientes.orden = orden.id");
                $columna = $peticion->fetch_assoc(); 
                $itemmes = array('dic' => $columna['SUM(total_price)'] ); 
                if ($itemmes['dic'] <= 0){
                  $itemmes['dic'] = 0;
                  printf("%.2f",$itemmes['dic'] );
                }else{
                printf("%.2f",$itemmes['dic'] );} ?>]
              }
            ]
          },
          options: {
            maintainAspectRatio: false,
            tooltips           : {
              mode     : mode,
              intersect: intersect
            },
            hover              : {
              mode     : mode,
              intersect: intersect
            },
            legend             : {
              display: false
            },
            scales             : {
              yAxes: [{
          // display: false,
                gridLines: {
                  display      : true,
                  lineWidth    : '4px',
                  color        : 'rgba(0, 0, 0, .2)',
                  zeroLineColor: 'transparent'
                },
                ticks    : $.extend({
                  beginAtZero: true,

            // Include a dollar sign in the ticks
                  callback: function (value, index, values) {
                    if (value >= 1000) {
                      value /= 1000
                      value += 'k'
                    }
                    return '$' + value
                  }
                }, ticksStyle)
              }],
              xAxes: [{
                display  : true,
                gridLines: {
                  display: false
                },
                ticks    : ticksStyle
              }]
            }
          }
        })

var $visitorsChart = $('#visitors-chart')
var visitorsChart  = new Chart($visitorsChart, {
  data   : {
    labels  : ['Ene','Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic'],
    datasets: [{
      type                : 'line',
      data                : [
        <?php 
        $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '01' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id"); 
        $columna = $peticion->fetch_assoc(); 
        $ventas = array('enero' => $columna['SUM(total_price)'] ); 
        printf("%.2f",$ventas['enero']) ;?>,

        <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '02' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
        $columna = $peticion->fetch_assoc(); 
        $ventas = array('febrero' => $columna['SUM(total_price)'] ); 
        printf("%.2f",$ventas['febrero']) ;?>,

        <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '03' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
        $columna = $peticion->fetch_assoc(); 
        $ventas = array('marzo' => $columna['SUM(total_price)'] ); 
        printf("%.2f",$ventas['marzo']) ;?>,

        <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '04' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
        $columna = $peticion->fetch_assoc(); 
        $ventas = array('abril' => $columna['SUM(total_price)'] ); 
        printf("%.2f",$ventas['abril']) ;?>,

        <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '05' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
        $columna = $peticion->fetch_assoc(); 
        $ventas = array('mayo' => $columna['SUM(total_price)'] ); 
        printf("%.2f",$ventas['mayo']) ;?>,

        <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '06' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
        $columna = $peticion->fetch_assoc(); 
        $ventas = array('junio' => $columna['SUM(total_price)'] ); 
        printf("%.2f",$ventas['junio']) ;?>,

        <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '07' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
        $columna = $peticion->fetch_assoc(); 
        $ventas = array('julio' => $columna['SUM(total_price)'] ); 
        printf("%.2f",$ventas['julio']) ;?>,

        <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '08' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
        $columna = $peticion->fetch_assoc(); 
        $ventas = array('agosto' => $columna['SUM(total_price)'] ); 
        printf("%.2f",$ventas['agosto']) ;?>,

        <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '09' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
        $columna = $peticion->fetch_assoc(); 
        $ventas = array('sep' => $columna['SUM(total_price)'] ); 
        printf("%.2f",$ventas['sep']) ;?>,

        <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '10' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
        $columna = $peticion->fetch_assoc(); 
        $ventas = array('oct' => $columna['SUM(total_price)'] ); 
        printf("%.2f",$ventas['oct']) ;?>,

        <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '11' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
        $columna = $peticion->fetch_assoc(); 
        $ventas = array('nov' => $columna['SUM(total_price)'] ); 
        printf("%.2f",$ventas['nov']) ;?>,

        <?php $peticion = $db->query("SELECT SUM(total_price) FROM `orden`,clientes WHERE mes = '12' and year ='".date('Y')."' and status='0' AND clientes.orden = orden.id");
        $columna = $peticion->fetch_assoc(); 
        $ventas = array('dic' => $columna['SUM(total_price)'] ); 
        printf("%.2f",$ventas['dic'] );?>],
        backgroundColor     : 'transparent',
        borderColor         : '#007bff',
        pointBorderColor    : '#007bff',
        pointBackgroundColor: '#007bff',
        fill                : false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      }]
    },


    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero : true,
            suggestedMax: 1000
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
})

</script>