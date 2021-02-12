<?php


require_once "controlador/plantillaControlador.php";
require_once "controlador/rutaControlador.php";
// BANNER
require_once "controlador/BannerController.php";
require_once "modelo/bannerModel.php";

// PLANES

require_once "controlador/planesControlador.php";
require_once "modelo/planesModel.php";

// Habitaciones 

require_once "controlador/categoriaControlador.php";
require_once "modelo/categoriaModelo.php";

// RECORRIDO

require_once "controlador/recorridoControlador.php";
require_once "modelo/recorridomodelo.php";

// RESTAURANTE

require_once "controlador/restauranteControlador.php";
require_once "modelo/restauranteModelo.php";

// HABITACION

require_once "controlador/habitacionControlador.php";
require_once "modelo/habitacionModelo.php";

// RESERVAS

require_once "controlador/reservasControlador.php";
require_once "modelo/reservasModelo.php";

// INTEGRAR MERCADO PAGO

require_once "extensiones/vendor/autoload.php";

// USUARIO

require_once "controlador/usuarioControlador.php";
require_once "modelo/usuarioModelo.php";

$plantilla= new controladorPlantilla();

$plantilla->ctlPlantilla();
