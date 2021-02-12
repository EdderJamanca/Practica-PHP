<?php 

Class PlanControlador {

	static public function ctlPlan(){

		$tabla="planes";

		$respuesta=PlanesControlador::mdlPlan($tabla);

		return $respuesta;



	}

}