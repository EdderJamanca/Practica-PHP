<?php 

require_once "../controlador/PlanesControlador.php";
require_once "../modelo/PlanesModelo.php";

Class PlanesAjax{

	/*=====================================
	=            Traer un plan            =
	=====================================*/

	public $idPlan;

	public function traerUnPlan(){

		$valor=$this ->idPlan;

		$respuesta =PlanesControlador::ctrTraerPlanes("id_planes", $valor);

		echo json_encode($respuesta);

	}
	
	/*=====================================
	=            Eliminar un plan          =
	=====================================*/

	public $idEliminar;
	public $imgPlan;

	public function ajaxEliminar(){

		$respuesta=PlanesControlador::ctrEliminarPlan($this->idEliminar,$this->imgPlan);

		echo $respuesta;

	}
	

}

if(isset($_POST["idPlan"])){

	$unPlan = new PlanesAjax();

	$unPlan -> idPlan =$_POST["idPlan"];

	$unPlan -> traerUnPlan();
}

if(isset($_POST["idEliminar"])){

	$eliminar = new PlanesAjax();
	$eliminar -> idEliminar=$_POST["idEliminar"];
	$eliminar ->imgPlan=$_POST["imgPlan"];
	$eliminar ->ajaxEliminar();

}