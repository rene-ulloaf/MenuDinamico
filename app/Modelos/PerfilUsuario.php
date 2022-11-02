<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class PerfilUsuario extends Model {
    protected $table = 'Perfil_Usuario';
    //protected $primaryKey = ['idUsuario', 'idPerfil'];
    public $timestamps = false;

    protected $fillable = [
        'idUsuario', 'idPerfil', 'pagina_inicio'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];
}