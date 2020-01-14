<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
            'business_name' => 'required|min:2',
            'business_activity' => 'required|min:2',
            'business_position' => 'required|min:2',
            'business_country' => 'required|min:2',
            'experience_level' => 'required',
            'month_from' => 'required',
            'year_from' => 'numeric|required|min:1950|max:2020',
            'to_present' => 'sometimes',
            'month_to' => 'required_without:to_present',
            'year_to' => 'numeric|required_without:to_present|max:2020',
            'area' => 'required|min:2',
            'sub_area' => 'required|min:2',
            'description' => 'required|min:2|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'business_name.required' => 'El campo Nombre de la empresa es obligatorio',
            'business_name.min' => 'Debe ingreser al menos 2 carácteres',
            'business_activity.required' => 'El campo Actividad de la empresa es obligatorio',
            'business_activity.min' => 'Debe ingreser al menos 2 carácteres',
            'business_position.required' => 'El campo Puesto es obligatorio',
            'business_position.min' => 'Debe ingreser al menos 2 carácteres',
            'business_country.required' => 'El campo País es obligatorio',
            'business_country.min' => 'Debe ingreser al menos 2 carácteres',
            'experience_level.required' => 'El campo Nivel de experiencia es obligatorio',
            'month_from.required' => 'El campo Mes desde es obligatorio',
            'year_from.required' => 'El campo Año desde es obligatorio',
            'year_from.numeric' => 'El campo Año debe ser numérico',
            'month_to.required_without' => 'El campo Mes hasta es obligatorio',
            'year_to.required_without' => 'El campo Año hasta es obligatorio',
            'year_to.numeric' => 'El campo Año debe ser numérico',
            'area.required' => 'El Área es obligatorio ',
            'sub_area.required' => 'El Subárea es obligatorio ',
        ];
    }
}
