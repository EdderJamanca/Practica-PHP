<?php 

require_once "../controlador/reservasControlador.php";
require_once "../modelo/reservasModelo.php";


Class ReservasAjax {

	public $idHabitacion;

	// TRAER RESERVA CON INNER JOIN

	public function traerReserva(){

		$valor=$this->idHabitacion;

		$respuesta=ReservaControlador::ctlReservas($valor);

		echo json_encode($respuesta);

	}
   // TRAER  RESERVA
	public $codigoReserva;
	public function codigoReserva(){

		$valor=$this->codigoReserva;

		$respuesta=ReservaControlador::ctrMostrarCodigoReserva($valor);

		echo json_encode($respuesta);

	}

	// TRAER TESTIMONIOS

	public $id_h;

	public function TraerTestimonioAjax(){

		$item = "id_habit";
		$valor = $this->id_h;
	
		$testimonio = ReservaControlador::ctrMostrarTestimonio($item,$valor);

		echo json_encode($testimonio);
	}




}

// OBJETO TRAER TESTIMONIO

if(isset($_POST["id_h"])){

	$testimonio = new ReservasAjax();

	$testimonio -> id_h = $_POST["id_h"];

	$testimonio ->TraerTestimonioAjax();

}



if(isset($_POST["idHabitacion"])){

	$reserva= new ReservasAjax();

	$reserva -> idHabitacion=$_POST["idHabitacion"];

	$reserva -> traerReserva();

}

if(isset($_POST["codigoReserva"])){

	$codigoReserva= new ReservasAjax();

	$codigoReserva -> codigoReserva =$_POST["codigoReserva"];

	$codigoReserva->codigoReserva();

}
