class Perfil {
    constructor(url) {
        this.URL = url;
        this._token = $('meta[name="csrf-token"]').attr('content');
    }
    
    InicioFormulario() {
        $("#txt-CrearNombre").val("");
        $("#txt-CrearDescripcion").val("");
        $('#error_message_crear').html("");
    }
    
    ValidarCrear() {
        if($("#txt-CrearNombre").val() == '') {
            swal({
                type : "warning",
                text : "Debe ingresar el nombre",
                animation : false
            });
            return false;
        }
        
        return true;
    }
    
    ValidarModificar() {
        if($("#txt-ModificarNombre").val() == '') {
            swal({
                type : "warning",
                text : "Debe ingresar el nombre",
                animation : false
            });
            return false;
        }
        
        return true;
    }
    
    Obtener(idPerfil) {
        $('#error_message_modificar').html("");
        
        $.ajax({
            url : this.URL + "/perfil/obtener/" + idPerfil,
            type : 'GET',
            data : {
                
            },
            dataType : 'json',
            success : function(data) {
                if(data.perfil.length == 1) {
                    $("#txt-ModificarIdPerfil").val(data.perfil[0].idPerfil);
                    $("#txt-ModificarNombre").val(data.perfil[0].nombre);
                    $("#txt-ModificarPaginaInicio").val(data.perfil[0].pagina_inicio);
                    $("#txt-ModificarDescripcion").val(data.perfil[0].descripcion);
                }
            },
            error : function(data){
                console.log(data.responseJSON);
                alert(data.responseJSON.message);
            }
        }).done(function() {
            
        });
    }
    
    Crear(){
        var url = this.URL;
        var token = this._token;
        var errorsHtml = "";
        $('#error_message_crear').html("");
        
        swal({
            title : "Crear",
            text : "¿Seguro que desea ingresar el perfil?",
            type : "question",
            animation : false,
            showCancelButton : true,
            confirmButtonClass : "btn-primary",
            confirmButtonText : "Si",
            cancelButtonText : "No",
        }).then(function(json_data) {
            $.post({
                async : false,
                url : url + "/perfil/store",
                type : 'POST',
                data : {
                    nombre : $("input[name=txt-CrearNombre]").val(),
                    idEstilo : 1,
                    pagina_inicio : $("#txt-CrearPaginaInicio").val(),
                    descripcion : $("textarea[name=txt-CrearDescripcion]").val(),
                    _token : token
                },
                dataType : 'json',
                success : function(data){
                    let xtable = $('#tbl_perfil').DataTable(); 
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
                $("#modal-PerfilCrear").modal("hide");
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
            text : "¿Seguro que desea modificar el perfil?",
            type : "question",
            animation : false,
            showCancelButton : true,
            confirmButtonClass : "btn-primary",
            confirmButtonText : "Si",
            cancelButtonText : "No",
        }).then(function(json_data) {
            $.ajax({
                url : url + "/perfil/update/" + $("#txt-ModificarIdPerfil").val(),
                type : 'PUT',
                data : {
                    nombre : $("#txt-ModificarNombre").val(),
                    idEstilo : 1,
                    pagina_inicio : $("#txt-ModificarPaginaInicio").val(),
                    descripcion : $("#txt-ModificarDescripcion").val(),
                    _token : token
                },
                dataType : 'json',
                success : function(data){
                    let xtable = $('#tbl_perfil').DataTable(); 
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

    Eliminar(idPerfil){
        var url = this.URL;
        var token = this._token;
        
        swal({
            title: "Eliminar",
            text: "¿Seguro que desea eliminar el perfil?",
            type: "question",
            animation : false,
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText : "Si",
            cancelButtonText : "No"
        }).then(function(json_data) {
            $.ajax({
                url : url + "/perfil/destroy/" + idPerfil,
                type: "PUT",
                data: {
                    _token : token
                },
                dataType : 'json',
                success : function(data){
                    let xtable = $('#tbl_perfil').DataTable(); 
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
        $('#tbl_perfil').DataTable({
            "paging" : false,
            "lengthChange" : false,
            "searching" : false,
            "processing" : true,
            "ordering" : false,
            "info" : false,
            "responsive" : true,
            "autoWidth" : false,
            "pageLength" : 20,
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
                "url" : this.URL + "/perfil/lista",
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
                { "data" : "idPerfil" },
                { "data" : "nombre" },
                { "data" : "pagina_inicio" },
                { "data" : "descripcion" },
                { "data" : null, render : function(data, type, row) {
                        return "<button title='Editar' class='btn btn-EditarPerfil btn-default'><i class='fas fa-edit'></i></button>&nbsp;<button title='Borrar' class='btn btn-EliminarPerfil btn-default'><i class='fa fa-times'></i></button>";
                    }
                },
            ]
        });
    }
}