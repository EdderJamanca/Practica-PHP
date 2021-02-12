<?php 

require_once "conexion.php";

Class UsuarioModelo {

	static public function mdlUsuarioModelo($tabla,$datos){

		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_use,password_use,email_use,foto_use,modo_use,verificacion_use,email_encriptado)  VALUES (:nombre_use,:password_use,:email_use,:foto_use,:modo_use,:verificacion_use,:email_encriptado)");

		$stmt->bindParam(":nombre_use",$datos["nombre"],PDO::PARAM_STR);
		$stmt->bindParam(":password_use",$datos["password"],PDO::PARAM_STR);
		$stmt->bindParam(":email_use",$datos["email"],PDO::PARAM_STR);
		$stmt->bindParam(":foto_use",$datos["foto"],PDO::PARAM_STR);
		$stmt->bindParam(":modo_use",$datos["modo"],PDO::PARAM_STR);
		$stmt->bindParam(":verificacion_use",$datos["verificacion"],PDO::PARAM_INT);
		$stmt->bindParam(":email_encriptado",$datos["email_emcriptado"],PDO::PARAM_STR);
	


		if($stmt->execute()){
			return "ok";
		}else {
			echo "\nPDO::errorInfo():n";
			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt=null;

	}
	/*=============================================
	MOSTRAR USUARIO
	=============================================*/
	static public function mdlMostrarUsuario($tabla, $item,$valor){

		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =:$item");

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->Close();

		$stmt=null;


	}
	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla,$id,$item,$valor){

		$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET $item =:$item WHERE id_usuario = :id_usuario");

		$stmt ->bindParam(":".$item,$valor, PDO::PARAM_STR);

		$stmt ->bindParam(":id_usuario",$id, PDO::PARAM_INT);

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