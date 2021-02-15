<?php 

Class ControladorInicio{
	/*====================================
	=            SUMAR VENTAS            =
	====================================*/
	 static public function ctrSumarVenta(){

	 	$tabla ="reservas";

	 	$respuesta=InicioModelo::mdlSumarVentas($tabla);

	 	return $respuesta;
	 }

	/*====================================
	=            MEJOR HABITACION       =
	====================================*/

	static public function ctrMejorHabitacion(){

	 	$tabla ="reservas";

	 	$respuesta=InicioModelo::mdlMejorHabitacion($tabla);

	 	return $respuesta;
	 }
	/*=============================================
	PEOR HABITACIÓN
	=============================================*/
	static public function ctrPeorHabitacion(){

	 	$tabla ="reservas";

	 	$respuesta=InicioModelo::mdlPeorHabitacion($tabla);

	 	return $respuesta;
	 }
	/*=============================================
	TRAER FOTO HABITACIÓN
	=============================================*/
	static public function ctrTraerFotoHabitacion($valor){

	 	$tabla1 ="habitaciones";
	 	$tabla2 ="reservas";

	 	$respuesta=InicioModelo::mdlTraerFotoHabitacion($tabla1,$tabla2,$valor);

	 	return $respuesta;
	 }


}