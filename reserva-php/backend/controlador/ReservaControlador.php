<?php 

 Class ReservaControlador{

 	/*=======================================
 	=            MOSTAR RESERVAS            =
 	=======================================*/


 	static public function ctrMostrarReserva($item, $valor){

 		$tabla1="usuario";
 		$tabla2="reservas";

 		$mostrarReserva=ReservaModelo::mdlMostrarReserva($tabla1,$tabla2,$item,$valor);

 		return $mostrarReserva;

 	}

 	/*=======================================
 	=            Cambiar Reserva           =
 	=======================================*/
 	static public function ctrCambiarReserva($datos){
 		$tabla="reservas";

 		$respuesta=ReservaModelo::mdlCambiarReserva($tabla,$datos);

 		return $respuesta;
 	}

 }