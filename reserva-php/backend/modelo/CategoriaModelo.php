<?php 

require_once "Conexion.php";

Class CategoriaModelo {


	/*===================================================
	=            CONSULTA DE CATEGORIA Y HAB            =
	===================================================*/
	
	static public function mdlTraerCategoria($tabla,$item,$valor){


		if($item !="" && $valor !=""){

			$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");

			$stmt->bindparam(":".$item,$valor,PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		}else{

			$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();

		$stmt=null;

	}

	/*===================================================
	=            GUARDAR DE CATEGORIA            =
	===================================================*/
	static public function mdlRegistrarCategoria($tabla,$datos){

		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla(ruta,color,tipo_c,img,descripcion,incluye, continental_alta,continental_baja,americano_alta,americano_baja) VALUES (:ruta,:color,:tipo_c,:img,:descripcion,:incluye,:continental_alta,:continental_baja,:americano_alta,:americano_baja)");



		$stmt->bindParam(":ruta",$datos["ruta"],PDO::PARAM_STR);
		$stmt->bindParam(":color",$datos["color"],PDO::PARAM_STR);
		$stmt->bindParam(":tipo_c",$datos["tipo"],PDO::PARAM_STR);
		$stmt->bindParam(":img",$datos["img"],PDO::PARAM_STR);
		$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);
		$stmt->bindParam(":incluye",$datos["incluye"],PDO::PARAM_STR);
		$stmt->bindParam(":continental_alta",$datos["continental_alta"],PDO::PARAM_INT);
		$stmt->bindParam(":continental_baja",$datos["continental_baja"],PDO::PARAM_INT);
		$stmt->bindParam(":americano_alta",$datos["americano_alta"],PDO::PARAM_INT);
		$stmt->bindParam(":americano_baja",$datos["americano_baja"],PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else {

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt=null;

	}

	/*===================================================
	=            ACTUALIZACION DE CATEGORIA            =
	===================================================*/

	static public function mdlActualizarCategoria($tabla,$datos){

		$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET ruta=:ruta, color=:color, tipo_c=:tipo_c,img=:img, descripcion=:descripcion, incluye=:incluye, continental_alta=:continental_alta, continental_baja=:continental_baja, americano_alta=:americano_alta,americano_baja=:americano_baja WHERE id=:id");

		$stmt->bindParam(":id",$datos["id"],PDO::PARAM_STR);
		$stmt->bindParam(":ruta",$datos["ruta"],PDO::PARAM_STR);
		$stmt->bindParam(":color",$datos["color"],PDO::PARAM_STR);
		$stmt->bindParam(":tipo_c",$datos["tipo"],PDO::PARAM_STR);
		$stmt->bindParam(":img",$datos["img"],PDO::PARAM_STR);
		$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);
		$stmt->bindParam(":incluye",$datos["incluye"],PDO::PARAM_STR);
		$stmt->bindParam(":continental_alta",$datos["continental_alta"],PDO::PARAM_INT);
		$stmt->bindParam(":continental_baja",$datos["continental_baja"],PDO::PARAM_INT);
		$stmt->bindParam(":americano_alta",$datos["americano_alta"],PDO::PARAM_INT);
		$stmt->bindParam(":americano_baja",$datos["americano_baja"],PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else {

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt=null;

	}

	/*===================================================
	=            VALIDAR DE CATEGORIA            =
	===================================================*/
	static public function mdlValidarCategoria($tabla,$item,$valor){

		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}
	
	/*===================================================
	=            ElIMINAR DE CATEGORIA            =
	===================================================*/
	static public function mdlEliminarCategoria($tabla,$id){

		$stmt=Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id =:id");

		$stmt->bindParam(":id",$id,PDO::PARAM_STR);

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