<?php 


require_once "../controlador/AdministradorControlador.php";
require_once "../modelo/AdministradorModelo.php";

Class TablaAdmin{

	/*==============================================
	=            trabla ADMINISTRADORES            =
	==============================================*/
	

	public function mostrarTabla(){

		$respuesta = AdministradorControlador::ctrMostrarUsuario(null,null);

		if(count($respuesta)==0){

			$datosJson='{"data":[]}';

			echo $datosJson;

			return;
		}

		$datosJson ='{ 
			"data":[';
			foreach ($respuesta as $key => $value) {

				if($value["id_admin"] !=1){

					if($value["estado"]==0){

						$estado = "<button class='btn btn-dark btn-sm btnActivar' estadoAdmin='1' idAdmin='".$value["id_admin"]."'>Desactivado</button>";
					}else {

						$estado = "<button class='btn btn-info btn-sm btnActivar' estadoAdmin='0' idAdmin='".$value["id_admin"]."'>Activado</button>";
					}

				}else {
					$estado="<button class='btn btn-info btn-sm'>Activado</button>";
				}

				$acciones="<button class='btn btn-warning btn-sm mr-1 editarAdministrador' data-toggle='modal' data-target='#editarAdministrador' editarAdministrador='".$value["id_admin"]."'><i class='fas fa-pencil-alt text-white'></i></button><button class='btn btn-danger btn-sm ml-1 eliminarAdministrador' eliminarAdministrador='".$value["id_admin"]."'><i class='fas fa-trash-alt text-white'></i></button>";

				$datosJson.='[ 
							  "'.($key+1).'",
							  "'.$value["nombre"].'",
							  "'.$value["usuario"].'",
							  "'.$value["perfil"].'",
							  "'.$estado.'",
							  "'.$acciones.'" 
							],';

			}

		$datosJson=substr($datosJson,0,-1);
		$datosJson.=']}';
		echo $datosJson;	

	}
		

}

/*=============================================
Tabla Administradores
=============================================*/ 

$tabla = new TablaAdmin();
$tabla ->mostrarTabla();























