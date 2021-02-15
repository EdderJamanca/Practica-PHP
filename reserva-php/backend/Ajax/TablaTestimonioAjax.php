<?php 

require_once "../controlador/TestimonioControlador.php";
require_once "../modelo/TestimonioModelo.php";

Class TablaTestimonio {

	/*========================================
	=            TABLA TESTIMONIO            =
	========================================*/
	
	public function tblTestimonio(){

		$testimonio=TestimonioControlador::ctrMostrarTestimonio(null,null);

		if(count($testimonio)==0){

			$datosJson='{"data": []}';

			echo $datosJson;

			return;
		}

		$datosJson ='{ 
					"data": [';
					foreach ($testimonio as $key => $value) {
						
						$reservaUsua=TestimonioControlador::ctrTestimonioInner("id_testimonio",$value["id_testimonio"]);
							/*========================================
							=            TABLA TESTIMONIO            =
							========================================*/

							if($value["aprobado"]==0){

								$estado="<button class='btn btn-dark text-white btn-sm btnAprobar' estadoTestimonio='1' idTestimonio='".$value["id_testimonio"]."'>Aprobar</button>";

							}else {

								$estado="<button class='btn btn-info text-white btn-sm btnAprobar' estadoTestimonio='0' idTestimonio='".$value["id_testimonio"]."'>Aprobado</button>";

							}
						$datosJson.='[
								"'.($key+1).'",
								"'.$reservaUsua["codigo_reserva"].'",
								"'.$reservaUsua["nombre_use"].'",
								"'.$reservaUsua["descripcion_reserva"].'",
								"'.$value["testimonio"].'",
								"'.$estado.'",
								"'.$value["fecha_testimonio"].'"

						],';

					}
					$datosJson=substr($datosJson,0,-1);

					$datosJson.='] 
				}';

				echo $datosJson;

	}
	

}

$tablaTestimonio = new TablaTestimonio();

$tablaTestimonio -> tblTestimonio(); 
