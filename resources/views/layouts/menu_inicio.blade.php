<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ str_replace("_", " ", config('app.name', 'TecnoBot')) }}</title>

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        
        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script rel="javascript" type="text/javascript" src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
        <!-- Script del dashboard -->
        <script src="{{ asset('js/TB/form/MenuInicio.js') }}" defer></script>
        
        @yield("headJS")
    </head>
    <body class="hold-transition sidebar-mini">
        <script type="text/javascript">
            $(document).ready(function() {
                const mi = new MenuInicio("{{ url('/') }}");
                
                //Ini Menu Administracion Plataforma
                var arrMI = mi.ObtenerMenuItem(1, {{ session('id_usuario') }}, {{ session('id_perfil') }});
                
                $.each(arrMI.data, function(idx, opt) {
                    if(opt.cant_hijo > 0) {
                        if(opt.desplegable) {
                            if(opt.padre == 0) {
                                $md = mi.CrearMenuDesplegable(opt.idMenu_Item, opt.glosa, opt.habilitado);
                                $("#ulMenuSistema").append($md);
                            } else {
                                $md = mi.CrearMenuDesplegable(opt.idMenu_Item, opt.glosa, opt.habilitado);
                                $("#ul_" + opt.padre).append($md);
                            }
                        } else {
                            $md = mi.CrearMenuDesplegable(opt.idMenu_Item, opt.glosa, opt.habilitado);
                            $("#ul_" + opt.padre).append($md);
                        }
                    } else {
                        if(opt.desplegable) {
                            $mi = mi.CrearMenuItem(opt.glosa, opt.link, opt.habilitado);
                            $("#ulMenuSistema").append($mi);
                        } else {
                            if(opt.padre == 0) {
                                $mi = mi.CrearMenuItem(opt.glosa, opt.link, opt.habilitado);
                                $("#ulMenuSistema").append($mi);
                            } else {
                                $mi = mi.CrearMenuItem(opt.glosa, opt.link, opt.habilitado);
                                $("#ul_" + opt.padre).append($mi);
                            }
                        }
                    }
                });
                
                if(arrMI != "") {
                    if(arrMI.data.length > 0) {
                        $("#divDivisor").show();
                    }
                }
                
                //Fin Menu Administracion Plataforma
                
                //Ini Menu Administracion Sistema
                var arrMI = mi.ObtenerMenuItem(2, {{ session('id_usuario') }}, {{ session('id_perfil') }});
                
                $.each(arrMI.data, function(idx, opt) {
                    if(opt.cant_hijo > 0) {
                        if(opt.desplegable) {
                            if(opt.padre == 0) {
                                $md = mi.CrearMenuDesplegable(opt.idMenu_Item, opt.glosa, opt.habilitado);
                                $("#ulMenuAdministracion").append($md);
                            } else {
                                $md = mi.CrearMenuDesplegable(opt.idMenu_Item, opt.glosa, opt.habilitado);
                                $("#ul_" + opt.padre).append($md);
                            }
                        } else {
                            $md = mi.CrearMenuDesplegable(opt.idMenu_Item, opt.glosa, opt.habilitado);
                            $("#ul_" + opt.padre).append($md);
                        }
                    } else {
                        if(opt.desplegable) {
                            $mi = mi.CrearMenuItem(opt.glosa, opt.link, opt.habilitado);
                            $("#ulMenuAdministracion").append($mi);
                        } else {
                            if(opt.padre == 0) {
                                $mi = mi.CrearMenuItem(opt.glosa, opt.link, opt.habilitado);
                                $("#ulMenuAdministracion").append($mi);
                            } else {
                                $mi = mi.CrearMenuItem(opt.glosa, opt.link, opt.habilitado);
                                $("#ul_" + opt.padre).append($mi);
                            }
                        }
                    }
                });
                
                if(arrMI != "") {
                    if(arrMI.data.length == 0) {
                        $("#divDivisor").hide();
                    }
                }
                //Fin Menu Administracion Sistema
                
                //Menu Principal
                var arrMI = mi.ObtenerMenuItem(3, {{ session('id_usuario') }}, {{ session('id_perfil') }});
                
                $.each(arrMI.data, function(idx, opt) {
                    if(opt.cant_hijo > 0) {
                        if(opt.desplegable) {
                            if(opt.padre == 0) {
                                $md = mi.CrearMenuItemPrincipalDesplegable(opt.idMenu_Item, opt.glosa, opt.habilitado);
                                $("#ulMenuPrincipal").append($md);
                            } else {
                                $md = mi.CrearMenuItemSecundarioDesplegable(opt.idMenu_Item, opt.glosa, opt.habilitado);
                                $("#divDDM_" + opt.padre).append($md);
                            }
                        } else {
                            $md = mi.CrearMenuItemSecundarioDesplegable(opt.idMenu_Item, opt.glosa, opt.habilitado);
                            $("#divDDM_" + opt.padre).append($md);
                        }
                    } else {
                        if(opt.desplegable) {
                            $mi = mi.CrearMenuItemPrincipal(opt.glosa, opt.link, opt.habilitado);
                            $("#ulMenuPrincipal").append($mi);
                        } else {
                            if(opt.padre == 0) {
                                $mi = mi.CrearMenuItemPrincipal(opt.glosa, opt.link, opt.habilitado);
                                $("#ulMenuPrincipal").append($mi);
                            } else {
                                $mi = mi.CrearMenuItemPrincipalDesplegableSecundario(opt.glosa, opt.link, opt.habilitado);
                                $("#divDDM_" + opt.padre).append($mi);
                            }
                        }
                    }
                });
                //Menu Principal
            })
        </script>
        
        @yield("bodyJS")
        
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul id="ulMenuPrincipal" class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <!--
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ url(config('app.paginainiurl')) }}" class="nav-link">{{ config('app.paginaininom') }}</a>
                    </li>
                    -->
                </ul>
                
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ (session('pagina_inicio') == "" ? url(config('app.paginainiurl')) : url(session('pagina_inicio'))) }}" class="brand-link">
                    <img src="{{ asset('adminlte/img/TBLogoBlanco.png') }}" alt="TecnoBot Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{ str_replace("_", " ", config('app.name', 'TecnoBot')) }}</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            @switch(session('persona_sexo'))
                                @case(2)
                                    <img src="{{ asset('adminlte/img/avatar5.png') }}" class="img-circle elevation-2" alt="Logo Usuario">
                                @break
                                @case(3)
                                    <img src="{{ asset('adminlte/img/avatar3.png') }}" class="img-circle elevation-2" alt="Logo Usuaria">
                                @break
                                @default
                                    <img src="{{ asset('adminlte/img/TBLogo.png') }}" class="img-circle elevation-2" alt="Logo">
                            @endswitch
                        </div>
                        <div class="info">
                            <a href="{{ route('persona.edit', session('id_persona')) }}" class="d-block">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</a>
                        </div>
                        
                        <div class="info">
                            <a href="{{ route('logout') }}" role="button" title="Salir" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off"></i>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                            <li class="nav-item has-treeview menu-close">
                                <a href="#" class="nav-link active">
                                    <p>Datos Usuario<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('persona.edit', session('id_persona')) }}" class="nav-link">
                                            <i class='nav-icon fa fa-caret-right'></i>
                                            <p>Actualizar datos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('cambio_email', session('id_usuario')) }}" class="nav-link">
                                            <i class='nav-icon fa fa-caret-right'></i>
                                            <p>Modificar e-mail</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('password.request') }}" class="nav-link">
                                            <i class='nav-icon fa fa-caret-right'></i>
                                            <p>Cambiar Password</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        
                        <ul id="ulMenuSistema" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            
                        </ul>
                        
                        <div id="divDivisor" style="display:none" class="dropdown-divider"></div>
                        
                        <ul id="ulMenuAdministracion" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            
                        </ul>  
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>    
                  
            @yield("content")
                
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                <div class="p-3">
                    <h5>Title</h5>
                    <p>Sidebar content</p>
                </div>
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- Default to the left -->
                <strong>Copyright &copy; 2015-{{ date('Y') }} <a href="http://www.tecnobot.cl" target="_blank">TecnoBot.cl</a>.</strong> Derechos Resevados.
                <!-- To the right -->
                <div class="float-right d-none d-sm-inline">
                    <div class="pull-right hidden-xs">
                        <b>Version</b> {{ config('app.version') }}
                    </div>
                </div>
            </footer>
        </div>
        <!-- ./wrapper -->
    </body>
</html>