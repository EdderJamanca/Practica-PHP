<?php 

require_once "../controlador/HabitacionControlador.php";
require_once "../modelo/HabitacionModelo.php";

class HabitacionAjax{

	/*==========================================
	=            GUARDAR HABITACION            =
	==========================================*/
	public $tipo;
	public $idCategoria;
	public $estilo;
	public $galeria;
	public $video;
	public $recorrido_virtual;
	public $descripcion;

	public $idHabitacion;
	public $recorridoAntigua;
	public $galeriaAntigua;
	
	public function guardarHabitacion(){

		$datos= array("tipo_c"=>$this->tipo,"tipo"=>$this->idCategoria,"estilo"=>$this->estilo,"galeria"=>$this->galeria,"video"=>$this->video,"recorrido_virtual"=>$this->recorrido_virtual,"descripcion_h"=>$this->descripcion);

		$respuesta= HabitacionControlador::ctrNuevaHabitacion($datos);

		echo trim($respuesta);


	}
	/*=============================================
	Editar habitación
	=============================================*/

	public function editarHabitacion(){

		$datos= array("tipo_c"=>$this->tipo,
			"tipo"=>$this->idCategoria, 
			"estilo"=>$this->estilo,
			 "galeria"=>$this->galeria,
			 "video"=>$this->video,
			 "recorrido_virtual"=>$this->recorrido_virtual,
			 "descripcion_h"=>$this->descripcion,
			 "id_h"=>$this->idHabitacion,
			 "recorridoAntigua"=>$this->recorridoAntigua,
			 "galeriaAntigua"=>$this->galeriaAntigua);

		$respuesta= HabitacionControlador::ctrEditarHabitacion($datos);

		echo trim($respuesta);

	}
	/*=============================================
	Editar habitación
	=============================================*/
	public $idEliminar;
	public $galeriaHabitacion;
	public $recorridoHabitacion;

	public function ajaxEliminarHabitacion(){
	
		$datos = array( "idEliminar" => $this->idEliminar,
						"galeriaHabitacion" => $this->galeriaHabitacion,
						"recorridoHabitacion" => $this->recorridoHabitacion);

		$respuesta = HabitacionControlador::ctrEliminarHabitacion($datos);

		echo $respuesta;

	}
	

}

if (isset($_POST["tipo_c"])){

	$guardarHabitacion= new HabitacionAjax();
	 $guardarHabitacion -> tipo =trim($_POST["tipo_c"]);
	 $guardarHabitacion -> idCategoria =trim($_POST["idCategoria"]);
	 $guardarHabitacion -> estilo =trim($_POST["estilo"]);
	 $guardarHabitacion -> galeria =trim($_POST["galeria"]);
	 $guardarHabitacion -> video =trim($_POST["video"]);
	 $guardarHabitacion -> recorrido_virtual =trim($_POST["recorrido_virtual"]);
	 $guardarHabitacion -> descripcion =trim($_POST["descripcion"]);
	 $guardarHabitacion -> galeriaAntigua =trim($_POST["galeriaAntigua"]);
	 $guardarHabitacion -> recorridoAntigua =trim($_POST["antiguoRecorrido"]);

	 if($_POST["idHabitacion"] !=""){

	 	 $guardarHabitacion -> idHabitacion =trim($_POST["idHabitacion"]);
	 	 $guardarHabitacion -> editarHabitacion();

	 }else {
	 	 $guardarHabitacion ->guardarHabitacion();
	 }
	
	
}
// eliminar habitacion objeto 
if (isset($_POST["idEliminar"])) {
	$eliminarH = new HabitacionAjax();
	$eliminarH -> idEliminar =$_POST["idEliminar"];
	$eliminarH -> galeriaHabitacion =$_POST["galeriaHabitacion"];
	$eliminarH -> recorridoHabitacion =$_POST["recorridoHabitacion"];
	$eliminarH -> ajaxEliminarHabitacion();
}