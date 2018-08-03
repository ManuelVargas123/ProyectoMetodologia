<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaltasRequest extends FormRequest
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
            'empleado' => 'required|numeric',
            'fecha' => 'required|date',
            'razon' => 'required|string|max:20000'
        ];
    }
}
