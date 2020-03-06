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
        return [
            'city' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'nacionality' => 'required',
            'objectives' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'birthday.required' => "El campo Fecha de Nacimiento es obligatorio",
            'gender.required' => "El campo Género es obligatorio",
            'nacionality.required' => "El campo Nacionalidad es obligatorio",
            'gender.required' => "El campo Género es obligatorio",
            'objectives.required' => "Los Objetivos Laborales son obligatorio",
        ];
    }
}
