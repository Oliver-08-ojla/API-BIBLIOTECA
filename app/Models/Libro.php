<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $table='libros';
    protected $fillable=['titulo','autor','url_libro','image_id'];

    public function Prestamo(){
        return $this->hasMany(Prestamo::class);
    }
}
