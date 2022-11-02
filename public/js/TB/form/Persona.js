/*var Persona = {
    function constructor(){
        alert("const");
    },
    
    ObtenerRegion : function(url) {
        //$.get("http://127.0.0.1:8000/region/lista/" + $('select[name=idPais]').val(),
        $.get(url + "/region/lista/" + $('select[name=idPais]').val(),
            function(data) {
                if(data.regiones.length > 0){
                    $.each(data.regiones, function(idx, opt) {
                        $("select[name=idRegion]").append('<option value="' + opt.idRegion + '">' + opt.nombre + '</option>');
                    });
                }else{
                    alert("No existen regiones");
                }
            },
            'json'
        );
    }
};*/

class Persona {
    constructor(url) {
        this.URL = url;
    }
    
    /*
    ObtenerPais() {
        //$.get("http://127.0.0.1:8000/region/lista/" + $('select[name=idPais]').val(),
        $.get(this.URL + "/region/lista/" + $('select[name=idPais]').val(),
            function(data) {
                if(data.regiones.length > 0){
                    $.each(data.regiones, function(idx, opt) {
                        $("select[name=idRegion]").append('<option value="' + opt.idRegion + '">' + opt.nombre + '</option>');
                    });
                }else{
                    alert("No existen regiones");
                }
            },
            'json'
        );
    }
    */
    
    ObtenerRegion(idPais, sel) {
        $("select[name=idRegion]").find('option').remove();
        $("select[name=idProvincia]").find('option').remove();
        $("select[name=idComuna]").find('option').remove();
        //$.get("http://127.0.0.1:8000/region/lista/" + $('select[name=idPais]').val(),
        $.get(this.URL + "/region/lista/" + idPais,
            function(data) {
                $("select[name=idRegion]").append('<option value="0">Seleccionar</option>');
                $("select[name=idProvincia]").append('<option value="0">Seleccionar</option>');
                $("select[name=idComuna]").append('<option value="0">Seleccionar</option>');
                
                if(data.regiones.length > 0){
                    $.each(data.regiones, function(idx, opt) {
                        if(sel == opt.idRegion) {
                            $("select[name=idRegion]").append('<option value="' + opt.idRegion + '" selected>' + opt.nombre + '</option>');
                        } else {
                            $("select[name=idRegion]").append('<option value="' + opt.idRegion + '">' + opt.nombre + '</option>');
                        }
                    });
                }
            },
            'json'
        );
    }
    
    ObtenerProvincia(idRegion, sel) {
        $("select[name=idProvincia]").find('option').remove();
        $("select[name=idComuna]").find('option').remove();
        
        $.get(this.URL + "/provincia/lista/" + idRegion,
            function(data) {
                $("select[name=idProvincia]").append('<option value="0">Seleccionar</option>');
                $("select[name=idComuna]").append('<option value="0">Seleccionar</option>');
                
                if(data.provincias.length > 0){
                    $.each(data.provincias, function(idx, opt) {
                        if(sel == opt.idProvincia) {
                            $("select[name=idProvincia]").append('<option value="' + opt.idProvincia + '" selected>' + opt.nombre + '</option>');
                        } else {
                            $("select[name=idProvincia]").append('<option value="' + opt.idProvincia + '">' + opt.nombre + '</option>');
                        }
                    });
                }
            },
            'json'
        );
    }
    
    ObtenerComuna(idProvincia, sel) {
        $("select[name=idComuna]").find('option').remove();
        
        $.get(this.URL + "/comuna/lista/" + idProvincia,
            function(data) {
                $("select[name=idComuna]").append('<option value="0">Seleccionar</option>');
                
                if(data.comunas.length > 0){
                    $.each(data.comunas, function(idx, opt) {
                        if(sel == opt.idComuna) {
                            $("select[name=idComuna]").append('<option value="' + opt.idComuna + '" selected>' + opt.nombre + '</option>');
                        } else {
                            $("select[name=idComuna]").append('<option value="' + opt.idComuna + '">' + opt.nombre + '</option>');
                        }
                    });
                }
            },
            'json'
        );
    }
}