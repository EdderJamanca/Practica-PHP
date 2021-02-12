<?php 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

Class UsuarioControlador {

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	public function ctrRegistrarUsuario(){

		if(isset($_POST["registroNombre"])){

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["registroNombre"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["registroEmail"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["registroPassword"])){

			   	$emcriptarPassword=crypt($_POST["registroPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			    $encriptarEmail=md5($_POST["registroEmail"]);

			    $tabla="usuario";

			    $datos=array("nombre"=>$_POST["registroNombre"],
							 "password"=>$emcriptarPassword,
							 "email"=>$_POST["registroEmail"],
							 "foto"=>"",
							 "modo"=>"directo",
							  "verificacion"=>0,
							  "email_emcriptado"=>$encriptarEmail);

			    $respuesta= UsuarioModelo::mdlUsuarioModelo($tabla,$datos);

			    if($respuesta=="ok"){

			    	/*=============================================
					VERIFICACIÓN CORREO ELECTRÓNICO
					=============================================*/

					date_default_timezone_set("America/Lima"); //la fecha del lugar

					$ruta=rutaControlador::ctrRuta();

					$mail= new PHPMailer;

					$mail->CharSet="UTF-8";

					$mail->isMail();

					$mail->setFrom('cursos@tutorialesatualcance.com', 'Tutoriales a tu Alcance');//quien los envia

					$mail->addReplyTo('cursos@tutorialesatualcance.com', 'Tutoriales a tu Alcance');// quien va responder

					$mail->Subject="Por favor verifique su dirección de correo electrónico";

					$mail->addAddress($_POST["registroEmail"]); //el correo del  usuario

					$mail->msgHTML('<div style="width: 100%; background: #eee; position: relative;font-family: sans-serif;padding-bottom: 40px">

								<center>

									<img src="https://0201.nccdn.net/1_2/000/000/0c2/30c/logo.jpg" style="padding: 20px; width: 10%">

								</center>

								<div style="position: relative; margin: auto; width: 600px; background: white; padding: 20px">

									<center>
										
										<img src="https://i.blogs.es/e2ccc8/gmail-logo-/450_1000.jpg" alt="">

										<h3 style="font-weight: 100; color: #999" >VERIFIQUE TU DIRECCIÓN DE CORREO ELECTRONICO</h3>

										<hr style="border:1px solid #ccc; width: 80%">

										<h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta, debe confirmar su dirección de correo electrónico</h4>

										<a href="'.$ruta.$encriptarEmail.'" target="_blank" style="text-decoration:none">
											
											<div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su dirección de correo electrónico</div>

										</a>

										<br>

										<hr style="border:1px solid #ccc; width:80%">

										<h5 style="font-weight:100; color:#999; ">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>


									</center>
									
								</div>
								
						</div>');

					    $envio=$mail->Send();
					    echo '<pre>'; print_r($envio); echo '</pre>';

					    if(!$envio){

					    	echo '<script>

					    	swal({
					    			type:"error",
					    			title:"¡ERROR!",
					    			text:"¡Ha ocurrido un problema enviado de correo electronico a!'.$_POST["registroEmail"].$mail->ErrorInfo.', por favor inténtelo nuevamente",
					    			showConfirmButton:true,
					    			confirmButtonText:"Cerrar"
					    		}).then(function(result){

					    			if(result.value){
					    				history.black();
					    			}

					    			});

					    	</script>';

					    }else {

					    	echo '<script>

					    		swal({

					    			type:"success",
					    			title:"¡SU CUENTA HA SIDO CREADO CORRECTAMENTE!",
					    			text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico para verificar la cuenta!",
					    			showConfirmButton: true,
					    			confirmButtonText: "Cerrar"
					    			}).then(function(result){

					    					if(result.value){
					    						history.back();
					    					}

					    				});

					    	</script>';

					    }

			    	
			    }else {
			    	echo'<script>

						swal({
								type:"error",
							  	title: "¡CORREGIR!",
							  	text: "¡No se permiten caracteres especiales!",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';
			    }


			}

		}

	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/
	static public function ctrMostrarUsuario($item,$valor) {

		$tabla="usuario";

		$respuesta=UsuarioModelo::mdlMostrarUsuario($tabla, $item,$valor);

		return $respuesta;

	}
	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/
	static public function ctrActualizarUsuario($id,$item,$valor){

		$tabla="usuario";

		$respuesta=UsuarioModelo::mdlActualizarUsuario($tabla,$id,$item,$valor);

		return $respuesta;

	}
	/*=============================================
	INGRESAR USUARIO
	=============================================*/

	public static function ctrIngresoUsuario(){

		if(isset($_POST["emailIngreso"])){

			if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailIngreso"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordIngreso"])){

						$tabla="usuario";
						$item="email_use";
						$valor=$_POST["emailIngreso"];

						$ingresoPassword=crypt($_POST["passwordIngreso"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

						$respuesta=UsuarioModelo::mdlMostrarUsuario($tabla,$item,$valor);

						if($respuesta["password_use"]==$ingresoPassword && $respuesta["email_use"]==$_POST["emailIngreso"]){

							if($respuesta["verificacion_use"]==0){

								echo '<script>

									swal({
											type:"error",
											title:"¡ERROR!",
											text:"¡El correo electrónico no ha sido verificado, por favor revise la bandeja de entrada o la carpeta de SPAN de su correo electronico para verificar la cuenta!",
											showConfirmButton:true,
											confirmButtton:"Cerrar"

										}).then(function(result){

											if(result.value){
												history.back();
											}

										});

								</script>';
								return;

							}else {

								$_SESSION["ValidarSession"]="ok";
								$_SESSION["id"]=$respuesta["id_usuario"];
								$_SESSION["nombre"]=$respuesta["nombre_use"];
								$_SESSION["foto"]=$respuesta["foto_use"];
								$_SESSION["email"]=$respuesta["email_use"];	
								$_SESSION["modo"]=$respuesta["modo_use"];	


								echo '<script>
										setTimeout(function(){

											window.location="'.$ruta.'perfil";

											},500);
								</script>';
							}

						}else {

							echo '<script>
									swal({
											type:"error",
											title:"¡ERROR!",
											text:"¡El imail o contraseña no coincide!",
											showConfirmButton:true,
											confirmButton:"Cerrar"
										}).then(function(result){
											if(result.value){
												history.back();
											}
											});
							</script>';

						}


			}
			// fin preg_match

		}
		// fin isset



	}
	// fin ingreso usuario

	public function ctrRegistroRedesSociales($datos){

		$tabla = "usuario";
		$item ="email_use";
		$valor =$datos["email"];
		$emailRepetido =false;

		$verificarExistencia = UsuarioModelo::mdlMostrarUsuario($tabla, $item, $valor);

		if($verificarExistencia){

			$emailRepetido =true;

		}else {

			$registroUsuario = UsuarioModelo::mdlUsuarioModelo($tabla,$datos);

		}

		if($emailRepetido || $registroUsuario=="ok"){

			$traerUsuario=UsuarioModelo::mdlMostrarUsuario($tabla,$item,$valor);

			if($traerUsuario["modo_use"]=="facebook"){

				session_start();

				$_SESSION["ValidarSession"]="ok";
				$_SESSION["id"]=$traerUsuario["id_usuario"];
				$_SESSION["nombre"]=$traerUsuario["nombre_use"];
				$_SESSION["foto"]=$traerUsuario["foto_use"];
				$_SESSION["email"]=$traerUsuario["email_use"];	
				$_SESSION["modo"]=$traerUsuario["modo_use"];	

				echo "ok";

			}else if($traerUsuario["modo_use"]=="google"){

					$_SESSION["ValidarSession"]="ok";
					$_SESSION["id"]=$traerUsuario["id_usuario"];
					$_SESSION["nombre"]=$traerUsuario["nombre_use"];
					$_SESSION["foto"]=$traerUsuario["foto_use"];
					$_SESSION["email"]=$traerUsuario["email_use"];	
					$_SESSION["modo"]=$traerUsuario["modo_use"];	

					echo '<script>
					
								setTimeout(function(){

											window.location="'.$ruta.'perfil";

								},500);

						</script>';

			}else {
				echo "";
			}
		}
	}

	/*=============================================
	CAMBIAR FOTO PERFIL
	=============================================*/

	public function ctlCambiarFotoControlador(){

		if(isset($_POST["idUsuarioFoto"])){

			$ruta="backend/".$_POST["fotoActual"];

			if(isset($_FILES["cambiarImagen"]["tmp_name"]) && !empty($_FILES["cambiarImagen"]["tmp_name"])){

				list($ancho,$alto)= getimagesize($_FILES["cambiarImagen"]["tmp_name"]);

				$nuevoAncho=500;
				$nuevoAlto=500;

				/*=============================================
				CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
				=============================================*/

				$directorio = "backend/vistas/img/usuarios/".$_POST["idUsuarioFoto"];
				/*=============================================
				PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
				=============================================*/
				if(!empty($ruta)){

					unlink($ruta);

				}else {

					if(!file_exists($directorio)){

						mkdir($directorio,0755);//creamos la carpeta

					}

				}

				/*=============================================
				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				=============================================*/

				if($_FILES["cambiarImagen"]["type"]=="image/jpeg"){

					$aleatorio=mt_rand(100,999);

					$ruta=$directorio."/".$aleatorio."jpg";

					$origen = imagecreatefromjpeg($_FILES["cambiarImagen"]["tmp_name"]);

					$destino=imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto,$ancho,$alto);

					imagejpeg($destino,$ruta);

				}else if($_FILES["cambiarImagen"]["type"]=="image/png"){

					$aleatorio=mt_rand(100,999);

					$ruta=$directorio."/".$aleatorio.".png";

					$original= imagecreatefrompng($_FILES["cambiarImagen"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagealphablending($destino, FALSE);

					imagesavealpha($destino, TRUE);

					imagecopyresized($destino, $original, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho,$alto);

					imagepng($destino,$ruta);

				} else {

					echo '<script>

						swal({
								type:"error",
								title: "¡CORREGIR!",
								text: "¡No se permite formatos diferentes a JPG y/o PNG!",
								showConfirmButton:true,
								confirmButtonText:"Cerrar"
							}).then(function(result){

								if(result.value){
									history.black();
								}

								});

					</script>';

				}

				$ruta=substr($ruta,8);


			}

			$tablas="usuario";
		
			$id=$_POST["idUsuarioFoto"];
			$item="foto_use";
	
			$valor =$ruta;
			

			$actualizarFotoPerfil= UsuarioModelo::mdlActualizarUsuario($tablas,$id,$item,$valor);
	
			if($actualizarFotoPerfil=="ok"){

				echo '<script>

					swal({

						type:"success",
						title:"¡CORRECTO!",
						text:"¨¡La foto de Perfil ha sido actualizado!",
						showConfirmButton:true,
						confirmButtonText: "Cerrar"
						}).then(function(result){

								if(result.value){
									history.back();
								}

							});

				</script>';

			}

		}

	}

	/*=============================================
	CAMBIAR PASSWORD
	=============================================*/

	public function ctrCambiarPassword(){

		if(isset($_POST["editarPassword"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

					$emcriptarPassword=crypt($_POST["editarPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					$tablas="usuario";
					$id=$_POST["idUsuarioPassword"];
					$item ="password_use";
					$valor=$emcriptarPassword;
					$actualizarPaawordPerfil= UsuarioModelo::mdlActualizarUsuario($tablas,$id,$item,$valor);

					if($actualizarPaawordPerfil=="ok"){

						echo '<script>

							swal({

								type:"success",
								title:"¡CORRECTO!",
								text:"¡Sus datos han sido actualizado!",
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

		}

	}


	/*=============================================
	RECUPERAR CONTRASEÑA
	=============================================*/

	public function ctrRecuperarPassword(){

		if(isset($_POST["emailRecuperarPassword"])){


			if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailRecuperarPassword"])){

				/*=============================================
				GENERAR CONTRASEÑA ALEATORIA
				=============================================*/

					function generarPassword($longitud){

						$password ="";

						$patron="1234567890abcdefghijklmnopqrstuvwxyz";

						$max =strlen($patron)-1;

						for ($i=0; $i <$longitud; $i++) { 

							$password .=$patron{mt_rand(0,$max)};
							
						}
						return $password;

					}
					// fingenerar password

					$nuevoPassword =generarPassword(11);

					$emcriptarPassword=crypt($nuevoPassword,'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				

					$tabla ="usuario";
					$item="email_use";
					$valor=$_POST["emailRecuperarPassword"];
			

					$mostrarUsuario=UsuarioModelo::mdlMostrarUsuario($tabla,$item,$valor);
			
					if($mostrarUsuario){

						$id=$mostrarUsuario["id_usuario"];

						$item="password_use";

						$valor=$emcriptarPassword;

						$actualizarPassword=UsuarioModelo::mdlActualizarUsuario($tabla,$id,$item,$valor);

							if($actualizarPassword=="ok"){
								/*=============================================
								VERIFICACIÓN CORREO ELECTRÓNICO
								=============================================*/
									date_default_timezone_set("America/Lima"); //la fecha del lugar

									$ruta=rutaControlador::ctrRuta();

									$mail= new PHPMailer;

									$mail->CharSet="UTF-8";

									$mail->isMail();

									$mail->setFrom("edder_20jame05@hotmail.com","Tutorial a tu Alcanxe");

									$mail->addReplyTo("edder_20jame05@hotmail.com","Tutorial a tu Alcanxe");

									$mail->Subject ="Por favor verifique su dirección de correo electronico";

									$mail->addAddress($_POST["emailRecuperarPassword"]);

									$mail->msgHTML('	<div style="width: 100%; background: #eee; position: relative; font-family: sans-serif; padding-bottom: 40px">

									<center>
										<img src="https://0201.nccdn.net/1_2/000/000/0c2/30c/logo.jpg" style="padding: 20px; width: 10%">
									</center>

									<div style="position: relative; margin: auto; width: 500px; background: white; padding: 20px">

										<center>

											<img src="https://i.blogs.es/e2ccc8/gmail-logo-/450_1000.jpg" alt="" style="padding: 20px; width: 15%">

											<h3 style="font-weight: 100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>

											<hr style="border:1 solid #ccc; width: 80%">

											<h4 style="font-weight: 100; color:#999; padding: 0 20px"><strong>Su nueva contraseña:</strong>'.$nuevoPassword.'</h4>

											<a href="'.$ruta.'" target="_blank" style="text-decoration: none">

												<div style="line-height:30px; background: #0aa; width: 60%; padding: 20px; color: white">
													Haz click aquí
												</div>
												
											</a>
											<h4 style="font-weight: 100; color: #999; padding: 0 20px">
											Ingrese nuevamente el sitio con esta contraseña cambiarla en el panel de perfil de usuario
											</h4>
											<br>

											<hr style="border:1px solid #ccc; width: 80%">

											<h5 style="font-weight:100; color:#999">
												Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.
											</h5>
											
										</center>
										
									</div>
									
								</div>');

									$envio =$mail->Send();

									if(!$envio){

										echo '<script>

											swal({

												type:"error",
												title:"¡ERROR!",
												text:"¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["emailRecuperarPassword"].$mail->ErrorInfo.', por favor inténtelo nuevamente",
												showConfirmButton:true,
												confirmButtonText:"Cerrar"

												}).then(function(result){

													if(result.value){
														history.back();
													}

													});

										</script>';

									}else {

									echo'<script>

										swal({
											type:"success",
										  	title: "¡SU SOLICITUD HA SIDO RECIBIDA!",
										  	text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["emailRecuperarPassword"].' para su cambio de contraseña!",
										  	showConfirmButton: true,
											confirmButtonText: "Cerrar"
										  
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
								  	title: "¡ERROR!",
								  	text: "¡El correo no existe en el sistema, puede registrase nuevamente con ese correo!",
								  	showConfirmButton: true,
									confirmButtonText: "Cerrar"
								  
								}).then(function(result){

										if(result.value){   
										    history.back();
										  } 
								});

							</script>';

					}

			}else {


					echo '<script>

							swal({

								type:"error",
								title:"CORREGIR!",
								text:"¡No se permiten caracteres especiales!",
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

	}

	/*=============================================
	FORMULARIO CONTACTENOS
	=============================================*/

	public function ctrFormularioContacto(){

		if(isset($_POST["correoContacto"])){


			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nombreContacto"])
			   && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["apellidoContacto"])
			   && preg_match('/^[0-9- ]+$/', $_POST["movilContacto"]) 
			   && preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["correoContacto"]) 
			   && preg_match('/^[?\\¿\\!\\¡\\:\\,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["mensajeContacto"])) {


				/*=============================================
				VERIFICACIÓN CORREO ELECTRÓNICO
				=============================================*/

				date_default_timezone_set("America/Lima");

				$ruta=rutaControlador::ctrRuta();

				$mail = new PHPMailer;

				$mail->CharSet ='UTF-8';

				$mail->isMail();

				$mail->setFrom('2014200351@ucss.pe','Tutorial a tu Alcance');

				$mail->addReplyTo('2014200351@ucss.pe','Tutorial a tu Alcance');

				$mail->Subject ='Por favor verificar su dirección de correo electrónico';

				$mail->addAddress("tucorreo@tudominio.com");

				$mail->msgHTML('
					<div style="width: 100%; background: #eee; position: relative; font-family: sans-serif; padding-bottom: 40px">

						<center>
							<img src="https://0201.nccdn.net/1_2/000/000/0c2/30c/logo.jpg" style="padding: 20px; width: 10%">
						</center>

						<div style="position: relative; margin: auto; width: 500px; background: white; padding: 20px">

							<center>

								<img src="https://i.blogs.es/e2ccc8/gmail-logo-/450_1000.jpg" alt="" style="padding: 20px; width: 15%">

								<h3 style="font-weight: 100; color:#999">HA RECIBIDO UNA CONSULTA</h3>

								<hr style="border:1 solid #ccc; width: 80%">

					
								<h4 style="font-weight: 100; color: #999; padding: 0 20px; text-align: center;">
									'.$_POST["nombreContacto"].' '.$_POST["apellidoContacto"].'
								</h4>

								<h4 style="padding: 0 20px; font-weight: 100; color: #999; text-align: center;">
									Móvil: '.$_POST["movilContacto"].'
								</h4>

								<h4 style="padding: 0 20px; font-weight: 100; color: #999; text-align: center;">
									Email: '.$_POST["correoContacto"].'
								</h4>
								<h4 style="padding: 0 20px; font-weight: 100; color: #999; text-align: center;">
									'.$_POST["mensajeContacto"].'
								<br>

								<hr style="border:1px solid #ccc; width: 80%">


							</center>
							
						</div>
						
					</div>
					');

				$envio = $mail->Send();

				if(!$envio){

					echo '<script>

						swal({

						      type:"error",
						      title:"¡ERROR!",
						      text:"¡Ha ocurrido un problema enviado el mensaje,vuelva a intentarlo!",
						      showConfirmButton:true,
						      ConfirmButtonText:"Cerrar"
							}).then(function(result){

								if(result.value){
									history.back();
								}

								});

					</script>';


				}else {

				echo '<script>

						swal({

						      type:"success",
						      title:"¡OK!",
						      text:"¡Su mensaje ha sido enviado, muy pronto le responderemos!",
						      showConfirmButton:true,
						      ConfirmButtonText:"Cerrar"
							}).then(function(result){

								if(result.value){
									history.back();
								}

								});

					</script>';


				}

			}else {

				echo '<script>

					swal({

							type:"error",
							title:"¡ERROR!",
							text:"¡Problemas al enviar el mensaje, revise que no tenga caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText:"Cerrar"

						}).then(function(result){

								if(result.value){
									history.back();
								}

							});

				</script>';

			}
			
		}

	}


}