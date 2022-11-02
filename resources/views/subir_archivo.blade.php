<script type="text/javascript">
    $(document).ready(function() {
        const ac = new ArchivoCarga("{{ url('/') }}");

        $("#btn-IngresoArchivo").click(function(e) {
            if(ac.Validar()) {
                ac.Ingresar($('input[name=txt_ruta_archivo]').val(), $('input[name=txt_nombre_archivo]').val(), $('input[name=txt_extensiones_archivo]').val(), document.getElementById('upload_archivo').files[0]);
            }
        });
    });
</script>

<div class="modal fade" id="modal-SubirArchivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Subir Archivo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="error_message"></div>
                <input type="hidden" id="txt_ruta_archivo" name="txt_ruta_archivo" />
                <input type="hidden" id="txt_extensiones_archivo" name="txt_extensiones_archivo" />

                <div class="form-group row">
                    <label for="rut" class="col-sd-3 control-label">Nombre Archivo</label>
                    <div class="col-sm-12 input-group text-md-right">
                        <input id="txt_nombre_archivo" type="text" class="form-control" name="txt_nombre_archivo" autofocus>
                    </div>
                </div>
                
                <div class="box-body" id="div_subir_archivo">
                    <form enctype="multipart/form-data" action="#" method="POST">
                        <input id="upload_archivo" name="upload_archivo" type="file" />
                    </form>
                </div> 
            </div>
            <div class="modal-footer">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="button" class="btn btn-primary" title="Ingresar" id="btn-IngresoArchivo" name="btn-IngresoArchivo">Ingresar</button>
                </div>
            </div>
        </div>
    </div>
</div>