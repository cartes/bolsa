<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
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
            'country_st' => 'required',
            'studies' => 'required',
            'condition' => 'required',
            'title' => 'required|min:3',
            'area_st' => 'required',
            'month_from_st' => 'required',
            'year_from_st' => 'numeric|required|min:1950|max:2020',
            'to_present_st' => 'sometimes',
            'month_to_st' => 'required_without:to_present_st',
            'year_to_st' => 'numeric|required_without:to_present_st|max:2020',
            'institution' => 'required'
        ];
    }
}
