  <?php
require_once "conexion.php";

Class BannerModel{

  /*=============================================>>>>>
                TRAER BANNER
  ===============================================>>>>>*/
  static public function mdlBanner($tabla){

    $stmt=conexion::conectar()->prepare("SELECT * FROM $tabla");

    $stmt->execute();

    return $stmt->fetchAll();

    $stmt->close();

    $stmt="";

  }
  // fin traer banner 





}
