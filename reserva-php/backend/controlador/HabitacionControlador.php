	<?php 

	Class HabitacionControlador {

		/*==========================================
		=            MOSTRAR HABITACION            =
		==========================================*/
		
		static public function ctrMostrarHabitacion($valor){

			$tabla1="habitaciones";
			$tabla2="categorias";

			$respuesta=HabitacionModulo::mdlMostrarHabitacion($tabla1,$tabla2,$valor);

			return $respuesta;

		}
		/*==========================================
		=            NUEVA HABITACION            =
		==========================================*/
		static public function ctrNuevaHabitacion($datos){
	
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["estilo"]) &&
				preg_match('/^[_\\a-zA-Z0-9]+$/', $datos["video"]) && 
				preg_match('/^[\/\=\\&\\$\\;\\_\\|\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["descripcion_h"])){

					if($datos["galeria"] != ""){

						$ruta = array();

						$guardarRuta=array();

						$galeria = json_decode($datos["galeria"],true);

						for ($i=0; $i <count($galeria) ; $i++) { 
							
							list($ancho,$alto)=getimagesize($galeria[$i]);

							$nuevoAncho =940;
							$nuevoAlto=480;

							/*=============================================
							Creamos el directorio donde vamos a guardar la imagen
							=============================================*/
							$directorio ="../vistas/img/".$datos["tipo_c"];

							array_push($ruta,$directorio."/".$datos["estilo"].($i+1).".jpg");

							$origen =imagecreatefromjpeg($galeria[$i]);

							$destino =imagecreatetruecolor($nuevoAncho,$nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho,$nuevoAlto, $ancho,$alto);
							imagejpeg($destino,$ruta[$i]);

							array_push($guardarRuta, substr($ruta[$i],3));
						}

					}else {

					echo '<script>

							swal({
									type:"error",
									title:"CORREGIR!",
									text:"¡La galería no puede estar vacio!",
									showConfirmButton: true,
									confirmButtonText:"Cerrar"
								}).then(function(result){

										if(result.value){
											history.back();
										}

									})

						</script>';

						return;

					}

					if($datos["recorrido_virtual"] !=""){

						list($ancho,$alto)=getimagesize($datos["recorrido_virtual"]);

						$nuevoAncho =4030;
						$nuevoAlto=1144;

						$directorio="../vistas/img/".$datos["tipo_c"];

						$ruta360= strtolower($directorio."/".$datos["estilo"]."-360.jpg");

						$origen=imagecreatefromjpeg($datos["recorrido_virtual"]);

						$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho , $nuevoAlto, $ancho,$alto);
						imagejpeg($destino,$ruta360);

					}else {

						echo '<script>

							swal({
									type:"error",
									title:"CORREGIR!",
									text:"¡El recorrido virtual no puede estar vacio!",
									showConfirmButton: true,
									confirmButtonText:"Cerrar"
								}).then(function(result){

										if(result.value){
											history.back();
										}

									})

						</script>';

						return;

					}
					$tablas ="habitaciones";
			

					$datos1= array("tipo"=>$datos["tipo"], 
									"estilo"=>$datos["estilo"],
									"galeria"=>json_encode($guardarRuta),
									"video"=>$datos["video"],
									"recorrido_virtual"=>substr($ruta360,3),
									"descripcion_h"=>$datos["descripcion_h"]);

					$respuesta = HabitacionModulo::mdlNuevaHabitacion($tablas,$datos1);

					return $respuesta;


			}else {
				echo '<script>
				

					swal({
							type:"error",
							title:"¡ERROR!",
							text:"No se permite Caracteres especiales",
							showConfirmButton: true,
							confirmButtonText:"Cerrar"
						}).then(function(result){

								if(result.value){
									history.back();
								}

							})

				</script>';
			}

		}

		/*==========================================
		=            ACTUALIZAR HABITACION            =
		==========================================*/
		static public function ctrEditarHabitacion($datos){

			if(preg_match('/^[-\\_\\a-zA-Z0-9]+$/', $datos["video"]) && 
			   preg_match('/^[\/\=\\&\\$\\;\\_\\-\\|\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["descripcion_h"])){

				//Validamos que la galería no venga vacía


			   	if($datos["galeriaAntigua"] == "" && $datos["galeria"] == ""){

					echo'<script>

							swal({
									type:"error",
								  	title: "¡CORREGIR!",
								  	text: "¡La galería no puede estar vacía",
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
				//Eliminar las fotos de la galería de la carpeta

				$traerHabitacion =HabitacionModulo::mdlMostrarHabitacion("habitaciones","categorias", $datos["id_h"]);

				if($datos["galeriaAntigua"] != ""){	


					$galeriaBD = json_decode($traerHabitacion["galeria"], true);

					$galeriaAntigua = explode(",", $datos["galeriaAntigua"]);


					$guardarRuta = $galeriaAntigua;
			
					$borrarFoto = array_diff($galeriaBD, $galeriaAntigua);
			

					foreach ($borrarFoto as $key => $valueFoto){
							
						unlink("../".$valueFoto);

					}



				}else{


					$galeriaBD = json_decode($traerHabitacion["galeria"], true);

					foreach ($galeriaBD as $key => $valueFoto){

						unlink("../".$valueFoto);

					}

					
				}

				if($datos["galeria"] != ""){


					echo '<pre>'; print_r("hola"); echo '</pre>';

				   	$ruta = array();
				   	$guardarRuta = array();

					$galeria = json_decode($datos["galeria"], true);
					$galeriaAntigua = explode(",",$datos["galeriaAntigua"]);

					for($i = 0; $i < count($galeria); $i++){

						list($ancho, $alto) = getimagesize($galeria[$i]);

						$nuevoAncho = 940;
						$nuevoAlto = 480;

						$aleatorio = mt_rand(100,999); 

						/*=============================================
						Creamos el directorio donde vamos a guardar la imagen
						=============================================*/

						$directorio = "../vistas/img/".$datos["tipo_c"];	

						array_push($ruta, strtolower($directorio."/".$datos["estilo"].$aleatorio.".jpg"));

						$origen = imagecreatefromjpeg($galeria[$i]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta[$i]);	

						array_push($guardarRuta, substr($ruta[$i], 3));

					}

					// Agregamos las fotos antiguas

				echo '<pre>'; print_r($datos["galeriaAntigua"]); echo '</pre>';

				echo '<pre>'; print_r($galeriaAntigua ); echo '</pre>';
				return;

					if($datos["galeriaAntigua"] != ""){

						foreach ($galeriaAntigua as $key => $value) {
							
							array_push($guardarRuta, $value);
						}

					}

			    }

				//Cuando viene recorrido virtual nuevo


				if($datos["recorrido_virtual"] != "undefined"){	

					unlink("../".$datos["recorridoAntigua"]);
					
					list($ancho,$alto) = getimagesize($datos["recorrido_virtual"]);

					$nuevoAncho = 4030;
					$nuevoAlto = 1144;

					$directorio = "../vistas/img/".$datos["tipo_c"];	

					$ruta360 = strtolower($directorio."/".$datos["estilo"]."-360.jpg");

					$origen = imagecreatefromjpeg($datos["recorrido_virtual"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta360);

					$ruta360 = substr($ruta360,3);	

				}else{

					$ruta360 = $datos["recorridoAntigua"];
					
				}

					$tabla = "habitaciones";

					$datos = array("id_h" => $datos["id_h"],
							   "tipo" => $datos["tipo"],
							   "estilo" => $datos["estilo"],
							   "galeria" => json_encode($guardarRuta),
							   "video" => $datos["video"],
							   "recorrido_virtual" => $ruta360,
							   "descripcion_h" => $datos["descripcion_h"]);



					$respuesta = HabitacionModulo::mdlEditarHabitacion($tabla,$datos);

					return $respuesta; 




			}else {
				echo '<script>
				

					swal({
							type:"error",
							title:"¡ERROR!",
							text:"No se permite Caracteres especiales en los campos",
							showConfirmButton: true,
							confirmButtonText:"Cerrar"
						}).then(function(result){

								if(result.value){
									history.back();
								}

							})

				</script>';
			}
		}
		
		/*==========================================
		=            ELIMINAR HABITACION            =
		==========================================*/
		static public function ctrEliminarHabitacion($datos){

			// ELIMINAR FOTOS DE LA GALERIAS


			$galeriasHabitacion=explode(",",$datos["galeriaHabitacion"]);

			foreach ($galeriasHabitacion as $key => $value) {
				unlink("../".$value);
			}
			// eliminar 360 grados

			unlink("../".trim($datos["recorridoHabitacion"]));
			

			$tabla="habitaciones";

			$respuesta=HabitacionModulo::mdlEliminarHabitacion($tabla,$datos["idEliminar"]);

			return $respuesta;

		}
		

	}