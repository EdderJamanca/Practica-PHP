<?php 

require_once "Conexion.php";


Class InicioModelo{

	/*====================================
	=            sumar ventas            =
	====================================*/
	
	static public function mdlSumarVentas($tabla){

		$stmt=Conexion::conectar()->prepare("SELECT sum(pago_reserva) as total FROM $tabla");

		$stmt ->execute();

		return $stmt -> fetch();

		$stmt ->close();

		$stmt= null;

	}
	
	/*====================================
	=            Mejor Habitacion          =
	====================================*/
	static public function mdlMejorHabitacion($tabla){

		$stmt=Conexion::conectar()->prepare("SELECT MAX(descripcion_reserva) as mejor FROM $tabla");

		$stmt ->execute();

		return $stmt -> fetch();

		$stmt ->close();

		$stmt= null;
	}

	/*====================================
	=            Peor Habitacion          =
	====================================*/
	static public function mdlPeorHabitacion($tabla){

		$stmt=Conexion::conectar()->prepare("SELECT MIN(descripcion_reserva) as peor FROM $tabla");

		$stmt ->execute();

		return $stmt -> fetch();

		$stmt ->close();

		$stmt= null;
	}
	/*=============================================
	Traer Foto Habitación
	=============================================*/

	static public function mdlTraerFotoHabitacion($tabla1,$tabla2,$valor){

		$stmt=Conexion::conectar()->prepare("SELECT $tabla1.*,$tabla2.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_h=$tabla2.id_habitacion WHERE descripcion_reserva=:descripcion_reserva");

		$stmt->bindParam(":descripcion_reserva",$valor,PDO::PARAM_STR);

		$stmt ->execute();

		return $stmt -> fetch();

		$stmt ->close();

		$stmt= null;

	}


}















