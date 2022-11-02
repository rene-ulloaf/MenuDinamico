class MenuInicio {
    constructor(url) {
        this.URL = url;
    }
    
    ObtenerMenuItem(idMenu, idUsuario, idPerfil) {
        var arrMI = [];
        
        $.ajax({
            async : false,
            url : this.URL + "/menu_item/listaMenu/" + idMenu + "/" + idUsuario + "/" + idPerfil,
            data : "",
            type : 'GET',
            dataType : 'json',
            success: function(data) {
                arrMI = data;
            }
        }).done(function(data) {
            
        });
        
        return arrMI;
    }
    
    CrearMenuDesplegable(idMenuItem, glosa, habilitado) {
        var hab = "disabled";
        
        if(habilitado) {
            hab = "active";
        }
        
        var $mi = "\
            <li class='nav-item has-treeview menu-close'>\n\
                <a href='' class='nav-link  " + hab + "'>\n\
                    <i class='nav-icon fas fa-th'></i>\n\
                        <p>" + glosa + "<i class='right fas fa-angle-left'></i></p>\n\
                </a>\n\
                <ul id='ul_" + idMenuItem + "' class='nav nav-treeview'></ul>\n\
            </li>\n\
        ";
        
        return $mi;
    }
    
    CrearMenuItem(glosa, link, habilitado) {
        var hab = "disabled";
        
        if(habilitado) {
            hab = "";
        }
        
        var $mi = "\
            <li class='nav-item'>\n\
                <a href='" + this.URL + "/" + link + "' class='nav-link " + hab + "'>\n\
                    <i class='nav-icon fa fa-caret-right'></i>\n\
                    <p>" + glosa + "</p>\n\
                </a>\n\
            </li>\n\
        ";
        
        return $mi;
    }

    CrearMenuItemPrincipalDesplegable(idMenuItem, glosa, habilitado) {
        var hab = "disabled";
        
        if(habilitado) {
            hab = "";
        }
        
        var $mi = "\
            <li class='nav-item dropdown'>\n\
                <a class='nav-link dropdown-toggle " + hab + "' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>" + glosa + "</a>\n\
                <div id='divDDM_" + idMenuItem + "' class='dropdown-menu'></div>\n\
            </li>\n\
        ";
        
        return $mi;
    }
    
    CrearMenuItemSecundarioDesplegable(idMenuItem, glosa, habilitado) {
        var hab = "disabled";
        
        if(habilitado) {
            hab = "";
        }
        
        var $mi = "\
            <a class='nav-link dropdown-toggle " + hab + "' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>" + glosa + "</a>\n\
            <div id='divDDM_" + idMenuItem + "' class='dropdown-menu'></div>\n\
        ";
        
        return $mi;
    }
    
    CrearMenuItemPrincipalDesplegableSecundario(glosa, link, habilitado) {
        var hab = "disabled";
        
        if(habilitado) {
            hab = "";
        }
        
        var $mi = "<a class='dropdown-item " + hab + "' href='" + this.URL + "/" + link + "'>" + glosa + "</a>";
        
        return $mi;
    }
    
    CrearMenuItemPrincipal(glosa, link, habilitado) {
        var hab = "disabled";
        
        if(habilitado) {
            hab = "";
        }
        
        var $mi = "\n\
            <li class='nav-item d-none d-sm-inline-block'>\n\
                <a class='nav-link " + hab + "' href='" + this.URL + "/" + link + "'>" + glosa + "</a>\n\
            </li>\n\
        ";
        
        return $mi;
    }
}