<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalDataRequest extends FormRequest
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
        $id = session()->get('id');
        return [
            'name' => 'required|min:2',
            'surname' => 'required|min:2',
            'birthday' => 'required',
            'gender' => 'required',
            'nacionality' => 'required',
            'marital_status' => 'required',
            'rut_user' => 'sometimes|required|cl_rut|unique:aquabe_users,rut_user,' . $id
        ];
    }

    public function messages()
    {
        return [
            'rut_user.cl_rut' => "Rut no válido",
            'rut_user.required' => "El campo Rut es obligatorio",
            'name.required' => "El campo Nombre es obligatorio",
            'surname.required' => "El campo Apellidos es obligatorio",
            'birthday.required' => "El campo Fecha de Nacimiento es obligatorio",
            'nacionality.required' => "El campo Nacionalidad es obligatorio",
            'marital_status.required' => "El campo Estado Civil es obligatorio",
            'gender.required' => "El campo Género es obligatorio",
        ];
    }
}
