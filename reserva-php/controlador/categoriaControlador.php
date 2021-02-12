<?php 

Class CategoriaControlador {

	/*=============================================
	Mostrar Categorias
	=============================================*/

	static public function ctlCategoria(){

		$tabla="categorias";

		$respuesta=CategoriaModelo::mdlCategoria($tabla);

		return $respuesta;

	}

	/*=============================================
	Mostrar Categoría Singular
	=============================================*/

	static public function ctrMostrarCategoriaSingular($valor){

		$tabla="categorias";

		$respuesta =CategoriaModelo::mdlMostrarCategoriaSingular($tabla,$valor);

		return $respuesta;

	}


}