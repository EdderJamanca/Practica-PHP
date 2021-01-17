<?php

class ControladorFormulario {
  /*=============================================>>>>>
          REGISTRO
  ===============================================>>>>>*/

  static public function ctrRegistro(){

    if(isset($_POST["registroNombre"])){

      if(preg_match('/^[a-zA-ZÑñáéíóúÁÉÍÓÚ ]+$/',$_POST["registroNombre"]) &&
         preg_match('/^[0-9a-zA-Z]+$/',$_POST["registroPassword"]) &&
         preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["registroEmail"])){

            $tabla = "registros";

            $token=md5($_POST["registroNombre"]."+".$_POST["registroEmail"]);

            $encriptarPassword=crypt($_POST["registroPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            $datos = array("token" => $token,
            "nombre" => $_POST["registroNombre"],
            "email"=>$_POST["registroEmail"],
            "password"=>$encriptarPassword);

            $respuesta = ModeloFormulario::mdlRegistro($tabla,$datos);

            return $respuesta;

      }else {
            $respuesta="error";
            return $respuesta;
      }


    }

  }

  /*=============================================>>>>>
          TRAER DATOS
  ===============================================>>>>>*/

  static public function ctrLeerRegistro($item, $valor){

    $tabla="registros";

    $respuestas = ModeloFormulario::mdlLeerRegistro($tabla,$item, $valor);

    return $respuestas;

  }

  /*=============================================>>>>>
                    LOGIN
  ===============================================>>>>>*/

  public function ctrLogin(){

    if(isset($_POST["ingresoEmail"])){

        $tabla = "registros";
        $item = "email";
       $valor = $_POST["ingresoEmail"];

      $respuesta = ModeloFormulario::mdlLeerRegistro($tabla, $item, $valor);

      $encriptarPassword=crypt($_POST["ingresoPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

      if($respuesta["email"] == $_POST["ingresoEmail"] && $respuesta["password"] == $encriptarPassword){

        ModeloFormulario::mdlActualizarIntento($tabla,0,$respuesta["token"]);

        $_SESSION["ingresoEmail"]="ok";

        echo '<script>
        if(window.history.replaceSttate){
          window.history.replaceStore(null,null,window.location.href);
        }
          window.location="index.php?pagina=inicio";
        </script>';

      }else {

          if($respuesta["intento_fallidos"] < 3){
            $tabla = "registros";
            $intentos_fallidos = $respuesta["intento_fallidos"]+1;
            ModeloFormulario::mdlActualizarIntento($tabla,$intentos_fallidos,$respuesta["token"]);
          }else {
            echo '<div class="alert alert-warning">RECAPTCHA Debes validar que no eres un robot</div>';
          }

          echo '<script>
              if(window.history.replaceSttate){
                window.history.replaceStore(null,null,window.location.href);
              }
          </script>';
        	echo '<div class="alert alert-danger">Error al ingresar al sistema, el email o la contraseña no coinciden</div>';
      }


    }



  }
  /*=============================================
      Seleccionar Registros
=============================================*/

static public function ctrSeleccionarRegistros($item,$valor){

  $tabla="registros";

  $respuesta=ModeloFormulario::mdlLeerRegistro($tabla,$item,$valor);

  return $respuesta;
}
/*=============================================
Actualizar Registro
=============================================*/

static public function ctrActualizarRegistro(){

  if(isset($_POST["actualizarNombre"])){

            $usuario = ModeloFormulario::mdlLeerRegistro("registros","token",$_POST["tokenUsuario"]);

            $compararToken = md5($usuario["nombre"]."+".$usuario["email"]);

            if($compararToken == $_POST["tokenUsuario"] && $usuario["id"]==$_POST["idUsuario"]){

                  if($_POST["actualizarPassword"] != ""){


                         $password = crypt($_POST["actualizarPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');;


                     }else{

                       $password = $_POST["passwordActual"];
                     }

                     $tabla = "registros";

                     $compararToken = md5( $_POST["actualizarNombre"]."+".$_POST["actualizarEmail"]);

                     $datos = array("id" => $_POST["idUsuario"],
                                "token" => $compararToken,
                                 "nombre" => $_POST["actualizarNombre"],
                                  "email" => $_POST["actualizarEmail"],
                                  "password" => $password);

                     $respuesta = ModeloFormulario::mdlActualizarRegistro($tabla, $datos);

                     return $respuesta;

            }else {
              $respuesta="error";

              return $respuesta;
            }


    //FIN ISSET
  }
//FIN ACTUALIZAR
}
/*=============================================
Eliminar Registro
=============================================*/

public function ctrEliminarRegistro(){



      if(isset($_POST["eliminarRegistro"])){

       $usuario = ModeloFormulario::mdlLeerRegistro("registros","token",$_POST["eliminarRegistro"]);

       $compararToken = md5($usuario["nombre"]."+".$usuario["email"]);

           if($compararToken == $_POST["eliminarRegistro"]){

             $tabla="registros";
             $valor=$_POST["eliminarRegistro"];

             $respuesta =ModeloFormulario::mdlEliminarRegistro($tabla,$valor);

             if($respuesta=="ok"){
               echo '<script>
                 if(window.history.replaceState){
                   window.history.replaceState(null,null,window.location.href);
                 }
                 window.location = "index.php?pagina=inicio";
               </script>';
             }

           }

      }

//FIN ELIMINAR
}











//fin clase
}
