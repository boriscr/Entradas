<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('new_eventos', function (Blueprint $table) {
            $table->id();
            //Columna1: Nombre, Descripción, Precio, Cantidad
            $table->string('nombre');
            $table->string('tipo_de_evento');
            $table->string('descripcion_corta');
            $table->text('descripcion');
            $table->string('lugar');
            //Columna2: Lugar
            $table->dateTime('fecha_de_inicio');
            $table->string('hora_de_inicio');
            $table->dateTime('fecha_a_finalizar');
            $table->string('hora_a_finalizar');
            //Columna3: Configuracion extra
            $table->string('portadaImg');
            $table->boolean('apt_todo_publico')->default(false);
            $table->integer('edad_minima')->nullable();
            $table->integer('edad_maxima')->nullable();
            //Columna4: Vendidos, Recaudado, Activo
            $table->integer('vendidos')->default(0);
            $table->decimal('recaudado',10,2)->default(0);
            $table->boolean('activo');
            //Guardar valor de la entrada
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_eventos');
    }
};
