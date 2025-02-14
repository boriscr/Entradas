<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newentrada extends Model
{
    // Indica el nombre de la tabla asociada al modelo
    protected $table = 'new_entradas';
    function eventos()
    {
        return $this->belongsTo(NewEvento::class, 'id_evento');
    }
}
