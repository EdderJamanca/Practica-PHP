<?php 

require_once "../controlador/habitacionControlador.php";
require_once "../modelo/habitacionModelo.php";

Class HabitacionAjax {

	public $ruta;

	public function ajaxTraerHabitacion(){

		$valor= $this ->ruta;

		$respuesta=HabitacionControlador::ctlHabitacion($valor);

		echo json_encode($respuesta);

	}



}

	$habitacion= new HabitacionAjax();

	$habitacion -> ruta = $_POST["ruta"];

	$habitacion -> ajaxTraerHabitacion();