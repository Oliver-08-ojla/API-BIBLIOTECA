<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
            'nombre'=>'admin',
            'apellido'=>'admin',
            'cedula'=>'1313897710',
            'correo'=>'admin@hotmail.com',
            'password'=>bcrypt('admin123'),
            'rol_id'=>'1'
            

        ]);

        Usuario::create([
            'nombre'=>'chala',
            'apellido'=>'admin',
            'cedula'=>'1313897711',
            'correo'=>'chalita@hotmail.com',
            'password'=>bcrypt('admin123'),
            'rol_id'=>'2'
            

        ]);
    }
}
