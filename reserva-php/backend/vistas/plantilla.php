<?php 
	session_start();
	$ruta=RutaContralador::ctrRutaServidor();
	$rutaFrom=RutaContralador::ctrRuta();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <title>Hotel | Backend</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1">

	 <link rel="icon" href="vistas/img/plantilla/icono.jpg">
	<!-- =================================
		PLUGINS DE ADMINLTE 
	====================================== -->
	<link rel="stylesheet" href="vistas/css/plugins/OverlayScrollbars.min.css">
	<link rel="stylesheet" href="vistas/css/plugins/adminlte.min.css">

	<!-- FONT AWESOME -->
	<script src="https://kit.fontawesome.com/57549a60e0.js" crossorigin="anonymous"></script>


	<!-- CSS  -->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- 360 PANO -->
	<link rel="stylesheet" href="vistas/css/plugins/jquery.pano.css">

	<!-- DataTables 
	https://datatables.net/-->
	<link rel="stylesheet" href="vistas/css/plugins/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="vistas/css/plugins/responsive.bootstrap.min.css">

	<!-- COLOR PICKER -->
	<link rel="stylesheet" href="vistas/css/plugins/bootstrap-colorpicker.min.css">

	<!-- ICHECK -->
	<link rel="stylesheet" href="vistas/css/plugins/minimal/blue.css">

	<!-- FULL CALENDAR -->
	<link rel="stylesheet" href="vistas/css/plugins/fullcalendar.css">

	<!-- DATEPICKER -->
	<link rel="stylesheet" href="vistas/css/plugins/bootstrap-datepicker.min.css">
	<!-- JS  -->

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<!-- ADMINLTE -->

	<script src="vistas/js/plugins/adminlte.min.js"></script>
	<script src="vistas/js/plugins/jquery.overlayScrollbars.min.js"></script>

		<!-- DataTables 
	https://datatables.net/-->
	<script src="vistas/js/plugins/jquery.dataTables.min.js"></script>
	<script src="vistas/js/plugins/dataTables.bootstrap4.min.js"></script>
	<script src="vistas/js/plugins/dataTables.responsive.min.js"></script>
	<script src="vistas/js/plugins/responsive.bootstrap.min.js"></script>

	<!-- sweetalert2 -->
	<script src="vistas/js/plugins/sweetalert2.all.js"></script>

	<!-- Color Piker -->
	<!-- https://itsjavi.com/bootstrap-colorpicker/ -->
	<!-- https://itsjavi.com/bootstrap-colorpicker/tutorial-Basics.html -->
	<script src="vistas/js/plugins/bootstrap-colorpicker.min.js"></script>
	<!-- ICHECK -->
	<!-- http://icheck.fronteed.com/#demo -->
	<script src="vistas/js/plugins/icheck.min.js"></script>

	<!-- PANO -->
	<script src="vistas/js/plugins/jquery.pano.js"></script>
	<!-- MOMENT -->
	<script src="vistas/js/plugins/moment.min.js"></script>
	<!-- FULL CALENDAR -->
	<script src="vistas/js/plugins/fullcalendar.js"></script>

	<!-- DATE PICKER -->
	<script src="vistas/js/plugins/bootstrap-datepicker.min.js"></script>
	<!-- CKEDITOR -->
	<!-- https://ckeditor.com/ckeditor-5/#classic -->
	<script src="vistas/js/plugins/ckeditor.js"></script>

</head>

<?php if (!isset($_SESSION["verificarUsuarioB"])): ?>

<?php include "paginas/login.php"; ?>

<?php else: ?>


<body class="hold-transition sidebar-mini layout-fixed" style="overflow-x: hidden;">

	<div class="wrapper">

		<?php 

			include "paginas/modulos/header.php";

			include "paginas/modulos/menu.php";

		 ?>

		 <!-- ======================================
		 	              CONTENIDO
		 =========================================== -->

		 <?php 
			 if (isset($_GET["pagina"])) {

			 	if($_GET["pagina"]=="inicio" ||
			 	   $_GET["pagina"]=="administradores" || 
			 	   $_GET["pagina"]=="banner" ||
			 	   $_GET["pagina"]=="planes" ||
			 	   $_GET["pagina"]=="categoria" || 
			 	   $_GET["pagina"]=="Habitaciones" || 
			 	   $_GET["pagina"]=="reservas" || 
			 	   $_GET["pagina"]=="testimonios" || 
			 	   $_GET["pagina"]=="usuarios" || 
			 	   $_GET["pagina"]=="recorrido"  || 
			 	   $_GET["pagina"]=="restaurante" ||
			 	   $_GET["pagina"]=="salir"){

			 		include "paginas/".$_GET["pagina"].".php";

			 	}else {
			 		include "paginas/error404.php";
			 	}
			 	
			 }else {

			 	include "vistas/paginas/inicio.php";

			 }



		  ?>


		 <?php 

		 include "paginas/modulos/footer.php";
		  ?>
		
	</div>

	<script src="vistas/js/administrador.js"></script>
	<script src="vistas/js/banner.js"></script>
	<script src="vistas/js/categoria.js"></script>
	<script src="vistas/js/habitacion.js"></script>
	<script src="vistas/js/reservas.js"></script>
	<script src="vistas/js/planes.js"></script>

</body>
	
<?php endif ?>

</html>