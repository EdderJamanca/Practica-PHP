<?php 

require_once "conexion.php";

Class CategoriaModelo {

	static public function mdlCategoria($tabla){

		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt="";

	}
	/*=============================================
	Mostrar Categoría Singular
	=============================================*/

	static public function mdlMostrarCategoriaSingular($tabla,$valor){

		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id=:id");

		$stmt->bindParam(":id",$valor,PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt=null;
	}

}
