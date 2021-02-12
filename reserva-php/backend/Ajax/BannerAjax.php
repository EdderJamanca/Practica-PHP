<?php 

require_once "../controlador/BannerberControlador.php";
require_once "../modelo/BannerModelo.php";

Class BannerAjax {

	

	/*=======================================
	=            TRAER UN BANNER            =
	=======================================*/
	
	public $idBanner;

	public function traerUnBanner(){

		$valor = $this ->idBanner;

		$item ="id";

		$respuesta = BannerContolador::ctrMostrarBanner($item,$valor);

		echo json_encode($respuesta);



	}
	/*=======================================
	=            ELIMINAR UN BANNER        =
	=======================================*/

	public $idEliminarBanner;
	public $rutaEliminarBanner;

	public function eliminarBanner(){

		$valor1 =$this ->idEliminarBanner;
		$url =$this ->rutaEliminarBanner;

		$respuesta1=BannerContolador::ctrEliminarBanner($valor1,$url);

		echo $respuesta1;

	}
		

}
	/*=======================================
	=   OBJETO     ELIMINAR UN BANNER        =
	=======================================*/

	if(isset($_POST["idElimi"])){

		$eliminarBanner = new BannerAjax();

		$eliminarBanner-> idEliminarBanner =$_POST["idElimi"];

		$eliminarBanner-> rutaEliminarBanner =$_POST["rutaElimi"];

		$eliminarBanner-> eliminarBanner();
	}

	/*=======================================
	=            OBJETO DE EDITAR       =
	=======================================*/
if(isset($_POST["idBanner"])){

	$traerBanner = new BannerAjax();

	$traerBanner -> idBanner =$_POST["idBanner"];

	$traerBanner ->traerUnBanner();
}