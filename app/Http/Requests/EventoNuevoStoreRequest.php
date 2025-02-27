<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoNuevoStoreRequest extends FormRequest
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
            'tipo_de_evento' => 'required|string|min:3|max:255',
            'descripcion_corta' => 'required|string|min:3|max:83',
            'descripcion' => 'required|string|min:5',
            'lugar' => 'required|string|min:3|max:255',
            //Columna2: Lugar
            'hora_de_inicio' => 'required|string',
            'fecha_de_inicio' => 'required|date',
            //Columna3: Fecha de fin
            'fecha_a_finalizar' => 'required|date',
            'hora_a_finalizar' => 'required|string',
            'portada_image' => 'required|mimes:png,jpg,jpeg|max:4096',
        ];
    }
}
