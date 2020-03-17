<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOfferRequest extends FormRequest
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
            'title' => 'required',
            'position' => 'required',
            'description' => 'required|min:15|max:3500',
            'area' => 'required',
            'sub_area' => 'required',
            'salary' => 'numeric'
        ];
    }

    public function messages()
    {
        return [
            'salary.numeric' => 'Renta ofrecida debe ser un valor numérico'
        ];
    }
}
