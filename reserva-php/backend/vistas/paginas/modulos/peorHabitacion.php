<?php 
	$peorHabitacion=ControladorInicio::ctrPeorHabitacion();

	$traerFoto=ControladorInicio::ctrTraerFotoHabitacion($peorHabitacion["peor"]);

	$traerFoto1=json_decode($traerFoto["galeria"],true);

 ?>


<div class="card card-danger card-outline">

	<div class="card-header">
		<h5 class="m-0">Habitación menos reservada</h5>
	</div>

	<div class="card-body">

		<img src="<?php echo $traerFoto1[0]; ?>" class="img-thumbnail">

		<h6 class="card-title py-3"><?php echo $peorHabitacion["peor"]; ?></h6>

		<a href="reservas" class="btn btn-danger">Ver reservas</a>

	</div>

</div>