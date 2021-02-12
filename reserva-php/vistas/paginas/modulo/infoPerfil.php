<?php 
	 $item ="id_usuario";
	 $valor =$_SESSION["id"];
	 $usuario = UsuarioControlador::ctrMostrarUsuario($item,$valor);
	 $reserva =ReservaControlador::ctrMostrarReservasUsario($valor);

	 // reservas vencidas
	 $hoy = date("Y-m-d");

	 $noVencidas=0;
	 $vensidas=0;

	 foreach ($reserva as $key => $value) {

	 	if ($hoy>=$value["fecha_ingreso"]) {

	 		++$vensidas;

	 	}else {

	 		++$noVencidas;

	 	}
	 	
	 }
	
 ?>

<!--=====================================
INFO PERFIL
======================================-->

<div class="infoPerfil container-fluid bg-white p-0 pb-5 mb-5">

	<div class="container">

		<div class="row">

			<!--=====================================
			BLOQUE IZQ
			======================================-->

			<div class="col-12 col-lg-3 colIzqPerfil p-0 px-lg-3">

				<div class="cabeceraPerfil pt-4">

					<?php if ($usuario["modo_use"]=="facebook"): ?>


							<a href="#" class="float-left lead text-white pt-1 px-3 mb-4 salir">
								<h5><i class="fas fa-chevron-left"></i> Salir</h5>
							</a>

						<?php else: ?>

							<a href="<?php echo $ruta; ?>salir" class="float-left lead text-white pt-1 px-3 mb-4">
								<h5><i class="fas fa-chevron-left"></i> Salir</h5>
							</a>
						
					<?php endif ?>


					<div class="clearfix"></div>

					<h1 class="text-white p-2 pb-lg-5 text-center text-lg-left">MI PERFIL</h1>
				</div>

				<!--=====================================
				PERFIL
				======================================-->

				<div class="descripcionPerfil">

					<figure class="text-center">

						<?php if ($usuario["foto_use"]==""): ?>

							<img src="vistas/img//testimonio01.png" class="img-fluid w-50 rounded-circle">

						<?php else: ?>

							<?php if ($usuario["modo_use"]=="directo"): ?>

									<img src="<?php echo $servidor.$usuario["foto_use"]; ?>" class="img-fluid w-50 rounded-circle">

								<?php else: ?>

									<img src="<?php echo $usuario["foto_use"]; ?>" class="img-fluid w-50 rounded-circle">
								
							<?php endif ?>
							
						<?php endif ?>


					</figure>

					<div id="accordion">

						<div class="card">

							<div class="card-header">
								<a class="card-link" data-toggle="collapse" href="#collapseOne">
									MIS RESERVAS
								</a>
							</div>

							<div id="collapseOne" class="collapse show" data-parent="#accordion">

								<ul class="card-body p-0">

									<li class="px-2 misReservas" style="background:#FFFDF4"> <?php echo $noVencidas; ?> Por vencerse</li>
									<li class="px-2 text-white misReservas" style="background:#CEC5B6"> <?php echo $vensidas; ?> vencidas</li>

								</ul>

								<!--=====================================
								TABLA RESERVAS MÓVIL
								======================================-->

								<?php foreach ($reserva as $key => $value): 

									 $habitacion =HabitacionControlador::ctlMostrarHabitacionSingular($value["id_habitacion"]);
							    	
							        $categoria=CategoriaControlador::ctrMostrarCategoriaSingular($habitacion["tipo"]);

									?>



										<div class="d-lg-none d-flex py-2">

											<div class="p-2 flex-grow-1">

												<h5><?php echo $categoria["tipo_c"]." ".$habitacion["estilo"]; ?></h5>
												<h5 class="small text-gray-dark"><?php echo "Del ".$value["fecha_ingreso"]." al ".$value["fecha_salida"]; ?></h5>

											</div>

											<div class="p-2">

												<button type="button" class="btn btn-dark btn-sm text-white"><i class="fas fa-pencil-alt"></i></button>
												<button type="button" class="btn btn-warning btn-sm text-white"><i class="fas fa-eye"></i></button>

											</div>

										</div>
										<hr class="my-0">
									
								<?php endforeach ?>


								
							</div>

						</div>

						<div class="card">

							<div class="card-header">
								<a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
									MIS DATOS
								</a>
							</div>

							<div id="collapseTwo" class="collapse" data-parent="#accordion">
								<div class="card-body p-0">

									<ul class="list-group">

										<li class="list-group-item small"><?php echo $usuario["nombre_use"]; ?></li>
										<li class="list-group-item small"><?php echo $usuario["email_use"]; ?></li>
										<li class="list-group-item small">
										<?php if ($usuario["modo_use"]=="directo"): ?>

											<button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#cambiarPasswordUsuario">Cambiar Contraseña</button>

										<!-- ==================================
											MODAL PARA CAMBIAR password usuario
										======================================= -->

										<div class="modal formulario" id="cambiarPasswordUsuario">

											<div class="modal-dialog">

												<div class="modal-content">

													<form method="post">

														<div class="modal-header">

															<h4 class="modal-title">Cambiar Contraseña</h4>

															<button class="close" type="button" data-dismiss="modal">
																&times;
															</button>
															
														</div>

														<div class="modal-body">

															<input type="hidden" name="idUsuarioPassword" value="<?php echo $usuario["id_usuario"]; ?>">


															<div class="form-group">
																<input type="password" class="form-control" placeholder="Nueva contraseña" name="editarPassword">
															</div>
															
														</div>

														<div class="modal-footer d-flex justify-content-between">

															<div>
																<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
															</div>
															<div>
																<button type="submit" class="btn btn-primary">Enviar</button>
															</div>
															
														</div>

														<?php 

														$cambiasPassword = new UsuarioControlador();

														$cambiasPassword->ctrCambiarPassword();

														 ?>
														
													</form>
													
												</div>
												
											</div>
											
										</div>

										<?php endif ?>

										</li>
										<li class="list-group-item small">
											<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#cambiarFotoPerfil">Cambiar Imagen</button>


										</li>

										<!-- ==================================
											MODAL PARA CAMBIAR FOTO DE PERFIL
										======================================= -->

										<div class="modal formulario" id="cambiarFotoPerfil">

											<div class="modal-dialog">

												<div class="modal-content">

													<form method="post" enctype="multipart/form-data">

														<div class="modal-header">

															<h4 class="modal-title">Cambiar Imagen</h4>

															<button type="button" class="close" data-dismiss="modal">&times;</button>
															
														</div>

														<div class="modal-body">

															<input type="hidden" name="idUsuarioFoto" value="<?php echo  $usuario["id_usuario"]; ?>">
															
															<div class="form-group">

																<input type="file" class="form-control-file border" name="cambiarImagen" required value="">

																<input type="hidden" name="fotoActual" value="<?php echo $usuario["foto_use"];  ?>">
																
															</div>
															
														</div>

														<div class="modal-footer d-flex justify-content-between">

															<div>
																<button type="button" class="btn btn-danger" data-dismiss="modal">
																	Cerrar
																</button>
															</div>
															<div>
																<button type="submit" class="btn btn-primary">
																	Enviar
																</button>
															</div>
															
														</div>
														<?php 
															$actualizarFotoPerfil = new UsuarioControlador();

															$actualizarFotoPerfil->ctlCambiarFotoControlador();

														 ?>
														
													</form>
													
												</div>
												
											</div>
											
										</div>

									</ul>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

			<!--=====================================
			BLOQUE DER
			======================================-->

			<div class="col-12 col-lg-9 colDerPerfil">

				<div class="row">

					<div class="col-6 d-none d-lg-block">

						<h4 class="float-left">Hola <?php echo $usuario["nombre_use"]; ?></h4>

					</div>


					<div class="col-12">
						<!-- VERIFICAMOS SI HAY DATOS COOKIE -->
						<?php if (isset($_COOKIE["codigoReserva"])): ?>

								<!-- se va a restringir la reserva el mismo dia  menor dia-->
								<?php 

									$validarPagoReserva=false;

									$hoy=date("Y-m-d");

									if($hoy>=$_COOKIE["fechaIngreso"] || $hoy>=$_COOKIE["fechaSalida"]){

										echo '<div class="alert alert-danger">
										Lo sentimos, las fechas de la reserva no pueden ser igual o inferiores al día de hoy, vuelve a intentarlo.
										</div>';
										$validarPagoReserva=false;

									}else {

										$validarPagoReserva=true;

									}

										/*=============================================
										 	CRUCE DE FECHAS-si algien reservo antes 
										=============================================*/

										$valor= $_COOKIE["idHabitacion"];

										$validarReserva=ReservaControlador::ctlReservas($valor);

										$option01=array();
										$option02=array();
										$option03=array();

										if($validarReserva !=0){

											foreach ($validarReserva as $key => $value) {

												//validar el cruce de fechas opcion 1

												if($_COOKIE["fechaIngreso"]==$value["fecha_ingreso"]){

													array_push($option01, false);

												}else {
													array_push($option01, true);
												}

												// VALIDAR CRUCE DE FECHAS OPCION 2

												if($_COOKIE["fechaIngreso"]>$value["fecha_ingreso"] && $_COOKIE["fechaIngreso"]<$value["fecha_salida"]){

													array_push($option02, false);

												}else {

													array_push($option02, true);

												}
												// VALIDAR CRUCE DE FECHAS OPCION 3
												if($_COOKIE["fechaIngreso"]<$value["fecha_ingreso"] && $_COOKIE["fechaSalida"]>$value["fecha_salida"]){

													array_push($option03, false);

												}else {

													array_push($option03, true);

												}
												//verificamos los casos

												if($option01[$key]==false || $option02[$key]==false || $option03[$key]==false){

													$validarPagoReserva=false;

													echo 'Lo sentimos, las fechas de la reserva que habías seleccionado han sido ocupadas  <a href="'.$ruta.'" class="btn btn-danger btn-sm">vuelve a intentarlo </a>';

													break;

												}else {

													$validarPagoReserva=true;

												}


											}

										}



								 ?>
								 <!-- se va a restringir la reserva el mismo dia  menor dia-->


								 <?php if ($validarPagoReserva): ?>

								 									<div class="card">

									<div class="card-header">
										<h4>Tienes una reserva pendiente por pagar</h4>
									</div>

									<div class="card-body text-center">

										<figure>

											<img src="<?php echo $_COOKIE['imgHabitacion']; ?>" alt="">
											
										</figure>
										<H5><strong> <?php echo $_COOKIE["infoHabitacion"]; ?> </strong></H5>
										<H6>Fechas <?php echo $_COOKIE["fechaIngreso"]; ?> - <?php echo $_COOKIE["fechaSalida"]; ?> </H6>
										<h4> s/<?php echo number_format($_COOKIE["pagoReserva"]); ?> </h4>
										
									</div>

									<div class="card-footer d-flex bg-white ">

										<figure>

											<img src="<?php echo $ruta?>vistas/img/mercadopago.png" class="img-fluid w-50" >
											
										</figure>

										<form action="<?php echo $ruta; ?>perfil" method="POST">
										  <script
										    src="https://www.mercadopago.com.pe/integrations/v1/web-tokenize-checkout.js"
										    data-public-key="TEST-6e74b251-c9c7-43f2-bfbb-085903056a1f"
										    data-transaction-amount="<?php echo $_COOKIE["pagoReserva"]; ?>"
										    data-button-label="Pagar"
										    data-summary-product-label="<?php echo $_COOKIE["infoHabitacion"]; ?>"
										    data-summary-product="<?php echo $_COOKIE["pagoReserva"]; ?>">
										  </script>
										</form>

										
									</div>									

								</div>

								<!-- MERCADO PAGO -->
								<?php

										if(isset($_REQUEST["token"])){

										 $token = $_REQUEST["token"];

										  $payment_method_id = $_REQUEST["payment_method_id"];

										  $installments = $_REQUEST["installments"];

										  $issuer_id = $_REQUEST["issuer_id"];

									     MercadoPago\SDK::setAccessToken("TEST-4237978535672747-012918-35426e35a79991b20217dd2921f2e060-708314853");
									    //...
									    $payment = new MercadoPago\Payment();
									    $payment->transaction_amount = $_COOKIE["pagoReserva"];
									    $payment->token = $token;
									    $payment->description = $_COOKIE["infoHabitacion"];
									    $payment->installments = $installments;
									    $payment->payment_method_id = $payment_method_id;
									    $payment->issuer_id = $issuer_id;
									    $payment->payer = array(
									    "email" => "john@yourdomain.com"
									    );
				
									    $payment->save();

									    echo $payment->status;

									    	if($payment->status=="approved"){

									    		$datos=array("id_habitacion"=>$_COOKIE["idHabitacion"],
									    					 "id_usuario"=>$usuario["id_usuario"],
									    					  "pago_reserva"=>$_COOKIE["pagoReserva"],
									    					  "numero_transaccion"=>$payment->id,
									    					  "codigo_reserva"=>$_COOKIE["codigoReserva"],
									    					   "descripcion_reserva"=>$_COOKIE["infoHabitacion"],
									    					   "fecha_reserva"=>$_COOKIE["fechaIngreso"],
									    					   "fecha_salida"=> $_COOKIE["fechaSalida"]);

											

									    		$respuesta = ReservaControlador::ctrGuardarReserva($datos);

									    		// ELIMINANDO COOKIE
									    		if($respuesta=="ok"){

									    			echo '<script>
									    				document.cookie="idHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
									    				document.cookie="pagoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
									    				document.cookie="codigoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
									    				document.cookie="infoHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
									    				document.cookie="fechaIngreso=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
									    				document.cookie="fechaIngreso=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
									    				document.cookie="idHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
									    				document.cookie="imgHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";

									    				swal({
																type:"success",
															  	title: "¡CORRECTO!",
															  	text: "¡La reserva ha sido creada con éxito!",
															  	showConfirmButton: true,
																confirmButtonText: "Cerrar"
															  
															}).then(function(result){

																	if(result.value){   
																	    history.back();
																	  } 
															});
									    			</script>';

									    			

									    		}
									    		// FIN ELIMINAR COOKIE
									    		


									    	}
									
									   

										}

								?>
								<!-- FIN MERCADO PAGO -->
								 	
								 <?php endif ?>


							
						<?php endif ?>



						
					</div>

					<div class="col-6 d-none d-lg-block"></div>

					<div class="col-12 mt-3">

						<table class="table table-striped">
					    <thead>
					      <tr>
					      	<th>#</th>
					        <th>Habitación</th>
					        <th>Fecha de Ingreso</th>
					        <th>Fecha de Salida</th>
					        <th>Comentarios</th>
					      </tr>
					    </thead>
					    <tbody>

					    		<?php 


					    		 ?>
					    <?php foreach ($reserva as $key => $value):

						    $habitacion =HabitacionControlador::ctlMostrarHabitacionSingular($value["id_habitacion"]);
						    	
						    $categoria=CategoriaControlador::ctrMostrarCategoriaSingular($habitacion["tipo"]);

						    $testimonio =ReservaControlador::ctrMostrarTestimonio("id_reser",$value["id_reserva"]);
	
						     ?>

						     <tr>
						        <td><?php echo ($key+1); ?></td>
						        <td><?php echo $categoria["tipo_c"]." ".$habitacion["estilo"]; ?></td>
						        <td><?php echo $value["fecha_ingreso"]; ?></td>
						        <td><?php echo $value["fecha_salida"]; ?></td>
						        <td>

									  <button type="button" class="btn btn-dark text-white editarTestimonio" data-toggle="modal" data-target="#editarTestimodio" idTestimonio=" <?php echo $testimonio[0]["id_testimonio"]; ?>" verTestimodio="<?php echo $testimonio[0]["testimonio"]; ?>"><i class="fas fa-pencil-alt"></i></button>

									  <button type="button" class="btn btn-warning text-white verTestimodio" verTestimodio="<?php echo $testimonio[0]['testimonio'];?>" data-toggle="modal" data-target="#verTestimodio"><i class="fas fa-eye"></i></button>

						        </td>
					       </tr>


					    	
					    <?php endforeach ?>

					    </tbody>
					  </table>


					</div>

				</div>

			</div>

		</div>

	</div>

</div>
<!--=====================================
MODAL PARA VER TESTIMONIO
======================================-->

<div class="modal" id="verTestimodio">

	<div class="modal-dialog">

		<div class="modal-content">

			<form method="post">

				<div class="modal-header">
					<h4 class="modal-title">Testimonio</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body visorTestimonio">

					<script>
						$(".verTestimodio").click(function(){

							var testimonio =$(this).attr("verTestimodio");

							if(testimonio !=""){
								$(".modal-body.visorTestimonio").html('<p>'+testimonio+'</p>');
							}else {
								$(".modal-body.visorTestimonio").html('<p>Aún no tienes testimonio de esta reserva</p>');
							}

						});
						
					</script>

				</div>
				
			</form>
			
		</div>
		
	</div>
	
</div>
<!--=====================================
MODAL PARA VER EDITAR TESTIMONIO
======================================-->

<div class="modal" id="editarTestimodio">

	<div class="modal-dialog">

		<div class="modal-content">

			<form method="post">

				<div class="modal-header">
					<h4 class="modal-title">Editar Testimonio</h4>
					<button class="close" type="button" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">


					<script>

						$(".editarTestimonio").click(function(){
								var idTestimonio =$(this).attr("idTestimonio");
								var verTestimodio=$(this).attr("verTestimodio");

							if(verTestimodio != ""){

								$(".modal-body textarea").val(verTestimodio);

							}else {
								$(".modal-body textarea").val("");
							}
							$("input[name='idTestimonio']").val(idTestimonio);

						});


					</script>

					<input type="hidden" value="" name="idTestimonio">
				
					<textarea class="form-control" rows="3" name="actualizarTestimonio" required></textarea>

					<input class="btn btn-primary my-3 float-right" type="submit" value="Guardar testimonio">
				</div>

				<?php 	
				 $actualizaTestimonio = new ReservaControlador();
				 $actualizaTestimonio->mdlActualizarTestimodio();
				 ?>
				
			</form>
			
		</div>
		
	</div>
	
</div>