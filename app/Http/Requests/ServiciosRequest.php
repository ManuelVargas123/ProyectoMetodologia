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
            'servicio' => 'required|string|max:255',
            'costo' => 'required|numeric|max:999999',
            'fecha' => 'required|date',
            'descripcion' => 'string|nullable|max:20000'
        ];
    }
}
