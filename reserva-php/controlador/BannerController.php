<?php

Class BannerController {
  

  /*=============================================>>>>>
                TRAER BANNER
  ===============================================>>>>>*/

  static public function ctlBanner(){

    $tabla="banner";

    $respuesta=BannerModel::mdlBanner($tabla);

    return $respuesta;

  }

}
