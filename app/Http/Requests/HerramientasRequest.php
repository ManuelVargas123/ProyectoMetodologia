<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HerramientasRequest extends FormRequest
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
            'cantidad' => 'required|numeric|max:99999',
            'marca' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'string|nullable|max:20000',
            'caja_herramientas' => 'integer'
        ];
    }
}
