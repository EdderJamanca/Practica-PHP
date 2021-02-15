<?php 

require_once "../controlador/ReservaControlador.php";
require_once "../modelo/ReservaModelo.php";

Class TablaReservaAjax{

	/*=====================================
	=            Traer Reserva            =
	=====================================*/

	public function tblReserva(){

		$reserva=ReservaControlador::ctrMostrarReserva(null,null);

		if(count($reserva)==0){

			$datosJson='{"data": []}';

			echo $datosJson;

			return;
		}

		$datosJson='{ 

					"data": [';

					foreach ($reserva as $key => $value) {

						$fechaIngreso= new DateTime($value["fecha_ingreso"]);
						$fechaSalida= new DateTime($value["fecha_salida"]);

						$diff=$fechaIngreso->diff($fechaSalida);

						$dias=$diff->days;

						if($value["fecha_ingreso"] !="0000-00-00" && $value["fecha_salida"] !="0000-00-00"){

							$acciones="<button class='btn btn-warning btn-sm mr editarReserva' data-toggle='modal' data-target='#editarReserva' idHabi='".$value["id_habitacion"]."'  idReserva='".$value["id_reserva"]."' idusu='".$value["id_usu"]."' fechaIng='".$value["fecha_ingreso"]."' fechaSal='".$value["fecha_salida"]."' descripcion='".$value["descripcion_reserva"]."' dias='".$dias."'><i class='fas fa-pencil-alt text-white'></i></button><button class='btn btn-danger btn-sm ml'><i class='fas fa-trash-alt text-white eliminarReserva' idReserva='".$value["id_reserva"]."'></i></button>";
						}else {
							$acciones = "<button class='btn btn-dark btn-sm'>Cancelada</button>";
						}

						$datosJson.='[

								"'.($key +1).'",
								"'.$value["codigo_reserva"].'",
								"'.$value["descripcion_reserva"].'",
								"'.$value["nombre_use"].'",
								"'.number_format($value["pago_reserva"],2,",",".").'",
								"'.$value["numero_transaccion"].'",
								"'.$value["fecha_ingreso"].'",
								"'.$value["fecha_salida"].'",
								"'.$acciones.'"
						],';
						
					}
					$datosJson=substr($datosJson,0,-1);

					$datosJson.='] 

				}';

				echo $datosJson;

	}	

}

$reserva= new TablaReservaAjax();
$reserva -> tblReserva();