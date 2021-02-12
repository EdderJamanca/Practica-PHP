<?php 

    session_start();

    $servidor=rutaControlador::ctrServidor();
    $ruta=rutaControlador::ctrRuta();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <title>Puerto Belo</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <link rel="icon" href="vistas/img/icono.jpg">


<!-- =============================================>>>>>
                            PLUGINS CSS
    ===============================================>>>>>-->

        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	 <!-- Hoja de estilo personalizada -->
    <link rel="stylesheet" href="vistas/css/style.css">
    <link rel="stylesheet" href="vistas/css/reservas.css">
    <link rel="stylesheet" href="vistas/css/perfil.css">
    <link rel="stylesheet" href="vistas/css/habitaciones.css">
    	<!-- Pano -->
    <link rel="stylesheet" href="vistas/css/plugins/jquery.pano.css">
    	<!-- jdSlider -->
    <link rel="stylesheet" href="vistas/css/plugins/jquery.jdSlider.css">
     <!-- fullCalendar -->
    <link rel="stylesheet" href="vistas/css/plugins/fullcalendar.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="vistas/css/plugins/bootstrap-datepicker.standalone.min.css">


    <!-- =============================================>>>>>
                                PLUGINS JS
        ===============================================>>>>>-->
     <!--  fontawesome -->
     <script src="https://kit.fontawesome.com/57549a60e0.js" crossorigin="anonymous"></script>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- fullCalendar -->
  	<!-- https://momentjs.com/ -->
    <script src="vistas/js/plugins/moment.js"></script>
    <!-- Pano -->
    <!-- https://www.jqueryscript.net/other/360-Degree-Panoramic-Image-Viewer-with-jQuery-Pano.html -->
    <script src="vistas/js/plugins/jquery.pano.js"></script>
    <!-- jdSlider -->
    <!-- https://www.jqueryscript.net/slider/Carousel-Slideshow-jdSlider.html -->
    <script src="vistas/js/plugins/jquery.jdSlider-latest.js"></script>
    	<!-- https://easings.net/es# -->
    <script src="vistas/js/plugins/jquery.easing.js"></script>
    <!-- https://markgoodyear.com/labs/scrollup/ -->
    <script src="vistas/js/plugins/scrollUP.js"></script>
	   <!-- https://fullcalendar.io/docs/background-events-demo -->
    <script src="vistas/js/plugins/fullcalendar.min.js"></script>
    <!-- bootstrap datepicker -->
    <!-- https://bootstrap-datepicker.readthedocs.io/en/latest/ -->
    <script src="vistas/js/plugins/bootstrap-datepicker.min.js"></script>

    <!-- JQUERY NUMBER -->  
    <!-- https://plugins.jquery.com/df-number-format/ -->
     <script src="vistas/js/plugins/jquery.number.min.js"></script>

      <!-- SWEET ALERT 2 -->  
    <!-- https://sweetalert2.github.io/ -->
   <script src="vistas/js/plugins/sweetalert2.js"></script>
  


  </head>

  <body>

    <!-- =============================================>>>>>
                              CABECERA
        ===============================================>>>>>-->
    <?php
        include "paginas/modulo/header.php";
        include "paginas/modulo/modal.php";
    ?>
    <!-- =============================================>>>>>
                              CONTENIDO
        ===============================================>>>>>-->
    <?php
        if (isset($_GET["pagina"])) {

         $categoria =CategoriaControlador::ctlCategoria();

         $validarRuta="";

         foreach ($categoria as $key => $value) {

            if($_GET["pagina"]==$value["ruta"]){

                 $validarRuta="habitacion";


            }

             
         }
          /*=============================================
          =             VALIDAR CORREO           =
          =============================================*/
          
          $item="email_encriptado";
        
          $valor=$_GET["pagina"];
          
          $validarCorreo=UsuarioControlador::ctrMostrarUsuario($item,$valor);

         if(isset($validarCorreo)){

               if($validarCorreo["email_encriptado"] == $_GET["pagina"]){

                  $id=$validarCorreo["id_usuario"];
                  $item="verificacion_use";
                  $valor=1;

                  $verificarUsuario= UsuarioControlador::ctrActualizarUsuario($id,$item,$valor);

                  if($verificarUsuario=="ok"){

                    echo '<script>

                      swal({
                              type:"success",
                              title:"¡CORRECTO!",
                              text: "!Su Cuente ha sido verificada, ya puede ingresar al sistema!'.$id.'/'.$item.''.$valor.'",
                              showConfirmButton:true,
                              confirmButtonText: "Center"
                        }).then(function(result){

                            if(result.value){
                              history.back();
                            }

                        });

                    </script>';

                    return;

                  }

               }

         }
         

          if($_GET["pagina"]=="reserva" || $_GET["pagina"]=="perfil" || $_GET["pagina"]=="salir"){

            include "paginas/".$_GET["pagina"].".php";

          }else if($validarRuta != ""){

                include "paginas/habitacion.php";

          }else {

           echo '<script>
                window.location="'.$ruta.'";
           </script>';

          }
            


        }else {

            include "paginas/inicio.php";

        }


    ?>
    <!-- =============================================>>>>>
                              FOOTER
        ===============================================>>>>>-->
    <?php
        include "paginas/modulo/footer.php";


    ?>
    <input type="hidden" id="rutaFromEnd" value="<?php echo $ruta; ?>">
    <input type="hidden" id="rutaServidor" value="<?php echo $servidor; ?>">

   
    <script src="vistas/js/menu.js"></script>
    <script src="vistas/js/idiomas.js"></script>
    <script src="vistas/js/habitaciones.js"></script>
    <script src="vistas/js/plantilla.js"></script>
    <script src="vistas/js/usuario.js"></script>
    <script src="vistas/js/reservas.js"></script>

    <script>

        window.fbAsyncInit = function() {
          FB.init({
            appId      : '244192233781733',
            xfbml      : true,
            version    : 'v9.0'
          });
          FB.AppEvents.logPageView();
        };

        (function(d, s, id){

           var js, fjs = d.getElementsByTagName(s)[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement(s); js.id = id;
           js.src = "https://connect.facebook.net/en_US/sdk.js";
           fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));
        
    </script>

  </body>

</html>
