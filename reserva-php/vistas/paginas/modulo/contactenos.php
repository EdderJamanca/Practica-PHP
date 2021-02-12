<!--=====================================
CONTÁCTENOS
======================================-->

<div class="contactenos container-fluid bg-white py-4" id="contactenos">

	<div class="container text-center">

		<h1 class="py-sm-4">CONTÁCTENOS</h1>

		<form method="post">

			<div class="input-group input-group-lg">

				<input type="text" class="form-control mb-3 mr-2 form-control-lg" placeholder="Nombre" name="nombreContacto">

				<input type="text" class="form-control mb-3 ml-2 form-control-lg" placeholder="Apellido" name="apellidoContacto">

			</div>

			<div class="input-group input-group-lg">

				<input type="text" class="form-control mb-3 mr-2 form-control-lg" placeholder="Móvil" name="movilContacto">

				<input type="text" class="form-control mb-3 ml-2 form-control-lg" placeholder="Correo Electrónico" name="correoContacto">

			</div>

			<textarea class="form-control" rows="6" placeholder="Escribe aquí tu mensaje" name="mensajeContacto"></textarea>

			<input type="submit" class="btn btn-dark my-4 btn-lg py-3 text-uppercase" value="Enviar">

			<?php 
				$contactar= new UsuarioControlador();
				$contactar -> ctrFormularioContacto();

			 ?>

		</form>

	</div>

</div>
