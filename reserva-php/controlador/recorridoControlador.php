<?php 

Class RecorridoContrlador {


	static public function ctlRecorrido(){

		$tabla="recorrido";

		$respuesta=RecorridoModelo::mdlRecorrido($tabla);

		return $respuesta;

	}
}