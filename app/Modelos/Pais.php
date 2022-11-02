<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model {
    protected $table = 'Pais';
    protected $primaryKey = 'idPais';
    public $timestamps = false;

    protected $fillable = [
        'idPais', 'nombre', 'gentilicio_femenino', 'gentilicio_masculino', 'orden', 'vigente'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];
}