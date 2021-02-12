<?php 

require_once "../controlador/CrategoriaControlador.php";
require_once "../modelo/CategoriaModelo.php";

Class tblCategoriaAjax{


	public function tblTraerCategoria(){

		$tblCategoria=CategoriaControlador::ctrTraerCategoria(null,null);

	/*============================================================
	=   verificamos si el resultado $tblCategoria esta vacio      =
	============================================================*/
	

		if(count($tblCategoria)==0){

			$datosJson='{"data": []}';

			echo $datosJson;

			return;
		}

		$datosJson='{

			"data": [';

			foreach ($tblCategoria as $key => $value) {
		 		/*=============================================
				COLOR
				=============================================*/	
				$color="<i style='color:".$value["color"]."' class='fas fa-square'></i>";

				/*=============================================
				IMAGEN
				=============================================*/	
				$imagen="<img src='".$value["img"]."' class='img-fluid' alt=''>";

				/*=============================================
				CARACTERÍSTICAS
				=============================================*/	
				$caracteristicas="";

				$jsonIncluye=json_decode($value["incluye"],true);

				foreach ($jsonIncluye as $indice => $valor) {

					$caracteristicas.="<div class='badge badge-secondary mr-1'><i class='".$valor["icono"]." pr-1'></i>".$valor["item"]."</div>";
					
				}
				/*=============================================
				ACCIONES
				=============================================*/

				$acciones="<div class='btn-group'><button class='btn btn-warning btn-sm editarCategoria' idCategoria='".$value["id"]."' data-toggle='modal' data-target='#editarCategoria'><i class='fas fa-pencil-alt text-white'></i></button><button class='btn btn-danger btn-sm eliminarCategoria' idCartegoria='".$value["id"]."' imgCategoria='".$value["img"]."' tipoCategoria='".$value["tipo_c"]."'><i class='fas fa-trash-alt'></i></button></div>";
				$datosJson.='[ 
							"'.($key+1).'",
							"'.$value["ruta"].'",
							"'.$color.'",
							"'.$value["tipo_c"].'",
							"'.$imagen.'",
							"'.$value["descripcion"].'",
							"'.$caracteristicas.'",
							"$ '.number_format($value["continental_alta"]).'",
							"$ '.number_format($value["continental_baja"]).'",
							"$ '.number_format($value["americano_alta"]).'",
							"$ '.number_format($value["americano_baja"]).'",
							"'.$acciones.'" 
						],';
				
			}

			$datosJson=substr($datosJson,0,-1);

			$datosJson.='] 
		}';

		echo $datosJson;

	}
}


/*=============================================
Tabla Categorias
=============================================*/
$tabla = new tblCategoriaAjax();

$tabla -> tblTraerCategoria();

















