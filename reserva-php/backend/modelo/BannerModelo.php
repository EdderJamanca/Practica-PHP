<?php  


require_once "Conexion.php";

Class BannerModelo {

	/*=============================================
	=            Mostrar Baner           =
	=============================================*/

	static public function mdlMostrarBanner($tabla,$item,$valor){

		if($item !="" && $valor !=""){

			$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");

		    $stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		    $stmt->execute();

		    return $stmt->fetch();

		}else {

			$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla");

		    $stmt->execute();

		    return $stmt->fetchAll();

		}

		$stmt->close();

		$stmt=null;

	}

	/*=============================================
	=            Registrar Banner           =
	=============================================*/

	static public function mdlRegistrarBanner($tabla,$ruta){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(img) VALUES (:img)");

		$stmt->bindParam(":img",$ruta,PDO::PARAM_STR);

		if($stmt ->execute()){

			return "ok";

		}else {

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt =null;

	}

	/*=========================================
	=            ACTUALIZAR BANNER            =
	=========================================*/
	static public function mdlActualizarBanner($tabla,$id,$ruta){

		$stmt =Conexion::conectar()->prepare("UPDATE $tabla SET img =:img WHERE id=:id");
		
		$stmt -> bindParam(":img",$ruta,PDO::PARAM_STR);
		$stmt -> bindParam(":id",$id,PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else  {

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());


		}
		$stmt->close();

		$stmt =null;


	}
	
	
	/*=============================================
	=            Eliminar Banner           =
	=============================================*/
	static public function mdlEliminarBanner($tabla,$item,$valor){

		$stmt=Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item=:$item");

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else {

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());

		}
	    $stmt->close();

		$stmt =null;



	}
	

}