<?php
namespace App\Modelos;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmail;
use App\Notifications\VerifyChangeEmail;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable implements MustVerifyEmail {
    use Notifiable;
    
    protected $table = 'Usuario';
    protected $primaryKey = 'idUsuario';
    public $incrementing = false;
    public $timestamps = false;
    protected $guard = 'users';

    protected $fillable = [
        'nombre', 'apellido', 'idUsuario', 'email', 'password', 'bloqueado', 'cambioPassword', 'email_verified_at', 'remember_token', 'vigente'
    ];

    protected $hidden = [
        'password', 'bloqueado', 'email_verified_at', 'fecha_caduca', 'fecha_creacion', 'fecha_modifica', 'vigente'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];
    
    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPasswordNotification($token));
    }
    
    public function sendEmailVerificationNotification() {
        $this->notify(new VerifyEmail);
    }
    
    public function sendChangeEmailVerificationNotification() {
        $this->notify(new VerifyChangeEmail);
    }
}