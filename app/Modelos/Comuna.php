<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model {
    protected $table = 'Comuna';
    protected $primaryKey = 'idComuna';
    public $timestamps = false;

    protected $fillable = [
        'idComuna', 'idRegion', 'idProvincia', 'nombre', 'orden', 'vigente'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];
}