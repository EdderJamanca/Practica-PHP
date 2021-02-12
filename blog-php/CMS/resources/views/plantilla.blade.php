<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blog del Viajero | CMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{$blog[0]["icono"]}}">
    {{--===========================
                Plugins CSS
     ===============================--}}

     {{-- Bootstrap 4 css--}}
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

     {{-- TAGS INPUT --}}
     <link rel="stylesheet" href="{{ url('/')}}/css/plugins/tagsinput.css">
     {{-- SUMMERNOTE --}}
     <link rel="stylesheet" href="{{ url('/')}}/css/plugins/summernote.css">
     {{-- NOTIE --}}
     <link rel="stylesheet" href="{{ url('/')}}/css/plugins/notie.css">
     {{-- DATA TABLE CSS --}}
     <link rel="stylesheet" href="{{ url('/')}}/css/plugins/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" href="{{ url('/')}}/css/plugins/dataTables.bootstrap.min.css">


     {{-- adminLTE --}}
     <link rel="stylesheet" href="{{ url('/')}}/css/plugins/OverlayScrollbars.min.css">
     <link rel="stylesheet" href="{{ url('/')}}/css/plugins/adminlte.min.css">


    {{--===========================
                Plugins JS
     ===============================--}}

     {{--font awesome --}}
     <script src="https://kit.fontawesome.com/57549a60e0.js" crossorigin="anonymous"></script>

          <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      <!-- Popper JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      {{-- TAGS INPUT --}}
      {{-- https://www.jqueryscript.net/form/Bootstrap-4-Tag-Input-Plugin-jQuery.html --}}
      <script src="{{ url('/')}}/js/plugins/tagsinput.js"></script>

      {{-- SUMMERNOTE --}}
	    {{-- https://summernote.org/ --}}
      <script src="{{ url('/')}}/js/plugins/summernote.js"></script>
      {{-- NOTIE --}}
      {{-- https://github.com/jaredreich/notie --}}
      <script src="{{ url('/')}}/js/plugins/notie.js"></script>
      {{-- SWEET ALERT --}}
      {{-- https://github.com/sweetalert2/sweetalert2 --}}
      <script src="{{url('/')}}/js/plugins/sweetalert.js"> </script>

      {{-- DATA TABLE JS --}}
      {{-- https://datatables.net/ --}}
      <script src="{{url('/')}}/js/plugins/jquery.dataTables.min.js"></script>
      <script src="{{url('/')}}/js/plugins/dataTables.bootstrap4.min.js"></script>
      <script src="{{url('/')}}/js/plugins/dataTables.responsive.min.js"></script>
      <script src="{{url('/')}}/js/plugins/responsive.bootstrap.min.js"></script>
      <!-- adminLTE -->
      <script src="{{ url('/')}}/js/plugins/jquery.overlayScrollbars.min.js"></script>
      <script src="{{ url('/')}}/js/plugins/adminlte.js"></script>

      </head>
      <body class="hold-transition sidebar-mini layout-fixed">


        <div class="wrapper">
            @include("modulos.cabecera")
            @include("modulos.sidebar")
            @yield('content')
            @include("modulos.footer")
        </div>

      <input type="hidden" name="ruta" value="{{url('/')}}" class="ruta">
      <script src="{{ url('/')}}/js/codigo.js"></script>
      </body>
</html>
