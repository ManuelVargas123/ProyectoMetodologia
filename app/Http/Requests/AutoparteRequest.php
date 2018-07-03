<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutoparteRequest extends FormRequest
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
            'parte' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'cantidad' => 'required|integer|max:99999',
            'marca' => 'required|string|max:255',
            'descripcion' => 'string|max:20000|nullable',
            'modelos_disponibles' => 'required|string|max:255',
            'palancaCambios' => 'string|nullable|max:255',
            'cilindros' => 'integer|nullable'
        ];
    }
}
