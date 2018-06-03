<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransmisionRequest extends FormRequest
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
            'nombre' => 'required|string',
            'modelo' => 'required|string',
            'cantidad' => 'required|integer',
            'marca' => 'required|string',
            'descripcion' => 'string|nullable',
            'modelosDisponibles' => 'required|string',
            'palancaCambios' => 'required|string'
        ];
    }
}
