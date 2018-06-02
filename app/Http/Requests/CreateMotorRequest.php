<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMotorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|max:255',
            'modelo' => 'required|max:255',
            'cantidad' => 'required|integer|max:999999',
            'marca' => 'required|max:255',
            'descripcion' => 'required|max:50000',
            'modelos_disponibles' => 'required|max:20000',
            'cilindros' => 'required|max:255',
            'modelos_disponibles' => 'required|max:20000'
        ];
    }
}
