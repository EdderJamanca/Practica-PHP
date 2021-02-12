<!--=====================================
MENÚ MÓVIL
======================================-->
<div class="menuMovil">

	<div class="row">

		<div class="col-6">

			<a href="#modalIngreso" data-toggle="modal">
				<i class="fas fa-user lead ml-3 mt-4"></i>
			</a>

		</div>

		<div class="col-6">

			<div class="float-right mr-3 mt-3 mr-sm-5 mt-sm-4">

				<span class="border border-info float-left p-1 bg-info text-white idiomaEs">ES</span>
				<span class="border border-info float-left p-1 bg-white text-dark idiomaEn">EN</span>

			</div>

		</div>

	</div>

	<form action="<?php echo $ruta; ?>reserva" method="POST">

		<div class="formReservas py-1 py-lg-2 px-4">

				<div class="form-group my-4">
					<select class="form-control form-control-lg selectTipoHabitacion">
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

						<input type="text" class="form-control datepicker entrada" placeholder="Entrada" autocomplete="off" required name="fecha-ingreso">

						<div class="input-group-append">

							<span class="input-group-text p-2">
								<i class="far fa-calendar-alt small text-gray-dark"></i>
							</span>

						</div>

					</div>

					<div class="col-6 input-group input-group-lg pl-1">

						<input type="text" class="form-control datepicker salida" placeholder="Salida" autocomplete="off" required readonly name="fecha-salida">

						<div class="input-group-append">

							<span class="input-group-text p-2">
								<i class="far fa-calendar-alt small text-gray-dark"></i>
							</span>

						</div>

					</div>

				</div>

				
				<input type="submit" class="btn btn-block btn-lg my-4 text-white" value="Ver disponibilidad">

	    </div>
		
	</form>>



	<ul class="nav flex-column mt-4 pl-4 mb-5">

		<li class="nav-item">
			<a class="nav-link text-white my-2" href="#planesMovil">Planes</a>
		</li>

		<li class="nav-item">
			<a class="nav-link text-white my-2" href="#habitaciones">Habitaciones</a>
		</li>

		<li class="nav-item">
			<a class="nav-link text-white my-2" href="#pueblo">Recorrido por el pueblo</a>
		</li>

		<li class="nav-item">
			<a class="nav-link text-white my-2" href="#restaurante">Restaurante</a>
		</li>

		<li class="nav-item">
			<a class="nav-link text-white my-2" href="#contactenos">Contáctenos</a>
		</li>

	</ul>

</div>
