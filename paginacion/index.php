<?php

try {
   $conexion=new PDO('mysql:host=localhost;dbname=paginacion','root','');

   $pagina=isset($_GET['pagina'])? (int)$_GET['pagina'] : 1;
   $postpagina=8;
   $inicio = ($pagina > 1) ? ($pagina*$postpagina - $postpagina) : 0;
   $articulo = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM paginacion LIMIT $inicio, $postpagina");

   $articulo->execute();
   $articulo=$articulo->fetchAll();

   if(!$articulo){
     header('Location:index.php');
   }
   $totalarticulo=$conexion->query('SELECT FOUND_ROWS() as total');
   $totalarticulo=$totalarticulo->fetch()['total'];

$numeroPagina=ceil($totalarticulo/$postpagina);

}catch(PDOException $e){
  echo "ERROR:".$e->getMessage();
}


require 'view/index01.php';
 ?>
