<?php 

require_once "../controlador/RestauranteControlador.php";
require_once "../modelo/RestauranteModelo.php";

Class TablaRestaurante{

	/*===============================================
	=            Traer tabla restauramte            =
	===============================================*/
	
	public function tablaRestaurante1(){

		$restaurante=RestauranteControlador::ctrTraerRestaurante(null,null);

		if(count($restaurante)==0){

			$datosJson ='{ "data": []}';

			echo $datosJson;

			return;
		}

		$datosJson = ' { 
			"data": [';

			foreach ($restaurante as $key => $value) {
			/*===============================================
			=                IMAGE            =
			===============================================*/

			$image="<img src='".trim($value["foto"])."' class='img-fluid rounded-circle' width='100px' alt=''>";

			/*===============================================
			=                Acciones            =
			===============================================*/
			$acciones = "<div class='btn-group'><button class='btn btn-warning btn-sm editarR' idRestaurante='".trim($value["id_restaurante"])."' data-toggle='modal' data-target='#editarRecorrido'><i class='fas fa-pencil-alt text-white'></i></button><button class='btn btn-danger btn-sm eliminarR' idElimin='".trim($value["id_restaurante"])."' fotoR='".trim($value["foto"])."'><i class='fas fa-trash-alt'></i></button></div>";

			$datosJson.='[
					"'.($key+1).'",
					"'.$image.'",
					"'.trim($value["descripcion"]).'",
					"'.$acciones.'"
			],';
		


			}

			$datosJson=substr($datosJson, 0,-1);

			$datosJson.='] 
			}';

			echo $datosJson;



	}
	

	

}

$tablaRest = new TablaRestaurante();
$tablaRest->tablaRestaurante1();