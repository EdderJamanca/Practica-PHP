<?php 

/*==============================================
=          TRAER RESERVA         =
==============================================*/
require_once "../controlador/ReservaControlador.php";
require_once "../modelo/ReservaModelo.php";
/*==============================================
=          TRAER TESTIMONIO         =
==============================================*/
require_once "../controlador/TestimonioControlador.php";
require_once "../modelo/TestimonioModelo.php";

Class UsuarioAjax{

	/*=================================================
	=            Sumar reesrvas de usuario            =
	=================================================*/
	
	public $idUsuario;

	public function sumarReservas(){

		$respuesta=ReservaControlador::ctrMostrarReserva("id_usu", $this->idUsuario);

		echo json_encode($respuesta);
	}
	/*=================================================
	=            Sumar tESTIMONIO de usuario            =
	=================================================*/
	
	public $idUsuarioT;

	public function sumarTestimonio(){

		$respuesta=TestimonioControlador::ctrMostrarTestimonio("id_usua", $this->idUsuarioT);

		echo json_encode($respuesta);
	}

	

}

	/*=================================================
	=            Sumar reesrvas de usuario            =
	=================================================*/
	if(isset($_POST["idUsuarioR"])){

		$sumaReserva =new UsuarioAjax();
		$sumaReserva -> idUsuario =$_POST["idUsuarioR"];
		$sumaReserva ->sumarReservas();

	}
	/*=================================================
	=            Sumar testimonio de usuario            =
	=================================================*/
	if(isset($_POST["idUsuarioT"])){

		$sumaTestimonio =new UsuarioAjax();
		$sumaTestimonio -> idUsuarioT =$_POST["idUsuarioT"];
		$sumaTestimonio ->sumarTestimonio();

	}