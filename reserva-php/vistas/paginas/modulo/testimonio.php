<?php 

	$valor=$_GET["pagina"];

	$habitacion = HabitacionControlador::ctlHabitacion($valor);
	$testimonio =ReservaControlador::ctrMostrarTestimonio("id_habit",$habitacion[0]["id_h"]);
	
 ?>

<!--=====================================
TESTIMONIOS
======================================-->
<div class="testimonios container-fluid py-5 text-white">

	<div class="container mb-3">

		<h1 class="text-center py-5">TESTIMONIOS</h1>

		<div class="row">

			<?php 
			   $cantidadTestimodio =0;
			   $idTestimonio= array();

			   foreach ($testimonio as $key => $value) {

			   		if($value["aprobado"] !=0){

			   			++$cantidadTestimodio;
			   			array_push($idTestimonio,$value["id_testimonio"]);

			   		}
			   
			   }

			  ?>

			  <?php if ($cantidadTestimodio >= 4): ?>

		  			<?php 

		  				for ($i=0; $i <count($idTestimonio); $i++) { 

			  			  	echo '<div class="col-12 col-lg-3 text-center p-4">';

			  				    if($testimonio[$i]["foto_use"]==""){

			  				    	echo '<img src="'.$servidor.'vistas/img/usuarios/default/default.png" class="img-fluid rounded-circle w-50">';
			  				    }else {

			  				    	if ($testimonio[$i]["modo_use"]=="directo") {

			  				    		echo '<img src="'.$servidor.$testimonio[$i]["foto_use"].'" class="img-fluid rounded-circle w-50">';
			  				    		
			  				    	}else {

			  				    		echo '<img src="'.$testimonio[$i]["foto_use"].'" class="img-fluid rounded-circle w-50">';

			  				    	}
			  				    }

			  				    echo '<h4 class="py-4">'.$testimonio[$i]["nombre_use"].'</h4>

					            	<p>'.$testimonio[$i]["testimonio"].'</p>

			  				    ';
			  				echo '</div>';

			  			  	
			  			  }

		  			 ?>
			  	<?php else: ?>

			  		<div class="col-12 text-white text-center">¡Esta habitación aún no tiene testimonios!</div>;
			  	
			  <?php endif ?>


		</div>

		<?php if ($cantidadTestimodio >4): ?>

			<button class="btn btn-default float-right px-4 verMasTestimopnio">VER MÁS</button>
			
		<?php endif ?>

		

	</div>

</div>
