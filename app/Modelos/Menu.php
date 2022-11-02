<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {
    protected $table = 'Menu';
    protected $primaryKey = 'idMenu';
    public $timestamps = false;

    protected $fillable = [
        'idMenu', 'glosa', 'descripcion', 'vigente'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];
}