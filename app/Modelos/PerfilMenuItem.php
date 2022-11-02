<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class PerfilMenuItem extends Model {
    protected $table = 'Perfil_Menu_Item';
    public $timestamps = false;

    protected $fillable = [
        'idPerfil', 'idMenu_Item', 'lectura', 'escritura', 'modifica', 'elimina'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];
}