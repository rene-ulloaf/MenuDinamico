@extends('layouts.app')

@section('content')

@if (isset($perfiles) != "")
    @if (count($perfiles) == 1)
       <script>window.location = "{{ route('perfilUsuario.seleccion', ['idUsuario' => $perfiles[0]->idUsuario, 'idPerfil' => $perfiles[0]->idPerfil]) }}";</script>
       <?php exit; ?>
    @endif
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>Ocurrió un error al obtener los perfiles</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="card">
                <div class="card-header">Seleccione el perfil con el cual desea ingresar.</div>

                <table class="table table-bordered">
                    <tr>
                        <th>Perfil</th>
                        <th>Descripci&oacute;n</th>
                        <th width="280px">Acci&oacute;n</th>
                    </tr>
            
                    @if (isset($perfiles) != "")
                        @if (count($perfiles) == 0)
                            <p>No tiene perfil asignado. Contactese con el encargado del sistema para que le asigne un perfil.</p>
                        @else
                            @foreach ($perfiles as $perfil)
                            <tr>
                                <td>{{ $perfil->nombre }}</td>
                                <td>{{ $perfil->descripcion }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('perfilUsuario.seleccion', ['idUsuario' => $perfil->idUsuario, 'idPerfil' => $perfil->idPerfil]) }}">Seleccionar</a>
                                </td>
                            </tr>
                            @endforeach
                        
                        @endif
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
