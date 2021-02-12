
<div class="content-wrapper" style="min-height: 179px;">

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Planes</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Inicio</a></li>

              <li class="breadcrumb-item"><a href="#">Planes</a></li>


            </ol>

          </div>

        </div>

      </div>

    </section>


    <section class="content">

      <div class="container-fluid">

        <div class="row">

          <div class="col-12">

            <div class="card">

              <div class="card-header">

                <h3 class="card-title">
                	 <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearAdministrador">Crear nuevo Plan</button>
                </h3>

              </div>

              <div class="card-body">

                <table class="table table-bordered table-striped tablePlanes dt-responsive" width="100%">

                	<thead>

                		<tr>

                			<th style="width: 10px">#</th>
                			<th>titulo</th>
                			<th>Imagen</th>
                			<th>Descipcion</th>
                			<th style="width: 40px">$.Tem.Alta</th>
                      <th style="width: 40px">$.Tem.Baja</th>
                			<th>Acciones</th>
                			
                		</tr>

                	</thead>
                	<tbody>
<!--                		<tr>
                			<td>1</td>
                      <td>Luna de Miel</td>
                			<td><img src="<?php echo $ruta ?>./vistas/img/planes/luna-de-miel.png" class="img-fluid" alt=""></td>
                			<td>
                        Lorem ipsum dolor sit amet consectetur adipisicing, elit. Eaque delectus possimus ipsam magni, tenetur in, consequuntur soluta porro provident vero et laborum! Ipsam, voluptates porro blanditiis aperiam vero. Reiciendis, ipsa!
                     </td>
                			<td>$/ 110000</td>
                			<td>$/ 120000</td>
                			<td>
                				<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarPlanes">
                					<i class="fas fa-pencil-alt text-white"></i>
                				</button>
                				 <button class="btn btn-danger btn-sm">
                					<i class="fas fa-trash-alt text-white"></i>
                				</button>
                			</td>
                	</tr>  -->
                	</tbody>
                	
                </table>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">

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
Modal Editar Plan
======================================-->
<div class="modal" id="editarPlanes">

	<div class="modal-dialog">

		<div class="modal-content">

			<form method="post" enctype="multipart/form-data">

				<div class="modal-header bg-success">

					<h4 class="modal-title">Editar Plan</h4>

					<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
					
				</div>

				<div class="modal-body">

					<input type="hidden" class="form-control" name="idPlan">
					<!-- NOMBRE  -->
					<div class="input-group mb-3">

						<div class="input-group-append input-group-text">

							<span class="fas fa-suitcase-rolling"></span>
							
						</div>

						<input type="text" class="form-control text-uppercase" placeholder="Nombre del Plan" name="editarPlan"  value="" required>
						
					</div>

					<!--CAMBIAR IMAGE -->

          <div class="form-group">

              <div class="form-group my-2">

                <div class="btn btn-default btn-file">

                    <i class="fas fa-paperclip"></i> Cambiar imagen del Plan

                    <input type="file" name="editarImgPlan">

                    <input type="hidden" name="imgPlanActual">
                  
                </div>

                  <img src="" class="EditarprevisualizarImgPlan img-fluid py-2" alt="">

                  <p>
                    Dimensiones: 480*382px | Peso Max. 2MB | Formato: JPG o PNG
                  </p>
 
              </div>

              <p>Escribe la descripcón del plan:</p>

              <textarea name="editarDescriocionPlan" id="editarDescriocionPlan" style="width:100%" value="sddsffdfdfd"></textarea>
            
          </div>


				   	<div class="input-group mb-3">

						<div class="input-group-append input-group-text">

							<span class="fas fa-dollar-sign"></span>

						</div>

						<input type="number" class="form-control" min="0" step="any" name="editar_precio_alta" required>
						
					</div>


					<div class="input-group mb-3">

						<div class="input-group-append input-group-text">

							<span class="fas fa-dollar-sign"></span>

						</div>

            <input type="number" min="0" step="any" class="form-control" name="editar_precio_baja" required>
						
					</div>
					
				</div>

				<div class="modal-footer d-flex justify-content-between">

					<div>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div>

					<div>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
					
				</div>
         <?php 

          $editarPlan = new  PlanesControlador();
          $editarPlan -> ctrActualizar();
         ?> 
				
			</form>
			
		</div>
		
	</div>
	
</div>

<!--=====================================
Modal Crear Plan
======================================-->

<div class="modal" id="crearAdministrador">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

        <div class="modal-header bg-success">

          <h4 class="modal-title">Crear Planes</h4>

          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          
        </div>

        <div class="modal-body">


          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">

              <span class="fas fa-suitcase-rolling"></span>
              
            </div>

            <input type="text" class="form-control text-uppercase" name="tipoPlan" placeholder="Ingrese el nombre del plan" required>
            
          </div>

          <div class="form-group">

            <div class="form-group my-2">

              <div class="btn btn-default btn-file">

                  <i class="fas fa-paperclip"></i> Adjuntar Imagen del plan 

                  <input type="file" name="subirImgPlan">
                 
              </div>

              <img class="previsualizarImgPlan img-fluid py-2" src="">

               <p class="help-block small">Dimensiones: 480px * 382px | Peso Max. 2MB | Formato: JPG o PNG</p>

            </div>

            <p>Escriba la descripción del plan:</p>

            <textarea  id="descripcionPlan" name="descripcionPlan" style="width: 100%"></textarea>

          </div>

          <div class="input-group mb-3">
           
            <div class="input-group-append input-group-text">
              <span class="fas fa-dollar-sign"></span>
            </div>
            
            <input type="number" min="0" step="any" class="form-control" name="precio_alta" placeholder="Precio temporada alta" required> 

          </div>

          <div class="input-group mb-3">
           
            <div class="input-group-append input-group-text">
              <span class="fas fa-dollar-sign"></span>
            </div>
            
            <input type="number" min="0" step="any" class="form-control" name="precio_baja" placeholder="Precio temporada baja" required> 

          </div>
          
        </div>

        <div class="modal-footer d-flex justify-content-between">

          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>

          <div>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
          
        </div>
        <?php 
              $crearPlan = new PlanesControlador();
              $crearPlan -> ctrRegistrarPlan();
         ?>
        
      </form>
      
    </div>
    
  </div>
  
</div>