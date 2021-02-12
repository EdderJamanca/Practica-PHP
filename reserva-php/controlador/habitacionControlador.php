<?php 


Class HabitacionControlador {

	static public function ctlHabitacion($valor){

		$tabla1="habitaciones";
     	$tabla2="categorias";

     	$respuesta=HabitacionModelo::mdlHabitacion($tabla1,$tabla2,$valor);

     	return $respuesta;


	}

	/*=============================================
	Mostrar Habitación Singular
	=============================================*/

	static public function ctlMostrarHabitacionSingular($valor){

		$tabla1="habitaciones";

		$respuesta=HabitacionModelo::mdlMostrarHabitacionSingular($tabla1, $valor);

		return $respuesta;

	}
	
}