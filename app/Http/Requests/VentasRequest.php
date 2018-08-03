<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentasRequest extends FormRequest
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
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string',
            'descripcion' => 'nullable|string|max:20000',
            'costo' => 'required|numeric',
            'moneda' => 'required|string',
            'motor' => 'nullable|numeric',
            'transmision' => 'nullable|numeric',
            'autoparte' => 'nullable|numeric',
            'cantidadMotor' => 'nullable|integer',
            'cantidadTransmision' => 'nullable|integer',
            'cantidadAutoparte' => 'nullable|integer'
        ];
    }
}
