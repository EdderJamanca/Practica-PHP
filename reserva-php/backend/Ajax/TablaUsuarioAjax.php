<?php 

require_once "../controlador/UsuarioControlador.php";
require_once "../modelo/UsuarioModelo.php";

Class TablaUsuarioAjax{
	/*=====================================
	=            Tabla Usuario            =
	=====================================*/
	public function mostrarTabla(){

		$usuarios=UsuarioControlador::ctrMostrarUsuarios(null,null);

		if(count($usuarios)==0){
			$datosJson='{"data": []}';

			echo $datosJson;

			return;
		}

		$datosJson='{ 
					"data": [';
					foreach ($usuarios as $key => $value) {

						/*==============================
						=            IMAGEN            =
						==============================*/
						if ($value["foto_use"] !="") {

							$foto="<img src='".$value["foto_use"]."' class='img-fluid rounded-circle' width='50px'>";

						}else{
							$foto="<img src='vistas/img/usuarios/default/default.png' class='img-fluid rounded-circle' width='50px'>";
						}

						$reservas ="<div class='sumarReservas' idUsuario='".$value["id_usuario"]."'>0</div>";
						$testimonios = "<div class='sumarTestimonios' idUsuario='".$value["id_usuario"]."'>0</div>";
						/*=============================================
						CANTIDAD DE RESERVAS
						=============================================*/	
						$datosJson.='[ 
									"'.($key+1).'",
									"'.$foto.'",
									"'.$value["nombre_use"].'",
									"'.$value["email_use"].'",
									"'.$reservas.'",
									"'.$testimonios.'" 
								],';
						
						
					}

					$datosJson=substr($datosJson,0,-1);

					$datosJson.='] 
				}';

				echo $datosJson;


	}
	
	

	
}
$tabla = new TablaUsuarioAjax();
$tabla -> mostrarTabla();
