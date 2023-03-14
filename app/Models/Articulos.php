<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Articulos extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'Articulos';

    protected $fillable = [
        'IdArticulos',
        'IdCategoria', 
        'DescripcionArticulo', 
        'PrecioArticulo', 
        'Resumen', 
        'StockArticulo', 
        'Tamanyo', 
        'Talla', 
        'Imagen', 
        'Esfavorito', 
        'IndBaja',
        '_token',
        'updated_at'
    ];
}
