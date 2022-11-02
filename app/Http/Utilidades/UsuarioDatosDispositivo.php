<?php
namespace App\Http\Utilidades;

class UsuarioDatosDispositivo {
    private $user_agent = "";

    function __construct() {
        $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
    }

    function getSO() {
        $plataformas = array(
            'Windows 10' => 'Windows NT 10.0+',
            'Windows 8.1' => 'Windows NT 6.3+',
            'Windows 8' => 'Windows NT 6.2+',
            'Windows 7' => 'Windows NT 6.1+',
            'Windows Vista' => 'Windows NT 6.0+',
            'Windows XP' => 'Windows NT 5.1+',
            'Windows 2003' => 'Windows NT 5.2+',
            'Windows' => 'Windows otros',
            'iPhone' => 'iPhone',
            'iPad' => 'iPad',
            'Mac OS X' => '(Mac OS X+)|(CFNetwork+)',
            'Mac otros' => 'Macintosh',
            'Android' => 'Android',
            'BlackBerry' => 'BlackBerry',
            'Linux' => 'Linux',
        );

        foreach($plataformas as $plataforma=>$pattern) {
            if (preg_match('/(?i)' . $pattern . '/', $this->user_agent)) {
                return $plataforma;
            }
        }

        return 'Otras';
    }

    function getExplorador() {
        $browser = array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
        
        foreach($browser as $parent) {
            $s = strpos(strtoupper($this->user_agent), $parent);
            $f = $s + strlen($parent);
            $version = substr($this->user_agent, $f, 15);
            $version = preg_replace('/[^0-9,.]/','', $version);
            
            if ($s) {
                return $parent . "-" . $version;
            }
	}
    }
    
    function getPais($ip) {
        $informacionSolicitud = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip);
        $dataSolicitud = json_decode(informacionSolicitud);
        var_dump($dataArray);
        
        return $dataArray;
    }
}