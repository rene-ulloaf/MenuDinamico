@extends('layouts.menu_inicio')

@section('headJS')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<!-- sweetalert -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">

<!-- DataTables -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- sweetalert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>

<script src="{{ asset('js/TB/form/Menu.js') }}" defer></script>
@endsection

@section('bodyJS')
<script type="text/javascript">
    $(document).ready(function() {
        const menu = new Menu("{{ url('/') }}");
        menu.Lista();
        
        $("#btn-CrearMenu").click(function(e) {
            e.preventDefault();
            
            $("#modal-MenuCrear").modal("show");
            menu.InicioFormulario();
            
        });
        
        $(document).on("click", ".btn-EditarMenu", function(e){
            e.preventDefault();
            
            let current_row = $(this).parents('tr'); 
            if (current_row.hasClass('child')) { 
                current_row = current_row.prev(); 
            }
            let table = $('#tbl_menu').DataTable(); 
            let data = table.row(current_row).data();
            
            $("#modal-MenuEditar").modal("show");
            menu.Obtener(data.idMenu);
            
        });
        
        $(document).on("click", ".btn-EliminarMenu", function(e) {
            e.preventDefault();
            
            let current_row = $(this).parents('tr'); 
            if (current_row.hasClass('child')) { 
                current_row = current_row.prev(); 
            }
            let table = $('#tbl_menu').DataTable(); 
            let data = table.row(current_row).data();
            
            menu.Eliminar(data.idMenu);
        });
        
        $(document).on("click", ".btn-MenuItemLista", function(e) {
            e.preventDefault();
            
            let current_row = $(this).parents('tr'); 
            if (current_row.hasClass('child')) { 
                current_row = current_row.prev(); 
            }
            let table = $('#tbl_menu').DataTable(); 
            let data = table.row(current_row).data();
            
            window.location.href = "{{ url('/') }}/menu_item/index/" + data.idMenu;
        });
        
        $("#btn-MenuIngresar").click(function(e){
            if(menu.ValidarCrear()) {
                menu.Crear();
            }
        });
        
        $("#btn-MenuModificar").click(function(e){
            if(menu.ValidarModificar()) {
                menu.Modificar();
            }
        });
    })
</script>
@endsection
 
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Listado Men&uacute;</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ (session('pagina_inicio') == "" ? url(config('app.paginainiurl')) : url(session('pagina_inicio'))) }}">{{ (session('pagina_inicio') == "" ? config('app.paginaininom') : "Inicio") }}</a></li>
                        <li class="breadcrumb-item active">Listado Men&uacute;</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-primary margin" id="btn-CrearMenu" title="Crear Men&uacute;"><i class="fa fa-plus"></i>&nbsp;Crear Men&uacute;</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="tbl_menu" class="table table-bordered table-hover"><!--table-hover o table-striped-->
                                <thead>
                                    <tr>
                                        <th width="20px">#</th>
                                        <th width="20px">Id</th>
                                        <th width="250px">Glosa</th>
                                        <th>Descripci&oacute;n</th>
                                        <th width="100px">Acci&oacute;n</th>
                                        <th width="80px">Menu Item</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('menu/create')

@include('menu/edit')

@endsection