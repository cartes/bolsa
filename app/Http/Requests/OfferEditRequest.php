<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferEditRequest extends FormRequest
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
            'title' => 'required|min:2',
            'description' => 'required|min:10|max:3500',
            'area' => 'required',
            'sub_area' => 'required',
        ];
    }
}
