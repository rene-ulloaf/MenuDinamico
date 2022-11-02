class DashBoardAdmin {
    constructor(url) {
        this.URL = url;
    }
    
    ObtenerCantUsuReg(idPerfilReg) {
        $.ajax({
            async : false,
            url : this.URL + "/dashboard/cantidad_registrados/" + idPerfilReg,
            data : "",
            type : 'GET',
            dataType : 'json',
            success: function(data) {
                $('#CantUsuReg').html(data.cantidad);
            }
        }).done(function(data) {
            
        });
    }
    
    ObtenerCantUsuAct() {
        $.ajax({
            async : false,
            url : this.URL + "/dashboard/cantidad_activos/",
            data : "",
            type : 'GET',
            dataType : 'json',
            success: function(data) {
                $('#CantUsuAct').html(data.cantidad);
            }
        }).done(function(data) {
            
        });
    }
}