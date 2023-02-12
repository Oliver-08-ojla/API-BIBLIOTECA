<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps=false;

    protected $table='usuarios';
    protected $fillable=['nombre','apellido','cedula','correo','password'];

    public function Rol(){
        return $this->belongsTo(Rol::class);
    }

    public function Prestamo(){
        return $this->hasMany(Prestamo::class);
    }

}
