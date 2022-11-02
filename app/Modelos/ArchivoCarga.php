<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class ArchivoCarga extends Model {
    protected $table = 'Archivo_Carga';
    protected $primaryKey = 'idArchivo_Carga';
    public $timestamps = false;

    protected $fillable = [
        'idArchivo_Carga',
        'idPersona',
        'nombre_archivo',
        'ruta_archivo',
        'procesado'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];
}