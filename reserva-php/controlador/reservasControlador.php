<?php 

Class ReservaControlador {

	/*=============================================
	Mostrar Reservas
	=============================================*/

	static public function ctlReservas($valor){

		
		$tabla1="habitaciones";
		$tabla2="reservas";
		$tabla3="categorias";

	

		$respuesta=ReservasModelo::mdlReservasInnerJoin($tabla1,$tabla2,$tabla3,$valor);

		return $respuesta;

	}
	/*=============================================
	Mostrar Código Reserva Singular
	=============================================*/
	static public function ctrMostrarCodigoReserva($valor){

		$tabla = "reservas";

		$respuesta = ReservasModelo::mdlMostrarCodigoReserva($tabla, $valor);

		return $respuesta;

	}

	/*=============================================
	Guardar Reserva
	=============================================*/

	static public function ctrGuardarReserva($datos){

		$tabla="reservas";

		$respuesta= ReservasModelo::mdlGuardarReserva($tabla,$datos);

		if(!empty($respuesta)){

			$tablaTestimonio="testimonio";

			$datos=array("id_reser"=>$respuesta,
				"id_usua"=>$datos["id_usuario"],
				"id_habit"=>$datos["id_habitacion"],
				"testimonio"=>"",
				"aprobado"=>0);

			$crearTestimonio = ReservasModelo::mdlCreaTestimonio($tablaTestimonio,$datos);

			return $crearTestimonio;
		}

	}
	/*=============================================
	Mostrar Reservas por usuario
	=============================================*/

	static public function ctrMostrarReservasUsario($valor){

		$tabla="reservas";

		$respuesta=ReservasModelo::mdlMostrarReservaUsuario($tabla,$valor);

		return $respuesta;

	}
	/*=============================================
	Mostrar testimonio
	=============================================*/

	static public function ctrMostrarTestimonio($item,$valor){

		$tabla1="testimonio";
		$tabla2="habitaciones";
		$tabla3="reservas";
		$tabla4="usuario";

		$respuesta=ReservasModelo::mdlMostrarTestimonio($tabla1,$tabla2,$tabla3,$tabla4,$item,$valor);
		return $respuesta;
	}

	/*=============================================
	Actualizar Testimonio
	=============================================*/

	public function mdlActualizarTestimodio(){

		if(isset($_POST["actualizarTestimonio"])){

			if(preg_match('/^[?\\¿\\!\\¡\\:\\,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["actualizarTestimonio"])){

				$datos =array("id_testimonio"=>$_POST["idTestimonio"],
							  "testimonio"=>$_POST["actualizarTestimonio"]);
				$tabla="testimonio";

				$actualizarTestimonio=ReservasModelo::mdlActualizarTestimonio($tabla,$datos);

				if($actualizarTestimonio=="ok"){

					echo '<script>
						swal({
								type:"success",
								title:"¡CORRECTO!",
								text:"¡El testimonio ha sido actualizado correctamente!",
								showConfirmButton:true,
								confirmButtonText:"Cerrar"
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
								text:"¡No se permite el uso de caracter especiales!",
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