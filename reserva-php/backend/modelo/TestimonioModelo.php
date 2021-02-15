<?php 

require_once "Conexion.php";

Class TestimonioModelo{

	/*========================================
				MOSTRAR TESTIMONIO
	========================================*/
	static public function mdlMostrarTestimonio($tabla,$item,$valor){

		if($item !=null && $valor !=null){

			$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");

			$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

			$stmt->execute();

			 return $stmt -> fetchAll();

		}else {

			$stmt=Conexion::conectar()->prepare("SELECT $tabla.* FROM $tabla ORDER BY id_testimonio DESC");

			$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

			$stmt->execute();

			 return $stmt -> fetchAll();

		}



			 $stmt->close();

			 $stmt=null;


	}

	/*========================================
	=TRAER TESTIMONIO-RESERVA-USUARIO
	========================================*/
	static public function mdlTraerTestimonioInner($tabla1,$tabla2,$tabla3,$item,$valor){

		$stmt=Conexion::conectar()->prepare("SELECT $tabla1.*,$tabla2.*,$tabla3.* FROM  $tabla1 INNER JOIN $tabla2 ON $tabla1.id_reser=$tabla2.id_reserva INNER JOIN $tabla3 ON $tabla1.id_usua=$tabla3.id_usuario WHERE $item=:$item");

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt->fetch();

		$stmt ->close();

		$stmt=null;

	}
	/*========================================
		ACTIVAR O DESACTIVAR 
	========================================*/
	static public function mdlAprobarTestimonio($tabla,$item1,$valor1,$item2,$valor2){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item2 = :$item2 WHERE $item1 = :$item1");

		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_INT);
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());

		}

		$stmt -> close();

		$stmt = null;
	}

	
}