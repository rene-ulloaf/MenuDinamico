<div class="modal fade" id="modal-MenuItemCrear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Crear Men&uacute;</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="error_message_crear"></div>
                
                <div class="box-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Menu Item Padre</label>
                            <div class="col-sm-12">
                                <select name="select-CrearPadre" class="form-control"></select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Glosa</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="txt-CrearGlosa" name="txt-CrearGlosa" placeholder="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Link</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="txt-CrearLink" name="txt-CrearLink" placeholder="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Desplegable</label>
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <select name="select-CrearDesplegable" class="form-control">
                                        <option value="2">Seleccionar</option>
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Habilitado</label>
                            <div class="col-sm-12">
                                <select name="select-CrearHabilitado" class="form-control">
                                    <option value="2">Seleccionar</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Descripci&oacute;n</label>
                            <div class="col-sm-12">
                                <textarea rows="6" cols="61" id="txt-CrearDescripcion" name="txt-CrearDescripcion" style="resize:none"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Orden</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="txt-CrearOrden" name="txt-CrearOrden" placeholder="">
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="button" class="btn btn-primary" title="Ingresar" id="btn-MenuItemIngresar" name="btn-MenuItemIngresar">Ingresar</button>
                </div>
            </div>
        </div>
    </div>
</div>