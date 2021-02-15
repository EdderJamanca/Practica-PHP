<?php 

require_once "../controlador/RecorridoControlador.php";
require_once "../modelo/RecorridoModelo.php";



Class TablaRecorrido{

	/*========================================
	=            Treaer Recorrido            =
	========================================*/

	public function tblRecorrido(){

		$recorrido=RecorridoControlador::ctmTrarRecorrido(null,null);

		if(count($recorrido)== 0){

 			$datosJson = '{"data": []}';

			echo $datosJson;

			return;

 		}

 		$datosJson = '{

	 	"data": [ ';

	 	foreach ($recorrido as $key => $value) {

	 		/*=============================================
			FOTO GRANDE
			=============================================*/	

			$foto_grande = "<img src='".trim($value["foto_gran"])."' class='img-fluid' style='width:200px'>";

	 		/*=============================================
			FOTO PEQUEÑA
			=============================================*/	

			$foto_peq = "<img src='".trim($value["foto_peq"])."' class='img-fluid' style='width:100px'>";
			
			/*=============================================
			ACCIONES
			=============================================*/

			$acciones = "<div class='btn-group'><button class='btn btn-warning btn-sm editarRecorrido' data-toggle='modal' data-target='#editarRecorrido' idRecorrido='".trim($value["id_recorrido"])."'><i class='fas fa-pencil-alt text-white'></i></button><button class='btn btn-danger btn-sm eliminarRecorrido' idRecorrido='".trim($value["id_recorrido"])."' imgGrandeRecorrido='".trim($value["foto_gran"])."' imgPeqRecorrido='".trim($value["foto_peq"])."'><i class='fas fa-trash-alt'></i></button></div>";	


			$datosJson.='[			
						"'.($key+1).'",
						"'.trim($value["titulo"]).'",
						"'.trim($value["descripcion"]).'",
						"'.$foto_grande.'",
						"'.$foto_peq.'",
						"'.$acciones.'"
						
				],';

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']

		}';

		echo $datosJson;

	}

}

$tabRecorrido = new TablaRecorrido();

$tabRecorrido ->tblRecorrido();