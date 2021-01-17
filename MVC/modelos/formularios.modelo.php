<?php

require_once "conexion.php";

class ModeloFormulario {

  /*=============================================>>>>>
                REGISTRO
  ===============================================>>>>>*/

  static public function mdlRegistro($tabla,$datos){

    $stmt =Conexion::conectar()->prepare("INSERT INTO $tabla(token,nombre, email, password)
     VALUES (:token,:nombre, :email, :password)");

    $stmt -> bindParam(":token", $datos["token"], PDO::PARAM_STR);
    $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
    $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);

    if($stmt->execute()){
        return "ok";
    }else {
      print_r(Conexion::conectar()->errorInfo());
    }
    $stmt -> close();

    $stmt -> null;

  }
  /*=============================================>>>>>
                R -> LEER DATOS
  ===============================================>>>>>*/

  static public function mdlLeerRegistro($tabla,$item,$valor){

    if($item==null && $valor==null){

      $stmt= Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha, '%d/%m/%y') AS fecha
      FROM $tabla ORDER BY id DESC");

      $stmt -> execute();

      return $stmt->fetchAll();

    }else {

      $stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM $tabla
    			WHERE $item = :$item ORDER BY id DESC");

    			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

    			$stmt->execute();

    			return $stmt -> fetch();

    }



        $stmt -> close();

        $stmt -> null;

  }
  /*=============================================>>>>>
                R -> LEER DATOS
  ===============================================>>>>>*/

  static public function mdlActualizarRegistro($tabla,$datos){

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET token = :token, nombre=:nombre, email=:email, password=:password
       WHERE id = :id");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":token", $datos["token"], PDO::PARAM_STR);
    $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;

  }
  static public function mdlEliminarRegistro($tabla,$valor){

    $stmt= Conexion::conectar()->prepare("DELETE FROM $tabla WHERE token=:token");

    $stmt->bindParam(":token",$valor,PDO::PARAM_STR);

    if($stmt->execute()){
      return "ok";
    }else {
      print_r(Conexion::conectar()->errorInfo());
    }

    $stmt->close();

    $stmt = null;

  }

  /*=============================================>>>>>
                 INTENTOS FALLIDOS
  ===============================================>>>>>*/
  static public function mdlActualizarIntento($tabla,$valor,$token){

    $stmt= Conexion::conectar()->prepare("UPDATE $tabla SET intento_fallidos=:intento_fallidos WHERE token = :token");

    $stmt->bindParam(":intento_fallidos",$valor,PDO::PARAM_INT);
    $stmt->bindParam(":token",$token,PDO::PARAM_STR);

    if($stmt->execute()){
      return "ok";
    }else {
      print_r(Conexion::conectar()->errorInfo());
    }

    $stmt->close();

    $stmt = null;

  //fin clases
  }
//fin clases
}
