<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model {
    protected $table = 'Perfil';
    protected $primaryKey = 'idPerfil';
    public $timestamps = false;

    protected $fillable = [
        'idPerfil', 'idEstilo', 'nombre', 'pagina_inicio', 'descripcion'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];
}