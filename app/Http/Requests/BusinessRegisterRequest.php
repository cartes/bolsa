<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessRegisterRequest extends FormRequest
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
            'firstname' => 'required|min:2',
            'surname' => 'required|min:2',
            'email_business' => 'required|email',
            'phone_business' => 'required',
            'rut_user' => 'required|cl_rut',
            'position' => 'required',
            'passbusiness' => 'required|confirmed|min:4',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => "El campo Nombre es obligatorio",
            'firstname.min' => "El campo Nombre debe contener al menos 2 caracteres",
            'surname.required' => "El campo Apellido es obligatorio",
            'rut_user.cl_rut' => "Debe ingresar un rut válido",
            'surname.min' => "El campo Apellido debe contener al menos 2 caracteres",
            'email.required' => "El campo Email es obligatorio",
        ];
    }
}
