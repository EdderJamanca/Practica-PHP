<?php 


Class BannerContolador {

	/*=============================================
	=            Mostrar Baner           =
	=============================================*/

	static public function ctrMostrarBanner($item,$valor){

		$tabla="banner";

		$respuesta = BannerModelo::mdlMostrarBanner($tabla,$item,$valor);

		return $respuesta;

	}

	/*=============================================
	=            Registrar Banner           =
	=============================================*/

	public function ctrRegistrarBanner(){



		if(isset($_FILES["subirBanner"]["tmp_name"]) && !empty($_FILES["subirBanner"]["tmp_name"])){

			list($ancho,$alto)=getimagesize($_FILES["subirBanner"]["tmp_name"]);//obtenemos las dimensiones 

			$nuevoAncho =1440;
			$nuevoAlto = 600;

			/*=============================================
			=            Registrar Banner           =
			=============================================*/
			$director ="vistas/img/banner";


			/*=============================================
			=DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES
			POR DEFECTO DE PHP           =
			=============================================*/

			if($_FILES["subirBanner"]["type"]=="image/jpeg"){

				$aleatorio =mt_rand(100,999);

				$ruta =$director."/".$aleatorio.".jpg";

				$origen = imagecreatefromjpeg($_FILES["subirBanner"]["tmp_name"]);

				$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho,$nuevoAlto,$ancho,$alto);

				imagejpeg($destino,$ruta);

			}
			else  if($_FILES["subirBanner"]["type"]=="image/png"){

				$aleatorio=mt_rand(100,999);

				$ruta =$directorio."".$aleatorio.".png";

				$origen = imagecreatefrompng($_FILES["subirBanner"]["tmp_name"]);

				$destino =imagecreatetruecolor($nuevoAncho,$nuevoAlto);

				imagealphablending($destino,FALSE);

				imagesavealpha($destino, TRUE);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho,$nuevoAlto,$ancho,$alto);

				imagepng($destino,$ruta);

			}else {

				echo '<script>
							swal({
									type:"error",
									title:"¡CORREGIR!",
									text:"¡No se permite formatos diferentes a JPG y/o PNG!",
									showConfirmButton:true,
									confirmButtomText:"Cerrar"
								}).then(function(result){

										if(result.value){

											history.back()

										}

									});
				</script>';

			}

			$tabla="banner";

			$respuesta =BannerModelo::mdlRegistrarBanner($tabla,$ruta);

			if($respuesta=="ok"){

				echo '<script>

					swal({
							type:"success",
							title:"¡CORRECTO!",
							text:"¡La imagen del banner ha sido creada exitosamente!",
							showConfirmButton:true,
							confirmButtonText:"Cerrar"
						}).then(function(result){

							if(result.value){

								window.location="banner"
							}

							});

				</script>';


			}

		}



	}

	/*=============================================
	=            Actualizar Banner           =
	=============================================*/	
	public function ctrActualizarBanner(){

		if(isset($_POST["idBanner"])){

			if(isset($_FILES["editarBanner"]["tmp_name"]) && !empty($_FILES["editarBanner"]["tmp_name"])){

				list($ancho,$alto) = getimagesize($_FILES["editarBanner"]["tmp_name"]);

				$nuevoAncho = 1440;
				$nuevoAlto =600;
				/*=============================================
				=            Actualizar Banner           =
				=============================================*/	
				$directorio ="vistas/img/banner";

				/*=============================================
				=   PREGUNTAR SI EXISTE OTRA IMANE EN LA BD  =
				=============================================*/	

				if(isset($_POST["bannerActual"])){

					unlink($_POST["bannerActual"]);

				}
				/*=============================================
				=   DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS 
				FUNCIONES  POR DEFEECTO DE PHP =
				=============================================*/	

				if($_FILES["editarBanner"]["type"]=="image/jpeg"){

					$aleatorio = mt_rand(100,999);

					$ruta = $directorio."/".$aleatorio.".jpg";

					$origen = imagecreatefromjpeg($_FILES["editarBanner"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto,$ancho,$alto);

					imagejpeg($destino,$ruta);

				}else if($_FILES["editarBanner"]["type"]=="image/png"){

					$aleatorio=mt_rand(100,999);

					$ruta =$directorio."/".$aleatorio.".png";

					$origen = imagecreatefrompng($_FILES["editarBanner"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagealphablending($destino, TRUE);

					imagesavealpha($destino, TRUE);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto,$ancho,$alto);

					imagepng($destino,$ruta);

				}else {

					echo '<script>

						swal({
								type:"error",
								title:"¡CORREGIR!",
								text: "¡Bo se permite formatos diferendes a JPG y/a PNG!",
								showConfirmButton: true,
								confirmButtonText:"Cerrar"
							}).then(function(result){

								if(result.value){
									window.location="banner";
								}

								});

					</script>';

					return;

				}
				$tabla="banner";

				$id=$_POST["idBanner"];

				$respuesta = BannerModelo::mdlActualizarBanner($tabla,$id,$ruta);

				if($respuesta =="ok"){

					echo '<script>

						swal({
								type:"success",
								title:"CORRECTO",
								text:"¡La imagen del banner ha sido actualizado!",
								showConfirmButton:true,
								confirmButtonText: "Cerrar"
							}).then(function(result){

									if(result.value){
										window.location="banner";
									}
								})

					</script>';

				}



			}

		}

	}

	/*=============================================
	=            Eliminar Banner           =
	=============================================*/	

	public function ctrEliminarBanner($id,$url){

		unlink("../".$url);

		$tabla = "banner";

		$item ="id";

		$respuesta = BannerModelo::mdlEliminarBanner($tabla,$item,$id);

		return $respuesta;

	}

}