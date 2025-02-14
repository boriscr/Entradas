<?php

namespace App\Models;

use App\Http\Controllers\EntradaAdminController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewEvento extends Model
{

    function entradas()
    {
        return $this->HasMany(NewEntrada::class, 'id');
    }
}
