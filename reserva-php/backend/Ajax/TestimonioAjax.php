<?php 

require_once "../controlador/TestimonioControlador.php";
require_once "../modelo/TestimonioModelo.php";

Class TestimonioAjax{

	/*========================
	=Aprobar Testimonio o desaprobar  =
	========================*/
	public $idTestimonio;
	public $estadoTestimonio;

	public function AprobarTestimonio(){
		$tabla="testimonio";

		$item1="id_testimonio";
		$valor1=$this->idTestimonio;

		$item2="aprobado";
		$valor2=$this->estadoTestimonio;

		$respuesta=TestimonioModelo::mdlAprobarTestimonio($tabla,$item1,$valor1,$item2,$valor2);

		echo $respuesta;

	}
	
}

if(isset($_POST["isTestimonio"])){

	$AprobarTest = new TestimonioAjax();
	$AprobarTest->idTestimonio=$_POST["isTestimonio"];
	$AprobarTest->estadoTestimonio=$_POST["estadoTestimonio"];

	$AprobarTest->AprobarTestimonio();

}