<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model {
    protected $table = 'Provincia';
    protected $primaryKey = 'idProvincia';
    public $timestamps = false;

    protected $fillable = [
        'idProvincia', 'idRegion', 'nombre', 'orden', 'vigente'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];
}