@extends("plantilla")

@section('content')


<div class="content-wrapper" style="min-height: 462px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Administradores</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Administradores</li>
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
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <button type="button" name="button" class="btn btn-sm bg-primary text-white" data-toggle="modal" data-target="#crearAdministrador">Crear un Nuevo Administrador</button>
                </h3>

                <div class="card-tools">

                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>

                </div>
              </div>

              <div class="card-body">

                  <table class="table table-bordered table-striped dt-responsive" width="100%" id="tablaAdministradores">

                    <thead>

                      <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th style="width:80px">Foto</th>
                        <th>Rol</th>
                        <th>Accines</th>
                      </tr>

                    </thead>



                    <tbody>
                      {{-- @foreach ($administracion as $key => $value)

                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$value["name"]}}</td>
                          <td>{{$value["email"]}}</td>
                          @php
                            if($value["foto"]==""){
                              echo '<td><img src="'.url('/').'/img/administrador/admin.png" alt="" class="img-fluid rounded-circle"></td>';
                            }else {
                              echo '<td><img src="'.url('/').'/'.$value["foto"].'" class="img-fluid rounded-circle"></td>';
                            }
                            if ($value["rol"]=="") {
                              echo '<td>administrador</td>';
                            }else {
                              echo '<td>'.$value["rol"].'</td>';
                            }
                          @endphp


                          <td>
                            <div class="btn-group">

                              <a href="{{url('/')}}/administradores/{{$value["id"]}}" name="editar" class="btn btn-warning btn-sm mr-1">
                                <i class="fas fa-pencil-alt text-white"></i>
                              </a>

                              <button  name="button" class="btn btn-danger btn-sm eliminarRegistro" action="{{url('/')}}/administradores/{{$value["id"]}}" method="DELETE" paginas="administradores">
                                @csrf
                                <i class="fas fa-trash text-white"></i>
                              </button>
                              {{-- <form action="{{url('/')}}/administradores/{{$value["id"]}}" method="post">

                                <input type="hidden" name="_method" value="DELETE">
                                @csrf

                                <button type="submit" name="buttoneliminar" class="btn btn-danger btn-sm ml-1">
                                  <i class="fas fa-trash text-white"></i>
                                </button>

                              </form> --}}


                            {{-- </div>
                          </td>
                        </tr> --}}
                      {{-- @endforeach --}}

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
  <div class="modal fade" id="crearAdministrador">

    <div class="modal-dialog">

      <div class="modal-content">
        {{-- inicio formulario --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf

              <div class="modal-header bg-info">

                <h5 class="modal-title">Crear Administrador</h5>

                <button type="button" class="close" data-dismiss="modal" name="button">
                  <span class="text-white">&times;</span>
                </button>

              </div>
              <div class="modal-body">



                  <div class="input-group mb-3">

                      <div class="input-group-appende input-group-text">
                          <i class="fas fa-user"></i>
                      </div>


                      <input id="name" type="text" placeholder="Escribir el Nombre" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror

                  </div>
                {{-- EMAIL --}}
                  <div class="input-group mb-3">

                    <div class="input-group-append input-group-text">
                        <i class="fas fa-envelope"></i>
                    </div>

                    <input id="email" type="email" placeholder="Escribir tu Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                  </div>
                  {{-- PASSWORD --}}
                  <div class="input-group mb-3">

                    <div class="input-group-append input-group-text">
                        <i class="fas fa-key"></i>
                    </div>
                    <input id="password" type="password" placeholder="Escribir tu Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                  </div>

                  <div class="input-group mb-3">

                    <div class="input-group-append input-group-text">
                        <i class="fas fa-key"></i>
                    </div>

                    <input id="password-confirm" type="password" placeholder="Confirmar Contraseña" class="form-control" name="password_confirmation" required autocomplete="new-password">

                  </div>


              </div>
              <div class="modal-footer justify-content-between">

                <div >
                   <button type="button" name="crearAdministrador" class="btn btn-danger">Cerrar</button>
                </div>
                <div>

                  <button type="submit" name="guardarAdministrador" class="btn btn-primary">Guardar</button>
                </div>

              </div>

        </form>

      </div>

    </div>

  </div>

@if (isset($status))

    @if ($status==200)
      @foreach ($Administrador as $key => $value)

        <div class="modal fade" id="editarAdministrador">

          <div class="modal-dialog">

            <div class="modal-content">
              {{-- inicio formulario --}}
              <form method="POST" action="{{url('/')}}/administradores/{{$value["id"]}}" enctype="multipart/form-data">
                  @method('PUT')
                  @csrf

                    <div class="modal-header bg-info">

                      <h5 class="modal-title">Editar Administrador</h5>

                      <button type="button" class="close" data-dismiss="modal" name="button">
                        <span class="text-white">&times;</span>
                      </button>

                    </div>
                    <div class="modal-body">

                        <div class="input-group mb-3">

                            <div class="input-group-appende input-group-text">
                                <i class="fas fa-user"></i>
                            </div>


                            <input id="name" type="text" placeholder="Escribir el Nombre" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $value["name"]}}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                      {{-- EMAIL --}}
                        <div class="input-group mb-3">

                          <div class="input-group-append input-group-text">
                              <i class="fas fa-envelope"></i>
                          </div>

                          <input id="email" type="email" placeholder="Escribir tu Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $value["email"] }}" required autocomplete="email">

                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror

                        </div>
                        {{-- PASSWORD --}}
                        <div class="input-group mb-3">

                          <div class="input-group-append input-group-text">
                              <i class="fas fa-key"></i>
                          </div>
                          <input id="password" type="password" placeholder="Escribir tu Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror

                        </div>
                        <input type="hidden" name="password_actual" value="{{$value["password"]}}">

                        {{-- ROL --}}
                        <div class="input-group mb-3">

                          <div class="input-group-append input-group-text">
                              <i class="fas fa-list-ul"></i>
                          </div>
                          <select class="form-control" name="rol" required>

                            @if ($value["rol"]=="administrador" || $value["rol"]=="")

                              <option value="administrador">administrador</option>
                              <option value="editor">editor</option>
                            @else
                              <option value="editor">editor</option>
                              <option value="administrador">administrador</option>

                            @endif

                          </select>

                        </div>
                        {{-- FOTO --}}
                        <hr class="pb-2">

                        <div class="form-group my-2 text-center">

                          <div class="btn btn-default btn-file">

                            <i class="fas fa-paperclip"></i>Adjuntar Foto

                            <input type="file" name="foto" >

                          </div>
                          <br>
                          @if ($value["foto"]=="")
                            <img src="{{url('/')}}/img/administrador/admin.png" class="previsualizar_foto img-fluid py-2 w-25 rounded-circle">
                          @else
                            <img src="{{url('/')}}/{{$value["foto"]}}" class="previsualizar_foto img-fluid py-2 w-25 rounded-circle">
                          @endif

                          <input type="hidden" value="{{$value["foto"]}}" name="imagen_actual">

                          <p class="help-block small">Dimensiones: 200px * 200px | Peso Max. 2MB | Formato: JPG o PNG</p>


                        </div>


                    </div>
                    <div class="modal-footer justify-content-between">

                      <div >
                         <button type="button" name="crearAdministrador" class="btn btn-danger">Cerrar</button>
                      </div>
                      <div>
                        <button type="submit" name="guardarAdministrador" class="btn btn-primary">Guardar</button>
                      </div>

                    </div>

              </form>

            </div>

          </div>

        </div>

      @endforeach

      <script>
          $("#editarAdministrador").modal();
      </script>
    @else
      {{$status}}
    @endif

@endif

@if (Session::has("no-validacion"))

  <script>
      notie.alert({ type: 2, text: '¡Hay campos no válidos en el formulario!', time: 10 })
  </script>

@endif

@if (Session::has("error"))

  <script>
      notie.alert({type:3, text: '¡Error en el gestor de administrador!', time:10})
  </script>

@endif


@if (Session::has("ok-eliminar"))

  <script>
      notie.alert({type:1, text: '¡El Administrador ha sido correctamente!', time:10})
  </script>

@endif

@if (Session::has("no-borrar"))

  <script>
      notie.alert({type:2, text: '¡El Administrador no se puede Borrar!', time:10})
  </script>

@endif



@endsection
