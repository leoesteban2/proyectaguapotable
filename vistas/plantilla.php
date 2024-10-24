<?php

session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Proyecto Agua Potable</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="icon" href="vistas/img/plantilla/icono-agua.png">
  <!-- PLUGINGS DE CSS -->
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- DataTables -->
    <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

          <!-- PLUGINGS DE JAVASCRIPT -->
  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
<script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
<script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>

  <!-- Agrega Select2 desde CDN -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>


<!-- CUERPO DOCUMENTO -->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">



<?php

if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

/* Site wrapper */
  echo '<div class="wrapper">';

  include "modulos/cabezote.php";
  include "modulos/menu.php";

  /* contenido */

  if(isset($_GET["ruta"])){

    if($_GET["ruta"] == "inicio" ||
       $_GET["ruta"] == "usuarios" ||
       $_GET["ruta"] == "usuariosproyecto" ||
       $_GET["ruta"] == "certificado" ||
       $_GET["ruta"] == "tarifas" ||
       $_GET["ruta"] == "contadores" ||
       $_GET["ruta"] == "asignarcontador" ||
       $_GET["ruta"] == "exceso" ||
       $_GET["ruta"] == "lectura" ||
       $_GET["ruta"] == "pagos" ||
       $_GET["ruta"] == "crear-cobros" ||
       $_GET["ruta"] == "reportecontador" ||
       $_GET["ruta"] == "reportecobros" ||
       $_GET["ruta"] == "reportepagos" ||
       $_GET["ruta"] == "reportelectura" ||
       $_GET["ruta"] == "reportes" ||
       $_GET["ruta"] == "estadocuenta" ||
       $_GET["ruta"] == "salir"){

      include "modulos/".$_GET["ruta"].".php";

    }else{

      include "modulos/404.php";

    }

  }else{

    include "modulos/inicio.php";

  }

  //FOOTER
  include "modulos/footer.php";

  echo '</div>';
 } else{

  include "modulos/login.php";

 }

?>

  <!-- =============================================== -->

  <!-- =============================================== -->

  
  <!-- /.content-wrapper -->

  
  <!-- Control Sidebar -->
 
</div>
<!-- ./wrapper -->

<script src="vistas/js/plantilla.js" ></script>
<script src="vistas/js/usuarios.js" ></script>
<script src="vistas/js/usuariosproyecto.js" ></script>
<script src="vistas/js/contador.js" ></script>
<script src="vistas/js/asignarcontador.js" ></script>
<script src="vistas/js/certificado.js" ></script>
<script src="vistas/js/lectura.js"></script>
<script src="vistas/js/tarifa.js"></script>
<script src="vistas/js/exceso.js"></script>
<script src="vistas/js/cobros.js"></script>
<script src="vistas/js/pagos.js"></script>

</body>
</html>
