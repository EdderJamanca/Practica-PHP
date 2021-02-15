<?php 

require_once "../controlador/ReservaControlador.php";
require_once "../modelo/ReservaModelo.php";

Class ReservaAjax {

	/*==========================================
	=            Motrar Una Reserva            =
	==========================================*/
	public $idHabitacion;
	public function MostrarUnaReserva(){

		$unareserva=ReservaControlador::ctrMostrarReserva('id_habitacion', $this-> idHabitacion);

		echo json_encode($unareserva);

	}
	/*==========================================
	=            Motrar Una Reserva            =
	==========================================*/
	public $fechaIngreso;
	public $fechaSalida;
	public $idReserva;
	public function GuardarReserva(){

		$datos= array("fechaIngreso"=>$this->fechaIngreso,
						"fechaSalida"=>$this->fechaSalida,
						"idReserva"=>$this->idReserva);

		$respuesta =ReservaControlador::ctrCambiarReserva($datos);

		echo $respuesta;
	}

}
/*==================================================
=            OBJETO MOSTRAR UNA RESERVA            =
==================================================*/
	if (isset($_POST["idhabitacion"])) {

		$unaReserva= new ReservaAjax();
		$unaReserva->idHabitacion=$_POST["idhabitacion"];
		$unaReserva ->MostrarUnaReserva();
		
	}
if (isset($_POST["idReserva"])) {
	$cambiar = new ReservaAjax();
	$cambiar->fechaIngreso=$_POST["fechaIngreso"];
	$cambiar->fechaSalida=$_POST["fechaSalida"];
	$cambiar->idReserva=$_POST["idReserva"];
	$cambiar->GuardarReserva();

}


















