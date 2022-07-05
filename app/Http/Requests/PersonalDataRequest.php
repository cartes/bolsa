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
            'birthday' => 'required|date_format:d-m-Y',
            'gender' => 'required',
            'nacionality' => 'required',
            'pretentions' => 'required',
            'objectives' => 'required',
            'marital_status' => 'required',
            'picture' => 'mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'birthday.required' => "El campo Fecha de Nacimiento es obligatorio",
            "birthday.date_format" => "El formato no corresponde (dd-mm-yyyy)",
            'gender.required' => "El campo Género es obligatorio",
            'nacionality.required' => "El campo Nacionalidad es obligatorio",
            'objectives.required' => "Los Objetivos Laborales son obligatorio",
            'picture.mimes' => "Solo formato jpeg o png",
            'picture.max' => "Archivo debe pesar menos de 2 Mbytes",
        ];
    }
}
