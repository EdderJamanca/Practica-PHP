<?php 

require_once "../controlador/usuarioControlador.php";
require_once "../modelo/usuarioModelo.php";

Class UsuarioAjax {


	/*=============================================
	VALIDAR EMAIL EXISTENTE
	=============================================*/

	public $validarEmail;

	public function consultarEmail(){

		$item="email_use";
		$valor=$this->validarEmail;
	
		$respuesta=UsuarioControlador::ctrMostrarUsuario($item,$valor);


		echo json_encode($respuesta);

	}

	/*=============================================
	REGISTRO CON FACENOOK
	=============================================*/
	public $email;
	public $nombre;
	public $foto;

	public function registrarFacebook(){

	    $datos=array("nombre"=>$this -> nombre,
			 "password"=>"null",
			 "email"=>$this -> email,
			 "foto"=>$this-> foto,
			 "modo"=>"facebook",
			  "verificacion"=>1,
			  "email_emcriptado"=>"null");

	    $respuesta =UsuarioControlador::ctrRegistroRedesSociales($datos);

	    echo $respuesta;

	}


}
	/*=============================================
		objeto de validar email
	=============================================*/

if(isset($_POST["validarEmail"])){

	$valEmail= new UsuarioAjax();

	$valEmail -> validarEmail=$_POST["validarEmail"];

	$valEmail ->consultarEmail();

}
/*=============================================
	onjeto registrar dcon facebook
=============================================*/

if(isset($_POST["email"])){

	$registroFacebook= new UsuarioAjax();

	$registroFacebook -> nombre=$_POST["nombre"];

	$registroFacebook -> email=$_POST["email"];

	$registroFacebook -> foto=$_POST["foto"];

	$registroFacebook ->registrarFacebook();

}