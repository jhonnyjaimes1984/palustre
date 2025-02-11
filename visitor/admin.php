<?php include_once "../paginas/cabecera2.php";
include_once "../conf/Configuracion.php"; ?>


    <main role="main" class="content-wrapper">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Inicio</h1>
        
      </div>  

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
    </style>
    <!-- Custom styles for this template -->
    <link href="../css/album.css" rel="stylesheet">
  </head>
  
  

<main role="main">     
  <div class="album py-5 bg-light">
    <div class="container">
   

       
  <?php

     
      $peticion = $db->query("SELECT COUNT(orden.id) FROM orden, clientes WHERE status = '0' AND clientes.orden = orden.id AND year='".date('Y')."'" ); 
      $columna = $peticion->fetch_assoc(); 
      $itempedido = array('id' => $columna['COUNT(orden.id)'] );

      ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h5 class="card-title">Pedidos en el año</h5>
                  <a href="busqueda.php">ver reporte</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg"><?php echo $itempedido['id'].' Ventas en el año';?></span>
                   
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">

                    
                    <span class="text-muted">Ganacia del año <?php echo date("Y");  ?></span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2B9BDB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect></svg> Ventas del mes
                  </span>
                </div>
              </div>
            </div>
          </div>
            <!-- /.card -->

        





                            <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h5 class="card-title">Ventas</h5>
                  <a href="busqueda.php">ver reporte</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <?php 
                    $query = $db->query("SELECT SUM(total_price)  FROM orden, clientes WHERE status ='0' AND clientes.orden = orden.id AND year='".date('Y')."'"); 
                    $row = $query->fetch_assoc(); 
                    $itemData = array('id' => $row['SUM(total_price)'] );?>
                    <span class="text-bold text-lg"><?php echo '$';printf("%.2f",$itemData ['id']) ; echo ' USD' ?> En Venta </span>
                    
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                   
                       
                       
                    <span class="text-muted">Ventas del <?php echo date("Y") ?></span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2B9BDB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect></svg> Este año
                  </span>

                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect></svg> Año pasado
                  </span>
                </div>
              </div>
            </div>





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