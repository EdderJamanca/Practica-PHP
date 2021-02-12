
<div class="content-wrapper" style="min-height: 179px;">

   <div class="preload"></div>
    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Habitación</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Inicio</a></li>

              <li class="breadcrumb-item active"><a href="#">Habitación</a></li>


            </ol>

          </div>

        </div>

      </div>

    </section>


    <section class="content">

      <div class="container-fluid">

        <div class="row">
            <!--=====================================
                        Listado de Habitación
            ======================================-->

            <div class="col-12 col-xl-5">

                <div class="card card-primary card-outline">

                  <!-- Header Card -->
                  <div class="card-header pl-2 pl-sm-3">

                      <a href="Habitaciones" class="btn btn-primary btn-sm">Crear nueva Habitación</a>

                      <!-- es el icono (-) para minimizar -->
                      <div class="card-tools">

                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
                        
                      </div>
                    
                  </div>

                  <!-- card body -->
                  <div class="card-body">
                      <!-- tabla categoria -->
                      <table class="table table-bordered table-striped tablaHabitacion" style="width: 100%">

                        <thead>

                          <th style="width: 10px">#</th>
                          <th>Categoría</th>
                          <th>Habitación</th>
                          <th style="width: 10px">Acciones</th>
                          
                        </thead>

                        <tbody>

<!--                           <tr>
                              <td>1</td>
                              <td>Suite</td>
                              <td>Oriental</td>
                              <td>
                                <button class="btn btn-secondary btn-sm">
                                  <i class="far fa-eye"></i>
                                </button>
                              </td>
                          </tr> -->

                        </tbody>

                        
                      </table>
                    
                  </div>

                  
                </div>
              
            </div>

            <!--=====================================
                        Editor de Habitación
            ======================================-->

            <?php 

                if (isset($_GET["id_h"])){

                  $habitaciones =HabitacionControlador:: ctrMostrarHabitacion($_GET["id_h"]);

                }else {

                  $habitaciones=null;

                }

             ?>

            <div class="col-12 col-xl-7">

               <div class="card card-primary card-outline">
                <!-- header card -->
                    <div class="card-header">
                      <?php if ($habitaciones !=null): ?>

                           <h5 class="card-title text-uppercase"><?php echo $habitaciones["tipo_c"]."/".$habitaciones["estilo"]; ?></h5>
                        
                      <?php endif ?>


                       <div class="card-tools">

                          <button type="button" class="btn btn-info btn-sm guardarHabitacion">

                              <i class="fas fa-save"></i>
                            
                          </button>
                          <?php if ($habitaciones != ""): 

                              $galeria =json_decode($habitaciones["galeria"],true);
                            ?>

                              <button type="button" class="btn btn-danger btn-sm eliminarHabitacion" idEliminar="<?php echo  $habitaciones["id_h"]?> " galeriaHabitacion="<?php echo implode(",", $galeria);?>" recorridoHabitacion="<?php echo $habitaciones["recorrido_virtual"]; ?> ">
                                <i class="fas fa-trash"></i>
                              </button>

                          <?php endif ?>

                         
                       </div>
                      
                    </div>
                 <!-- card body -->
                    <div class="card-body">
                        <?php if ($habitaciones !=0): ?>
                             <input type="hidden" class="idHabitacion justify-content-start" value="<?php echo $habitaciones["id_h"]; ?>">
                             <?php else: ?>
                            <input type="hidden" class="idHabitacion justify-content-start" value="">
                        <?php endif ?>


                       <!-- Categoria y nombre de la habitacion -->
                       <div class="d-flex flex-column flex-md-row justify-content-end mb-3">

                          <div class="form-inline mx-3 px-3 border border-left-0 border-top-0  border-bottom-0">

                              <p class="mr-sm-2">Elija la Categoría</p>

                              <?php if ($habitaciones !=0):?>

                                <select class="form-control seleccionarTipo" readonly style="width: 200px">
                                  <option value="<?php echo $habitaciones["id"].",".$habitaciones["tipo_c"]?>"><?php echo $habitaciones["tipo_c"]; ?></option>
                                </select>

                               <?php else: ?>

                                <?php 
                                      $Categoria=CategoriaControlador::ctrTraerCategoria(null,null);
                                 ?>

                                <select class="form-control seleccionarTipo" readonly>

                                  <?php foreach ($Categoria as $key => $value): ?>
                                       <option value="<?php echo $value["id"].",".$value["tipo_c"]; ?> "><?php echo $value["tipo_c"]; ?></option>
                                  <?php endforeach ?>

                                </select>
                                
                              <?php endif ?>


                            
                          </div>

                          <div class="form-inline mx-3">

                              <p class="mr-sm-2">Escribe el nombre de la Habitación</p>
                              <br>

                              <?php if ($habitaciones !=null): ?>


                                 <input type="text" class="form-control seleccionarEstilo" value="<?php echo $habitaciones["estilo"]; ?>">

                              <?php else: ?>

                                <input type="text" class="form-control seleccionarEstilo">

                              <?php endif ?>

                            
                          </div>
                         
                       </div>

                       <!-- Galeria -->
                       <div class="card rounded-lg card-secondary card-outline">

                         <div class="card-header pl-2 pl-sm-3">

                            <h5>Galería</h5>
                            
                         </div>

                         <div class="card-body">

                          <ul class="row p-0 vistaGaleria">

                            <?php if ($habitaciones !=null): ?>

                              <?php $galeria=json_decode($habitaciones["galeria"],true); ?>

                              <?php foreach ($galeria as $key => $value): ?>

                                <li class="col-12 col-md-6 col-lg-3 card px-3 rounded-0 shadow-none">

                                    <img src="<?php echo $value; ?>" class="card-img-top img-fluid" alt="">

                                    <div class="card-img-overlay p-0 pr-3">

                                        <button class="btn btn-danger btn-sm float-right shadow-sm quitarFotoAntigua" temporal="<?php echo $value; ?>">
                                          <i class="fas fa-times"></i>
                                        </button>
                                      
                                    </div>
                                  
                                </li>

                                
                              <?php endforeach ?>
                              
                            <?php endif ?>
                            
                          </ul>
                         
                         </div>

                         <input type="hidden" class="inputNuevaGaleria">

                         <input type="hidden" class="inputAntiguaGaleria" value="<?php echo implode(",",$galeria); ?>">

                         <div class="card-footer">
                          <!-- Al usar MULTIPLE permite cargar varias Imagenes -->
                            <input type="file" multiple id="galeria" class="d-none">

                            <label for="galeria" class="text-dark text-center py-5 border rounded bg-white w-100 subirGaleria">
                            Haz Click aquí o arrastra las imagenes <br>
                            <span class="help-block small"> Dimensiones: 940px * 480px | Peso Max. 2MB | Format: JPG o PNG</span>
                            </label>
                        
                         </div>
                         
                       </div>

                      <!-- video y 360 -->

                       <div class="row">

                          <div class="col-12 col-xl-6">

                              <div class="card rounded-lg card-outline card-secondary">

                                <div class="card-header">
                                  <h5>Video</h5>
                                </div>

                                <div class="card-body vistaVideo">

                                  <?php if ($habitaciones !=null): ?>

                                    <iframe width="100%" height="320" src="https://www.youtube.com/embed/<?php echo $habitaciones["video"];?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    
                                  <?php endif ?>

                                
                                </div>

                                <div class="card-footer">

                                  <div class="input-group">

                                      <div class="input-group-prepend">
                                        <span class="p-2 bg-secondary rounded-left small">youtube.com/embed</span>
                                      </div>
                                      <?php if ($habitaciones !=null): ?>
                                         <input type="text" class="form-control agregarVideo" placeholder="Agrege el código del vídeo" value="<?php echo $habitaciones["video"]; ?>">

                                       <?php else: ?>

                                          <input type="text" class="form-control agregarVideo" placeholder="Agrege el código del vídeo" value="">

                                      <?php endif ?>

                                    
                                  </div>
                                  
                                </div>
                                
                              </div>

                            
                          </div>

                          <!-- 360 -->
                          <div class="col-12 col-xl-6">

                             <div class="card rounded-lg card-secondary card-outline">

                                <div class="card-header pl-2 pl-sm-3">

                                  <h5>Recorrido Virtual:</h5>
                                  
                                </div>

                                <div class="card-body ver360">

                                  <?php if ($habitaciones !=null): ?>


                                    <div class="pano" id="360Antiguo" back="<?php echo $habitaciones["recorrido_virtual"]; ?>">

                                         <div class="controls" id="myPano">
                                                <a href="#" class="left">&laquo;</a>
                                                <a href="#" class="right">&raquo;</a>
                                           </div>
                                                        
                                     </div>
                                                    
                                  <?php endif ?>

<!--                                     <div class="pano" id="360Antiguo" back="vistas/img/suite/oriental-360.jpg">

                                        <div class="controls" id="myPano">
                                          <a href="#" class="left">&laquo;</a>
                                          <a href="#" class="right">&raquo;</a>
                                        </div>
                                      
                                    </div> -->
                                                                      
                                </div>

                                <div class="card-footer">

                                  <?php if ($habitaciones !=null): ?>

                                     <input type="hidden" class="antiguoRecorrido" value="<?php echo $habitaciones["recorrido_virtual"] ?>">
                                    <?php else: ?>

                                    <input type="hidden" class="antiguoRecorrido" value="">
                                    
                                  <?php endif ?>


                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="image360">
                                      <label class="custom-file-label" for="imagen360">Agregar imagen 360°</label>
                                      
                                    </div>
                                  
                                </div>
                               
                             </div>
                            
                          </div>
                         
                       </div>

                         <!-- descripcion -->
                        <div class="card rounded-lg card-secondary card-outline">

                           <div class="card-header pl-2 pl-sm-3">

                              <h5>Descripción:</h5>
                             
                           </div>
                           <div class="card-body">

                            <?php if ($habitaciones !=null): ?>

                                <textarea class="form-control rounded-0"  id="descripcionHabitacion" style="width: 100%"><?php echo $habitaciones["descripcion_h"]; ?></textarea>
                                   
                            <?php endif ?>

                              <textarea class="form-control rounded-0"  id="descripcionHabitacion" style="width: 100%"></textarea>
                             
                           </div>
                          
                        </div>

                      
                    </div>

                    <!-- footer card -->

                    <div class="card-footer">

                        <div class="preload">

                          <div class="card-tools float-right">

                             <button type="button" class="btn btn-info btn-sm guardarHabitacion">
                               <i class="fas fa-save"></i>
                             </button>
                              <?php if ($habitaciones != ""): 

                                  $galeria =json_decode($habitaciones["galeria"],true);
                                ?>

                                  <button type="button" class="btn btn-danger btn-sm eliminarHabitacion" idEliminar="<?php echo  $habitaciones["id_h"]?> " galeriaHabitacion="<?php echo implode(",", $galeria);?>" recorridoHabitacion="<?php echo $habitaciones["recorrido_virtual"]; ?> ">
                                    <i class="fas fa-trash"></i>
                                  </button>


                              <?php endif ?>
                            
                          </div>
                          
                        </div>
                      
                    </div>


               </div>
              
            </div>

        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
