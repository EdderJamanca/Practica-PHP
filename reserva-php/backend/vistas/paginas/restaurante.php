
<div class="content-wrapper" style="min-height: 179px;">

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Gestor Platos</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Inicio</a></li>

              <li class="breadcrumb-item active"><a href="#"> Gestor Platos</a></li>


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
                   <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearPlato">Crear nuevo Plato del Restaurante</button>
                </h3>

              </div>

              <div class="card-body">

                <table class="table table-bordered table-striped tableRestaurante" width="100%">

                	<thead>

                		<tr>

                			<th style="width: 10PX">#</th>
                			<th>img</th>
                			<th>Descripción</th>
                			<th>Acciones</th>
                			
                		</tr>

                	</thead>
                	<tbody>
<!--                 		<tr>
                			<td>1</td>
                      <td><img src="vistas/img/restaurante/plato01.png" class="img-fluid" width="150px" alt=""></td>
                      <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo velit quis iusto magnam cupiditate dolorum repudiandae tempore cum minus eos a iure, officiis, eius, consequuntur unde nulla, enim quibusdam beatae.</td>
                			<td>
                          <div class="btn-group">

                                  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarRecorrido"><i class="fas fa-pencil-alt text-white"></i></button>
                                  <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                 
                               </div>
                			</td>
                		</tr>  -->
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
Modal Crear Restaurante
======================================-->

<div class="modal formulario" id="crearPlato">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">Crear Plato</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <div class="form-group">

          <div class="form-group my-2">

            <div class="btn btn-default btn-file">

                <i class="fas fa-paperclip"></i> Adjuntar Imagen del plato

                <input type="file" name="subirImgRestaurante" >
               
            </div>

            <br>

            <img class="previsualizarImgRestaurante img-fluid py-2">

             <p class="help-block small">Dimensiones: 169px x 169px | Peso Max. 2MB | Formato: JPG o PNG</p>

          </div>

        </div>  

        <div class="input-group mb-3">

          <textarea class="form-control" maxlength="40" name="pescripcionRestaurante" placeholder="Ingresa la descripción del Plato" required></textarea>

        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-between">

        <div>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>

        <div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

      </div>
        <?php 
            $nuevoPlato= new RestauranteControlador();

            $nuevoPlato -> ctrNuevoRestaurante();

         ?>

      </form>

    </div>

  </div>

</div>
<!--=====================================
Modal Ediatr Restaurante 
======================================-->

<div class="modal formulario" id="editarRecorrido">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">Crear Restaurante</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <div class="form-group">
            <input type="hidden" name="idPlato">
          <div class="form-group my-2">

            <div class="btn btn-default btn-file">

                <i class="fas fa-paperclip"></i> Adjuntar Imagen del plato

                <input type="file" name="editarsubirImgRestaurante">
                <input type="hidden" name="antiguoimgPlato">
               
            </div>

            <br>

            <img class="EdiprevisualizarImgRestaurante img-fluid py-2">

             <p class="help-block small">Dimensiones: 169px x 169px | Peso Max. 2MB | Formato: JPG o PNG</p>

          </div>

        </div>  

        <div class="input-group mb-3">

          <textarea class="form-control" maxlength="40" name="EditPescripcionRestaurante" placeholder="Ingresa la descripción del Plato" required></textarea>

        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-between">

        <div>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>

        <div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

      </div>
          <?php 
                $editarPlato=new RestauranteControlador();

                $editarPlato ->ctraAcualizarRestaurante();
           ?>

      </form>

    </div>

  </div>

</div>