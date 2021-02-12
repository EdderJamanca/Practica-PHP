<?php 

require_once "../controlador/AdministradorControlador.php";
require_once "../modelo/AdministradorModelo.php";

Class AdministradorAjax{

	public $idAdmin;

	public function traerAdministradorAjax(){

		$valor = $this ->idAdmin;
		$item ="id_admin";

		$editarAdministrador =AdministradorControlador::ctrMostrarUsuario($item,$valor);

		echo json_encode($editarAdministrador);

	}
	/*============================================
	=            activar o desactivar            =
	============================================*/
	public $idAdmin1;
	public $estadoAdmin;


	public function cambioEstado(){

		$tabla="administrador";
		$item1="id_admin";

		$valor1=$this->idAdmin1;
		

		$item2="estado";
		$valor2=$this->estadoAdmin;
		

		$respuesta = AdministradorModelo::mdlActualizarEstado($tabla,$item1,$valor1,$item2,$valor2);

		echo $respuesta;
	}
	
	
	/*============================================
	=            activar o desactivar            =
	============================================*/

	public $eliminarId;

	public function eliminarAdministrar(){

		$item3="id_admin";
		$valor3 =$this ->eliminarId;

		$respuesta =AdministradorControlador::ctrEliminarAdministrador($item3,$valor3);

		echo $respuesta;

	}
	

}
	/*============================================
	=           ELIMINAR ADMINISTRADOR           =
	============================================*/

	if(isset($_POST["botonidAdm"])){

		$eliminarAdmin= new AdministradorAjax();

		$eliminarAdmin -> eliminarId =$_POST["botonidAdm"];

		$eliminarAdmin -> eliminarAdministrar();
	}

	/*============================================
	=            ACTIVAR O DESACTIVAR          =
	============================================*/

	if(isset($_POST["estadoAdmin"])){

		$cambiarEstado = new AdministradorAjax();

		$cambiarEstado -> idAdmin1 = $_POST["idAdmin1"];

		$cambiarEstado -> estadoAdmin = $_POST["estadoAdmin"];

		$cambiarEstado ->cambioEstado();

	}


	/*============================================
	=            EDITAR ADMINISTRADOR           =
	============================================*/

if(isset($_POST["idAdmin"])) {

	$editarAdministrador = new AdministradorAjax();

	$editarAdministrador -> idAdmin =$_POST["idAdmin"];

	$editarAdministrador -> traerAdministradorAjax();
	
}