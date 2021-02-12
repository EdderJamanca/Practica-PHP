<?php 

Class PlanesControlador {

	/*====================================
	=            TRAER PLANES            =
	====================================*/

	static public function ctrTraerPlanes($item, $valor){

		$tabla="planes";

		$respuesta =PlanesModelos::mdlTraerPlanes($tabla, $item, $valor);

		return $respuesta;

	}

	/*====================================
	=            GUARDAR PLANES            =
	====================================*/

	public function ctrRegistrarPlan(){

		if(isset($_POST["tipoPlan"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["tipoPlan"]) && 
				preg_match('/^[\/\=\\&\\;\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\$\\|\\-\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionPlan"]) &&
				preg_match('/^[0-9. ]+$/', $_POST["precio_alta"]) &&
				preg_match('/^[0-9. ]+$/', $_POST["precio_baja"])){


				if(isset($_FILES["subirImgPlan"]["tmp_name"]) && !empty($_FILES["subirImgPlan"]["tmp_name"])){


					// obtenemos el ancho y alto de la imagen temporal
					list($ancho,$alto)= getimagesize($_FILES["subirImgPlan"]["tmp_name"]);

					// Definimos las nuevas dimensiones

					$nuvoAncho=480;
					$nuevoAlto=382;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL PLAN
					=============================================*/

					$directorio="vistas/img/planes";
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["subirImgPlan"]["type"]=="image/jpeg"){

						$aleatorio=mt_rand(100,999);

						$ruta=$directorio."/".$aleatorio.".jpg";

						$origen=imagecreatefromjpeg($_FILES["subirImgPlan"]["tmp_name"]);

						$destino =imagecreatetruecolor($nuvoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0,$nuvoAncho, $nuevoAlto, $ancho,$alto);
						imagejpeg($destino,$ruta);

					}else if($_FILES["subirImgPlan"]["type"]=="image/png"){

						$aleatorio=mt_rand(100,999);

						$ruta=$directorio."/".$aleatorio.".png";

						$origen =imagecreatefrompng($_FILES["subirImgPlan"]["tmp_name"]);

						$destino=imagecreatetruecolor($nuvoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);

						imagesavealpha($destino, FALSE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuvoAncho, $nuevoAlto, $ancho,$alto);
						imagepng($destino,$ruta);

					}else {

						echo '<script>
									swal({
										   type:"error",
										   title:"¡CORREGIR!",
										   text:"¡No se permiten formatos diferentes a JPG y/o PNG!",
										   showConfirmButton:true,
										   confirmButtonText:"Cerrar"
										}).then(function(result){

												if(result.value){
													history.back();
												}

											})
						</script>';

						return;

					}

					$tabla="planes";
					$datos=array("tipo"=>$_POST["tipoPlan"],
						"img"=>$ruta,
						"descripcion"=>$_POST["descripcionPlan"],
						"precioAlto"=>$_POST["precio_alta"],
						"precioBajo"=>$_POST["precio_baja"]
					);

					$respuesta = PlanesModelos::mdlRegistrarPlanes($tabla,$datos);

					if($respuesta=="ok"){

						echo '<script>

									swal({
											type:"success",
											title:"¡CORRECTO!",
											text:"¡El plan ha sido creado exitosamente!",
											showConfirmButton:true,
											confirmButtonText:"Cerrar"
										}).then(function(result){

											if(result.value){
												history.back();
											}

											});
						</script>';

					}



				}



			}else {

				echo '<script>
						swal({
								type:"error",
								title:"¡CORREGIR!",
								text:"¡No se permite Carácteres especiales en ningunos de los campos!",
								showConfirmButton:true,
								confirmButtonText:"Cerrar"
							}).then(function(result){

								if(result.value){
									history.back();
								}

								})
				</script>';
			}

		}

	}

	/*====================================
	=      ACTUALIZAR PLANES            =
	====================================*/

	public function ctrActualizar(){

		if(isset($_POST["idPlan"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarPlan"]) &&
			   preg_match('/^[\/\=\\&\\;\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\$\\|\\-\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescriocionPlan"]) && 
				preg_match('/^[0-9.]+$/',$_POST["editar_precio_alta"]) &&
				preg_match('/^[0-9.]+$/',$_POST["editar_precio_baja"])){

				$ruta = $_POST["imgPlanActual"];

				if(isset($_FILES["editarImgPlan"]["tmp_name"]) && !empty($_FILES["editarImgPlan"]["tmp_name"])){

					list($ancho,$alto)=getimagesize($_FILES["editarImgPlan"]["tmp_name"]);

					$nuevoAncho=480;
					$nuevoAlto=382;

					/*=============================================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================================*/
					$directorio ="vistas/img/planes";
					/*=============================================================
					PRIMERO PREGUNTEMOS SI EXISTA OTRA IMAGEN EL LA BD
					=============================================================*/

					if(isset($_POST["imgPlanActual"])){

						unlink($_POST["imgPlanActual"]);

					}
					/*=============================================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================================*/

					if($_FILES["editarImgPlan"]["type"] == "image/jpeg"){

						$aleatorio =mt_rand(100,999);

						$ruta = $directorio."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImgPlan"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho,$alto);

						imagejpeg($destino,$ruta);

					}else if ($_FILES["editarImgPlan"]["type"] == "image/png"){

						$aleatorio=mt_rand(100,999);

						$ruta = $directorio."/".$aleatorio.".png";

						$origen=imagecreatefrompng($_FILES["editarImgPlan"]["tmp_name"]);

						$destino=imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);

						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho,$alto);

						imagepng($destino,$ruta);

					}else {

						echo '<script>
									swal({
											type:"error",
											title."¡CORREGIR!",
											text:"¡o se permiten formatos diferentes a JPG  y/o PNG!",
											showConfirmButton:true,
											confirmButtonText:"Cerrar"
										}).then(function(result){

												if(result.value){
													history.back();
												}

											})
						</script>';

					}
	
				}

					$tabla="planes";

					$datos=array("tipo"=>$_POST["editarPlan"],
						"id"=>$_POST["idPlan"],
						"img"=>$ruta,
						"descripcion"=>$_POST["editarDescriocionPlan"],
						"precioAlto"=>$_POST["editar_precio_alta"],
						"precioBajo"=>$_POST["editar_precio_baja"]
					);

					$actualizarPlanes = PlanesModelos::mdlActualizarPlanes($tabla,$datos);

					if($actualizarPlanes=="ok"){

					  echo '<script>
							swal({
									type:"success",
									title:"CORRECTO!",
									text:"¡El plan ha sido actualizado!",
									showConfirmButton:true,
									confirmButtonText:"Cerrar"
								}).then(function(result){
										if(result.value){
											history.back();
										}
								})
				        </script>';

					}


			}else {

				echo '<script>
							swal({
									type:"error",
									title:"¡CORREGIR!",
									text:"¡No se permite caracteres especiales en los campos!",
									showConfirmButton:true,
									confirmButtonText:"Cerrar"
								}).then(function(result){
										if(result.value){
											history.back();
										}
								})
				</script>';

			}

		}
	}

	static public function ctrEliminarPlan($id,$ruta){

		unlink("../".$ruta);

		$tabla="planes";

		$respuesta = PlanesModelos::mdlEliminarPlan($tabla,$id);

		return $respuesta;
	}


}