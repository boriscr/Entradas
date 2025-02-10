<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntradaNuevaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre_del_evento' => 'required|string|min:3|max:255',
            'tipo_de_entrada'=> 'required|string|min:3|max:255',
            'descripcion_corta'=>'required|string|min:3|max:70',
            'descripcion' => 'required|string|min:5',
            'precio' => 'required|numeric|min:1|max:99999999',
            'cantidad' => 'required|integer|min:1',
            //Columna2: Lugar
            'hora_de_inicio' => 'required|string',
            'fecha_de_inicio' => 'required|date',
            'lugar' => 'required|string|min:3|max:255',
            //Columna3: Fecha de fin
            'fecha_a_finalizar'=> 'required|date',
            'hora_a_finalizar' => 'required|string',
        ];
    }
}
