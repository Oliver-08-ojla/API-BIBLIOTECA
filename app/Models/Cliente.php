<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $table='clientes';
    protected $fillable=['nombre','apellido','cedula','correo','telefono'];
    
    public function Prestamo(){
        return $this->hasMany(Prestamo::class);
    }
}
