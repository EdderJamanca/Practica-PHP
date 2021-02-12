<?php 

require_once "Conexion.php";

Class AdministradorModelo{

	/*=============================================
	=            Mostrar Administrador            =
	=============================================*/
	
	static public function mdlMostrarUsuario($tabla,$item,$valor){

		if($item !=null && $valor !=null){

			$stmt =conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =:$item");

			$stmt ->bindParam(":".$item,$valor,PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt->fetch();

		}else {

			$stmt =conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt->fetchAll();

		}

		$stmt-> close();

		$stmt= null;

	}
	
	
	/*=============================================
	=            Registrar Administrador          =
	=============================================*/

	static public function mdlRegistrarAdministrador($tabla,$datos){

		$stmt =conexion::conectar()->prepare("INSERT INTO $tabla(nombre,perfil,usuario,password,estado) VALUES(:nombre,:perfil,:usuario,:password,:estado)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

		
		if($stmt->execute()){

			return "ok";

		}else {

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	=            Editar Administrador          =
	=============================================*/
	static public function 	mdlEditarAdministrador($tabla, $datos){

		$stmt =conexion::conectar()->prepare("UPDATE $tabla SET nombre=:nombre,perfil=:perfil, usuario=:usuario, password=:password WHERE id_admin=:id_admin");

		$stmt->bindParam(":id_admin", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else {

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;




	}
	/*=============================================
	=            Editar Administrador          =
	=============================================*/

	static public function mdlActualizarEstado($tabla,$item1,$valor1,$item2,$valor2){

		$stmt =conexion::conectar()->prepare("UPDATE $tabla SET $item2=:$item2 WHERE $item1=:$item1");

		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		}else {
			echo "\nPDO::errorInfo:\n";
			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt-> close();

		$stmt= null;

	}
	/*=============================================
	=            Eliminar Administrador          =
	=============================================*/
	static public function mdlEliminarAdministrador($tabla,$item,$valor){

		$stmt =conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item=:$item");

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else {

			echo "\nPDO::errorInfo:\n";
			print_r(Conexion::conectar()->errorInfo());
			
		}

		$stmt-> close();

		$stmt= null;

	}


}