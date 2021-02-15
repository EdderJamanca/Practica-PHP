<?php 

Class TestimonioControlador {

	/*========================================
	=            TRAER TESTIMONIO            =
	========================================*/
	static public function ctrMostrarTestimonio($item,$valor){

		$tabla="testimonio";

		$respuesta=TestimonioModelo::mdlMostrarTestimonio($tabla,$item,$valor);

		return $respuesta;

	}

	/*========================================
	=TRAER TESTIMONIO-RESERVA-USUARIO
	========================================*/
	static public function ctrTestimonioInner($item,$valor){

		$tabla1="testimonio";
		$tabla2="reservas";
		$tabla3="usuario";

		$respuesta=TestimonioModelo::mdlTraerTestimonioInner($tabla1,$tabla2,$tabla3,$item,$valor);

		return $respuesta;

	}
	

}