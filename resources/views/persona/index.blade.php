@extends('layouts.menu_inicio')

@section('headJS')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<!-- Botones Tabla -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
<!-- sweetalert -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">

<!-- DataTables -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Botones Tabla -->
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<!-- sweetalert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
@endsection

@section('bodyJS')
<script type="text/javascript">
    $(document).ready(function() {
        $('#tbl_persona').DataTable({
            "paging" : true,
            "lengthChange" : false,
            "searching" : true,
            "processing" : false,
            "ordering" : true,
            "info" : false,
            "responsive" : false,
            "autoWidth" : false,
            "pageLength" : 15,
            "dom" : '<"top"f>rtip',
            "dom": 'Bfrtip',
            "buttons": [
                'csv', 'excel'
            ],
            "fnDrawCallback" : function(oSettings) {
            },
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
        });
    })
</script>
@endsection
 
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Listado Personas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ (session('pagina_inicio') == "" ? url(config('app.paginainiurl')) : url(session('pagina_inicio'))) }}">{{ (session('pagina_inicio') == "" ? config('app.paginaininom') : "Inicio") }}</a></li>
                        <li class="breadcrumb-item active">Listado Personas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a title="Crear Persona" class="btn btn-primary margin" href="persona/create"><i class="fa fa-plus"></i>&nbsp;Crear Persona</a>
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($success))
                <div class="alert alert-success">{{ $success }}</div>
            @endif

            @if (!empty($warning))
                <div class="alert alert-warning">{{ $warning }}</div>
            @endif

            @error('error')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="tbl_persona" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Rut</th>
                                        <th>Nombre</th>
                                        <th>E-Mail</th>
                                        <th>Tel&eacute;fono</th>
                                        <th>Celular</th>
                                        <th>Fecha Ing.</th>
                                        <th>Vigente</th>
                                        <th width="100px">Acci&oacute;n</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($personas as $persona)
                                    <tr>
                                        <td>{{ $persona->rut }}</td>
                                        <td>{{ $persona->nombres . " " . $persona->apellido1 . " " . $persona->apellido2 }}</td>
                                        <td>{{ $persona->email }}</td>
                                        <td>{{ $persona->telefono }}</td>
                                        <td>{{ $persona->celular }}</td>
                                        <td>{{ date("d/m/Y", strtotime($persona->fecha_ingreso)) }}</td>
                                        <td>{{ ($persona->vigente == 1 ? "Si" : "No") }}</td>
                                        <td>
                                            <form action="{{ route('persona.destroy', $persona->idPersona) }}" method="POST">
                                                <a title='Editar' class='btn btn-Eliminar btn-default' href="{{ route('persona.edit', $persona->idPersona) }}"><i class='fa fa-edit'></i></a>

                                                @csrf
                                                <button title='Borrar' type="submit" class='btn btn-Eliminar btn-default'><i class='fa fa-times'></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <thead>
                                    <tr>
                                        <th>Rut</th>
                                        <th>Nombre</th>
                                        <th>E-Mail</th>
                                        <th>Tel&eacute;nfono</th>
                                        <th>Celular</th>
                                        <th>Fecha Ing.</th>
                                        <th>Vigente</th>
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
</div>
@endsection