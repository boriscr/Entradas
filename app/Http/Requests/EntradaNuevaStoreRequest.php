<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class entradaNuevaStoreRequest extends FormRequest
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
            'evento'=>'required',
            'tipo_de_entrada'=> 'required|string|min:3|max:255',
            'descripcion' => 'required|string|min:5',
            'precio' => 'required|numeric|min:1|max:99999999',
            'cantidad' => 'required|integer|min:1',
        ];
    }
}
