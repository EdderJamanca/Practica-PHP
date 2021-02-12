<aside class="main-sidebar sidebar-dark-primary elevation-4" >
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{url('/')}}/{{$blog[0]["icono"]}}" alt="juanito travel" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Juanito Travel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition"><div class="os-resize-observer-host"><div class="os-resize-observer observed" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer observed"></div></div><div class="os-content-glue" style="margin: 0px -8px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible os-viewport-native-scrollbars-overlaid" style="overflow-y: scroll; right: 0px; bottom: 0px;"><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('/')}}/vistas/img/usuarios/default.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Administrador</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!---====================================
              BOTN BLOG
        =========================================-->
              <li class="nav-item">

                    <a href="{{url('/')}}" class="nav-link">

                      <i class="nav-icon fas fa-home"></i>
                      <p>Blog</p>

                    </a>
              </li>

        <!---====================================
              BOTON ADMINISTRADRES
        =========================================-->
              <li class="nav-item">

                    <a href="{{url('/administradores')}}" class="nav-link">

                      <i class="nav-icon fas fa-users-cog"></i>
                      <p>Administradores</p>

                    </a>
              </li>
        <!---====================================
              BOTON CATEGORIAS
        =========================================-->
              <li class="nav-item">

                    <a href="{{url('/categoria')}}" class="nav-link">

                      <i class="nav-icon fas fa-list"></i>
                      <p>Categorias</p>

                    </a>
              </li>
          <!---====================================
                BOTON ARTICULOS
          =========================================-->
              <li class="nav-item">

                    <a href="{{url('/articulos')}}" class="nav-link">

                      <i class="nav-icon fas fa-sticky-note"></i>
                      <p>Articulos</p>

                    </a>
              </li>
          <!---====================================
                BOTON BANNER
          =========================================-->
              <li class="nav-item">

                    <a href="{{url('/banner')}}" class="nav-link">

                      <i class="nav-icon fas fa-image"></i>
                      <p>Banner</p>

                    </a>
              </li>
        <!---====================================
              BOTON anuncios
        =========================================-->
              <li class="nav-item">

                    <a href="{{url('/anuncios')}}" class="nav-link">

                      <i class="nav-icon fas fa-bullhorn"></i>
                      <p>Anuncios</p>

                    </a>
              </li>
        <!---====================================
                  SISIO WEB
        =========================================-->
              <li class="nav-item">

                    <a href="{{substr(url('/'),0,-11)}}" class="nav-link active" target="_blank">

                      <i class="nav-icon fas fa-globe"></i>
                      <p>Sitio Web</p>

                    </a>
              </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 36.9142%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
    <!-- /.sidebar -->
  </aside>
