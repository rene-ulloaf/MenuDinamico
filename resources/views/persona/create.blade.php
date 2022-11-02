@extends('layouts.menu_inicio')

@section('headJS')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- TecnoBot -->
<script src="{{ asset('js/TB/form/Persona.js') }}" defer></script>
<script src="{{ asset('js/TB/Util.js') }}" defer></script>
@endsection

@section('bodyJS')
<script type="text/javascript">
    $(document).ready(function() {
        /*
        var persona = Object.create(Persona);
        
        $("select[name=idPais]").change(function() {
            persona.ObtenerRegion('{{ url('/') }}');
        })
        */
        const p = new Persona("{{ url('/') }}");
        const u = new Util();
       
        //p.ObtenerPais();
       
        $("select[name=idPais]").change(function() {
            p.ObtenerRegion($('select[name=idPais]').val(), "");
        })
        
        $("select[name=idRegion]").change(function() {
            p.ObtenerProvincia($('select[name=idRegion]').val(), "");
        })
        
        $("select[name=idProvincia]").change(function() {
            p.ObtenerComuna($('select[name=idProvincia]').val(), "");
        })
        
        $("input[name=rut]").keyup(function() {
            $('input[name=rut]').val(u.RutFormat($('input[name=rut]').val()));
        })
        
        if("{{ old('idPais') }}" != "") {
            p.ObtenerRegion("{{ old('idPais') }}", "{{ old('idRegion') }}");
        }
        
        if("{{ old('idRegion') }}" != "") {
            p.ObtenerProvincia("{{ old('idRegion') }}", "{{ old('idProvincia') }}");
        }
        
        if("{{ old('idProvincia') }}" != "") {
            p.ObtenerComuna("{{ old('idProvincia') }}", "{{ old('idComuna') }}");
        }
    })
</script>
@endsection

@section('content')

@php
    use App\Http\Utilidades\LlenarComboFecha;
    $cmbFecha = new LlenarComboFecha();
@endphp

<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url("/persona") }}">Listado Personas</a></li>
                        <li class="breadcrumb-item active">Crear Persona</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
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
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Persona</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('persona.store') }}">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="rut" class="col-md-4 col-form-label text-md-right">Rut</label>

                            <div class="col-md-6">
                                <input id="rut" type="text" class="form-control @error('rut') is-invalid @enderror" name="rut" value="{{ old('rut') }}" autocomplete="rut" autofocus>

                                @error('rut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="nombres" class="col-md-4 col-form-label text-md-right">Nombres</label>

                            <div class="col-md-6">
                                <input id="nombres" type="text" class="form-control @error('nombres') is-invalid @enderror" name="nombres" value="{{ old('nombres') }}" required autocomplete="nombres" autofocus>

                                @error('nombres')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="apellido1" class="col-md-4 col-form-label text-md-right">Primer Apellido</label>

                            <div class="col-md-6">
                                <input id="apellido1" type="text" class="form-control @error('apellido1') is-invalid @enderror" name="apellido1" value="{{ old('apellido1') }}" required autocomplete="apellido1" autofocus>

                                @error('apellido1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="apellido2" class="col-md-4 col-form-label text-md-right">Segundo Apellido</label>

                            <div class="col-md-6">
                                <input id="apellido2" type="text" class="form-control @error('apellido2') is-invalid @enderror" name="apellido2" value="{{ old('apellido2') }}" autocomplete="apellido2" autofocus>

                                @error('apellido2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="input-group text-md-right">
                                <label class="col-md-4 col-form-label text-md-right">Fecha Nacimiento</label>
                                <select name="cmb-dia" class="form-control">
                                    <option value="0">D&iacute;a</option>
                                    {!! $cmbFecha->getDias(0, old('cmb-dia')) !!}
                                </select>
                                &nbsp;<b>/</b>&nbsp;
                                <select name="cmb-mes" class="form-control">
                                    <option value="0">Mes</option>
                                    {!! $cmbFecha->getMeses(old('cmb-mes')) !!}
                                </select>
                                &nbsp;<b>/</b>&nbsp;
                                <select name="cmb-ano" class="form-control">
                                    <option value="0">Año</option>
                                    {!! $cmbFecha->getAnnos(130, old('cmb-ano'), 'desc') !!}
                                </select>
                                <label class="col-md-2">&nbsp;</label>
                                
                                @error('fecha_nacimiento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="direccion" class="col-md-4 col-form-label text-md-right">Direcci&oacute;n</label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" autocomplete="direccion">

                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="celular" class="col-md-4 col-form-label text-md-right">Celular</label>

                            <div class="col-md-6">
                                <input id="celular" type="text" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{ old('celular') }}" autocomplete="celular" placeholder="56922222222" autofocus>

                                @error('celular')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="telefono" class="col-md-4 col-form-label text-md-right">Tel&eacute;fono</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" autocomplete="telefono" autofocus>

                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="idSexo" class="col-md-4 col-form-label text-md-right">Sexo</label>
                            
                            <div class="col-md-6">
                                <select name="idSexo" class="form-control">
                                    <option value="1">Seleccionar</option>
                                    @foreach($sexo as $sex)
                                    <option value="{{ $sex->idSexo }}" {{ ($sex->idSexo == old('idSexo') ? 'selected' : '') }}>{{ $sex->glosa }}</option>
                                    @endforeach
                                </select>
                                
                                @error('idSexo')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="idPais" class="col-md-4 col-form-label text-md-right">Pa&iacute;s</label>
                            
                            <div class="col-md-6">
                                <select name="idPais" class="form-control">
                                    <option value="0">Seleccionar</option>
                                    @foreach($paises as $pais)
                                    <option value="{{ $pais->idPais }}" {{ ($pais->idPais == old('idPais') ? 'selected' : '') }}>{{ $pais->nombre }}</option>
                                    @endforeach
                                </select>
                                
                                @error('idPais')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idRegion" class="col-md-4 col-form-label text-md-right">Region</label>
                            
                            <div class="col-md-6">
                                <select name="idRegion" class="form-control">
                                    <option value="0">Seleccionar</option>
                                </select>
                                
                                @error('idRegion')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="idProvincia" class="col-md-4 col-form-label text-md-right">Provincia</label>
                            
                            <div class="col-md-6">
                                <select name="idProvincia" class="form-control">
                                    <option value="0">Seleccionar</option>
                                </select>
                                
                                @error('idProvincia')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="idComuna" class="col-md-4 col-form-label text-md-right">Comuna</label>
                            
                            <div class="col-md-6">
                                <select name="idComuna" class="form-control">
                                    <option value="0">Seleccionar</option>
                                </select>
                                
                                @error('idComuna')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection