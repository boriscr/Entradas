<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewEntrada extends Model
{
    // Indica el nombre de la tabla asociada al modelo
    protected $table = 'new_entradas';

    protected $fillable = [
        'tipo_de_entrada',
        'descripcion',
        'precio',
        'cantidad',
        'vendidos',
        'recaudado',
        'activo',
    ];


    function eventos()
    {
        return $this->belongsTo(NewEvento::class, 'id_evento');
    }
}
