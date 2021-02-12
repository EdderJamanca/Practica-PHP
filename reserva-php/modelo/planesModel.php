<?php 


require_once "conexion.php";

Class PlanesControlador{

	static public function mdlPlan($tabla){

			$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();

			return $stmt->fetchAll();

			$stmt->close();

			$stmt="";

	}




}