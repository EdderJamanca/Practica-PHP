<?php 

require_once "conexion.php";

Class ReservasModelo {

		/*=============================================
			MOSTRAR HABITACIONES-RESERVAS-CATEGORIAS CON INNER JOIN
			=============================================*/

	static public function mdlReservasInnerJoin($tabla1,$tabla2, $tabla3,$valor){

		$stmt=Conexion::conectar()->prepare("SELECT $tabla1.*,$tabla2.*,$tabla3.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_h=$tabla2.id_habitacion INNER JOIN $tabla3 ON $tabla1.tipo=$tabla3.id WHERE id_h=:id_h");


		$stmt->bindParam(":id_h",$valor,PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->Close();

		$stmt=null;

	}


	/*=============================================
	Mostrar Codigo Reserva Singular
	=============================================*/
	static public function mdlMostrarCodigoReserva($tabla,$valor){

	    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE codigo_reserva = :codigo_reserva");

		$stmt -> bindParam(":codigo_reserva", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}
	/*=============================================
		REGISTRAR RESERVA
	=============================================*/

	static public function mdlGuardarReserva($tabla,$datos){

		$connection=Conexion::conectar();

		$stmt = $connection->prepare("INSERT INTO $tabla(id_habitacion,id_usuario,pago_reserva,numero_transaccion,codigo_reserva,descripcion_reserva,fecha_ingreso,fecha_salida) VALUES(:id_habitacion,:id_usuario,:pago_reserva,:numero_transaccion,:codigo_reserva,:descripcion_reserva,:fecha_ingreso,:fecha_salida)");

		$stmt ->bindParam(":id_habitacion",$datos["id_habitacion"],PDO::PARAM_INT);
		$stmt ->bindParam(":id_usuario",$datos["id_usuario"],PDO::PARAM_INT);
		$stmt ->bindParam(":pago_reserva",$datos["pago_reserva"],PDO::PARAM_INT);
		$stmt ->bindParam(":numero_transaccion",$datos["numero_transaccion"],PDO::PARAM_STR);
		$stmt ->bindParam(":codigo_reserva",$datos["codigo_reserva"],PDO::PARAM_STR);
		$stmt ->bindParam(":descripcion_reserva",$datos["descripcion_reserva"],PDO::PARAM_STR);
		$stmt ->bindParam(":fecha_ingreso",$datos["fecha_reserva"],PDO::PARAM_STR);
		$stmt ->bindParam(":fecha_salida",$datos["fecha_salida"],PDO::PARAM_STR);

		if($stmt -> execute()){

			$id=$connection->lastInsertId();

			return $id;
		}else {
			return "error";
		}

		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	Mostrar Reservas por Usuario
	=============================================*/
	static public function mdlMostrarReservaUsuario($tabla,$valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario=:id_usuario ORDER BY id_reserva DESC LIMIT 5");

		$stmt->bindParam(":id_usuario",$valor,PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt= null;

	}

	/*=============================================
		CREAR TESTIMONIO
	=============================================*/
	static public function mdlCreaTestimonio($tablaTestimonio,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tablaTestimonio(id_reser,id_usua,id_habit,testimonio,aprobado) VALUES(:id_reser,:id_usua,:id_habit,:testimonio,:aprobado)");

		$stmt->bindParam(":id_reser",$datos["id_reser"],PDO::PARAM_INT);
		$stmt->bindParam(":id_usua",$datos["id_usua"],PDO::PARAM_INT);
		$stmt->bindParam(":id_habit",$datos["id_habit"],PDO::PARAM_INT);
		$stmt->bindParam(":testimonio",$datos["testimonio"],PDO::PARAM_STR);
		$stmt->bindParam(":aprobado",$datos["aprobado"],PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";
		}else {
			return "error";
		}
		$stmt->close();

		$stmt=null;


	}
	/*=============================================
	Mostrar testimonio
	=============================================*/

	static public function mdlMostrarTestimonio($tabla1,$tabla2,$tabla3,$tabla4,$item,$valor){

		$stmt=Conexion::conectar()->prepare("SELECT $tabla1.*,$tabla2.*,$tabla3.*,$tabla4.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_habit =$tabla2.id_h INNER JOIN $tabla3 ON  $tabla3.id_reserva = $tabla1.id_reser INNER JOIN $tabla4 ON $tabla4.id_usuario = $tabla1.id_usua WHERE $item=:$item ORDER BY id_testimonio DESC");
		$stmt->bindParam(":".$item,$valor,PDO::PARAM_INT);

		$stmt-> execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt=null;

	}
	/*=============================================
	Actualizar Testimonio
	=============================================*/

	static public function mdlActualizarTestimonio($tabla,$datos){

		$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET testimonio=:testimonio WHERE id_testimonio=:id_testimonio");

		$stmt->bindParam(":testimonio",$datos["testimonio"],PDO::PARAM_STR);
		$stmt->bindParam(":id_testimonio",$datos["id_testimonio"],PDO::PARAM_INT);
			
		if($stmt-> execute()){
			return "ok";
		}else {
			echo "\nPDO::errorInfo():n";
			print_r(Conexion::conectar()->errorInfo());
		}


		$stmt->close();

		$stmt=null;


	}

}