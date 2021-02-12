<?php 

require_once "../controlador/PlanesControlador.php";
require_once "../modelo/PlanesModelo.php";

class TablaPlanesAjax {

	/*====================================
	=            TRAER PLANES            =
	====================================*/

	public function btlPlanes(){

		$planes =PlanesControlador::ctrTraerPlanes(null, null);


		if(count($planes)==0){

			$datosJson ='{"data": []}';

			echo $datosJson;

			return;
		}

		$datosJson ='{ 

			"data": [';

			foreach ($planes as $key => $value) {
				
				/*==============================
				=            IMAGEN            =
				==============================*/
				$imagen="<img src='".$value["img"]."' width='100px' class='img-fluid' alt=''>";

				/*==============================
				=            ACCIONES          =
				==============================*/

				$acciones ="<button class='btn btn-warning btn-sm editarPlan' data-toggle='modal' data-target='#editarPlanes' idPlanes='".$value["id_planes"]."'><i class='fas fa-pencil-alt text-white'></i></button><button class='btn btn-danger btn-sm eliminarPlan' idPlanes='".$value["id_planes"]."' imgPlan='".$value["img"]."'><i class='fas fa-trash-alt text-white'></i></button>";

				$datosJson.='[
						"'.($key+1).'",
						"'.trim($value["tipo"]).'",
						"'.$imagen.'",
						"'.$value["descripcion"].'",
						"$ '.number_format($value["precio_alto"]).'",
						"$ '.number_format($value["precio_bajo"]).'",
						"'.$acciones.'"
				],';

			}

			$datosJson=substr($datosJson,0,-1);

			$datosJson.='] 
			  }';

			  echo $datosJson;


	}

}

$tablaPlanes = new TablaPlanesAjax();

$tablaPlanes -> btlPlanes();















