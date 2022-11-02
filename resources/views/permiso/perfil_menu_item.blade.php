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

<script src="{{ asset('js/TB/form/PerfilMenuItem.js') }}" defer></script>
@endsection

@section('bodyJS')
<script type="text/javascript">
    $(document).ready(function() {
        const pmi = new PerfilMenuItem("{{ url('/') }}");
        
        $("#btn-BuscarPerfilMI").click(function(e) {
            if($("select[name=idPerfil]").val() != 0) {
                pmi.Lista($("select[name=idPerfil]").val());
            } else {
                swal("Debe elegir el perfil");
            }
        });
        
        $(document).on("click", ".btn-Asignar", function(e) {
            e.preventDefault();
            let lectura = 1;
            let escritura = 0;
            let modifica = 0;
            let elimina = 0;
            
            if($("select[name=idPerfil]").val() != 0) {
                let current_row = $(this).parents('tr'); 
                if (current_row.hasClass('child')) { 
                    current_row = current_row.prev(); 
                }
                let table = $('#tbl_perfil_mi').DataTable();
                let data = table.row(current_row).data();

                /*if($("input:checkbox[name=chkLectura_" + data.idMenu_Item + "]").prop('checked')) {
                    lectura = 1;
                }*/

                if($("input:checkbox[name=chkEscritura_" + data.idMenu_Item + "]").prop('checked')) {
                    escritura = 1;
                }

                if($("input:checkbox[name=chkModifica_" + data.idMenu_Item + "]").prop('checked')) {
                    modifica = 1;
                }

                if($("input:checkbox[name=chkElimina_" + data.idMenu_Item + "]").prop('checked')) {
                    elimina = 1;
                }

                pmi.Asignar(data.idMenu_Item, lectura, escritura, modifica, elimina);
            } else {
                swal("Debe elegir el perfil");
            }
        });
        
        $(document).on("click", ".btn-Editar", function(e) {
            e.preventDefault();
            
            let lectura = 0;
            let escritura = 0;
            let modifica = 0;
            let elimina = 0;
            
            let current_row = $(this).parents('tr'); 
            if (current_row.hasClass('child')) { 
                current_row = current_row.prev(); 
            }
            let table = $('#tbl_perfil_mi').DataTable(); 
            let data = table.row(current_row).data();
            
            if($("input:checkbox[name=chkLectura_" + data.idMenu_Item + "]").prop('checked')) {
                lectura = 1;
            }

            if($("input:checkbox[name=chkEscritura_" + data.idMenu_Item + "]").prop('checked')) {
                escritura = 1;
            }

            if($("input:checkbox[name=chkModifica_" + data.idMenu_Item + "]").prop('checked')) {
                modifica = 1;
            }

            if($("input:checkbox[name=chkElimina_" + data.idMenu_Item + "]").prop('checked')) {
                elimina = 1;
            }
            
            pmi.Modificar(data.idPerfil, data.idMenu_Item, lectura, escritura, modifica, elimina);
        });
        
        $(document).on("click", ".btn-Eliminar", function(e) {
            e.preventDefault();
            
            let current_row = $(this).parents('tr'); 
            if (current_row.hasClass('child')) { 
                current_row = current_row.prev(); 
            }
            let table = $('#tbl_perfil_mi').DataTable(); 
            let data = table.row(current_row).data();
            
            pmi.Eliminar(data.idPerfil, data.idMenu_Item);
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
                    <h1 class="m-0 text-dark">Asignar Men&uacute; Item a Perfil</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ (session('pagina_inicio') == "" ? url(config('app.paginainiurl')) : url(session('pagina_inicio'))) }}">{{ (session('pagina_inicio') == "" ? config('app.paginaininom') : "Inicio") }}</a></li>
                        <li class="breadcrumb-item active">Asignar Men&uacute; a Perfil</li>
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
                            <div class="form-inline">
                                <div class="form-group" class="col-lg-3">
                                    <select name="idPerfil" class="form-control">
                                        <option value="0">Seleccionar</option>
                                        @if (isset($perfiles) != "")
                                            @foreach($perfiles as $perfil)
                                            <option value="{{ $perfil->idPerfil }}">{{ $perfil->nombre }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    &nbsp;
                                    <button class="btn btn-primary margin" id="btn-BuscarPerfilMI" title="Buscar"><i class="fa fa-search"></i>&nbsp;Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="tbl_perfil_mi" class="table table-bordered table-hover"><!--table-hover o table-striped-->
                                <thead>
                                    <tr>
                                        <th width="20px">#</th>
                                        <th width="20px">IdPerfil</th>
                                        <th width="20px">IdMenuItem</th>
                                        <th width="200px">Menu</th>
                                        <th width="200px">Menu Item</th>
                                        <th>Descripci&oacute;n</th>
                                        <th width="100px">Lectura</th>
                                        <th width="100px">Escritura</th>
                                        <th width="100px">Modificar</th>
                                        <th width="100px">Eliminar</th>
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
@endsection