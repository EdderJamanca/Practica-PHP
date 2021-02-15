<?php 

require_once "Conexion.php";

Class RecorridoModelo {

	/*========================================
	=            Treaer Recorrido            =
	========================================*/
	static public function mdlTraerRecorrido($tabla,$item,$valor)	{

		if($item !=null && $valor != null){

			$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");

			$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();


		}else {


			$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_recorrido DESC");


			$stmt->execute();

			return $stmt->fetchAll();

		}
		$stmt->close();

		$stmt=null;
	}
	/*========================================
	=            NUEVO Recorrido            =
	========================================*/

	static public function mdlNuevoRecorrido($tabla,$datos){

		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla(foto_peq,foto_gran,titulo,descripcion) VALUES (:foto_peq,:foto_gran,:titulo,:descripcion)");

		$stmt->bindParam(":foto_peq",$datos["foto_peq"],PDO::PARAM_STR);
		$stmt->bindParam(":foto_gran",$datos["foto_gran"],PDO::PARAM_STR);
		$stmt->bindParam(":titulo",$datos["titulo"],PDO::PARAM_STR);
		$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt= null;
	}
	/*========================================
	=            actualizar Recorrido            =
	========================================*/

	static public function mdlActualizarRecorrido($tabla,$datos){

		$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET foto_peq=:foto_peq,foto_gran=:foto_gran,titulo=:titulo,descripcion=:descripcion WHERE id_recorrido=:id_recorrido");

		$stmt->bindParam(":id_recorrido",$datos["id_recorrido"],PDO::PARAM_STR);
		$stmt->bindParam(":foto_peq",$datos["foto_peq"],PDO::PARAM_STR);
		$stmt->bindParam(":foto_gran",$datos["foto_gran"],PDO::PARAM_STR);
		$stmt->bindParam(":titulo",$datos["titulo"],PDO::PARAM_STR);
		$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt= null;
	}
	/*========================================
	=            Eliminar Recorrido            =
	========================================*/
	static public function mdlEliminarRecorrido($tabla,$id){

		$stmt=Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_recorrido=:id_recorrido");

		$stmt->bindParam(":id_recorrido",$id,PDO::PARAM_INT);

		if($stmt->execute()){
			return "ok";
		}else {

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());

		}
		$stmt->close();
		$stmt= null;

	}
	
}