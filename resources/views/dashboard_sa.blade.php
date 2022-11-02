@extends('layouts.menu_inicio')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ session('pagina_inicio') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{ session('pagina_inicio') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Datos .env</h5>
                        </div>
                        
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            id sistema: [{{ config('app.idsistema', 'XXXX') }}]<br />
                            version: [{{ config('app.version', 'X.X.X') }}]<br />
                            minpass: [{{ config('app.minpass', 6) }}]<br />
                            paginaininom: [{{ config('app.paginaininom', 'home') }}]<br />
                            paginainiurl: [{{ config('app.paginainiurl', 'home') }}]<br />
                            id_perfil_usuario: [{{ config('app.id_perfil_usuario') }}]<br />
                            id_perfil_ocacional: [{{ config('app.id_perfil_ocacional') }}]
                        </div>
                    </div>
                </div><!-- /.col-md-4 -->
                
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Datos Sesion</h5>
                        </div>
                        
                        <div class="card-body">
                            id_usuario_ingreso: {{ session('id_usuario_ingreso') }}<br />
                            id_perfil: {{ session('id_perfil') }}<br />
                            id_usuario: {{ session('id_usuario') }}<br />
                            id_persona: {{ session('id_persona') }}<br />
                            persona_sexo: {{ session('persona_sexo') }}<br />
                            pagina_inicio: {{ session('pagina_inicio') }}
                        </div>
                    </div>
                </div><!-- /.col-md-4 -->
                
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Datos Auth::user</h5>
                        </div>
                        
                        <div class="card-body">
                            idUsuario: {{ Auth::user()->idUsuario }}<br />
                            nombre: {{ Auth::user()->nombre }}<br />
                            apellido: {{ Auth::user()->apellido }}<br />
                            email: {{ Auth::user()->email }}<br />
                            password: {{ Auth::user()->password }}<br />
                            bloqueado: {{ Auth::user()->bloqueado }}<br />
                            email_verified_at: {{ Auth::user()->email_verified_at }}<br />
                            fecha_caduca: {{ Auth::user()->fecha_caduca }}<br />
                            fecha_creacion: {{ Auth::user()->fecha_creacion }}<br />
                            fecha_modifica: {{ Auth::user()->fecha_modifica }}<br />
                            remember_token: {{ Auth::user()->remember_token }}<br />
                            cant_ingreso: {{ Auth::user()->cant_ingreso }}<br />
                            cambioPassword: {{ Auth::user()->cambioPassword }}<br />
                            vigente: {{ Auth::user()->vigente }}<br />
                        </div>
                    </div>
                </div><!-- /.col-md-4 -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
</div>
@endsection