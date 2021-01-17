<?php

require_once "../controladores/formulario.controlador.php";
require_once "../modelos/formularios.modelo.php";

/*=============================================>>>>>
            CLASE DE AJAX
===============================================>>>>>*/

class AjaxFormulario {

    public $validarEmail;

    public function ajaxValidarEmail(){

        $item="email";
        $valor=$this->validarEmail;
        $respuesta = ControladorFormulario::ctrLeerRegistro($item,$valor);

        echo json_encode($respuesta);
    }

    /*=============================================>>>>>
          VALIDAR TOKEN EXITENTE
    ===============================================>>>>>*/
    public $validarToken;

    public function ajaxValidarToken(){
      $item="token";
      $valor=$this->validarToken;
      $respuesta = ControladorFormulario::ctrLeerRegistro($item,$valor);

      echo json_encode($respuesta);

    }

}

/*=============================================>>>>>
      OBJETO DE AJAX QUE RECIBE LA VERSION POST
===============================================>>>>>*/

if(isset($_POST["validarEmail"])){

  $valEmail = new   AjaxFormulario();
  $valEmail->validarEmail=$_POST["validarEmail"];
  $valEmail->ajaxValidarEmail();

}
if(isset($_POST["validarToken"])){

  $valtoken = new   AjaxFormulario();
  $valtoken->validarToken=$_POST["validarToken"];
  $valtoken->ajaxValidarToken();

}
