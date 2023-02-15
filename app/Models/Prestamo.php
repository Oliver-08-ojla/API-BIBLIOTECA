<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $table='prestamos';
    protected $fillable=['fechaPrestamo','fechaDevolucion','fechaRealDevolucion','libro_id','cliente_id','usuario_id','isBorrowed','isReturn'];

   /*  public function Cliente(){
        return $this->belongsTo(Cliente::class);
    } */

    /* public function Libro(){
        return $this->belongsTo(Libro::class);
    }

    public function Usuario(){
        return $this->belongsTo(Usuario::class);
    } */

}
