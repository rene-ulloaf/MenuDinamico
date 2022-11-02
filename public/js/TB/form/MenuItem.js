class MenuItem {
    constructor(url, idMenu) {
        this.URL = url;
        this.IDMENU = idMenu;
        this._token = $('meta[name="csrf-token"]').attr('content');
    }
    
    InicioCrear() {
        $("#select-CrearPadre").val("0");
        $("#txt-CrearGlosa").val("");
        $("#txt-CrearLink").val("");
        $("select[name=select-CrearDesplegable]").val("2");
        $("select[name=select-CrearHabilitado]").val("2");
        $("#txt-CrearDescripcion").val("");
        $("#txt-CrearOrden").val("0");
        
        $('#error_message_crear').html("");
        
        this.ListaMenuItemPadreCrear(this.IDMENU);
        $("input[name=txt-CrearGlosa]").focus();
    }
    
    InicioModificar(idMenuItem) {
        this.ListaMenuItemPadreModificar(idMenuItem);
        this.Obtener(idMenuItem);
        $("input[name=txt-ModificarGlosa]").focus();
        $('#error_message_modificar').html("");
    }
    
    ValidarCrear() {
        if($("#txt-CrearGlosa").val() == '') {
            swal({
                type : "warning",
                text : "Debe ingresar la glosa",
                animation : false
            });
            return false;
        }
        
        if ($("select[name=select-CrearDesplegable]").val() == 2) {
            swal({
                type : "warning",
                text : "Campo desplegable es invalido",
                animation : false
            });
            return false;
        }
        
        if ($("select[name=select-CrearHabilitado]").val() == 2) {
            swal({
                type : "warning",
                text : "Campo habilitado es invalido",
                animation : false
            });
            return false;
        }
        
        return true;
    }
    
    ValidarModificar() {
        if($("#txt-ModificarGlosa").val() == '') {
            swal({
                type : "warning",
                text : "Debe ingresar la glosa",
                animation : false
            });
            return false;
        }
        
        if ($("select[name=select-ModificarDesplegable]").val() == 2) {
            swal({
                type : "warning",
                text : "Campo desplegable es invalido",
                animation : false
            });
            return false;
        }
        
        if ($("select[name=select-ModificarHabilitado]").val() == 2) {
            swal({
                type : "warning",
                text : "Campo habilitado es invalido",
                animation : false
            });
            return false;
        }
        
        return true;
    }
    
    Obtener(idMenuItem) {
        $('#error_message_modificar').html("");
        
        $.ajax({
            url : this.URL + "/menu_item/obtener/" + idMenuItem,
            type : 'GET',
            data : {
                
            },
            dataType : 'json',
            success : function(data) {
                $("input[name=txt-ModificarIdMenuItem]").val(data.menu_item.idMenu_Item)
                $("select[name=select-ModificarPadre]").val(data.menu_item.padre)
                $("#txt-ModificarIdMenu").val(data.menu_item.idMenu_Item);
                $("#select-ModificarPadre").val(data.menu_item.padre);
                $("#txt-ModificarGlosa").val(data.menu_item.glosa);
                $("#txt-ModificarLink").val(data.menu_item.link);
                $("select[name=select-ModificarDesplegable]").val(data.menu_item.desplegable);
                $("select[name=select-ModificarHabilitado]").val(data.menu_item.habilitado);
                $("#txt-ModificarDescripcion").val(data.menu_item.descripcion);
                $("#txt-ModificarOrden").val(data.menu_item.orden);
            },
            error : function(data){
                console.log(data.responseJSON);
                alert(data.responseJSON.error);
            }
        }).done(function() {
            
        });
        
        $('#error_message').html("");
    }
    
    Crear(){
        var url = this.URL;
        var token = this._token;
        var idMenu = this.IDMENU;
        var errorsHtml = "";
        $('#error_message_crear').html("");
        
        swal({
            title : "Crear",
            text : "¿Seguro que desea ingresar el item?",
            type : "question",
            animation : false,
            showCancelButton : true,
            confirmButtonClass : "btn-primary",
            confirmButtonText : "Si",
            cancelButtonText : "No",
        }).then(function(json_data) {
            $.post({
                async:false,
                url : url + "/menu_item/store",
                type : 'POST',
                data : {
                    padre : $("select[name=select-CrearPadre]").val(),
                    glosa : $("input[name=txt-CrearGlosa]").val(),
                    link : $("input[name=txt-CrearLink]").val(),
                    target : "_PARENT",
                    desplegable : $("select[name=select-CrearDesplegable]").val(),
                    habilitado : $("select[name=select-CrearHabilitado]").val(),
                    descripcion : $("textarea[name=txt-CrearDescripcion]").val(),
                    orden : $("input[name=txt-CrearOrden]").val(),
                    idMenu : idMenu,
                    _token : token
                },
                dataType : 'json',
                success : function(data){
                    let xtable = $('#tbl_menu_item').DataTable(); 
                    xtable.ajax.reload( null, false );
                },
                error : function(data){
                    var i=0;
                    var errors = data.responseJSON;

                    // /Log in the console
                    //console.log(errors);
                    //alert(errors.glosa);
                    
                    swal({
                        type : "error",
                        text : "Tiene errores que debe corregir",
                        animation : false
                    });
                    
                    errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors.errors, function (key, value) {
                        //alert(key);
                        //alert(value);
                        errorsHtml += '<li>'+ value + '</li>';
                        i++;
                    });
                    errorsHtml += '</ul></di>';
                    if(i > 0){
                        $('#error_message').html(errorsHtml);
                    }
                }
            }).done(function() {
                $("#modal-MenuItemCrear").modal("hide");
            });
        }, function(dismiss) {
            if (dismiss === 'cancel' || dismiss === 'close') {
                //
            }
        })
    }
    
    Modificar(){
        var url = this.URL;
        var token = this._token;
        var errorsHtml = "";
        $('#error_message_modificar').html("");
        
        swal({
            title : "Modificar",
            text : "¿Seguro que desea modificar el item?",
            type : "question",
            animation : false,
            showCancelButton : true,
            confirmButtonClass : "btn-primary",
            confirmButtonText : "Si",
            cancelButtonText : "No",
        }).then(function(json_data) {
            $.ajax({
                url : url + "/menu_item/update/" + $("input[name=txt-ModificarIdMenuItem]").val(),
                type : 'PUT',
                data : {
                    padre : $("select[name=select-ModificarPadre]").val(),
                    glosa : $("input[name=txt-ModificarGlosa]").val(),
                    link : $("input[name=txt-ModificarLink]").val(),
                    desplegable : $("select[name=select-ModificarDesplegable]").val(),
                    habilitado : $("select[name=select-ModificarHabilitado]").val(),
                    descripcion : $("textarea[name=txt-ModificarDescripcion]").val(),
                    orden : $("input[name=txt-ModificarOrden]").val(),
                    _token : token
                },
                dataType : 'json',
                success : function(data){
                    let xtable = $('#tbl_menu_item').DataTable(); 
                    xtable.ajax.reload( null, false );
                },
                error : function(data) {
                    var i=0;
                    var errors = data.responseJSON;

                    // /Log in the console
                    //console.log(errors);
                    //alert(errors.glosa);
                    
                    swal({
                        type : "error",
                        text : "Tiene errores que debe corregir",
                        animation : false
                    });
                    
                    errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors.errors, function (key, value) {
                        //alert(key);
                        //alert(value);
                        errorsHtml += '<li>'+ value + '</li>';
                        i++;
                    });
                    errorsHtml += '</ul></di>';
                    if(i > 0){
                        $('#error_message').html(errorsHtml);
                    }
                }
            }).done(function() {
                $("#modal-MenuItemModificar").modal("hide");
            });
        }, function(dismiss) {
            if (dismiss === 'cancel' || dismiss === 'close') {
                //
            }
        })
    }

    Eliminar(idMenuItem){
        var url = this.URL;
        var token = this._token;
        
        swal({
            title: "Eliminar",
            text: "¿Seguro que desea eliminar el item?",
            type: "question",
            animation : false,
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText : "Si",
            cancelButtonText : "No"
        }).then(function(json_data) {
            $.ajax({
                url : url + "/menu_item/destroy/" + idMenuItem,
                type: "PUT",
                data: {
                    _token : token
                },
                dataType : 'json',
                success : function(data){
                    let xtable = $('#tbl_menu_item').DataTable(); 
                    xtable.ajax.reload( null, false );
                },
                error: function (request, textStatus, errorThrown) {
                    swal("Error ", request.responseJSON.message, "error");
                }
            });
        }, function(dismiss) {
            if (dismiss === 'cancel' || dismiss === 'close') {
                //
            }
        })
    }

    Lista() {
        $('#tbl_menu_item').DataTable({
            "paging" : false,
            "lengthChange" : false,
            "searching" : false,
            "processing" : true,
            "ordering" : false,
            "info" : false,
            "responsive" : true,
            "autoWidth" : false,
            "pageLength" : 100,
            "dom" : '<"top"f>rtip',
            "columnDefs": [
                {
                    "targets": [1],
                    "visible": false,
                    "searchable": false
                }
            ],
            "fnDrawCallback" : function(oSettings) {
            },
            "ajax" : {
                "url" : this.URL + "/menu_item/lista/" + this.IDMENU,
                "type" : "GET",
                "data" : {
                    //method : "",
                },
                error : function(request, textStatus, errorThrown) {
                    swal(request.responseJSON.message);
                }
            },
            columns : [
                {
                    "data" : null, render : function (data, type, full, meta) {
                        return  meta.row + 1;
                    }
                },
                { "data" : "idMenu_Item" },
                { "data" : "glosa" },
                { "data" : "link" },
                { "data" : "descripcion" },
                { "data" : "menu_padre" },
                { "data" : null, render : function(data, type, row) {
                        if(data.desplegable) {
                            return "<input type='checkbox' value='' id='defaultCheck1' checked disabled>";
                        } else {
                            return "<input type='checkbox' value='' id='defaultCheck1' disabled>";
                        }
                    }
                },
                { "data" : null, render : function(data, type, row) {
                        if(data.habilitado) {
                            return "<input type='checkbox' value='' id='defaultCheck1' checked disabled>";
                        } else {
                            return "<input type='checkbox' value='' id='defaultCheck1' disabled>";
                        }
                    }
                },
                { "data" : "orden" },
                { "data" : null, render : function(data, type, row) {
                        return "<button title='Editar' class='btn btn-EditarMenuItem btn-info'><i class='fas fa-edit'></i></button>&nbsp;<button title='Borrar' class='btn btn-EliminarMenuItem btn-info'><i class='fa fa-times'></i></button>";
                    }
                },
            ]
        });
    }

    ListaMenuItemPadreCrear() {
        $("select[name=select-CrearPadre]").find('option').remove();
        
        $.get(this.URL + "/menu_item/listaMenuItemPadre/" + this.IDMENU,
            function(data) {
                $("select[name=select-CrearPadre]").append('<option value="0">Ninguno</option>');

                if(data.menu_items.length > 0){
                    $.each(data.menu_items, function(idx, opt) {
                        $("select[name=select-CrearPadre]").append('<option value="' + opt.idMenu_Item + '">' + opt.glosa + '</option>');
                    });
                }
            },
            'json'
        );
    }
    
    ListaMenuItemPadreModificar() {
        $("select[name=select-ModificarPadre]").find('option').remove();
        
        $.get(this.URL + "/menu_item/listaMenuItemPadre/" + this.IDMENU,
            function(data) {
                $("select[name=select-ModificarPadre]").append('<option value="0">Ninguno</option>');

                if(data.menu_items.length > 0){
                    $.each(data.menu_items, function(idx, opt) {
                        $("select[name=select-ModificarPadre]").append('<option value="' + opt.idMenu_Item + '">' + opt.glosa + '</option>');
                    });
                }
            },
            'json'
        );
    }
}