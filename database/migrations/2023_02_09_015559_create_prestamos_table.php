<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->date('fechaPrestamo');
            $table->date('fechaDevolucion');
            $table->date('fechaRealDevolucion')->nullable();
            $table->foreignId('libro_id')
            ->constrained('libros')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
            $table->foreignId('cliente_id')
            ->constrained('clientes')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
            $table->foreignId('usuario_id')
            ->constrained('usuarios')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
};
