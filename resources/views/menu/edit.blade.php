<div class="modal fade" id="modal-MenuEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Crear Men&uacute;</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="error_message_modificar"></div>
                
                <div class="box-body">
                    <div class="form-horizontal">
                        <input type="hidden" id="txt-ModificarIdMenu">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Glosa</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="txt-ModificarGlosa" name="txt-ModificarGlosa" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Descripci&oacute;n</label>
                            <div class="col-sm-12">
                                <textarea rows="6" cols="61" id="txt-ModificarDescripcion" name="txt-ModificarDescripcion" style="resize:none"></textarea>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="button" class="btn btn-primary" title="Modificar" id="btn-MenuModificar" name="btn-ModificarMenu">Modificar</button>
                </div>
            </div>
        </div>
    </div>
</div>