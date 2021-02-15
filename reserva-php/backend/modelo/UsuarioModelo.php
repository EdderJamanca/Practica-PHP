<?php 

	require_once "Conexion.php";

	Class UsuarioModelo {

			static public function mdlMostrarUsuarios($tabla, $item, $valor){

			if($item != null && $valor != null){

				$stmt = Conexion::conectar()->prepare("SELECT  * FROM $tabla WHERE $item = :$item");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetch();

			}else{

				$stmt = Conexion::conectar()->prepare("SELECT  * FROM $tabla ORDER BY id_usuario DESC");

				$stmt -> execute();

				return $stmt -> fetchAll();

			}

			$stmt -> close();

			$stmt = null;

		}

	}