<?php

namespace Database\Seeders;

use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrestamoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prestamo::create([
            'fechaPrestamo'=>'2022-02-08',
            'fechaDevolucion'=>'2022-02-15',
            'libro_id'=>'1',
            'cliente_id'=>'1',
            'usuario_id'=>'2'
        ]);

        Libro::findOrFail(1)->update([
            'estado'=>0
        ]);
    }
}
