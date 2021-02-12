<?php 


Class AdministradorControlador{

/*=============================================
=            INGRESO USUARIO           =
=============================================*/

	public function ctrIngresoUsuario(){

			if(isset($_POST["ingresoUsuario"])){


				if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["ingresoUsuario"]) && 
				   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoPassword"])){

					$tabla= "administrador";
					$item ="usuario";

					$valor = $_POST["ingresoUsuario"];
					$respuesta = AdministradorModelo::mdlMostrarUsuario($tabla,$item,$valor);

					if($respuesta != null){

						 if($respuesta["usuario"]==$_POST["ingresoUsuario"] && $respuesta["password"]==$_POST["ingresoPassword"]){

							if($respuesta["estado"]==1){

								$_SESSION["verificarUsuarioB"]="ok";
								$_SESSION["idUsuarioB"]=$respuesta["id_admin"];

							echo '<script>
									window.location = "'.$_SERVER["REQUEST_URI"].'";
							     </script>';


							}else {

							echo '<div class="alert alert-danger">
									<span>¡ERROR AL INGRESAR!</span> El usuario está desactivado.
								 </div>';

							}


						} else {


							echo '<div class="alert alert-danger">
							<span>¡ERROR AL INGRESAR!</span> Su contraseña y/o usario no es correcta, Intentelo de nuevo.
							</div>';

						}



					}
				


				}else {

					echo '<div class="alert alert-danger">
					<span>¡ERROR!</span> no se permite caracteres especiales.
					</div>';

				}




			}

	}

	/*=============================================
	Mostrar Administradores
	=============================================*/

	static public function ctrMostrarUsuario($item,$valor){

		$tabla="administrador";

		$respuesta = AdministradorModelo::mdlMostrarUsuario($tabla,$item,$valor);

		return $respuesta;

	}
	/*=============================================
	Registro de administrador
	=============================================*/

	public function ctrRegistrarAdministrador(){

		if(isset($_POST["crearNombre"])){

			if(preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ ]+$/', $_POST["crearNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["crearUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["crearPassword"])){

			   	$encriptarPassword =crypt($_POST["crearPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			   $tabla = "administrador";

			   $datos =array("nombre"=>$_POST["crearNombre"],
							 "usuario"=>$_POST["crearUsuario"],
							 "password"=>$encriptarPassword,
							 "perfil"=>$_POST["crearPerfil"],
							 "estado"=>0);
			   $respuesta=AdministradorModelo::mdlRegistrarAdministrador($tabla,$datos);

			   if($respuesta !=""){

			   		if($respuesta=="ok"){

			   		echo'<script>

						swal({
								type:"success",
							  	title: "¡CORRECTO!",
							  	text: "El administrador ha sido creado correctamente",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    window.location = "administradores";
								  } 
						});

					</script>';
			   		}

			   }

			}else {
				echo '<div class="alert alert-danger">¡Error, no se permite caracteres especiales!</div>';
			}

		}

	}
	/*=============================================
	Actualizar de administrador
	=============================================*/

	public function ctrActualizarAdministrador(){

		if(isset($_POST["editarNombre"])){

			if(preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["editarNombre"]) && 
			    preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarUsuario"])){

				if($_POST["editarPassword"] != ""){

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

						$password = crypt($_POST["editarPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					}else {
						echo "<div class='alert alert-danger mt-3 smail'>ERROR: No se permiten caracteres</div>";
						return;
					}

				}else {

					$password=$_POST["passwordActual"];

				}

				$tabla = "administrador";

			    $datos =array("id"=>$_POST["editarid"],
			    			  "nombre"=>$_POST["editarNombre"],
							 "usuario"=>$_POST["editarUsuario"],
							 "password"=>$password,
							 "perfil"=>$_POST["editarPerfil"]);
			    $respuesta= AdministradorModelo::mdlEditarAdministrador($tabla, $datos);


			    if($respuesta=="ok"){

			    	echo '<script>

			    	swal({
			    			type:"success",
			    			title:"¡CORRECTO!",
			    			text:"¡El administrador ha editado correctamente!",
			    			showConfirmButton: true,
			    			confirmButtonText:"Cerrar"
			    		}).then(function(result){

			    			if(result.value){
			    				history.back()

			    			}

			    		});

			    	</script>';
			    }

			}else {
				
				echo "<div class='alert alert-danger mt-3 small'>ERROR: No se permiten caracteres especiales</div>";
			}

		}

	}

	/*============================================
	=           ELIMINAR ADMINISTRADOR           =
	============================================*/

	public function ctrEliminarAdministrador($item,$valor){

		$tabla="administrador";

		$respuesta = AdministradorModelo::mdlEliminarAdministrador($tabla,$item,$valor);

		return $respuesta;

	}


}










