<br>
<br>
<br>


			</div>

<script src="../../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS 
<script src="../../../plugins/chart.js/Chart.min.js"></script> -->
<!-- Sparkline -->
<script src="../../../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../../plugins/moment/moment.min.js"></script>
<script src="../../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../dist/js/demo.js"></script>
<script src="../../../plugins/jquery/jquery.min.js"></script> 

<script src="../../../plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="../../../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script> 
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script> -->
<script src="../../../dist//dashboard.js"></script></body>
<script src="../../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script>
  $(function () {
    $("#example1").DataTable({
      order: [[0, "desc"]], // Ordenar por la primera columna (id) en orden descendente
      language:{
        "emptyTable": "No hay datos para mostrar",
        "info":"Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "search":"Buscar:",
        "infoFiltered":"(Filtrado de _MAX_ total entradas)",
        "lengthMenu": 'Mostrando <select>'+
       '<option value="10">10</option>'+
       '<option value="20">20</option>'+
       '<option value="50">50</option>'+
       '<option value="100">100</option>'+       
       '<option value="-1">Todos</option>'+
       '</select> Entradas',
        "paginate": {
          "first":"Primero",
          "last":"Último",
          "next":"Next",
          "previous":"Anterior" // Corregido "Previous" a "previous"
        }
      }
    });
});

   $(function () {
    $("#example2").DataTable({
    order: [[0, "desc"]], // Ordenar por la primera columna (id) en orden descendente
      language:{
        "emptyTable": "No hay datos para mostrar",
        "info":"Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "search":"Buscar:",
        "infoFiltered":"(Filtrado de _MAX_ total entradas)",
        "lengthMenu": 'Mostrando <select>'+
       '<option value="10">10</option>'+
       '<option value="20">20</option>'+
       '<option value="50">50</option>'+
       '<option value="100">100</option>'+       
       '<option value="-1">Todos</option>'+
       '</select> Entradas',
        "paginate": {
          "first":"Primero",
          "last":"Último",
          "next":"Next",
          "previous":"Anterior" // Corregido "Previous" a "previous"
        }
      }
    });
    
  });
   $(function () {
    $("#example3").DataTable({
    order: [[0, "desc"]], // Ordenar por la primera columna (id) en orden descendente
      language:{
        "emptyTable": "No hay datos para mostrar",
        "info":"Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "search":"Buscar:",
        "infoFiltered":"(Filtrado de _MAX_ total entradas)",
        "lengthMenu": 'Mostrando <select>'+
       '<option value="10">10</option>'+
       '<option value="20">20</option>'+
       '<option value="50">50</option>'+
       '<option value="100">100</option>'+       
       '<option value="-1">Todos</option>'+
       '</select> Entradas',
        "paginate": {
          "first":"Primero",
          "last":"Último",
          "next":"Next",
          "previous":"Anterior" // Corregido "Previous" a "previous"
        }
      }
    });
    
  });
    $(function () {
    $("#example4").DataTable({
    order: [[0, "desc"]], // Ordenar por la primera columna (id) en orden descendente
      language:{
        "emptyTable": "No hay datos para mostrar",
        "info":"Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "search":"Buscar:",
        "infoFiltered":"(Filtrado de _MAX_ total entradas)",
        "lengthMenu": 'Mostrando <select>'+
       '<option value="10">10</option>'+
       '<option value="20">20</option>'+
       '<option value="50">50</option>'+
       '<option value="100">100</option>'+       
       '<option value="-1">Todos</option>'+
       '</select> Entradas',
        "paginate": {
          "first":"Primero",
          "last":"Último",
          "next":"Next",
          "previous":"Anterior" // Corregido "Previous" a "previous"
        }
      }
    });
    
  });

    

    document.addEventListener("DOMContentLoaded", function () {
    let body = document.body;
    let content = document.querySelector(".content-wrapper");

    function adjustContentWidth() {
      if (body.classList.contains("sidebar-collapse")) {
        content.style.marginLeft = "80px"; // Sidebar colapsado
        content.style.width = "calc(95%)";
      } else {
        content.style.marginLeft = "250px"; // Sidebar expandido
        content.style.width = "calc(95%)";
      }
    }

    document.querySelector("[data-widget='pushmenu']").addEventListener("click", function () {
      setTimeout(adjustContentWidth, 300);
    });

    adjustContentWidth(); // Ejecutar al cargar la página
  });
</script>



</body>

</html>