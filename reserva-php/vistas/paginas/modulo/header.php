<?php 

	$categoria=CategoriaControlador::ctlCategoria();

	if(isset($_SESSION["ValidarSession"])){

		if($_SESSION["ValidarSession"]=="ok"){
				 $item ="id_usuario";
				 $valor =$_SESSION["id"];
				 $usuario = UsuarioControlador::ctrMostrarUsuario($item,$valor);
		}
	}

 ?>

<header class="container-fluid p-0 bg-white py-2">

	<div class="container p-0">

		<div class="grid-container py-2">

			<!-- LOGO -->

			<div class="grid-item">

				<a href="<?php echo $ruta; ?>">

					<img src="vistas/img/logoPortobelo.png" class="img-fluid">

				</a>

			</div>

			<div class="grid-item d-none d-lg-block"></div>

			<!-- CAMPANA Y RESERVA -->

			<div class="grid-item d-none d-lg-block bloqueReservas">

				<div class="py-2 campana-y-reserva mostrarBloqueReservas" modo="abajo">

					<i class="fas fa-concierge-bell lead mx-2"></i>

					<i class="fas fa-caret-up lead mx-2 flechaReserva"></i>

				</div>

				<!--=====================================
				FORMULARIO DE RESERVAS
				======================================-->

				<form action="<?php echo $ruta; ?>reserva" method="POST">

				<div class="formReservas py-1 py-lg-2 px-4">

					<div class="form-group my-4">
						<select class="form-control form-control-lg selectTipoHabitacion" required>
							<option value="">Tipo de habitación</option>

							<?php foreach ($categoria as $key => $value): ?>

								<option value="<?php echo $value["ruta"]; ?>"><?php echo $value["tipo_c"]; ?></option>
								
							<?php endforeach ?>
			
						</select>
					</div>

					<div class="form-group my-4">
						<select class="form-control form-control-lg selectTemaHabitacion" name="id-habitacion" required>
								<option value="">Temática de habitación</option>
						</select>
					</div>
					<input type="hidden" id="ruta" name="ruta">

					<div class="row">

						<div class="col-6 input-group input-group-lg pr-1">

							<input type="text" class="form-control datepicker entrada" autocomplete="off" placeholder="Entrada" name="fecha-ingreso">

							<div class="input-group-append">

								<span class="input-group-text p-2">
									<i class="far fa-calendar-alt small text-gray-dark"></i>
								</span>

							</div>

						</div>

						<div class="col-6 input-group input-group-lg pl-1">

							<input type="text" class="form-control datepicker salida" autocomplete="off" placeholder="Salida" name="fecha-salida">

							<div class="input-group-append">

								<span class="input-group-text p-2">
									<i class="far fa-calendar-alt small text-gray-dark"></i>
								</span>

							</div>

						</div>

					</div>

					<input type="submit" class="btn btn-block btn-lg my-4 text-white" value="Ver disponibilidad">


				</div>

					

				</form>


			</div>

			<!-- INGRESO DE USUARIOS -->

			<div class="grid-item d-none d-lg-block mt-2">

				<?php if (isset($_SESSION["ValidarSession"])): ?>

						<?php if ($_SESSION["ValidarSession"]=="ok"): ?>

							<a href="<?php echo $ruta.'perfil'; ?>">


							 	<?php if (empty($usuario["foto_use"])): ?>

									  <i class="fas fa-user"></i>

							    <?php else: ?>

										<?php if ($usuario["modo_use"]=="directo"): ?>

											<img src="<?php echo $servidor.$usuario["foto_use"]; ?>" alt="" class="img-fluid rounded-circle" style="width: 30px">

										  <?php else: ?>

											<img src="<?php echo $usuario["foto_use"]; ?>" alt="" class="img-fluid rounded-circle" style="width: 30px">
											
										<?php endif ?> 
									
								<?php endif ?> 
								
							</a>
							
						<?php endif ?>

				 <?php else: ?>

				<a href="#modalIngreso" data-toggle="modal"><i class="fas fa-user"></i></a>
					
			<?php endif ?> 


			</div>

			<!-- SELECCIÓN DE IDIOMA -->

			<div class="grid-item d-none d-lg-block mt-1 idiomas">

				<span class="border border-info float-left p-1 bg-info text-white idiomaEs">ES</span>

				<span class="border border-info float-left p-1 bg-white text-dark idiomaEn">EN</span>

			</div>

			<!-- MENÚ HAMBURGUESA -->

			<div class="grid-item mt-1 mt-sm-3 mt-md-4 mt-lg-2 botonMenu">

				<i class="fas fa-bars lead"></i>

			</div>

		</div>

	</div>

</header>
