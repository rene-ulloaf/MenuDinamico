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

<script src="{{ asset('js/TB/form/MenuItem.js') }}" defer></script>
@endsection

@section('bodyJS')
<script type="text/javascript">
    $(document).ready(function() {
        const menu_item = new MenuItem("{{ url('/') }}", "{{ (isset($menu) == "" ? 0 : $menu->idMenu) }}");
        menu_item.Lista();
        
        $("#btn-CrearMenuItem").click(function(e) {
            e.preventDefault();
            menu_item.InicioCrear();
            $("#modal-MenuItemCrear").modal("show");
            
        });
        
        $(document).on("click", ".btn-EditarMenuItem", function(e) {
            e.preventDefault();
            
            let current_row = $(this).parents('tr'); 
            if (current_row.hasClass('child')) {
                current_row = current_row.prev(); 
            }
            let table = $('#tbl_menu_item').DataTable(); 
            let data = table.row(current_row).data();
            
            $("#modal-MenuItemModificar").modal("show");
            menu_item.InicioModificar(data.idMenu_Item);
            
        });
        
        $(document).on("click", ".btn-EliminarMenuItem", function(e) {
            e.preventDefault();
            
            let current_row = $(this).parents('tr'); 
            if (current_row.hasClass('child')) { 
                current_row = current_row.prev(); 
            }
            let table = $('#tbl_menu_item').DataTable(); 
            let data = table.row(current_row).data();
            
            menu_item.Eliminar(data.idMenu_Item);
        });
        
        $("#btn-MenuItemIngresar").click(function(e) {
            if(menu_item.ValidarCrear()) {
                menu_item.Crear();
            }
        });
        
        $("#btn-MenuItemModificar").click(function(e) {
            if(menu_item.ValidarModificar()) {
                menu_item.Modificar();
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
                    <h1 class="m-0 text-dark">Listado Menu Item - [{{ (isset($menu) == "" ? 0 : $menu->glosa) }}]</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/menu') }}">Listado Men&uacute;</a></li>
                        <li class="breadcrumb-item active">Listado Menu Item</li>
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
                            <button class="btn btn-primary margin" id="btn-CrearMenuItem" title="Crear Men&uacute; Item"><i class="fa fa-plus"></i>&nbsp;Crear Men&uacute; Item</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="tbl_menu_item" class="table table-bordered table-hover"><!--table-hover o table-striped-->
                                <thead>
                                    <tr>
                                        <th width="20px">#</th>
                                        <th width="20px">Id</th>
                                        <th width="150px">Glosa</th>
                                        <th width="150px">Link</th>
                                        <th>Descripci&oacute;n</th>
                                        <th width="40px">Padre</th>
                                        <th width="40px">Desp.</th>
                                        <th width="40px">Hab.</th>
                                        <th width="40px">Orden</th>
                                        <th width="100px">Acci&oacute;n</th>
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

@include('menu_item/create')
@include('menu_item/edit')
@endsection