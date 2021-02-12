<?php 


require_once "conexion.php";

Class RecorridoModelo{

	static public function mdlRecorrido($tabla){

		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->Close();

		$stmt="";

	}

}