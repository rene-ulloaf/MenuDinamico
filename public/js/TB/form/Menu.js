class Menu {
    constructor(url) {
        this.URL = url;
        this._token = $('meta[name="csrf-token"]').attr('content');
    }
    
    InicioFormulario() {
        $("#txt-CrearGlosa").val("");
        $("#txt-CrearDescripcion").val("");
        $("input[name=txt-CrearGlosa]").focus();
        $('#error_message_crear').html("");
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
        
        return true;
    }
    
    Obtener(idMenu) {
        $('#error_message_modificar').html("");
        
        $.ajax({
            url : this.URL + "/menu/obtener/" + idMenu,
            type : 'GET',
            data : {
                
            },
            dataType : 'json',
            success : function(data){
                if(data.data.length == 1) {
                    $("#txt-ModificarIdMenu").val(data.data[0].idMenu);
                    $("#txt-ModificarGlosa").val(data.data[0].glosa);
                    $("#txt-ModificarDescripcion").val(data.data[0].descripcion);
                }
            },
            error : function(data){
                console.log(data.responseJSON);
                alert(data.responseJSON.message);
            }
        }).done(function() {
            
        });
    }
    
    Crear() {
        var url = this.URL;
        var token = this._token;
        var errorsHtml = "";
        $('#error_message_crear').html("");
        
        swal({
            title : "Crear",
            text : "¿Seguro que desea ingresar el menu?",
            type : "question",
            animation : false,
            showCancelButton : true,
            confirmButtonClass : "btn-primary",
            confirmButtonText : "Si",
            cancelButtonText : "No",
        }).then(function(json_data) {
            $.post({
                async : false,
                url : url + "/menu/store",
                type : 'POST',
                data : {
                    glosa : $("input[name=txt-CrearGlosa]").val(),
                    descripcion : $("input[name=txt-CrearDescripcion]").val(),
                    _token : token
                },
                dataType : 'json',
                success : function(data){
                    let xtable = $('#tbl_menu').DataTable(); 
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
                $("#modal-MenuCrear").modal("hide");
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
            text : "¿Seguro que desea modificar el menu?",
            type : "question",
            animation : false,
            showCancelButton : true,
            confirmButtonClass : "btn-primary",
            confirmButtonText : "Si",
            cancelButtonText : "No",
        }).then(function(json_data) {
            $.ajax({
                url : url + "/menu/update/" + $("#txt-ModificarIdMenu").val(),
                type : 'PUT',
                data : {
                    glosa : $("#txt-ModificarGlosa").val(), descripcion : $("#txt-ModificarDescripcion").val(), _token : token
                },
                dataType : 'json',
                success : function(data){
                    let xtable = $('#tbl_menu').DataTable(); 
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
                $("#modal-MenuEditar").modal("hide");
            });
        }, function(dismiss) {
            if (dismiss === 'cancel' || dismiss === 'close') {
                //
            }
        })
    }

    Eliminar(idMenu){
        var url = this.URL;
        var token = this._token;
        
        swal({
            title: "Eliminar",
            text: "¿Seguro que desea eliminar el menu?",
            type: "question",
            animation : false,
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText : "Si",
            cancelButtonText : "No",
        }).then(function(json_data) {
            $.ajax({
                url : url + "/menu/destroy/" + idMenu,
                type: "PUT",
                data: {
                    _token : token
                },
                dataType : 'json',
                success : function(data){
                    let xtable = $('#tbl_menu').DataTable(); 
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
        $('#tbl_menu').DataTable({
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
                    "targets": [ 1 ],
                    "visible": false,
                    "searchable": false
                }
            ],
            "fnDrawCallback" : function(oSettings) {
            },
            "ajax" : {
                "url" : this.URL + "/menu/lista",
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
                { "data" : "idMenu" },
                { "data" : "glosa" },
                { "data" : "descripcion" },
                { "data" : null, render : function(data, type, row) {
                        return "<button title='Editar' class='btn btn-EditarMenu btn-default'><i class='fas fa-edit'></i></button>&nbsp;<button title='Borrar' class='btn btn-EliminarMenu btn-default'><i class='fa fa-times'></i></button>";
                    }
                },
                { "data" : null, render : function(data, type, row) {
                        return "<button title='Listado Menu Item' class='btn btn-MenuItemLista btn-default'>Listado</button>";
                    }
                },
            ]
        });
    }
}