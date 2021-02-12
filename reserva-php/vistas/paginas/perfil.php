<?php

if(isset($_SESSION["ValidarSession"])){

	 if($_SESSION["ValidarSession"]=="ok"){

	 	include "modulo/menu.php";
		include "modulo/menu-movil.php";
		include "modulo/bannerInterno.php";
		include "modulo/infoPerfil.php";
		include "modulo/contactenos.php";
		include "modulo/mapa.php";
	    echo '<div class="mb-5"></div>';

   }


}else {
	echo '<script>
		window.location="'.$ruta.'";
	</script>';
}
 


