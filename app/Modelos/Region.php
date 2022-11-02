<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {
    protected $table = 'Region';
    protected $primaryKey = 'idRegion';
    public $timestamps = false;

    protected $fillable = [
        'idRegion', 'idPais', 'nombre', 'orden', 'vigente'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];
}