<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/formulario.controlador.php";
require_once "modelos/formularios.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla ->ctrTraerPlantilla();
