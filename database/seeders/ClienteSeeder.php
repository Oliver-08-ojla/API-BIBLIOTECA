<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([

            'nombre'=>'Chala',
            'apellido'=>'Loor',
            'cedula'=>'1313897711',
            'correo'=>'chala@hotmail.com',
            'telefono'=>'0994861344'
        ]);
    }
}
