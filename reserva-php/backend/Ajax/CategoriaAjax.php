<?php 

require_once "../controlador/CrategoriaControlador.php";
require_once "../modelo/CategoriaModelo.php";

Class CategoriaAjax {

	/*===========================================
	=            TRAER UNA CATEGORIA            =
	===========================================*/
	public $idCategoria;

	public function traerUnaCategoria(){

		$item="id";
		$valor=$this->idCategoria;

		$respuesta=CategoriaControlador::ctrTraerCategoria($item,$valor);

		echo json_encode($respuesta);

	}
	/*===========================================
	=            VALIDAR CATEGORIA          =
	===========================================*/

	public $tipo;

	public function validarCategoria(){

		$respuesta = CategoriaControlador::ctrValidarCategoria("tipo",$this->tipo);

		echo json_encode($respuesta);

	}

	/*===========================================
	=            ELIMINAR UNA CATEGORIA          =
	===========================================*/
	public $idEliminar;
	public $imgCat;
	public $tipoCat;

	public function eliminarCategoria(){

		$eliminar=CategoriaControlador::ctrEliminarCategoria($this->idEliminar,$this->imgCat,$this->tipoCat);

		echo $eliminar;

	}
	
}

/*=============================================
Editar categorias
=============================================*/	
if(isset($_POST["idCategoria"])){

	$categoria = new CategoriaAjax();

	$categoria -> idCategoria=$_POST["idCategoria"];

	$categoria->traerUnaCategoria();

}
/*=============================================
Eliminar categorias
=============================================*/	
if(isset($_POST["idEliminar"])){

	$eliminarCat= new CategoriaAjax();

	$eliminarCat -> idEliminar=$_POST["idEliminar"];

	$eliminarCat -> imgCat=$_POST["imgCate"];

	$eliminarCat -> tipoCat=$_POST["tipoCat"];

	$eliminarCat ->eliminarCategoria();

}
/*=============================================
Validar categorias
=============================================*/	

if(isset($_POST["tipo"])){

	$validar= new CategoriaAjax();

	$validar->tipo=$_POST["tipo"];

	$validar ->validarCategoria();

}