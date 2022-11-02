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

<script src="{{ asset('js/TB/Util.js') }}" defer></script>
<script src="{{ asset('js/TB/form/DashBoard.js') }}" defer></script>
@endsection

@section('bodyJS')
<script type="text/javascript">
    $(document).ready(function() {
        const dash = new DashBoard("{{ url('/') }}");
        let fecha = new Date();
        let ayer = new Date(fecha.getTime() - 24*60*60*1000);

        dash.ObtenerVentasDia(ayer.getFullYear(), ayer.getMonth(), ayer.getDate());
        dash.ObtenerVentasMes(ayer.getFullYear(), ayer.getMonth());
        dash.ProductoMasVendido();
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
                    <h1 class="m-0 text-dark">Dashboard</h1>
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
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-info"></i></span>
        
                        <div class="info-box-content">
                            <span class="info-box-text">Ventas Día Anterior</span>
                            <span class="info-box-number" id="VentaDia">&nbsp;</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-info"></i></span>
        
                        <div class="info-box-content">
                            <span class="info-box-text">Ventas Acumuladas Mes</span>
                            <span class="info-box-number" id="VentaMes">&nbsp;</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-12">
                    <div class="info-box mb-3">
                        <div class="info-box-content">
                            <span class="info-box-text">Productos Más Vendidos</span>

                            <table id="tbl_producto_mas_vendido" class="table table-bordered table-hover"><!--table-hover o table-striped-->
                                <thead>
                                    <tr>
                                        <th width="100px">C&oacute;digo</th>
                                        <th width="200px">Nombre</th>
                                        <th>Descripci&oacute;n</th>
                                        <th width="100px">cantidad</th>
                                    </tr>
                                </thead>
                            </table>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <!-- /.col-md-6 -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
</div>
@endsection