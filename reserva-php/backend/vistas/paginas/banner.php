
<div class="content-wrapper" style="min-height: 179px;">

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Banner</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Inicio</a></li>

              <li class="breadcrumb-item"><a href="#">Banner</a></li>


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
                	 <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearBanner">Crear nuevo Banner</button>
                </h3>

              </div>

              <div class="card-body">

                <table class="table table-bordered table-striped tableBanner" style="width: 100%">

                	<thead>

                		<tr>

                			<th style="width: 10px">#</th>
                			<th>Banner</th>
                			<th>Acciones</th>
                			
                		</tr>

                	</thead>
                	<tbody>
<!--                 		<tr>
                			<td>1</td>
                			<td><img src="<?php echo $ruta ?>./vistas/img/banner/banner01.jpg" class="img-fluid" alt=""></td>
                			<td>
                				<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarBanner">
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
Modal Editar Administrador
======================================-->
<div class="modal" id="editarBanner">

	<div class="modal-dialog">

		<div class="modal-content">

			<form method="post" enctype="multipart/form-data">

				<div class="modal-header bg-success">

					<h4 class="modal-title">Editar Banner</h4>

					<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
					
				</div>

				<div class="modal-body">

					<input type="hidden" name="idBanner" class="form-control">
				
					<div class="input-group my-3">

            <input type="file" class="form-control-file border" name="editarBanner" required>

            <input type="hidden" name="bannerActual">

            <p class="help-block small">Dimensiones: 1440px * 600px | Peso Max. 2MB | Format: JPG o PNG</p>

						<img src="" class="previsualizarBanner img-fluid" alt="">
						
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

          $editarBanner = new  BannerContolador();
          $editarBanner -> ctrActualizarBanner();
         ?> 
				
			</form>
			
		</div>
		
	</div>
	
</div>

<!--=====================================
Modal Crear Banner
======================================-->

<div class="modal" id="crearBanner">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

        <div class="modal-header bg-success">

          <h4 class="modal-title">Crear Bnner</h4>

          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          
        </div>

        <div class="modal-body">


          <div class="input-group my-3">

            <input type="file" class="form-control-file border" name="subirBanner" required>

            <p class="help-block small">Dimensiones:1440px * 600px | Peso Max. 2MB | Format: JPG o PNG</p>

            <img class="previsualizarBanner img-fluid" alt="">     

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
              $crearBanner = new BannerContolador();
              $crearBanner -> ctrRegistrarBanner();
         ?> 
   
      </form>
      
    </div>
    
  </div>
  
</div>