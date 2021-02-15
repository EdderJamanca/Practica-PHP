<?php 

Class UsuarioControlador {

	/*=======================================
	=            Mostrar Usuario            =
	=======================================*/
	
	static public function ctrMostrarUsuarios($item, $valor){

		$tabla="usuario";

		$respuesta = UsuarioModelo::mdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;

	}

	
}