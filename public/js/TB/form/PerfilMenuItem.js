class PerfilMenuItem {
    constructor(url) {
        this.URL = url;
        this._token = $('meta[name="csrf-token"]').attr('content');
    }
    
    Asignar(idMenuItem, lectura, escritura, modifica, elimina){
        var url = this.URL;
        var token = this._token;
        var errorsHtml = "";
        
        swal({
            title : "Asignar",
            text : "¿Seguro que desea asignar el perfil?",
            type : "question",
            animation : false,
            showCancelButton : true,
            confirmButtonClass : "btn-primary",
            confirmButtonText : "Si",
            cancelButtonText : "No"
        }).then(function(json_data) {
            $.post({
                async : false,
                url : url + "/PerfilMenuItem/asignar",
                type : 'POST',
                data : {
                    idPerfil : $("select[name=idPerfil]").val(),
                    idMenu_Item : idMenuItem,
                    lectura : lectura,
                    escritura : escritura,
                    modifica : modifica,
                    elimina : elimina,
                    _token : token
                },
                dataType : 'json',
                success : function(data){
                    let xtable = $('#tbl_perfil_mi').DataTable(); 
                    xtable.ajax.reload( null, false );
                },
                error : function(data){
                    var i=0;
                    var errors = data.responseJSON;

                    // /Log in the console
                    console.log(errors);
                    //alert(errors.glosa);
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
                
            });
        }, function(dismiss) {
            if (dismiss === 'cancel' || dismiss === 'close') {
                //
            }
        })
    }
 
    Modificar(idPerfil, idMenuItem, lectura, escritura, modifica, elimina){
        var url = this.URL;
        var token = this._token;
        var errorsHtml = "";
        
        swal({
            title : "Modificar",
            text : "¿Seguro que desea modificar?",
            type : "question",
            animation : false,
            showCancelButton : true,
            confirmButtonClass : "btn-primary",
            confirmButtonText : "Si",
            cancelButtonText : "No"
        }).then(function(json_data) {
            $.ajax({
                url : url + "/PerfilMenuItem/update/" + idPerfil + "/" + idMenuItem,
                type : 'PUT',
                data : {
                    lectura : lectura,
                    escritura : escritura,
                    modifica : modifica,
                    elimina : elimina,
                    _token : token
                },
                dataType : 'json',
                success : function(data){
                    let xtable = $('#tbl_perfil_mi').DataTable(); 
                    xtable.ajax.reload( null, false );
                },
                error : function(data) {
                    var i=0;
                    var errors = data.responseJSON;

                    // /Log in the console
                    console.log(errors);
                    //alert(errors.glosa);
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
                $("#modal-PerfilEditar").modal("hide");
            });
        }, function(dismiss) {
            if (dismiss === 'cancel' || dismiss === 'close') {
                //
            }
        })
    }

    Eliminar(idPerfil, idMenuItem){
        var url = this.URL;
        var token = this._token;
        
        swal({
            title: "Eliminar",
            text: "¿Seguro que desea eliminar?",
            type: "question",
            animation : false,
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText : "Si",
            cancelButtonText : "No"
        }).then(function(json_data) {
            $.ajax({
                url : url + "/PerfilMenuItem/destroy/" + idPerfil + "/" + idMenuItem,
                type: "PUT",
                data: {
                    _token : token
                },
                dataType : 'json',
                success : function(data){
                    let xtable = $('#tbl_perfil_mi').DataTable(); 
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

    Lista(idPerfil) {
        $('#tbl_perfil_mi').DataTable({
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
            destroy: true,
            "columnDefs": [
                {
                    "targets": [ 1 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 2 ],
                    "visible": false,
                    "searchable": false
                }
            ],
            "fnDrawCallback" : function(oSettings) {
            },
            "ajax" : {
                "url" : this.URL + "/PerfilMenuItem/lista/" + idPerfil,
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
                { "data" : null, render: function(data, type, row, meta) {
                        if(data.idPerfil == null) {
                            return "";
                        } else {
                            return data.idPerfil;
                        }
                    }
                },
                { "data" : null, render: function(data, type, row, meta) {
                        if(data.idMenu_Item == null) {
                            return "";
                        } else {
                            return data.idMenu_Item;
                        }
                    }
                },
                { "data" : "menu" },
                { "data" : "mi" },
                { "data" : "descripcion" },
                { "data" : null, render : function(data, type, row) {
                        if(data.desplegable) {
                            return "--";
                        } else {
                            if(data.lectura) {
                                return "<input type='checkbox' value='' name='chkLectura_" + data.idMenu_Item + "' disabled checked>";
                            } else {
                                return "<input type='checkbox' value='' name='chkLectura_" + data.idMenu_Item + "' disabled>";
                            }
                        }
                    }
                },
                { "data" : null, render : function(data, type, row) {
                        if(data.desplegable) {
                            return "--";
                        } else {
                            if(data.escritura) {
                                return "<input type='checkbox' value='' name='chkEscritura_" + data.idMenu_Item + "' checked>";
                            } else {
                                return "<input type='checkbox' value='' name='chkEscritura_" + data.idMenu_Item + "'>";
                            }
                        }
                    }
                },
                { "data" : null, render : function(data, type, row) {
                        if(data.desplegable) {
                            return "--";
                        } else {
                            if(data.modifica) {
                                return "<input type='checkbox' value='' name='chkModifica_" + data.idMenu_Item + "' checked>";
                            } else {
                                return "<input type='checkbox' value='' name='chkModifica_" + data.idMenu_Item + "'>";
                            }
                        }
                    }
                },
                { "data" : null, render : function(data, type, row) {
                        if(data.desplegable) {
                            return "--";
                        } else {
                            if(data.elimina) {
                                return "<input type='checkbox' value='' name='chkElimina_" + data.idMenu_Item + "' checked>";
                            } else {
                                return "<input type='checkbox' value='' name='chkElimina_" + data.idMenu_Item + "'>";
                            }
                        }
                    }
                },
                { "data" : null, render : function(data, type, row) {
                        if(data.idPerfil == null) {
                            return "<button title='Asignar' class='btn btn-Asignar btn-default'><i class='fas fa-plus'></i> Asignar</button>";
                        } else {
                            return "<button title='Editar' class='btn btn-Editar btn-default'><i class='fas fa-edit'></i></button>&nbsp;<button title='Borrar' class='btn btn-Eliminar btn-default'><i class='fa fa-times'></i></button>";
                        }
                    }
                },
            ]
        });
    }
}