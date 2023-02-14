<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    /* use HasApiTokens, HasFactory, Notifiable;
    public $timestamps=false;
    protected $table='usuarios';
    protected $fillable=['nombre','apellido','cedula','correo','password'];

    public function Rol(){
        return $this->belongsTo(Rol::class);
    }

    public function Prestamo(){
        return $this->hasMany(Prestamo::class);
    } */
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps=false;
    protected $table='usuarios';
    protected $fillable=['nombre','apellido','cedula','correo','password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
        Añadiremos estos dos métodos
    */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

}
