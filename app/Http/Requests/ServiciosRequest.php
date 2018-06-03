<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiciosRequest extends FormRequest
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
            'servicio' => 'required|string',
            'costo' => 'required|numeric',
            'fecha' => 'required|date',
            'descripcion' => 'string|nullable'
        ];
    }
}
