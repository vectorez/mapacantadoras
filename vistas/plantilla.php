<?php

session_start();
ini_set('display_errors', 'On');
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>

<head>

    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

  
  <link href="vistas/assets/css/theme.css" rel="stylesheet">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Map places</title>
  <!-- ===============================================-->
  <!--    Stylesheets-->
  <!-- ===============================================-->
  <script src="vistas/assets/js/config.navbar-vertical.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
  <!-- <link href="vistas/assets/lib/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet">
  <link href="vistas/assets/lib/datatables-bs4/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="vistas/assets/lib/datatables.net-responsive-bs4/responsive.bootstrap4.css" rel="stylesheet">
  <link href="vistas/assets/lib/leaflet/leaflet.css" rel="stylesheet">
  <link href="vistas/assets/lib/leaflet.markercluster/MarkerCluster.css" rel="stylesheet">
  <link href="vistas/assets/lib/leaflet.markercluster/MarkerCluster.Default.css" rel="stylesheet"> -->


  <!-- <link href="vistas/assets/lib/select2/select2.min.css" rel="stylesheet"> -->
  <link href="vistas/assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="vistas/assets/lib/sweetalert2/dist/sweetalert2.min.css"> -->
  <link href="vistas/assets/lib/owl.carousel/owl.carousel.css" rel="stylesheet">
  <link rel="stylesheet" href="vistas/css/inicio.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
  <link href="vistas/assets/lib/apollo/audio7_html5.css" rel="stylesheet" type="text/css">
  <link href="vistas/css/style.css" rel="stylesheet">

  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->
  <script src="vistas/assets/js/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
  <script src="vistas/assets/js/popper.min.js"></script>
  <script src="vistas/assets/js/bootstrap.min.js"></script>
  <!-- <script src="vistas/assets/lib/stickyfilljs/stickyfill.min.js"></script>
  <script src="vistas/assets/lib/sticky-kit/sticky-kit.min.js"></script>
  <script src="vistas/assets/lib/is_js/is.min.js"></script>
  <script src="vistas/assets/lib/lodash/lodash.min.js"></script>
  <script src="vistas/assets/lib/perfect-scrollbar/perfect-scrollbar.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
  <script src="vistas/assets/lib/chart.js/Chart.min.js"></script>
  <script src="vistas/assets/lib/datatables/js/jquery.dataTables.min.js"></script>
  <script src="vistas/assets/lib/datatables-bs4/dataTables.bootstrap4.min.js"></script>
  <script src="vistas/assets/lib/datatables.net-responsive/dataTables.responsive.js"></script>
  <script src="vistas/assets/lib/datatables.net-responsive-bs4/responsive.bootstrap4.js"></script>
  <script src="vistas/assets/lib/leaflet/leaflet.js"></script>
  <script src="vistas/assets/lib/leaflet.markercluster/leaflet.markercluster.js"></script>
  <script src="vistas/assets/lib/leaflet.tilelayer.colorfilter/leaflet-tilelayer-colorfilter.min.js"></script>
  
  <script src="vistas/assets/js/theme.js"></script>
  <script src="vistas/assets/lib/select2/select2.min.js"></script>
  <script src="vistas/assets/lib/sweetalert2/dist/sweetalert2.min.js"></script> -->
  <script src="vistas/assets/lib/three/three.min.js"></script>
  <script src="vistas/assets/lib/panolens/panolens.min.js"></script>
  <script src="vistas/assets/lib/owl.carousel/owl.carousel.js"></script>
  <script src="vistas/assets/lib/apollo/js/jquery.mousewheel.min.js" type="text/javascript"></script>
  <script src="vistas/assets/lib/apollo/js/jquery.touchSwipe.min.js" type="text/javascript"></script>
  <script src="vistas/assets/lib/apollo/js_UNCODED/audio7_html5.js" type="text/javascript"></script>
  <script src="vistas/js/inicio.js?v=1"></script>

</head>

<body id="bodyId" data-spy="scroll" class="perfect-scrollbar scrollbar" data-target="#v-pills" data-offset="90">
  <?php
  date_default_timezone_set('America/Bogota');
  // echo '<main class="main" id="top">
  // <div class="container-fluid">
  // <div class="content">';
  /* Menu */
  // include "modulos/cabezote.php";
  // VISTA
  include "modulos/inicio.php";
  /* Footer */
  // include "modulos/footer.php";

  // echo '</div>'; 
  // echo '</div></main>';

  ?>

</body>

</html>