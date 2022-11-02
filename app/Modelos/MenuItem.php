<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model {
    protected $table = 'Menu_Item';
    protected $primaryKey = 'idMenu_Item';
    public $timestamps = false;

    protected $fillable = [
        'idMenu_Item', 'padre', 'glosa', 'link', 'imagen', 'target', 'desplegable', 'habilitado', 'descripcion', 'orden', 'vigente', 'idMenu'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];
}