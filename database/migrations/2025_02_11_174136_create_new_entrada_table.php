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
        Schema::create('new_entradas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_evento')->constrained('new_eventos')->cascadeOnDelete();
            //Columna1: Nombre, Descripción, Precio, Cantidad
            $table->string('tipo_de_entrada');
            $table->text('descripcion');
            $table->decimal('precio', 8, 2);
            $table->integer('cantidad');
            //Columna2: Lugar
            $table->decimal('porcentaje_de_descuento',5,2)->nullable();
            $table->decimal('precio_final')->nullable();
            $table->string('cupon')->nullable();
            $table->integer('cantidad_minima_de_entradas')->nullable();
            $table->integer('cantidad_maxima_de_entradas')->nullable();
            //Columna3: Configuracion extra
            $table->integer('asientos')->nullable();
            $table->string('ubicacion')->nullable();

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
        Schema::dropIfExists('new_entradas');
    }
};
