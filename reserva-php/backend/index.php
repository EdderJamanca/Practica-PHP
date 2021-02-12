<?php 
/*==============================================
=          TRAER RUTA Y PLANTILLA            =
==============================================*/

require_once "controlador/PlantillaControlador.php";

require_once "controlador/RutaControlador.php";

/*==============================================
=          TRAER ADMINISTRADOR          =
==============================================*/

require_once "controlador/AdministradorControlador.php";
require_once "modelo/AdministradorModelo.php";

/*==============================================
=          TRAER BANNER          =
==============================================*/
require_once "controlador/BannerberControlador.php";
require_once "modelo/BannerModelo.php";

/*==============================================
=          TRAER PLANES         =
==============================================*/
require_once "controlador/PlanesControlador.php";
require_once "modelo/PlanesModelo.php";
/*==============================================
=          TRAER CATEGORIA         =
==============================================*/
require_once "controlador/CrategoriaControlador.php";
require_once "modelo/CategoriaModelo.php";
/*==============================================
=          TRAER HABITACION         =
==============================================*/
require_once "controlador/HabitacionControlador.php";
require_once "modelo/HabitacionModelo.php";


$plantilla = new PlantillaControlador();

$plantilla -> ctrPlantilla();