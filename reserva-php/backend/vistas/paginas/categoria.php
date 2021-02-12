
<div class="content-wrapper" style="min-height: 179px;">

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Categoría</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Inicio</a></li>

              <li class="breadcrumb-item"><a href="#">Categoría</a></li>


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
                	 <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearCategoria">Crear nueva Categoría</button>
                </h3>

              </div>

              <div class="card-body">

                <table class="table table-bordered table-striped dt-responsive tableCategoria" width="100%">

                	<thead>

                		<tr>

                			<th style="width: 10px">#</th>
                			<th>Ruta</th>
                			<th>Color</th>
                			<th>tipo</th>
                			<th>Imagen</th>
                			<th>Descripción</th>
                      <th>Carácteristicas</th>
                      <th>Continental Temp.Alta</th>
                      <th>Continental Temp.Baja</th>
                      <th>Americano Temp.Alta</th>
                      <th>Americano Temp.Baja</th>
                      <th>Acciones</th>
                			
                		</tr>

                	</thead>
                	<tbody>

<!--                     <tr>
                        <td>1</td>
                        <td>habitacion-tipo-suite</td>
                        <td>
                          <i style="color:#847059" class="fas fa-square"></i>
                        </td>
                        <td>
                          Sute
                        </td>
                        <td>
                          <img src="vistas/img/suite/retro04.jpg" class="img-fluid" alt="">
                        </td>
                        <td>
                          Lorem ipsum dolor sit amet
                        </td>
                        <td>

                            <div class="badge badge-secondary">

                                <i class="fas fa-bed"></i>
                                cama 2x2
                              
                            </div>

                            <div class="badge badge-secondary">

                              <i class="fas fas-tv"></i>
                              TV de 42 Pulg
                              
                            </div>

                            <div class="badge badge-secondary">

                                <i class="fas fa-tint"></i>
                                Agua Caliente
                              
                            </div>

                            <div class="badge badge-secondary">

                              <i class="fas ta-water"></i>
                              Jacuzzi
                              
                            </div>

                            <div class="badge badge-secondary">

                                <i class="fas fa-toilet"></i>
                                Baño privado
                              
                            </div>

                            <div class="badge badge-secondary">

                                <i class="fas fa-couch"></i>
                                Sofá
                              
                            </div>

                            <div class="badge badge-secondary">

                                <i class="far fa-image"></i>
                                Balcón
                              
                            </div>

                            <div class="badge badge-secondary">

                               <i class=" fas fa-wifi"></i>
                               Servicio Wifi
                              
                            </div>
                            <td>$ <?php echo number_format(350000) ?></td>
                            <td>$ <?php echo number_format(300000) ?></td>
                            <td>$ <?php echo number_format(420000) ?></td>
                            <td>$ <?php echo number_format(380000) ?></td>

                            <td>

                               <div class="btn-group">

                                  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarCategoria"><i class="fas fa-pencil-alt text-white"></i></button>
                                  <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                 
                               </div>
                              
                            </td>
                          
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
Modal Crear Categoria
======================================-->

<div class="modal formulario" id="crearCategoria">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

        <div class="modal-header bg-success">

          <h4 class="modal-title">Crear Categoría</h4>

          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          
        </div>

        <div class="modal-body">

         <!--  <input type="hidden" name="editarid"> -->
          <!-- NOMBRE  -->
          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">

              <span class="fas fa-list-ol"></span>
              
            </div>

            <input type="text" class="form-control" name="rutaCategoria" placeholder="Ingrese la ruta de la Categoría" required>
            
          </div>

           <!-- Color Picker -->

          <div class="input-group colorPicker mb-3">

            <div class="input-group-append">

              <span class="input-group-text  colorpicker-input-addon"><i></i></span>

            </div>

            <input type="text" class="form-control"  name="colorCategoria" placeholder="&#xf0a5; Elige color" style="font-family: Source Sans Pro,Font Awesome\ 5 Free" required  value="#DD0F20FF">
            
          </div>
          <!-- tipo de vategoria -->
          <div class="input-group mb-3">

              <div class="input-group-append input-group-text">

                    <span class="fas fa-certificate"></span>
                
              </div>

              <input type="text" class="form-control" name="tipoCategoria" placeholder="Ingreso el tipo de categoría" required>
            
          </div>

          <hr class="pb-2">

          <div class="form-group ">

            <div class="form-group my-2">

                <div class="btn btn-default btn-file">

                    <i class="fas fa-paperclip"></i> Adjuntar Imagen de la Categoría

                    <input type="file" name="subirImgCategoria">
                  
                </div>

                <img src="" class="previsualizarImgCategoria img-fluid py-2" alt="">

                <p class="small">Dimensiones: 359px * 254px | Peso Max. 2MB | Formato: JPG o PNG</p>
              
            </div>

               <p>Esciba la descripción de la Categoría</p>
               <textarea name="descripcionCategoria" class="p-3" style="width: 100%" maxlength="30"></textarea>
            
          </div>

          <hr class="pb-2">

          <p>Caracteristicas de la categoría</p>

          <div class="form-check">
            <label class="form-check-label"></label>
            <input class="CrearCheckbox ml-3" type="checkbox" value="Cama 2 x 2, fas fa-bed">
            <span class="badge badge-secondary"><i class="fas fa-bed mr-1"></i>Cama 2 x 2</span>
            
          </div>
          <div class="form-check">
            <label class="form-check-label"></label>
            <input class="CrearCheckbox ml-3" type="checkbox" value="TV de 42 Pulg, fas fa-tv">
            <span class="badge badge-secondary"><i class="fas fa-tv mr-1"></i>TV de 42 Pulg</span>         
          </div>

          <div class="form-check">
            <label class="form-check-label"></label>
            <input class="CrearCheckbox ml-3" type="checkbox" value="Agua Caliente, fas fa-tint">
            <span class="badge badge-secondary"><i class="fas fa-tint mr-1"></i>Agua Caliente</span>         
          </div>

          <div class="form-check">
            <label class="form-check-label"></label>
            <input class="CrearCheckbox ml-3" type="checkbox" value="Jacuzzi, fas fa-water">
            <span class="badge badge-secondary"><i class="fas fa-water mr-1"></i>Jacuzzi</span>         
          </div>

          <div class="form-check">
            <label class="form-check-label"></label>
            <input class="CrearCheckbox ml-3" type="checkbox" value="Baño privado, fas fa-toilet">
            <span class="badge badge-secondary"><i class="fas fa-toilet mr-1"></i>Baño privado</span>         
          </div>

          <div class="form-check">
            <label class="form-check-label"></label>
            <input class="CrearCheckbox ml-3" type="checkbox" value="Sofá, fas fa-couch">
            <span class="badge badge-secondary"><i class="fas fa-couch mr-1"></i>Sofá</span>         
          </div>

          <div class="form-check">
            <label class="form-check-label"></label>
            <input class="CrearCheckbox ml-3" type="checkbox" value="Balcón, far fa-image">
            <span class="badge badge-secondary"><i class="far fa-image mr-1"></i>Balcón</span>         
          </div>

          <div class="form-check">
            <label class="form-check-label"></label>
            <input class="CrearCheckbox ml-3" type="checkbox" value="Servicio wifi, fas fa-wifi">
            <span class="badge badge-secondary"><i class="fas fa-wifi mr-1"></i>Servicio Wifi</span>         
          </div>

          <input type="hidden" name="caracteristicasCategoria">

          <hr class="pb-2">

          <div class="input-group mb-3">

             <div class="input-group-append input-group-text">

                <span class="fas fa-dollar-sign"></span>
               
             </div>

             <input type="number" min="0" step="any" class="form-control" name="continental_alta" placeholder="Precio Plan Continental temporada alta" required>
            
          </div>

          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">

              <span class="fas fa-dollar-sign"></span>
              
            </div>
            <input type="number" min="0" step="any" class="form-control" name="continental_baja" placeholder="Precio Plan Continental Temporada baja" required>
            
          </div>

          <div class="input-group mb-3">

             <div class="input-group-append input-group-text">
                  <span class="fas fa-dollar-sign"></span>               
             </div>

             <input type="number" min="0" step="any" class="form-control" name="americano_alta" placeholder="Precio Plan Americano Temporada alta" required>
            
          </div>

          <div class="input-group mb-3">

             <div class="input-group-append input-group-text">
                  <span class="fas fa-dollar-sign"></span>               
             </div>

             <input type="number" min="0" step="any" class="form-control" name="americano_baja" placeholder="Precio Plan Americano Temporada baja" required>
            
          </div>
          
        </div>
       <!--MODAL FOOTER -->
        <div class="modal-footer d-flex justify-content-between">

          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>

          <div>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
          
        </div>
        <?php 
              $crearCategoria = new CategoriaControlador();
              $crearCategoria -> ctrGuardarCategoria();
         ?>
        
      </form>
      
    </div>
    
  </div>
  
</div>

<!--=====================================
Modal Editar Categoria
======================================-->

<div class="modal" id="editarCategoria">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post"  enctype="multipart/form-data">

        <div class="modal-header bg-success">

          <h4 class="modal-title">Editar Categoría</h4>

          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          
        </div>

        <div class="modal-body">

          <input type="hidden" name="editarid">
          <!-- NOMBRE  -->
          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">

              <span class="fas fa-list-ol"></span>
              
            </div>

            <input type="text" class="form-control" name="editarRutaCategoria" placeholder="Ingrese la ruta de la Categoría" required>
            
          </div>

           <!-- Color Picker -->

          <div class="input-group colorPicker mb-3">

            <div class="input-group-append">

              <span class="input-group-text  colorpicker-input-addon"><i></i></span>

            </div>

            <input type="text" class="form-control"  name="editarColorCategoria" placeholder="&#xf0a5; Elige color" style="font-family: Source Sans Pro,Font Awesome\ 5 Free" required  value="#DD0F20FF">
            
          </div>
          <!-- tipo de vategoria -->
          <div class="input-group mb-3">

              <div class="input-group-append input-group-text">

                    <span class="fas fa-certificate"></span>
                
              </div>

              <input type="text" class="form-control" name="editarTipoCategoria" placeholder="Ingreso el tipo de categoría" required>
            
          </div>

          <hr class="pb-2">

          <div class="form-group">

            <div class="input-group my-2 px-auto">

                <div class="btn btn-default btn-file">

                    <i class="fas fa-paperclip"></i> Adjuntar Imagen de la Categoría

                    <input type="file" name="EditarImgCategoria">
                  
                </div>
                <input type="hidden" name="editarRutaActual">

                <img src="" class="EditarPrevisualizarImgCategoria img-fluid py-2" alt="">

                <p class="small ">Dimensiones: 359px * 254px | Peso Max. 2MB | Formato: JPG o PNG</p>
              
            </div>

               <p>Esciba la descripción de la Categoría</p>
               <textarea name="EditarDescripcionCategoria" class="p-3" style="width: 100%" maxlength="30"></textarea>
            
          </div>

          <hr class="pb-2">

          <p>Caracteristicas de la categoría</p>

          <div class="form-check">
            <label class="form-check-label"></label>
            <input class="EditarCheckbox ml-3" type="checkbox" value="Cama 2 x 2, fas fa-bed">
            <span class="badge badge-secondary"><i class="fas fa-bed mr-1"></i>Cama 2 x 2</span>
            
          </div>
          <div class="form-check">
            <label class="form-check-label"></label>
            <input class="EditarCheckbox ml-3" type="checkbox" value="TV de 42 Pulg, fas fa-tv">
            <span class="badge badge-secondary"><i class="fas fa-tv mr-1"></i>TV de 42 Pulg</span>         
          </div>

          <div class="form-check">
            <label class="form-check-label"></label>
            <input class="EditarCheckbox ml-3" type="checkbox" value="Agua Caliente, fas fa-tint">
            <span class="badge badge-secondary"><i class="fas fa-tint mr-1"></i>Agua Caliente</span>         
          </div>

          <div class="form-check">
            <label class="form-check-label"></label>
            <input class="EditarCheckbox ml-3" type="checkbox" value="Jacuzzi, fas fa-water">
            <span class="badge badge-secondary"><i class="fas fa-water mr-1"></i>Jacuzzi</span>         
          </div>

          <div class="form-check">
            <label class="form-check-label"></label>
            <input class="EditarCheckbox ml-3" type="checkbox" value="Baño privado, fas fa-toilet">
            <span class="badge badge-secondary"><i class="fas fa-toilet mr-1"></i>Baño privado</span>         
          </div>

          <div class="form-check">
            <label class="form-check-label"></label>
            <input class="EditarCheckbox ml-3" type="checkbox" value="Sofá, fas fa-couch">
            <span class="badge badge-secondary"><i class="fas fa-couch mr-1"></i>Sofá</span>         
          </div>

          <div class="form-check">
            <label class="form-check-label"></label>
            <input class="EditarCheckbox ml-3" type="checkbox" value="Balcón, far fa-image">
            <span class="badge badge-secondary"><i class="far fa-image mr-1"></i>Balcón</span>         
          </div>

          <div class="form-check">
            <label class="form-check-label"></label>
            <input class="EditarCheckbox ml-3" type="checkbox" value="Servicio wifi, fas fa-wifi">
            <span class="badge badge-secondary"><i class="fas fa-wifi mr-1"></i>Servicio Wifi</span>         
          </div>

          <input type="hidden" name="EditarCaracteristicasCategoria">

          <hr class="pb-2">

          <div class="input-group mb-3">

             <div class="input-group-append input-group-text">

                <span class="fas fa-dollar-sign"></span>
               
             </div>

             <input type="number" min="0" step="any" class="form-control" name="EditarContinental_alta" placeholder="Precio Plan Continental temporada alta" required>
            
          </div>

          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">

              <span class="fas fa-dollar-sign"></span>
              
            </div>
            <input type="number" min="0" step="any" class="form-control" name="EditarContinental_baja" placeholder="Precio Plan Continental Temporada baja" required>
            
          </div>

          <div class="input-group mb-3">

             <div class="input-group-append input-group-text">
                  <span class="fas fa-dollar-sign"></span>               
             </div>

             <input type="number" min="0" step="any" class="form-control" name="EditarAmericano_alta" placeholder="Precio Plan Americano Temporada alta" required>
            
          </div>

          <div class="input-group mb-3">

             <div class="input-group-append input-group-text">
                  <span class="fas fa-dollar-sign"></span>               
             </div>

             <input type="number" min="0" step="any" class="form-control" name="EditarAmericano_baja" placeholder="Precio Plan Americano Temporada baja" required>
            
          </div>
          
        </div>
       <!--MODAL FOOTER -->
        <div class="modal-footer d-flex justify-content-between">

          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>

          <div>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
          
        </div>
          <?php 
              $actualizarCategoria = new CategoriaControlador();
              $actualizarCategoria -> ctrActualizarCategoria();
         ?>
        
      </form>
      
    </div>
    
  </div>
  
</div>
