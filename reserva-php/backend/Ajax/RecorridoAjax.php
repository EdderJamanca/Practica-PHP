<?php 


require_once "../controlador/RecorridoControlador.php";
require_once "../modelo/RecorridoModelo.php";

Class RecorridoAjax{

	/*==========================================
	=            TRAER UN RECORRIDO            =
	==========================================*/
	public $idRecorrido;
	public function traerUnRecorrido(){

		$respuesta=RecorridoControlador::ctmTrarRecorrido("id_recorrido",$this->idRecorrido);

		echo json_encode($respuesta);

	}
	/*==========================================
	=            TRAER UN RECORRIDO            =
	==========================================*/

	public $ideliminar;
	public $imgGram;
	public $imgPeq;

	public function eliminarRecorrido(){

		$respuesta=RecorridoControlador::ctrEliminarRecorrido($this->ideliminar,$this->imgGram,$this->imgPeq);

		echo $respuesta;
	}
	

}
/*==========================================
=            TRAER UN RECORRIDO            =
==========================================*/
if (isset($_POST["idRecorrido"])) {
	
	$unRecorrido = new RecorridoAjax();

	$unRecorrido ->idRecorrido=$_POST["idRecorrido"];

	$unRecorrido ->traerUnRecorrido();

}

/*==========================================
=            Eliminar UN RECORRIDO            =
==========================================*/
if (isset($_POST["idEliminar"])) {
	
	$elimRecorrido = new RecorridoAjax();

	$elimRecorrido ->ideliminar=$_POST["idEliminar"];
	$elimRecorrido ->imgGram=$_POST["imgGrande"];
	$elimRecorrido ->imgPeq=$_POST["imgPeque"];

	$elimRecorrido ->eliminarRecorrido();

}
