<?php 

require_once "Conexion.php";

Class ReservaModelo{

	/*============================================
	=            MOSTRAR LAS RESERVAS            =
	============================================*/
	
	static public function mdlMostrarReserva($tabla1,$tabla2,$item,$valor){

		if($item !=null && $valor != null){

			$stmt=Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_usuario=$tabla2.id_usu WHERE $item=:$item");

			$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchALL();

		}else {

			$stmt=Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_usuario=$tabla2.id_usu ORDER BY id_reserva DESC");

			$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();

		$stmt=null;


	}
	/*=============================================
	Cambiar reserva
	=============================================*/

	static public function mdlCambiarReserva($tabla,$datos){

	  $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_ingreso = :fecha_ingreso, fecha_salida = :fecha_salida WHERE id_reserva = :id_reserva");

		$stmt->bindParam(":fecha_ingreso", $datos["fechaIngreso"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_salida", $datos["fechaSalida"], PDO::PARAM_STR);
		$stmt->bindParam(":id_reserva", $datos["idReserva"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();

		$stmt = null;

	}

}