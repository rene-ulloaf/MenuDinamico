class Util {
    RutFormat(rut) {
        //contador de para saber cuando insertar el . o la -
        var nPos = 0;
        //Guarda el rut invertido con los puntos y el gui&oacute;n agregado
        var sInvertido = "";
        //Guarda el resultado final del rut como debe ser
        var sRut = "";
        var sRut1 = rut;

        if(sRut1.length > 1) {
            sRut1 = sRut1.replace('-', '');// se elimina el guion
            sRut1 = sRut1.replace(/[.]/gi,'');// se elimina los punto
            sRut1 = sRut1.replace(/k$/,"K");

            for(var i = sRut1.length - 1; i >= 0; i-- ) {
                sInvertido += sRut1.charAt(i);

                if(i == sRut1.length - 1 ) {
                    sInvertido += "-";
                } else if (nPos == 3) {
                    sInvertido += ".";
                    nPos = 0;
                }

                nPos++;
            }

            for(var j = sInvertido.length - 1; j >= 0; j-- ) {
                if (sInvertido.charAt(sInvertido.length - 1) != ".") {
                    sRut += sInvertido.charAt(j);
                } else if (j != sInvertido.length - 1 ) {
                    sRut += sInvertido.charAt(j);
                }
            }

            return sRut.toUpperCase();
        } else {
            return sRut1;
        }
    }

    calcularEdad(fecha) {
        // Si la fecha es correcta, calculamos la edad

        if (typeof fecha != "string" && fecha && esNumero(fecha.getTime())) {
            fecha = formatDate(fecha, "yyyy-MM-dd");
        }

        var values = fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];

        // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth() + 1;
        var ahora_dia = fecha_hoy.getDate();

        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if (ahora_mes < mes) {
            edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia)) {
            edad--;
        }
        if (edad > 1900) {
            edad -= 1900;
        }

        // calculamos los meses
        var meses = 0;

        if (ahora_mes > mes && dia > ahora_dia)
            meses = ahora_mes - mes - 1;
        else if (ahora_mes > mes)
            meses = ahora_mes - mes
        if (ahora_mes < mes && dia < ahora_dia)
            meses = 12 - (mes - ahora_mes);
        else if (ahora_mes < mes)
            meses = 12 - (mes - ahora_mes + 1);
        if (ahora_mes == mes && dia > ahora_dia)
            meses = 11;

        // calculamos los dias
        var dias = 0;
        if (ahora_dia > dia)
            dias = ahora_dia - dia;
        if (ahora_dia < dia) {
            ultimoDiaMes = new Date(ahora_ano, ahora_mes - 1, 0);
            dias = ultimoDiaMes.getDate() - (dia - ahora_dia);
        }

        //return edad + " años, " + meses + " meses y " + dias + " días";
        return edad;
    }
    
    number_format(amount, decimals) {
        amount += ''; // por si pasan un numero en vez de un string
        amount = parseFloat(amount.replace(/[^0-9\.\-]/g, '')); // elimino cualquier cosa que no sea numero o punto

        decimals = decimals || 0; // por si la variable no fue fue pasada

        // si no es un numero o es igual a cero retorno el mismo cero
        if (isNaN(amount) || amount === 0) 
            return parseFloat(0).toFixed(decimals);

        // si es mayor o menor que cero retorno el valor formateado como numero
        amount = '' + amount.toFixed(decimals);

        var amount_parts = amount.split(','),
            regexp = /(\d+)(\d{3})/;

        while (regexp.test(amount_parts[0]))
            amount_parts[0] = amount_parts[0].replace(regexp, '$1' + '.' + '$2');

        return amount_parts.join(',');
    }
}