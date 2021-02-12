<?php 

Class CategoriaControlador{


	/*=======================================
	=            TRAER CATEGORIA            =
	=======================================*/
	static public function ctrTraerCategoria($item,$valor){

		$tabla="categorias";

		$respuesta=CategoriaModelo::mdlTraerCategoria($tabla,$item,$valor);

		return $respuesta;
	}
	
	/*=======================================
	=            GUARDAR CATEGORIA        =
	=======================================*/
	public function ctrGuardarCategoria(){

		if(isset($_POST["rutaCategoria"])){

			/*=========================================
			=            validar los datos            =
			=========================================*/
			if(preg_match('/^[a-zA-Z0-9-]+$/', $_POST["rutaCategoria"]) &&
			  preg_match('/^[a-zA-Z0-9]+$/', $_POST["tipoCategoria"]) &&
			   preg_match('/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionCategoria"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["continental_alta"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["continental_baja"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["americano_alta"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["americano_baja"])){



			   	if(isset($_FILES["subirImgCategoria"]["tmp_name"]) && !empty($_FILES["subirImgCategoria"]["tmp_name"])){

			   		// obtener las dimensiones de imagen
			   		list($ancho,$alto)= getimagesize($_FILES["subirImgCategoria"]["tmp_name"]);

			   		$nuevoAncho=359;
			   		$nuevoAlto=254;

			   		/*=====================================================
			   		=Creamos el directorio donde vamos a guardar la imagen
			   		======================================================*/
			   		
			   		$directorio ="vistas/img/".strtolower($_POST["tipoCategoria"]);
			   		if(!file_exists($directorio)){
			   			mkdir($directorio, 0755);
			   		}
			   		/*=====================================================
			   		=De auerdo al tipode imagen aplicamos las funciones por defecto de PHP
			   		======================================================*/			   		
			   		if($_FILES["subirImgCategoria"]["type"]=="image/jpeg"){

			   			$aleatorio =mt_rand(100,999);

			   			$ruta=$directorio."/".$aleatorio.".jpg";

			   			$origen=imagecreatefromjpeg($_FILES["subirImgCategoria"]["tmp_name"]);

			   			$destino=imagecreatetruecolor($nuevoAncho, $nuevoAlto);

			   			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho,$alto);

			   			imagejpeg($destino,$ruta);


			   		}else if($_FILES["subirImgCategoria"]["type"]=="image/png"){

			   			$aleatorio =mt_rand(100,999);

			   			$ruta=$directorio."/".$aleatorio.".png";

			   			$origen=imagecreatefrompng($_FILES["subirImgCategoria"]["tmp_name"]);

			   			$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);

			   			imagealphablending($destino, FALSE);

			   			imagesavealpha($destino, TRUE);

			   			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho,$alto);
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

			   		$tabla ="categorias";

			   		$datos =array("ruta"=>$_POST["rutaCategoria"],
			   				 "tipo"=>$_POST["tipoCategoria"],
			   				 "incluye"=>$_POST["caracteristicasCategoria"],
			   				 "color"=>$_POST["colorCategoria"],
			   				 "img"=>$ruta,
			   				 "descripcion"=>$_POST["descripcionCategoria"],
			   				 "continental_alta"=>$_POST["continental_alta"],
			   				 "continental_baja"=>$_POST["continental_baja"],
			   				 "americano_alta"=>$_POST["americano_alta"],
			   				  "americano_baja"=>$_POST["americano_baja"]);
			
			   		$respuesta= CategoriaModelo::mdlRegistrarCategoria($tabla,$datos);

			   		if($respuesta=="ok"){

			   			echo '<script>
							swal({
									type:"success",
									title:"CORRECTO!",
									text:"¡La Categoria ha sido creado exitosamente!",
									showConfirmButton:true,
									confirmButonText:"Cerrar"
								}).then(function(result){

										if(result.value){
											window.location="categoria";
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
								text:"No se permite caracteres especiales en los campos",
								showConfirmButton:true,
								confirmButonText:"Cerrar"
							}).then(function(result){

									if(result.value){
										history.back();
									}

								});
				</script>';
			}
		

		}//fin iseet

	}

	/*=======================================
	=            ACTUALIZAR CATEGORIA        =
	=======================================*/
	public function ctrActualizarCategoria(){

		if(isset($_POST["editarid"])){

			if(preg_match('/^[a-zA-Z0-9-]+$/', $_POST["editarRutaCategoria"]) &&
				  preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarTipoCategoria"]) &&
				 preg_match('/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditarDescripcionCategoria"]) &&
				   preg_match('/^[0-9.]+$/', $_POST["EditarContinental_alta"]) &&
				   preg_match('/^[0-9.]+$/', $_POST["EditarContinental_baja"]) &&
				   preg_match('/^[0-9.]+$/', $_POST["EditarAmericano_alta"]) &&
				   preg_match('/^[0-9.]+$/', $_POST["EditarAmericano_baja"])){

					$ruta=$_POST["editarRutaActual"];
					echo '<pre>'; print_r($ruta); echo '</pre>';

					if(isset($_FILES["EditarImgCategoria"]["tmp_name"]) && !empty($_FILES["EditarImgCategoria"]["tmp_name"])){

						list($ancho,$alto)=getimagesize($_FILES["EditarImgCategoria"]["tmp_name"]);

						$nuevoAncho=359;
						$nuevoAlto=254;

						$directorio="vistas/img/".strtolower($_POST["editarTipoCategoria"]);

						/*================================================
						=PRIMERO VEMOS SI EXITE OTRA IMAGEN EN LA BD      
						===============================================*/
						if(isset($_POST["editarRutaActual"])){
							unlink($_POST["editarRutaActual"]);
						}
						
						/*================================================
						=PRIMERO VEMOS SI EXITE OTRA IMAGEN EN LA BD      
						===============================================*/
							if($_FILES["EditarImgCategoria"]["type"]=="image/jpeg"){

				   			$aleatorio =mt_rand(100,999);

				   			$ruta=$directorio."/".$aleatorio.".jpg";

				   			$origen=imagecreatefromjpeg($_FILES["EditarImgCategoria"]["tmp_name"]);

				   			$destino=imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				   			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho,$alto);

				   			imagejpeg($destino,$ruta);


				   		}else if($_FILES["EditarImgCategoria"]["type"]=="image/png"){

				   			$aleatorio =mt_rand(100,999);

				   			$ruta=$directorio."/".$aleatorio.".png";

				   			$origen=imagecreatefrompng($_FILES["EditarImgCategoria"]["tmp_name"]);

				   			$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				   			imagealphablending($destino, FALSE);

				   			imagesavealpha($destino, TRUE);

				   			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho,$alto);
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

					}

					$tabla ="categorias";

					   $datos =array("id"=>$_POST["editarid"],
								   	"ruta"=>$_POST["editarRutaCategoria"],
					   				 "tipo"=>$_POST["editarTipoCategoria"],
					   				 "incluye"=>$_POST["EditarCaracteristicasCategoria"],
					   				 "color"=>$_POST["editarColorCategoria"],
					   				 "img"=>$ruta,
					   				 "descripcion"=>$_POST["EditarDescripcionCategoria"],
					   				 "continental_alta"=>$_POST["EditarContinental_alta"],
					   				 "continental_baja"=>$_POST["EditarContinental_baja"],
					   				 "americano_alta"=>$_POST["EditarAmericano_alta"],
					   				  "americano_baja"=>$_POST["EditarAmericano_baja"]);


				   		$respuesta= CategoriaModelo::mdlActualizarCategoria($tabla,$datos);

				   		if($respuesta=="ok"){

				   			echo '<script>
								swal({
										type:"success",
										title:"CORRECTO!",
										text:"¡La Categoria ha sido creado exitosamente!",
										showConfirmButton:true,
										confirmButonText:"Cerrar"
									}).then(function(result){

											if(result.value){
												window.location="categoria";
											}

										});
					        </script>';

				   		}





			}else {

				echo '<script>
							swal({
									type:"error",
									title:"CORREGIR",
									text:"No se permite caracteres especiales en los campos",
									showConfirmButton:true,
									confirmButtonText:"Cerrar"
								}).then(function(result){

										if(result.value){
											window.location="categoria";
										}

									})
				</script>';
			}
		}
	}
	/*=======================================
	=            VALIDAR CATEGORIA        =
	=======================================*/

	static public function ctrValidarCategoria($item, $valor){
		$tabla ="habitaciones";

		$respuesta = CategoriaModelo::mdlValidarCategoria($tabla,$item,$valor);

		return $respuesta;
	}

	/*=======================================
	=            ELIMINAR CATEGORIA        =
	=======================================*/
	static public  function ctrEliminarCategoria($id,$ruta,$tipo){

		unlink("../".$ruta);
		rmdir("../vistas/img/".strtolower($tipo));

		$tabla="categorias";

		$respuesta=CategoriaModelo::mdlEliminarCategoria($tabla,$id);

		return $respuesta;

	}

}