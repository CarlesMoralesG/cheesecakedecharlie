<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuarios extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'Usuarios';

    protected $fillable = [
        'Nombre', 
        'Apellido', 
        'email', 
        'password', 
        'Direccion', 
        'CodigoPostal', 
        'Provincia', 
        'Telefono', 
        'Rol',
        'EnvioPublicidad', 
        'IndBaja', 
        'FechaBaja',
        'Poblacion'
    ];

    protected $hidden = [
        'password'
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

}
