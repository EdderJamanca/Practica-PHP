
<div class="content-wrapper" style="min-height: 179px;">

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Reservas</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Inicio</a></li>

              <li class="breadcrumb-item Active"><a href="#">Reservas</a></li>


            </ol>

          </div>

        </div>

      </div>

    </section>


    <section class="content">

      <div class="container-fluid">

        <div class="row">

          <div class="col-12">

            <div class="card rounded-lg card-outline card-primary">


              <div class="card-body">

                <table class="table table-bordered table-striped tableReserva" width="100%">

                	<thead>

                		<tr>

                			<th style="width: 10PX">#</th>
                			<th>Código</th>
                			<th>Descripción</th>
                			<th>Usuario</th>
                			<th>Pago</th>
                			<th>Transación</th>
                      <th>Ingreso</th>
                      <th>Salida</th>
                      <th>Acciones</th>
                			
                		</tr>

                	</thead>
                	<tbody>
                		<tr>
                  			<td>1</td>
                  			<td>O8NZJZULS</td>
                  			<td>Habitación suite Oriental-Plan Continental-2</td>
                  			<td>Ivan Gonzales</td>
                        <td>$ <?php echo number_format(90000); ?> </td>
                        <td>1233463938</td>
                        <td>2020-10-17</td>
                        <td>2020-10-20</td>
                        <td>
                          <button class="btn btn-warning btn-sm mr" data-toggle="modal" data-target="#editarReserva">
                            <i class="fas fa-pencil-alt text-white"></i>
                          </button>
                           <button class="btn btn-danger btn-sm ml">
                            <i class="fas fa-trash-alt text-white"></i>
                          </button>
                        </td>
                		</tr> 

                	</tbody>
                	
                </table>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">

                Footer

              </div>

              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

<!--=====================================
Modal Editar Reserva
======================================-->
<div class="modal" id="editarReserva">

	<div class="modal-dialog modal-lg">

		<div class="modal-content">

			<form method="post">
        <!--Modal Header -->
				<div class="modal-header bg-info">

					<h4 class="modal-title">Editar Reserva: <span class="small"></span></h4>

					<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
					
				</div>
        <!-- Modal Body -->
				<div class="modal-body">

          <h6 class="lead pt-4 pb-2"> Puede modificar la fecha de acuerdo a los dias disponibles:</h6>

					<div class="container mb-3">

                <div class="row py-2" style="background: #509CC3">

                   <div class="col-6 col-md-3 input-group pr-1">

                      <input type="text" class="form-control datapicker entrada" autocomplete="off" placeholder="Entrada" value="" required>

                      <div class="input-group-append">

                        <span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
                        
                      </div>
                     
                   </div>

                   <div class="col-6 col-md-3 input-group pl-1">

                     <input type="text" class="form-control datepicker salida" readonly required>

                     <div class="input-group-append">

                       <span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
                       
                     </div>
                     
                   </div>

                   <div class="col-12 col-md-6 mt-2 mt-lg-0 input-group">

                      <button class="btn btn-block btn-md text-white verDisponibilidad" idHabilidad style="background: black">Ver disponibilidad</button>
                     
                   </div>
                  
                </div>

					</div>

          <div class="bg-white p-4 calendarioReservas">

            <div class="infoDisponibilidad">
              <h1 class="pb-5 float-left infoDisponibilidad">¡Está disponible!</h1>
            </div>

            <div class="float-right pb-3">

                <ul style="list-style: none">

                   <li>
                     <a href="#" class="fas fa-square-full" style="color:#847059"></a>
                   </li>
                   <li>
                     <a href="#" class="fas fa-square-full" style="color:#eee"></a>
                   </li>
                   <li>
                     <a href="#" class="fas fa-square-full" style="color:#FFCC29"></a>
                   </li>
                  
                </ul>
              
            </div>
            
          </div>

          <div class="clearfix"></div>

          <div class="agregarCalendario p-3">
            <div id="calendar"></div>
          </div>

						
				</div>

        <!-- modal footer -->

        <div class="modal-footer d-flex justify-content-between">

          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>
          <div>
            <button type="button" class="btn btn-primary guardarNuevaReserva" fechaIngreso fechaSalida idReserva>Cerrar</button>
          </div>
          
        </div>


			</form>
			
		</div>
		
	</div>
	
</div>
