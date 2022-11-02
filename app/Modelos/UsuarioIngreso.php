<?php
namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class UsuarioIngreso extends Model {
    protected $table = 'Usuario_Ingreso';
    protected $primaryKey = 'idUsuarioIngreso';
    public $timestamps = false;
    
    protected $fillable = [
        'idUsuarioIngreso', 'idUsuario', 'so', 'explorador', 'version', 'cookies', 'ip', 'pais'
    ];
}