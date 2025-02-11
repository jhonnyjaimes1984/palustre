<?php session_start(); if(!isset($_SESSION['nombre']) or $_SESSION['privilegio']!='Administrator'){ header("Location: salir.php"); } 
include_once "../../conf/Config.php"; include_once BASE_URL ."/conf/configuracion.php";?> 
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.1.1">
  <link rel="icon" href="<?php echo BASE_URL;?>/image/imagen_2.png">
  <title>Pagina de Administrador</title>

  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script> 
<style type="text/css">
  

  .content-wrapper {
    transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
    margin-left: 10px; /* Tamaño normal cuando el sidebar está expandido */
    width: calc(95%);
}

.sidebar-collapse .content-wrapper {
    margin-left: 10px !important; /* Ajusta el margen cuando el sidebar se colapsa */
    width: calc(95% );
}
</style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>


      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-primary elevation-4" style="background-color: #00008B;" >
      <!-- Brand Logo -->
      <a href="../admin.php" class="brand-link"><img src="../../image/imagen_2.png" alt="" class="img-size-100 mr-3" width="60" height="60"> BD PALUSTRES </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <li class="nav-item">
                <a class="nav-link" href="../admin.php" style="color: #ffffff;">
                 <img src="../../icons/home.png" alt="" class="img-size-100 mr-3" width="45" height="45">
                 <p> Home </p>
               </a>
             </li>
             <li class="nav-item has-treeview">
               <a href="../stock_birds/stock_birds.php" class="nav-link" style="color: #ffffff;" id="stockBirdsLink">
                <img src="../../icons/individuals2.png" alt="" class="img-size-100 mr-3" width="45" height="45">
                <p>
                  Stock Birds 
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <div id="subMenu" style="display: none;">

              </div>

              <ul class="nav nav-treeview">
               <li class="nav-item">
                <a href="../stock_birds/select.php" class="nav-link" style="color: #ffffff;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../stock_birds/insert_stockbirds.php" class="nav-link" style="color: #ffffff;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Insert</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../stock_birds/update_stockbirds.php" class="nav-link" style="color: #ffffff;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../stock_birds/delete_stockbirds.php" class="nav-link" style="color: #ffffff;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Delete</p> <!-- aqui todo ok -->
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
             <a href="../control_area/select_control_area.php" class="nav-link" style="color: #ffffff;" id="select_control_area">
              <img src="../../icons/control.png" alt="" class="img-size-100 mr-3" width="45" height="45">
              <p>
                Control Area
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <div id="subMenu_1" style="display: none;">
            </div>
            <ul class="nav nav-treeview">
             <li class="nav-item">
              <a href="../control_area/monitoring/select_monitoring.php" class="nav-link" style="color: #ffffff;"> <!-- aqui va bien -->
                <img src="../../icons/monitoring.png" alt="" class="img-size-100 mr-3" width="30" height="30">
                <p>Monitoring</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../control_area/preventive_care/select_preventive_care.php" class="nav-link" style="color: #ffffff;">
                <img src="../../icons/preventive_care.png" alt="" class="img-size-100 mr-3" width="30" height="30">
                <p>Preventive Care</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../control_area/veterinary/select_veterinary.php" class="nav-link" style="color: #ffffff;">
                <img src="../../icons/veterinary.png" alt="" class="img-size-100 mr-3" width="30" height="30">
                <p>Veterinary</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../control_area/assignment/select_assignment.php" class="nav-link" style="color: #ffffff;"> <!-- aqui va bien -->
                <img src="../../icons/assignment.png" alt="" class="img-size-100 mr-3" width="30" height="30">
                <p>Assignment</p> <!-- aqui ok -->
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item has-treeview">
          <a href="../bredding_area/select_breeding_area.php" class="nav-link" style="color: #ffffff;" id="select_breeding_area">
           <img src="../../icons/breeding_area.png" alt="" class="img-size-100 mr-3" width="45" height="45">
           <p>
             Bredding Area
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <div id="subMenu_2" style="display: none;"></div>

        <ul class="nav nav-treeview">
         <li class="nav-item">
          <a href="../bredding_area/pairs/select_pairs.php" class="nav-link" style="color: #ffffff;">
            <img src="../../icons/pairs.png" alt="" class="img-size-100 mr-3" width="30" height="30">
            <p>Pairs</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../bredding_area/clutches/select_clutches.php" class="nav-link" style="color: #ffffff;">
            <img src="../../icons/egg.png" alt="" class="img-size-100 mr-3" width="30" height="30">
            <p>Clutches</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../bredding_area/egg/select_egg.php" class="nav-link" style="color: #ffffff;">
            <img src="../../icons/egg.png" alt="" class="img-size-100 mr-3" width="30" height="30">
            <p>Egg</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../bredding_area/incubation/select_incubation.php" class="nav-link" style="color: #ffffff;">
            <img src="../../icons/incubation.png" alt="" class="img-size-100 mr-3" width="30" height="30">
            <p>Incubation</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../bredding_area/chickens/select_chickens.php" class="nav-link" style="color: #ffffff;">
            <img src="../../icons/chickens.png" alt="" class="img-size-100 mr-3" width="30" height="30">
            <p>Chickens</p> <!-- aqui ok -->
          </a>
        </li>
      </ul>
    </li>



    <li class="nav-item has-treeview">
      <a href="../ex_situ_area/select_ex_situ_area.php" class="nav-link" style="color: #ffffff;" id="select_ex_situ_area">
        <img src="../../icons/area_ex_situ.png" alt="" class="img-size-100 mr-3" width="45" height="45">
        <p>
         Ex-situ Area
         <i class="fas fa-angle-left right"></i>
       </p>
     </a>
     <div id="subMenu_3" style="display: none;"></div>

     <ul class="nav nav-treeview">
       <li class="nav-item">
        <a href="../ex_situ_area/release/select_release.php" class="nav-link" style="color: #ffffff;">
          <img src="../../icons/release.png" alt="" class="img-size-100 mr-3" width="30" height="30">
          Release
        </p>
      </a>
  </li>
  <li class="nav-item">
    <a href="../ex_situ_area/tracking/select_tracking.php" class="nav-link" style="color: #ffffff;">
      <img src="../../icons/tracking.png" alt="" class="img-size-100 mr-3" width="30" height="30">
      <p>
       Tracking
     
     </p> <!-- aqui ok -->
   </a> 
</li>
</ul>
<li class="nav-item has-treeview">
  <a href="../management_area/select_management_area.php" class="nav-link" style="color: #ffffff;" id="select_management_area">
   <img src="../../icons/management.png" alt="" class="img-size-100 mr-3" width="45" height="45">
   <p>
    Management Area
    <i class="fas fa-angle-left right"></i>
  </p>
</a>
 <div id="subMenu_4" style="display: none;"></div>

<ul class="nav nav-treeview">
 <li class="nav-item">
  <a href="../management_area/species/select_species.php" class="nav-link" style="color: #ffffff;">
   <img src="../../icons/species.png" alt="" class="img-size-100 mr-3" width="30" height="30">
   <p>Species</p>
 </a>
</li>
<li class="nav-item">
  <a href="../management_area/origin/select_origin.php" class="nav-link" style="color: #ffffff;">
   <img src="../../icons/origin.png" alt="" class="img-size-100 mr-3" width="30" height="30">
   <p>Origin</p>
 </a>
</li>
<li class="nav-item">
  <a href="../management_area/facilities/select_facilities.php" class="nav-link" style="color: #ffffff;">
    <img src="../../icons/facilities.png" alt="" class="img-size-100 mr-3" width="30" height="30">
    <p>Facilities</p>
  </a>
</li>
<li class="nav-item">
  <a href="../management_area/nest/select_nest.php" class="nav-link" style="color: #ffffff;">
    <img src="../../icons/nest.png" alt="" class="img-size-100 mr-3" width="30" height="30">
    <p>Nest</p>
  </a>
</li>
<li class="nav-item">
  <a href="../management_area/staff/select_staff.php" class="nav-link" style="color: #ffffff;">
   <img src="../../icons/staff.png" alt="" class="img-size-100 mr-3" width="30" height="30">
   <p>Staff</p>
 </a>
</li>
<li class="nav-item">
  <a href="../management_area/privileges/select_privileges.php" class="nav-link" style="color: #ffffff;">
   <img src="../../icons/privileges.png" alt="" class="img-size-100 mr-3" width="30" height="30">
   <p>Privileges</p>
 </a>
</li>

</ul>
</li>

<li class="nav-item">
  <a class="nav-link"  href="../../admin/salir.php" style="color: #ffffff;">
   <i class="nav-icon   fas fa-sign-out-alt" ></i>
   <p>Salir</p>
 </a>
</li>


</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
<script>
  document.getElementById("stockBirdsLink").addEventListener("click", function(event) {
    var submenu = document.getElementById("subMenu");
    var icon = this.querySelector("i");

    // Si el submenú está visible, se va al enlace
    if (submenu.style.display === "block") {
      window.location.href = this.href; // Navega al href del enlace
    } else {
      // Si el submenú no está visible, lo muestra
      submenu.style.display = "block";
      icon.classList.toggle("fa-angle-left"); // Cambiar icono
      icon.classList.toggle("fa-angle-down"); // Cambiar icono
      event.preventDefault(); // Prevenir que se siga el enlace
    }
  });

  document.getElementById("select_control_area").addEventListener("click", function(event) {
    var submenu = document.getElementById("subMenu_1");
    var icon = this.querySelector("i");

    // Si el submenú está visible, se va al enlace
    if (submenu.style.display === "block") {
      window.location.href = this.href; // Navega al href del enlace
    } else {
      // Si el submenú no está visible, lo muestra
      submenu.style.display = "block";
      icon.classList.toggle("fa-angle-left"); // Cambiar icono
      icon.classList.toggle("fa-angle-down"); // Cambiar icono
      event.preventDefault(); // Prevenir que se siga el enlace
    }
  });


  document.getElementById("select_breeding_area").addEventListener("click", function(event) {
    var submenu = document.getElementById("subMenu_2");
    var icon = this.querySelector("i");

    // Si el submenú está visible, se va al enlace
    if (submenu.style.display === "block") {
      window.location.href = this.href; // Navega al href del enlace
    } else {
      // Si el submenú no está visible, lo muestra
      submenu.style.display = "block";
      icon.classList.toggle("fa-angle-left"); // Cambiar icono
      icon.classList.toggle("fa-angle-down"); // Cambiar icono
      event.preventDefault(); // Prevenir que se siga el enlace
    }
  });

   document.getElementById("select_ex_situ_area").addEventListener("click", function(event) {
    var submenu = document.getElementById("subMenu_3");
    var icon = this.querySelector("i");

    // Si el submenú está visible, se va al enlace
    if (submenu.style.display === "block") {
      window.location.href = this.href; // Navega al href del enlace
    } else {
      // Si el submenú no está visible, lo muestra
      submenu.style.display = "block";
      icon.classList.toggle("fa-angle-left"); // Cambiar icono
      icon.classList.toggle("fa-angle-down"); // Cambiar icono
      event.preventDefault(); // Prevenir que se siga el enlace
    }
  });

    document.getElementById("select_management_area").addEventListener("click", function(event) {
    var submenu = document.getElementById("subMenu_4");
    var icon = this.querySelector("i");

    // Si el submenú está visible, se va al enlace
    if (submenu.style.display === "block") {
      window.location.href = this.href; // Navega al href del enlace
    } else {
      // Si el submenú no está visible, lo muestra
      submenu.style.display = "block";
      icon.classList.toggle("fa-angle-left"); // Cambiar icono
      icon.classList.toggle("fa-angle-down"); // Cambiar icono
      event.preventDefault(); // Prevenir que se siga el enlace
    }
  });

  
</script>