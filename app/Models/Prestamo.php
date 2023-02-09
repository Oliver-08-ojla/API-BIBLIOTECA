<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $table='prestamos';
    protected $fillable=['nombre','apellido','cedula','correo','telefono'];
}
