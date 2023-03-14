<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'Nombre' => 'required|max:100',
            'Apellido' => 'required|max:100',
            'password' => 'required|min:6|max:50',
            'Direccion' => 'required|max:100',
            'CodigoPostal' => 'required|min:5|numeric|max:5',
            'Telefono' => 'required|min:9|numeric|max:9',
            'Poblacion' => 'required|max:100'
        ];
    }
}
