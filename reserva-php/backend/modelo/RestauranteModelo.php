<?php 

require_once "Conexion.php";

Class RestauranteModelo{

	/*=========================================
	=            Traer restaurante            =
	=========================================*/
	static public function mdlTraerRestaurante($tabla,$item,$valor){

		if ($item != null && $valor != null) {
			
			$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");

			$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		}else {

			$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_restaurante DESC");

			$stmt->execute();

			return $stmt->fetchAll();

		}
		$stmt->close();

		$stmt=null;

	}

	/*=========================================
	=            Nuvo restaurante            =
	=========================================*/

		static public function mdlNuevoRestaurante($tabla,$datos){

			$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla(foto,descripcion) VALUES (:foto,:descripcion)");

			$stmt->bindParam(":foto",$datos["foto"],PDO::PARAM_STR);
			$stmt -> bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);

			if($stmt -> execute()){
				return "ok";
			}else {
			echo "\nPDO::errorInfo():\n";
			 print_r(Conexion::conectar()->errorInfo()); 

		   }
		  $stmt->close();

		  $stmt=null;

	   }

	/*=========================================
	=            Actualizar restaurante     =
	=========================================*/

	static public function mdlActualizarRestaurante($tabla,$datos){

		$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET foto=:foto, descripcion=:descripcion WHERE id_restaurante=:id_restaurante");

		$stmt->bindParam(":id_restaurante",$datos["id"],PDO::PARAM_INT);
		$stmt->bindParam(":foto",$datos["foto"],PDO::PARAM_STR);
		$stmt ->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else {

		echo "\nPDO::errorInfo():\n";
		 print_r(Conexion::conectar()->errorInfo()); 

	   }

	    $stmt->close();

		$stmt=null;

	}


	/*=========================================
	=            RLIMINAR PLATO            =
	=========================================*/

	static public function mdlEliminarRestaurante($tabla,$id){

		$stmt=Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_restaurante=:id_restaurante");

		$stmt -> bindParam(":id_restaurante",$id,PDO::PARAM_STR);

		if($stmt -> execute()){

				return "ok";

			}else {

			echo "\nPDO::errorInfo():\n";
			 print_r(Conexion::conectar()->errorInfo()); 

		   }
		   
		  $stmt->close();

		  $stmt=null;


	}


}