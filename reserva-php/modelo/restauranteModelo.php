<?php 


require_once "conexion.php";

Class RestauranteModelo {

	static public function mdlRestaurante($tabla){

		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt->execute();

		return $stmt;

		$stmt->Close();

		$stmt="";

	}

}