<?php 

require_once "Conexion.php";

Class PlanesModelos {

	/*====================================
	=            TRAER PLANES            =
	====================================*/

	static public function mdlTraerPlanes($tabla, $item, $valor){

		if($item != "" && $valor != ""){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");

			$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		}else {

			$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_planes DESC");

			$stmt->execute();

			return $stmt->fetchAll();

		}


		$stmt->close();

		$stmt=null;

	}
	/*====================================
	=            REGISTRAR PLAN           =
	====================================*/

	static public function mdlRegistrarPlanes($tabla,$datos){

		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla(tipo,img,descripcion,precio_alto,precio_bajo) VALUES (:tipo,:img,:descripcion,:precio_alto,:precio_bajo)");

		$stmt->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
		$stmt->bindParam(":img",$datos["img"],PDO::PARAM_STR);
		$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);
		$stmt->bindParam(":precio_alto",$datos["precioAlto"],PDO::PARAM_INT);
		$stmt->bindParam(":precio_bajo",$datos["precioBajo"],PDO::PARAM_INT);

		if($stmt->execute()){
			return "ok";
		}else {

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();
		$stmt=null;
	}

	/*====================================
	=            ACTUALIZAR PLAN           =
	====================================*/
	static public function mdlActualizarPlanes($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipo=:tipo, img=:img, descripcion=:descripcion, precio_alto=:precio_alto, precio_bajo=:precio_bajo  WHERE id_planes=:id_planes");

		$stmt -> bindParam(":id_planes",$datos["id"],PDO::PARAM_STR);
		$stmt -> bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
		$stmt -> bindParam(":img",$datos["img"],PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);
		$stmt -> bindParam(":precio_alto",$datos["precioAlto"],PDO::PARAM_INT);
		$stmt -> bindParam(":precio_bajo",$datos["precioBajo"],PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else {

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());


		}
		$stmt->close();
		$stmt=null;

	}
	/*====================================
	=            ELIMINAR PLAN           =
	====================================*/
	static public function mdlEliminarPlan($tabla,$id){

		$stmt=Conexion::conectar()->prepare("DELETE FROM $tabla WHERE 	id_planes=:id_planes");

		$stmt->bindParam(":id_planes",$id,PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else {


			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();
		$stmt=null;


	}

}