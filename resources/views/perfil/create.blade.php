<div class="modal fade" id="modal-PerfilCrear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Crear Perfil</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="error_message_crear"></div>
                
                <div class="box-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nombre</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="txt-CrearNombre" name="txt-CrearNombre" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">P&aacute;gina Inicio</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="txt-CrearPaginaInicio" name="txt-CrearPaginaInicio" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Descripci&oacute;n</label>
                            <div class="col-sm-12">
                                <textarea rows="6" cols="61" id="txt-CrearDescripcion" name="txt-CrearDescripcion" style="resize:none"></textarea>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="button" class="btn btn-primary" title="Ingresar" id="btn-PerfilIngresar" name="btn-PerfilIngresar">Ingresar</button>
                </div>
            </div>
        </div>
    </div>
</div>