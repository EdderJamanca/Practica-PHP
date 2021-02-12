
<div class="content-wrapper" style="min-height: 179px;">

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Administradores</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Inicio</a></li>

              <li class="breadcrumb-item"><a href="#">Administradores</a></li>


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
                	 <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearAdministrador">Crear nuevo administrador</button>
                </h3>

              </div>

              <div class="card-body">

                <table class="table table-bordered table-striped tableAdministrador" width="100%">

                	<thead>

                		<tr>

                			<th style="width: 10PX">#</th>
                			<th>Nombres</th>
                			<th>Usuario</th>
                			<th>Perfil</th>
                			<th>Estado</th>
                			<th>Acciones</th>
                			
                		</tr>

                	</thead>
                	<tbody>
<!--                 		<tr>
                			<td>1</td>
                			<td>Hotel Portobelo</td>
                			<td>Portobelolo</td>
                			<td>Adminidtrador</td>
                			<td><button class="btn btn-info text-white btn-sm">Activo</button></td>
                			<td>
                				<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarAdministrador">
                					<i class="fas fa-pencil-alt text-white"></i>
                				</button>
                				 <button class="btn btn-danger btn-sm">
                					<i class="fas fa-trash-alt text-white"></i>
                				</button>
                			</td>
                		</tr> -->
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
Modal Editar Administrador
======================================-->
<div class="modal" id="editarAdministrador">

	<div class="modal-dialog">

		<div class="modal-content">

			<form method="post">

				<div class="modal-header bg-success">

					<h4 class="modal-title">Editar Administrador</h4>

					<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
					
				</div>

				<div class="modal-body">

					<input type="hidden" name="editarid">
					<!-- NOMBRE  -->
					<div class="input-group mb-3">

						<div class="input-group-append input-group-text">

							<span class="fas fa-user"></span>
							
						</div>

						<input type="text" class="form-control" name="editarNombre"  value="" required>
						
					</div>

					<!--USUARIO  -->

					<div class="input-group mb-3">

						<div class="input-group-append input-group-text">

							<span class="fas fa-user-lock"></span>

						</div>

						<input type="text" class="form-control" name="editarUsuario"  value required>
						
					</div>
				   <!-- PASSWORD -->

				   	<div class="input-group mb-3">

						<div class="input-group-append input-group-text">

							<span class="fas fa-lock"></span>

						</div>

						<input type="text" class="form-control" name="editarPassword" placeholder="Cambiar la Contraseña" value>

						<input type="hidden" name="passwordActual">
						
					</div>

					<!-- PERFIL -->

					<div class="input-group mb-3">

						<div class="input-group-append input-group-text">

							<span class="fas fa-key"></span>

						</div>

						<select name="editarPerfil" class="form-control" required>
							
							<option class="editarPerfilOpcion" val=""></option>

							<option value="">Seleccione perfil</option>

							<option value="administrador">Administrador</option>

							<option value="editar">Editar</option>

						</select>


						
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

          $editar = new  AdministradorControlador();
          $editar -> ctrActualizarAdministrador();
         ?>
				
			</form>
			
		</div>
		
	</div>
	
</div>

<!--=====================================
Modal Crear Administrador
======================================-->

<div class="modal" id="crearAdministrador">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post">

        <div class="modal-header bg-success">

          <h4 class="modal-title">Crear Administrador</h4>

          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          
        </div>

        <div class="modal-body">

          <input type="hidden" name="editarid">
          <!-- NOMBRE  -->
          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">

              <span class="fas fa-user"></span>
              
            </div>

            <input type="text" class="form-control" name="crearNombre" placeholder="Nombre Usuario" value required>
            
          </div>

          <!--USUARIO  -->

          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">

              <span class="fas fa-user-lock"></span>

            </div>

            <input type="text" class="form-control" name="crearUsuario" placeholder="Usuario" value required>
            
          </div>
           <!-- PASSWORD -->

            <div class="input-group mb-3">

            <div class="input-group-append input-group-text">

              <span class="fas fa-lock"></span>

            </div>

            <input type="text" class="form-control" name="crearPassword" placeholder="Cambiar la Contraseña" value required>
            
          </div>

          <!-- PERFIL -->

          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">

              <span class="fas fa-key"></span>

            </div>

            <select name="crearPerfil" class="form-control" required>
              

              <option value="">Seleccione perfil</option>

              <option value="administrador">Administrador</option>

              <option value="editar">Editar</option>

            </select>


            
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
              $crearAdmin = new AdministradorControlador();
              $crearAdmin -> ctrRegistrarAdministrador();
         ?>
        
      </form>
      
    </div>
    
  </div>
  
</div>