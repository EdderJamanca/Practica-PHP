@extends("plantilla")

@section('content')

<div class="content-wrapper" style="min-height: 462px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Blog</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Blog</li>
            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @foreach ($blog as $element)

            @endforeach

            <form action="{{url('/')}}/blog/{{$element->id}}" method="post" enctype="multipart/form-data">
              @method('PUT')
              @csrf
                <!-- Default box -->

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Title</h3>

                    <div class="card-tools">

                          <button type="submit" name="button" class="btn btn-md btn-primary float-right">Guardar Cambios</button>

                    </div>
                  </div>


                      <div class="card-body">

                            <div class="row">

                                  <div class="col-lg-7">

                                        <div class="card">

                                            <div class="card-body">
                                                   {{-- DOMINIO --}}
                                                  <div class="input-group mb-3">

                                                      <div class="input-group-append">

                                                          <span class="input-group-text">Dominio</span>

                                                      </div>

                                                      <input type="text" class="form-control" name="dominio" value="{{$element->dominio}}">

                                                  </div>
                                                  {{-- SERVIDOR --}}
                                                  <div class="input-group mb-3">

                                                    <div class="input-group-append">
                                                          <span class="input-group-text">Servidor</span>
                                                    </div>

                                                    <input type="text" class="form-control" name="servidor" value="{{$element->servidor}}">

                                                  </div>
                                                  {{-- TITULO --}}
                                                  <div class="input-group mb-3">

                                                    <div class="input-group-append">
                                                          <span class="input-group-text">Titulo</span>
                                                    </div>

                                                    <input type="text" class="form-control" name="titulo" value="{{$element->titulo}}">

                                                  </div>
                                                  {{-- Descripcion --}}
                                                  <div class="input-group mb-3">

                                                    <div class="input-group-append">
                                                          <span class="input-group-text">Descripcion</span>
                                                    </div>

                                                     <textarea class="form-control" name="descripcion" rows="6" cols="80">{{$element->descripcion}}</textarea>

                                                  </div>
                                                      {{-- PALABRAS CLAVES --}}
                                                  <hr class="pb-2">

                                                  <div class="form-group mb-3">

                                                      <label>Palabras Claves</label>
                                                      @php
                                                        $tags=json_decode($element->palabras_claves,true);
                                                        $palabras_claves="";
                                                        foreach ($tags as $key => $value) {
                                                          $palabras_claves.=$value.",";
                                                        }

                                                      @endphp
                                                        <input type="text" class="form-control" name="palabras_claves" value="{{$palabras_claves}}" data-role="tagsinput" required>

                                                  </div>

                                                  {{-- REDES SOCIALES --}}
                                                  <hr class="pb-2">

                                                  <label>Redes Sociales</label>

                                                  <div class="row">

                                                    <div class="col-5">

                                                        <div class="input-group mb-3">

                                                            <div class="input-group-append">

                                                                <span class="input-group-text">Icono</span>

                                                            </div>

                                                            <select class="form-control" id="icono_red">

                                                              <option value="fab fa-facebook-f, #1475E0">
                                                                Facebook
                                                              </option>

                                                              <option value="fab fa-instagram, #B18768">
                                                                Instagram
                                                              </option>

                                                              <option value="fab fa-twitter, #00A6FF">
                                                                Twitter
                                                              </option>

                                                              <option value="fab fa-youtube, #F95F62">
                                                                Youtube
                                                              </option>

                                                              <option value="fab fa-snapchat-ghost, #FF9052">
                                                                Snapchat
                                                              </option>


                                                            </select>


                                                        </div>

                                                    </div>

                                                    {{-- FIN 5 COL --}}
                                                    <div class="col-5">

                                                       <div class="input-group mb-3">

                                                          <div class="input-group-append">

                                                              <span class="input-group-text">Url</span>

                                                          </div>
                                                          <input type="text" class="form-control" id="url_red">
                                                       </div>

                                                    </div>
                                                    {{-- FIN 5 COL --}}
                                                    <div class="col-2">

                                                      <button type="button" class="btn btn-primary w-100 AgregarRed">Agregar</button>

                                                    </div>
                                                    {{-- FIN 2 COL --}}

                                                  </div>
                                                  {{-- FIN ROW --}}
                                                  <div class="row listanuevo">



                                                          @php
                                                           echo "<input type='hidden' name='redes_sociales' value='".$element->redes_sociales."' id='listraRed'>";

                                                            $redes=json_decode($element->redes_sociales,true);

                                                            foreach ($redes as $key => $value) {

                                                              echo '
                                                              <div class="col-lg-12">
                                                                   <div class="input-group mb-3">

                                                                            <div class="input-group-prepend">

                                                                               <div class="input-group-text" style="background:'.$value["background"].'">

                                                                                 <i class="text-white '.$value["icono"].'"></i>

                                                                               </div>

                                                                            </div>
                                                                            <input type="text" class="form-control" value="'.$value["url"].'">

                                                                            <div class="input-group-prepend">

                                                                               <div class="input-group-text" style="cursor:pointer">

                                                                                 <span class="bg-danger px-2 rounded-circle eliminarRed" red="'.$value["icono"].'" url="'.$value["url"].'">&times;</span>

                                                                               </div>

                                                                            </div>

                                                                      </div>

                                                              </div>  ';

                                                            }

                                                          @endphp

                                                  </div>

                                            </div>

                                        </div>

                                  </div>

                                  <div class="col-lg-5">

                                        <div class="card">

                                          <div class="card-body">

                                                <div class="row">

                                                    <div class="col-lg-12">
                                                        {{-- cambiar logo --}}
                                                        <div class="form-group my-2 text-center">

                                                            <div class="btn btn-default btn-file mb-3">

                                                                <i class="fas fa-paperclip"></i>Adjuntar Imagen de Logo
                                                                <input type="file" name="logo" >
                                                                <input type="hidden" name="logo_actual" value="{{$element->logo}}">

                                                            </div><br>
                                                            <img src="{{url('/')}}/{{$element->logo}}" class="img-fluid py-2 bg-secondary previsualizar_logo">
                                                            <p class="help-block small mt-3">Dimensiones: 700px * 200px | Peso Max. 2MB | Formato: JPG o PNG</p>

                                                        </div>
                                                        <hr class="mb-2">
                                                        {{-- cambiar portada --}}
                                                        <div class="form-group my-2 text-center">

                                                            <div class="btn btn-default btn-file mb-3">

                                                                <i class="fas fa-paperclip"></i>Adjuntar Imagen de Portada
                                                                <input type="file" name="portada" >
                                                                <input type="hidden" name="portada_actual" value="{{$element->portada}}">

                                                            </div><br>
                                                            <img src="{{url('/')}}/{{$element->portada}}" class="img-fluid py-2 previsualizar_portada">
                                                            <p class="help-block small mt-3">Dimensiones: 700px * 420px | Peso Max. 2MB | Formato: JPG o PNG</p>

                                                        </div>
                                                        <hr class="mb-2">
                                                        {{-- cambiar Icono --}}
                                                        <div class="form-group my-2 text-center">

                                                            <div class="btn btn-default btn-file mb-3">

                                                                <i class="fas fa-paperclip"></i>Adjuntar Imagen de Icono
                                                                <input type="file" name="icono" >
                                                                <input type="hidden" name="icono_actual" value="{{$element->icono}}">

                                                            </div>
                                                            <br>
                                                            <img src="{{url('/')}}/{{$element->icono}}" class="img-fluid rounded-circle py-2 previsualizar_icono">
                                                            <p class="help-block small mt-3">Dimensiones: 150px * 150px | Peso Max. 2MB | Formato: JPG o PNG</p>

                                                        </div>

                                                    </div>

                                                </div>

                                          </div>

                                        </div>

                                  </div>
                                  {{-- SOBRE MI INTRO --}}
                                  <div class="col-lg-6">

                                        <div class="card">

                                          <div class="card-body">

                                            <label>Sobre mi <span class="small">(Intro)</span> </label>
                                            <textarea class="form-control summernote_sm" name="sobre_mi" rows="10" cols="30">{{$element->sobre_mi}}</textarea>

                                          </div>

                                        </div>

                                  </div>
                                  {{-- SOBRE MI COMPLETO --}}
                                  <div class="col-lg-6">

                                        <div class="card">

                                          <div class="card-body">

                                            <label>Sobre mi <span class="small">(Completo)</span> </label>
                                            <textarea class="form-control summernote_smc" name="sobre_mi_completo" rows="10" cols="30">{{$element->sobre_mi_completo}}</textarea>


                                          </div>

                                        </div>

                                  </div>


                            </div>
                      </div>


                  <!-- /.card-body -->
                  <div class="card-footer">

                    <button type="submit" name="button" class="btn btn-md btn-primary float-right">Guardar Cambios</button>

                  </div>

                  <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  @if (Session::has("no-validacion"))

    <script>

       notie.alert({
         type:2,
         text:"¡Hay campos no validados en el formulario!",
         time:7
       })

    </script>

  @endif
  @if (Session::has("error"))

    <script>

       notie.alert({
         type:3,
         text:"¡error en el gestor de blog!",
         time:7
       })

    </script>

  @endif
  @if (Session::has("no-validacion-imagen"))

    <script>

       notie.alert({
         type:3,
         text:"¡La imagen debe estar en formato JPG o PNG y debe pesar no máss de 2MB_!",
         time:7
       })

    </script>

  @endif
  @if (Session::has("actualizado"))

    <script>

       notie.alert({
         type:1,
         text:"¡El blog a sido actualizado correctamente!",
         time:7
       })

    </script>

  @endif
















@endsection
