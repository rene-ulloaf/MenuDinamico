<?php
namespace App\Http\Utilidades;

class LlenarComboFecha {

    function __construct() {
        
    }
    
    function getDias($fin_dia, $selected) {
        $ini_dia = 1;
        $fin_dia = ($fin_dia == 0 ? 31 : $fin_dia);
        $option = "";

        for ($i = $ini_dia; $i <= $fin_dia; $i++) {
            $option .= "<option value='" . $i . "'" . ($i == $selected ? 'selected'  :  '') . ">" . $i . "</option>";
        }
        
        return $option;
    }
    function getMeses($selected) {
        $ini_mes = 1;
        $fin_mes = 12;
        $meses = array("1" => "Enero", "2" => "Febrero", "3" => "Marzo", "4" => "Abril", "5" => "Mayo", "6" => "Junio", "7" => "Julio", "8" => "Agosto", "9" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre");
        $option = "";
        
        for ($i = $ini_mes; $i <= $fin_mes; $i++) {
            $option .= "<option value='" . $i . "'" . ($i == $selected ? 'selected'  :  '') . ">" . $meses[$i] . "</option>";
        }
        
        return $option;
    }
    
    function getAnnos($ano_hasta, $selected, $order) {
        $ini_ano = date('Y');
        $fin_ano = date('Y')-($ano_hasta == 0 ? 100 : $ano_hasta);
        $option = "";
        
        if($order == 'desc') {
            for ($i = $ini_ano; $i >= $fin_ano; $i--) {
                $option .= "<option value='" . $i . "'" . ($i == $selected ? 'selected'  :  '') . ">" . $i . "</option>";
            }
        } else {
            for ($i = $fin_ano; $i <= $ini_ano; $i++) {
                $option .= "<option value='" . $i . "'" . ($i == $selected ? 'selected'  :  '') . ">" . $i . "</option>";
            }
        }
        
        return $option;
    }
}