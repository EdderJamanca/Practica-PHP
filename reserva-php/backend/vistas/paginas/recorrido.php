
<div class="content-wrapper" style="min-height: 179px;">

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Gestor Recorrido</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Inicio</a></li>

              <li class="breadcrumb-item"><a href="#">Recorrido</a></li>


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
                   <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearRecorrido">Crear nueva Recorrido</button>
                </h3>

              </div>

              <div class="card-body">

                <table class="table table-bordered table-striped tableRecorrido" width="100%">

                	<thead>

                		<tr>

                			<th style="width: 10PX">#</th>
                			<th>Titulo</th>
                			<th>Descripción</th>
                			<th>Foto Grande</th>
                			<th>Foto Pequeña</th>
                			<th>Acciones</th>
                			
                		</tr>

                	</thead>
                	<tbody>
                		<tr>
                			<td>1</td>
                      <td>Lorem Ipsum</td>
                      <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo velit quis iusto magnam cupiditate dolorum repudiandae tempore cum minus eos a iure, officiis, eius, consequuntur unde nulla, enim quibusdam beatae.</td>
                			<td><img src="vistas/img/recorrido/pueblo01b.png" alt="" class="img-fluid" width="50px"></td>
                			<td><img src="vistas/img/recorrido/pueblo01a.png" alt="" class="img-fluid" width="50px"></td>
                			<td>
                          <div class="btn-group">

                                  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarRecorrido"><i class="fas fa-pencil-alt text-white"></i></button>
                                  <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                 
                               </div>
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
Modal Crear Recorrido crearRecorrido
======================================-->

<div class="modal" id="crearRecorrido">

  <div class="modal-dialog">

     <div class="modal-content">

        <form method="post" enctype="multipart/form-data"></form>

        <!-- Modal Header -->

            <div class="modal-header bg-info" >

                <h4 class="modal-title">
                  Crear Recorrido
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->

            <div class="modal-body">

              <div class="input-group md-3">
                
                <div class="input-group-append input-group-text">

                  <span class="fas fa-suitcase-rolling"></span>
                  
                </div>

                <input type="text" class="form-control" name="tituloRecorrido" placeholder="Ingresa el Título del recorrido" required>

              </div>

              <!-- descripcion -->

              <div class="input-group my-3">

                <textarea name="descripcionRecorrido" class="form-control" maxlength="220" placeholder="Ingrese la descripción del recorrido"></textarea>
                
              </div>
              <!-- subir foto pequeña -->
              <div class="input-group">

                  <div class="form-group my-2">

                    <div class="btn btn-default btn-file">

                       <i class="fas fa-paperclip"></i>Adjuntar Imagen Pequeñas del Recorrido

                       <input type="file" name="subirImgPeqRecorrido">
                   
                    </div>
                    <img class="previsualizarImgRecorrido img-fluid py-2" alt="">

                     <p class="help-block small">Dimensiones: 455px x 280px | Peso Max. 2MB | Formato: JPG o PNG</p>
                    
                  </div>
                
              </div>
              <!-- subir foto grande -->

              <div class="input-group">

                  <div class="form-group my-2">

                    <div class="btn btn-default btn-file">

                       <i class="fas fa-paperclip"></i>Adjuntar Imagen Grande del Recorrido

                       <input type="file" name="subirImgPeqRecorrido">
                   
                    </div>
                    <img class="previsualizarImgGrandeRecorrido img-fluid py-2" alt="">

                     <p class="help-block small">Dimensiones: 650px x 450px | Peso Max. 2MB | Formato: JPG o PNG</p>
                    
                  </div>
                
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
       
     </div>
    
  </div>
  
</div>

<!--=====================================
Modal Crear Recorrido 
======================================-->

<div class="modal" id="editarRecorrido">

  <div class="modal-dialog">

     <div class="modal-content">

        <form method="post" enctype="multipart/form-data"></form>

        <!-- Modal Header -->

            <div class="modal-header bg-info" >

                <h4 class="modal-title">
                  Editar Recorrido
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->

            <div class="modal-body">

              <div class="input-group md-3">
                
                <div class="input-group-append input-group-text">

                  <span class="fas fa-suitcase-rolling"></span>
                  
                </div>

                <input type="text" class="form-control" name="editartituloRecorrido" placeholder="Ingresa el Título del recorrido" required>

              </div>

              <!-- descripcion -->

              <div class="input-group my-3">

                <textarea name="editarDescripcionRecorrido" class="form-control" maxlength="220" placeholder="Ingrese la descripción del recorrido"></textarea>
                
              </div>
              <!-- subir foto pequeña -->
              <div class="input-group">

                  <div class="form-group my-2">

                    <div class="btn btn-default btn-file">

                       <i class="fas fa-paperclip"></i>Adjuntar Imagen Pequeñas del Recorrido

                       <input type="file" name="EditarsubirImgPeqRecorrido">
                   
                    </div>
                    <img class="EditarPrevisualizarImgRecorrido img-fluid py-2" alt="">

                     <p class="help-block small">Dimensiones: 455px x 280px | Peso Max. 2MB | Formato: JPG o PNG</p>
                    
                  </div>
                
              </div>
              <!-- subir foto grande -->

              <div class="input-group">

                  <div class="form-group my-2">

                    <div class="btn btn-default btn-file">

                       <i class="fas fa-paperclip"></i>Adjuntar Imagen Grande del Recorrido

                       <input type="file" name="EditarSubirImgPeqRecorrido">
                   
                    </div>
                    <img class="EditprevisualizarImgGrandeRecorrido img-fluid py-2" alt="">

                     <p class="help-block small">Dimensiones: 650px x 450px | Peso Max. 2MB | Formato: JPG o PNG</p>
                    
                  </div>
                
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
       
     </div>
    
  </div>
  
</div>