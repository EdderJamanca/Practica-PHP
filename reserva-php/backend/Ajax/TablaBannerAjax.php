<?php 


require_once "../controlador/BannerberControlador.php";
require_once "../modelo/BannerModelo.php";


Class TablaBannerAjax{

	/*====================================
	=            TRAER BANNER            =
	====================================*/
	
	public function mostrarTabla(){

		$banner = BannerContolador::ctrMostrarBanner(null,null);

		if(count($banner)==0){

			$datosJason='{"data": []}';

			echo $datosJason;

			return;
		}

		$datosJason = '{ 

			"data": [';

			foreach ($banner as $key => $value) {

				/*==============================
				=            IMAGEN            =
				==============================*/
				
				$imagen ="<img src='".$value["img"]."' class='img-fluid' alt=''>";

				/*==============================
				=            IMAGEN            =
				==============================*/

				$aciones ="<div class='btn-group'><button class='btn btn-warning btn-sm editarBanner' data-toggle='modal' data-target='#editarBanner' idBanner='".$value["id"]."'><i class='fas fa-pencil-alt text-white'></i></button><button class='btn btn-danger btn-sm eliminarBanner' idBanner='".$value["id"]."' rutaBanner='".$value["img"]."'><i class='fas fa-trash-alt text-white'></i></button></div>";

				$datosJason.= '[
								"'.($key+1).'",
								"'.$imagen.'",
								"'.$aciones.'"
							],';
				
			}

			$datosJason=substr($datosJason,0,-1);

			$datosJason.='] 

			}';

			echo $datosJason;

	}
	

}
/*==============================================
=            OBJETO DE TRAER BANNER            =
==============================================*/

	$traerBanner = new TablaBannerAjax();

	$traerBanner ->mostrarTabla();















