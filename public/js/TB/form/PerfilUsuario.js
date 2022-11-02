class PerfilUsuario {
    constructor(url) {
        this.URL = url;
        this._token = $('meta[name="csrf-token"]').attr('content');
    }
    
    Asignar(idUsuario, idPerfil){
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
                url : url + "/PerfilUsuario/asignar",
                type : 'POST',
                data : {
                    idUsuario : idUsuario,
                    idPerfil : idPerfil,
                    _token : token
                },
                dataType : 'json',
                success : function(data){
                    let xtable = $('#tbl_perfil_usuario').DataTable(); 
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

    Eliminar(idPerfil, idUsuario){
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
                url : url + "/PerfilUsuario/destroy/" + idPerfil + "/" + idUsuario,
                type: "PUT",
                data: {
                    _token : token
                },
                dataType : 'json',
                success : function(data){
                    let xtable = $('#tbl_perfil_usuario').DataTable(); 
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
        $('#tbl_perfil_usuario').DataTable({
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
                },
                {
                    "targets": [2],
                    "visible": false,
                    "searchable": false
                }
            ],
            destroy: true,
            "fnDrawCallback" : function(oSettings) {
            },
            "ajax" : {
                "url" : this.URL + "/PerfilUsuario/lista/" + idPerfil,
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
                { "data" : "idUsuario" },
                { "data" : "nombre" },
                { "data" : "apellido" },
                { "data" : "email" },
                { "data" : null, render : function(data, type, row) {
                        if(data.idPerfil == null) {
                            return "<button title='Asignar' class='btn btn-Asignar btn-default'><i class='fas fa-plus'></i>&nbsp;Asignar</button>";
                        } else {
                            return "<button title='Borrar' class='btn btn-Eliminar btn-default'><i class='fa fa-times'></i>&nbsp;Eliminar</button>";
                        }
                    }
                },
            ]
        });
    }
}