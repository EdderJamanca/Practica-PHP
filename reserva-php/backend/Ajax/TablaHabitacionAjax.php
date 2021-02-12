<?php 

require_once "../controlador/HabitacionControlador.php";
require_once "../modelo/HabitacionModelo.php";

Class TablaHabitacionAjax{

	/*===========================================
	=            TABLA ADMINISTRADOR            =
	===========================================*/

	public function mostrarHabitacion(){

		$habitacion =HabitacionControlador::ctrMostrarHabitacion(null);

		if(count($habitacion)==0){

			$datosJson='{"data": []}';

			echo $datosJson;

			return;
		}

		$datosJson='{

			"data": [';

		foreach ($habitacion as $key => $value){

			/*=============================================
			ACCIONES
			=============================================*/
			$acciones="<a href='index.php?pagina=Habitaciones&id_h=".$value["id_h"]."' class='btn btn-secondary btn-sm'><i class='far fa-eye'></i></a>";

			$datosJson.='[

				"'.($key+1).'",
				"'.$value["tipo_c"].'",
				"'.$value["estilo"].'",
				"'.$acciones.'"
		],';
			
		}

		$datosJson=substr($datosJson,0,-1);

		$datosJson.=']
		}';

		echo $datosJson;


	}
	

}

$tablaHabitacion= new TablaHabitacionAjax();

$tablaHabitacion -> mostrarHabitacion();
















