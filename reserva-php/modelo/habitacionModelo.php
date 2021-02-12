<?php 

require_once "conexion.php";

Class HabitacionModelo {

	static public function mdlHabitacion($tabla1,$tabla2,$valor){


		$stmt=Conexion::conectar()->prepare("SELECT $tabla1.*,$tabla2.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.tipo =$tabla2.id WHERE ruta=:ruta");

		$stmt->bindParam(":ruta",$valor,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->Close();

		$stmt=null;

	}
	/*=============================================
	Mostrar Habitación Singular
	=============================================*/

	static public function mdlMostrarHabitacionSingular($tabla1, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla1 WHERE id_h=:id_h");

		$stmt->bindParam(":id_h",$valor,PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt=null;
	}

}