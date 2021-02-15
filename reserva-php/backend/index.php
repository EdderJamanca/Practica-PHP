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

/*==============================================
=          TRAER RESERVA         =
==============================================*/
require_once "controlador/ReservaControlador.php";
require_once "modelo/ReservaModelo.php";
/*==============================================
=          TRAER TESTIMONIO         =
==============================================*/
require_once "controlador/TestimonioControlador.php";
require_once "modelo/TestimonioModelo.php";
/*==============================================
=          TRAER USUARIO         =
==============================================*/
require_once "controlador/UsuarioControlador.php";
require_once "modelo/UsuarioModelo.php";
/*==============================================
=          TRAER USUARIO         =
==============================================*/
require_once "controlador/RecorridoControlador.php";
require_once "modelo/RecorridoModelo.php";

/*==============================================
=          RESTAURANTE         =
==============================================*/
require_once "controlador/RestauranteControlador.php";
require_once "modelo/RestauranteModelo.php";
/*==============================================
=          INICIO         =
==============================================*/
require_once "controlador/InicioControlador.php";
require_once "modelo/InicioModelo.php";

$plantilla = new PlantillaControlador();

$plantilla -> ctrPlantilla();