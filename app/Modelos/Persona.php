<?php
namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model {
    protected $table = 'Persona';
    protected $primaryKey = 'idPersona';
    public $timestamps = false;

    protected $fillable = [
        'idUsuario',
        'rut',
        'nombres',
        'apellido1',
        'apellido2',
        'fecha_nacimiento',
        'email',
        'direccion',
        'telefono',
        'celular',
        'idSexo',
        'idPais',
        'idRegion',
        'idProvincia',
        'idComuna',
        'seleccionable',
        'fecha_ingreso',
        'fecha_modifica',
        'vigente'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];
}