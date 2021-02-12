<?php 

Class RestauranteControlador {

	static public function ctrRestaurante(){

		$tabla="restaurante";

		$respuesta=RestauranteModelo::mdlRestaurante($tabla);

		return $respuesta;

	}

}