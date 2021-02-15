<?php 


Class RecorridoControlador{
	
	/*========================================
	=            Treaer Recorrido            =
	========================================*/
	static public function ctmTrarRecorrido($item,$valor){

		$tabla="recorrido";

		$respuesta=RecorridoModelo::mdlTraerRecorrido($tabla,$item,$valor);

		return $respuesta;
	}
	/*========================================
	=            Un nuevo recorrido            =
	========================================*/

	public function ctrNuevoRecorrido(){

		if(isset($_POST["tituloRecorrido"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["tituloRecorrido"]) && preg_match('/^[\/\=\\&\\;\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionRecorrido"])){

				// IMAGEN PEQUEÑA
				if(isset($_FILES["subirImgPeqRecorrido"]["tmp_name"]) && !empty($_FILES["subirImgPeqRecorrido"]["tmp_name"])){

					list($ancho,$alto)= getimagesize($_FILES["subirImgPeqRecorrido"]["tmp_name"]);

						$nuevoAncho=455;
						$nuevoAlto=280;

					/*=============================================
					NOMBRAMOS EL DIRECTORIO
					=============================================*/
					$directorio="vistas/img/recorrido";
					/*=============================================
					De acuerdo el tipo de imagen aplicar las funciones por defecto de php
					=============================================*/

					if($_FILES["subirImgPeqRecorrido"]["type"]=="image/jpeg"){

						$aleatorio=mt_rand(100,999);

						$rutaImgPeq=$directorio."/".$aleatorio.".jpg";

						$origen=imagecreatefromjpeg($_FILES["subirImgPeqRecorrido"]["tmp_name"]);

						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0,$nuevoAncho,$nuevoAlto, $ancho,$alto);
						imagejpeg($destino,$rutaImgPeq);

					}else if($_FILES["subirImgPeqRecorrido"]["type"]=="image/png"){

						$aleatorio=mt_rand(100,999);

						$rutaImgPeq=$directorio."/".$aleatorio.".png";

						$origen=imagecreatefrompng($_FILES["subirImgPeqRecorrido"]["tmp_name"]);

						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagealphablending($destino, FALSE);

						imagesavealpha($destino,TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho,$nuevoAlto,  $ancho,$alto);

						imagepng($destino,$rutaImgPeq);

					}else {
						echo'<script>

							swal({
									type:"error",
								  	title: "¡CORREGIR!",
								  	text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
								  	showConfirmButton: true,
									confirmButtonText: "Cerrar"
								  
							}).then(function(result){

									if(result.value){   
									    history.back();
									  } 
							});

						</script>';

						return;
					}


				}
				// IMAGE GRANDE
				if(isset($_FILES["subirImgGraRecorrido"]["tmp_name"]) && !empty($_FILES["subirImgGraRecorrido"]["tmp_name"])){

					list($ancho,$alto)= getimagesize($_FILES["subirImgGraRecorrido"]["tmp_name"]);

						$nuevoAncho=650;
						$nuevoAlto=450;

					/*=============================================
					NOMBRAMOS EL DIRECTORIO
					=============================================*/
					$directorio="vistas/img/recorrido";
					/*=============================================
					De acuerdo el tipo de imagen aplicar las funciones por defecto de php
					=============================================*/

					if($_FILES["subirImgGraRecorrido"]["type"]=="image/jpeg"){

						$aleatorio=mt_rand(100,999);

						$rutaImgGra=$directorio."/".$aleatorio.".jpg";
							
						$origen=imagecreatefromjpeg($_FILES["subirImgGraRecorrido"]["tmp_name"]);

						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0,$nuevoAncho,$nuevoAlto, $ancho,$alto);
						imagejpeg($destino,$rutaImgGra);

					}else if($_FILES["subirImgGraRecorrido"]["type"]=="image/png"){

						$aleatorio=mt_rand(100,999);

						$rutaImgGra=$directorio."/".$aleatorio.".png";

						$origen=imagecreatefrompng($_FILES["subirImgGraRecorrido"]["tmp_name"]);

						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagealphablending($destino, FALSE);

						imagesavealpha($destino,TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho,$nuevoAlto,  $ancho,$alto);

						imagepng($destino,$rutaImgGra);

					}else {
						echo'<script>

							swal({
									type:"error",
								  	title: "¡CORREGIR!",
								  	text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
								  	showConfirmButton: true,
									confirmButtonText: "Cerrar"
								  
							}).then(function(result){

									if(result.value){   
									    history.back();
									  } 
							});

						</script>';

						return;
					}

				}

				$tabla="recorrido";

				$datos=array("titulo"=>strtoupper($_POST["tituloRecorrido"]),
			                 "descripcion"=>$_POST["descripcionRecorrido"],
			             	"foto_peq"=>$rutaImgPeq, "foto_gran"=>$rutaImgGra);

					$respuesta=RecorridoModelo::mdlNuevoRecorrido($tabla,$datos);

					if($respuesta == "ok"){

							echo '<script>

								swal({
									type:"success",
								  	title: "¡CORRECTO!",
								  	text: "¡El recorrido ha sido creado exitosamente!",
								  	showConfirmButton: true,
									confirmButtonText: "Cerrar"
								  
								}).then(function(result){

										if(result.value){   
										    window.location = "recorrido";
										  } 
								});

							</script>';

						}	


			}else {
				echo '<script>

					swal({
						type:"error",
						title:"¡CORREGIR!",
						text:"No se permite Caracteres especiales",
						showConfirmButtom:true,
						confirmButtonText:"Cerrar"
						}).then(function(resultado){

							if(resultado.value){
								history.back();
							}

							})

				</script>';
			}
		}

	}

	/*========================================
	=      Un Actualizar recorrido            =
	========================================*/

	public function ctrActualizarRecorrido(){

		if(isset($_POST["idrecorrido"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editartituloRecorrido"]) &&
				preg_match('/^[\/\=\\&\\;\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionRecorrido"])){

				 $rutaImgPeq=$_POST["imgPeAntigua"];

				 $rutaImgGra=$_POST["imgGranAntigua"];
				// IMAGEN PEQUEÑA
				if(isset($_FILES["EditarsubirImgPeqRecorrido"]["tmp_name"]) && !empty($_FILES["EditarsubirImgPeqRecorrido"]["tmp_name"])){

					list($ancho,$alto)= getimagesize($_FILES["EditarsubirImgPeqRecorrido"]["tmp_name"]);

						$nuevoAncho=455;
						$nuevoAlto=280;
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(isset($_POST["imgPeAntigua"])){
						
						unlink($_POST["imgPeAntigua"]);

					}

					/*=============================================
					NOMBRAMOS EL DIRECTORIO
					=============================================*/
					$directorio="vistas/img/recorrido";
					/*=============================================
					De acuerdo el tipo de imagen aplicar las funciones por defecto de php
					=============================================*/

					if($_FILES["EditarsubirImgPeqRecorrido"]["type"]=="image/jpeg"){

						$aleatorio=mt_rand(100,999);

						$rutaImgPeq=$directorio."/".$aleatorio.".jpg";

						$origen=imagecreatefromjpeg($_FILES["EditarsubirImgPeqRecorrido"]["tmp_name"]);

						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0,$nuevoAncho,$nuevoAlto, $ancho,$alto);
						imagejpeg($destino,$rutaImgPeq);

					}else if($_FILES["EditarsubirImgPeqRecorrido"]["type"]=="image/png"){

						$aleatorio=mt_rand(100,999);

						$rutaImgPeq=$directorio."/".$aleatorio.".png";

						$origen=imagecreatefrompng($_FILES["EditarsubirImgPeqRecorrido"]["tmp_name"]);

						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagealphablending($destino, FALSE);

						imagesavealpha($destino,TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho,$nuevoAlto,  $ancho,$alto);

						imagepng($destino,$rutaImgPeq);

					}else {
						echo'<script>

							swal({
									type:"error",
								  	title: "¡CORREGIR!",
								  	text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
								  	showConfirmButton: true,
									confirmButtonText: "Cerrar"
								  
							}).then(function(result){

									if(result.value){   
									    history.back();
									  } 
							});

						</script>';

						return;
					}


				}
				// IMAGE GRANDE
				if(isset($_FILES["EditarSubirImgGraRecorrido"]["tmp_name"]) && !empty($_FILES["EditarSubirImgGraRecorrido"]["tmp_name"])){

					list($ancho,$alto)= getimagesize($_FILES["EditarSubirImgGraRecorrido"]["tmp_name"]);

						$nuevoAncho=650;
						$nuevoAlto=450;
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(isset($_POST["imgGranAntigua"])){
						
						unlink($_POST["imgGranAntigua"]);

					}

					/*=============================================
					NOMBRAMOS EL DIRECTORIO
					=============================================*/
					$directorio="vistas/img/recorrido";
					/*=============================================
					De acuerdo el tipo de imagen aplicar las funciones por defecto de php
					=============================================*/

					if($_FILES["EditarSubirImgGraRecorrido"]["type"]=="image/jpeg"){

						$aleatorio=mt_rand(100,999);

						$rutaImgGra=$directorio."/".$aleatorio.".jpg";
							
						$origen=imagecreatefromjpeg($_FILES["EditarSubirImgGraRecorrido"]["tmp_name"]);

						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0,$nuevoAncho,$nuevoAlto, $ancho,$alto);
						imagejpeg($destino,$rutaImgGra);

					}else if($_FILES["EditarSubirImgGraRecorrido"]["type"]=="image/png"){

						$aleatorio=mt_rand(100,999);

						$rutaImgGra=$directorio."/".$aleatorio.".png";

						$origen=imagecreatefrompng($_FILES["EditarSubirImgGraRecorrido"]["tmp_name"]);

						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagealphablending($destino, FALSE);

						imagesavealpha($destino,TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho,$nuevoAlto,  $ancho,$alto);

						imagepng($destino,$rutaImgGra);

					}else {
						echo'<script>

							swal({
									type:"error",
								  	title: "¡CORREGIR!",
								  	text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
								  	showConfirmButton: true,
									confirmButtonText: "Cerrar"
								  
							}).then(function(result){

									if(result.value){   
									    history.back();
									  } 
							});

						</script>';

						return;
					}

				}
				$tabla="recorrido";

				$datos=array("titulo"=>strtoupper($_POST["editartituloRecorrido"]),
			                 "descripcion"=>$_POST["editarDescripcionRecorrido"],
			                 "id_recorrido"=>$_POST["idrecorrido"],
			             	"foto_peq"=>$rutaImgPeq, "foto_gran"=>$rutaImgGra);

					$respuesta=RecorridoModelo::mdlActualizarRecorrido($tabla,$datos);

					if($respuesta == "ok"){

							echo '<script>

								swal({
									type:"success",
								  	title: "¡CORRECTO!",
								  	text: "¡El recorrido ha sido creado exitosamente!",
								  	showConfirmButton: true,
									confirmButtonText: "Cerrar"
								  
								}).then(function(result){

										if(result.value){   
										    window.location = "recorrido";
										  } 
								});

							</script>';

						}


			}else {

				echo '<script>

					swal({
						type:"error",
						title:"¡CORREGIR!",
						text:"No se permite Caracteres especiales",
						showConfirmButtom:true,
						confirmButtonText:"Cerrar"
						}).then(function(resultado){

							if(resultado.value){
								history.back();
							}

							})

				</script>';

			}

		}
	}
	/*========================================
	=      Eliminar recorrido            =
	========================================*/

	static public function ctrEliminarRecorrido($id,$imgGram,$imgPeq){

		unlink("../".$imgGram);
		unlink("../".$imgPeq);

		$tabla="recorrido";

		$respuesta =RecorridoModelo::mdlEliminarRecorrido($tabla,$id);

		return $respuesta;

	}

}