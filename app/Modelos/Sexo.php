<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model {
    protected $table = 'Sexo';
    protected $primaryKey = 'idSexo';
    public $timestamps = false;

    protected $fillable = [
        'idSexo', 'glosa', 'vigente'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];
}