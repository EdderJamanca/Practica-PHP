<?php

$error='';
$enviado='';

if(isset($_POST["enviar"])){

  $nombre=$_POST["nombre"];
  $emal=$_POST["email"];
  $mensaje=$_POST["mensaje"];


if(!empty($nombre)){
  $nombre=trim($nombre);
  $nombre=filter_var($nombre,FILTER_SANITIZE_STRING);

    if($nombre==""){
      $error.='Por favor ingresar un nombre.<br/>';
    }
  }else {
    $error.='Por favor ingrese un nombre.<br/>';
  }

  if(!empty($emal)){
    $emal=filter_var($emal,FILTER_SANITIZE_EMAIL);
    if(!filter_var($emal,FILTER_SANITIZE_EMAIL)){
      $error.="Por favor ingrese un correo valido.<br/>";
    }
  }else {
    $error.="Por favor ingrese un correo.<br/>";
  }
  if(!empty($mensaje)){
    $mensaje=htmlspecialchars($mensaje);
    $mensaje=trim($mensaje);
    $mensaje=stripslashes($mensaje);
  } else {
    $error.='Por favor ingrese el mensaje.<br/>';
  }

  if(!$error){
    $enviar_a='edder.jame05@gmail.com';
    $asunto='Correo enviado desde mi Pagina.com';
    $mensaje="De: $nombre \n";
    $mensaje.="correo: $emal \n";
    $mensaje.='Mensaje:'.$_POST['mensaje'];
    $enviado='true';
  }
}
?>
