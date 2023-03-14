<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|unique:Usuarios,email|max:200',
            'password' => 'required|max:200',
            'Direccion' => 'required|max:200',
            'CodigoPostal' => 'required|min:5|max:5',
            'Provincia' => 'required',
            'Poblacion' => 'required|max:200',
            'Telefono' => 'required|min:9|max:9',
            'EnvioPublicidad' => 'nullable',
            'TerminosCondiciones' => 'required'
        ];
    }
}
