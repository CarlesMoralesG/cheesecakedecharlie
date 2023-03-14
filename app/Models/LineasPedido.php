<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class LineasPedido extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'LineasPedido';

    protected $fillable = [
        'IdLineaPedido',
        'IdPedido', 
        'IdArticulo', 
        'IdUsuario', 
        'Cantidad', 
        'Precio', 
        'Estado', 
        'FechaPedido'
    ];
}
