<?php 

require_once "../controlador/RestauranteControlador.php";
require_once "../modelo/RestauranteModelo.php";

Class RestauranteAjax{

	/*======================================
	=            Traer un plato            =
	======================================*/
	public $idEditar;
	
	public function TraerUnPlato(){

		$respuesta=RestauranteControlador::ctrTraerRestaurante("id_restaurante",$this->idEditar);

		echo json_encode($respuesta);

	}

	/*======================================
	=            eliminar un plato            =
	======================================*/

	public $ideliminar;
	public $fotoPlato;

	public function EliminarPlato(){

		$respuesta1=RestauranteControlador::ctrEliminarRestaurante($this->ideliminar,$this->fotoPlato);

		echo $respuesta1;
	}

	

}
if(isset($_POST["idEditar"])){
	$unRestaurante= new RestauranteAjax();
	$unRestaurante-> idEditar =$_POST["idEditar"];
	$unRestaurante->TraerUnPlato();
}

if(isset($_POST["ideliminar"])){

	$eliminarR= new RestauranteAjax();
	$eliminarR ->ideliminar=$_POST["ideliminar"];
	$eliminarR ->fotoPlato=$_POST["FotoEliminar"];
	$eliminarR ->EliminarPlato();
}