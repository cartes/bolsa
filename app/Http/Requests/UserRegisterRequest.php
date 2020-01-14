<?php

namespace App\Http\Requests;

use Freshwork\ChileanBundle\Rut;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;

class UserRegisterRequest extends FormRequest
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
            'firstName' => 'required|min:2',
            'lastName' => 'required|min:2',
            'email' => 'required|email',
            'password' => 'required|min:4',
            'rut' => 'required|unique:aquabe_users,rut_user|cl_rut',
        ];
    }

    public function messages()
    {
        return [
            'rut.cl_rut' => "El Rut no es válido, digito verificador no corresponde",
            'rut.required' => "El campo Rut es obligatorio",
            "firstName.required" => "El campo Nombres es obligatorio",
            "lastName.required" => "El campo Apellidos es obligatorio",
            "email.required" => "El campo Email es obligatorio",
            "password.required" => "El campo Clave es obligatorio",
        ];
    }
}
