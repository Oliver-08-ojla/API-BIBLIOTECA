<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $table='usuarios';
    protected $fillable=['fechaPrestamo','fechaDevolucion','fechaRealDevolucion','libro_id','cliente_id'];
}
