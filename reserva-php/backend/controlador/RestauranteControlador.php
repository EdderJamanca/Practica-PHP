<?php 

Class RestauranteControlador{

	/*=========================================
	=            Traer Restaurante            =
	=========================================*/
	
	static public function ctrTraerRestaurante($item,$valor){


		$tabla="restaurante";

		$respuesta =RestauranteModelo::mdlTraerRestaurante($tabla,$item,$valor);

		return $respuesta;
	}
	
	/*=========================================
	=            NUEVO PLATO            =
	=========================================*/
	public function ctrNuevoRestaurante(){

		if(isset($_POST["pescripcionRestaurante"])){

			if(preg_match('/^[\/\=\\&\\;\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["pescripcionRestaurante"])){

				if(isset($_FILES["subirImgRestaurante"]["tmp_name"]) && !empty($_FILES["subirImgRestaurante"]["tmp_name"])){

					list($anchos,$altos)=getimagesize($_FILES["subirImgRestaurante"]["tmp_name"]);

					$nuevoAncho=169;
					$nuevoAlto=169;
					/*=========================================
					=            Nombramos el dirctorio        =
					=========================================*/
					$directorio="vistas/img/restaurante";


					/*=========================================
					=De acuerdo al tipo de imagen aplicamos las funciones por defecto de psp       =
					=========================================*/

					if($_FILES["subirImgRestaurante"]["type"]=="image/jpeg"){

						$aleatorio =mt_rand(100,999);
						$ruta =$directorio."/".$aleatorio.".jpg";

						$origin=imagecreatefromjpeg($_FILES["subirImgRestaurante"]["tmp_name"]);

						$destino=imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino,$origin, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $anchos,$altos);

						imagejpeg($destino,$ruta);

					}else if($_FILES["subirImgRestaurante"]["type"]=="image/png"){


						$aleatorio = mt_rand(100,999);

						$ruta = $directorio."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["subirImgRestaurante"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, TRUE);
			
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $anchos,$altos);

						imagepng($destino, $ruta);

					}else{

					echo '<script>

						swal({

							type:"error",
							title: "¡CORREGIR!",
							text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){

								window.location = "restaurante";

							}

						});	

					</script>';

					}

				}

				$tabla="restaurante";

				$datos=array("foto"=>$ruta,"descripcion"=>$_POST["pescripcionRestaurante"]);

				$respuesta=RestauranteModelo::mdlNuevoRestaurante($tabla,$datos);

				if($respuesta=="ok"){

				 echo '<script>

						swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡El plato del restaurante ha sido creado exitosamente!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
						}).then(function(result){

								if(result.value){   
								    window.location = "restaurante";
								  } 
						});

					</script>';

				}

			}else {

			echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales en ninguno de los campos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "restaurante";

						}

					});	

				</script>';

			}

		}
	}

	/*=========================================
	=            ACTUALIZAR PLATO            =
	=========================================*/

	public function ctraAcualizarRestaurante(){

		if(isset($_POST["idPlato"])){

			if(preg_match('/^[\/\=\\&\\;\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditPescripcionRestaurante"])){

				$ruta=$_POST["antiguoimgPlato"];

				if(isset($_FILES["editarsubirImgRestaurante"]["tmp_name"]) && !empty($_FILES["editarsubirImgRestaurante"]["tmp_name"])){

					list($anchos,$altos)=getimagesize($_FILES["editarsubirImgRestaurante"]["tmp_name"]);

					$nuevoAncho=169;
					$nuevoAlto=169;
					/*=========================================
					=           VERIFICAR SI EXITE UNA IMAGEN EN LA BD        =
					=========================================*/

					if(isset($_POST["antiguoimgPlato"])){

						unlink($_POST["antiguoimgPlato"]);
					}

					/*=========================================
					=            Nombramos el dirctorio        =
					=========================================*/
					$directorio="vistas/img/restaurante";


					/*=========================================
					=De acuerdo al tipo de imagen aplicamos las funciones por defecto de psp       =
					=========================================*/

					if($_FILES["editarsubirImgRestaurante"]["type"]=="image/jpeg"){

						$aleatorio =mt_rand(100,999);
						$ruta =$directorio."/".$aleatorio.".jpg";

						$origin=imagecreatefromjpeg($_FILES["editarsubirImgRestaurante"]["tmp_name"]);

						$destino=imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino,$origin, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $anchos,$altos);

						imagejpeg($destino,$ruta);

					}else if($_FILES["editarsubirImgRestaurante"]["type"]=="image/png"){


						$aleatorio = mt_rand(100,999);

						$ruta = $directorio."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarsubirImgRestaurante"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, TRUE);
			
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $anchos,$altos);

						imagepng($destino, $ruta);

					}else{

					echo '<script>

						swal({

							type:"error",
							title: "¡CORREGIR!",
							text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){

								window.location = "restaurante";

							}

						});	

					</script>';

					return;

					}

				}

				$tabla="restaurante";

				$datos=array("id"=>$_POST["idPlato"],
					"foto"=>$ruta,
					"descripcion"=>$_POST["EditPescripcionRestaurante"]);

				$respuesta=RestauranteModelo::mdlActualizarRestaurante($tabla,$datos);

				if($respuesta=="ok"){

				 echo '<script>

						swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡El plato del restaurante ha sido modificado exitosamente!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
						}).then(function(result){

								if(result.value){   
								    window.location = "restaurante";
								  } 
						});

					</script>';

				}

			}else {

			echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales en ninguno de los campos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "restaurante";

						}

					});	

				</script>';

			}

		}
	}

	/*=========================================
	=            RLIMINAR PLATO            =
	=========================================*/
	static public function ctrEliminarRestaurante($id,$fotoPlato){

		unlink("../".$fotoPlato);
		$tabla="restaurante";

		$respuesta=RestauranteModelo::mdlEliminarRestaurante($tabla,$id);

		return $respuesta;
	}


}