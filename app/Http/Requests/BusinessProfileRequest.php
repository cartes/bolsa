<?php

namespace App\Http\Requests;

use App\Business;
use Illuminate\Foundation\Http\FormRequest;

class BusinessProfileRequest extends FormRequest
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
        $id_user = session()->get('id');
        $business = Business::where('id', $id_user)->with('business_meta')->first();
        $id = $business->business_meta->id;

        return [
            'businessName' => 'required',
            'activity' => 'required',
            'email' => 'email|required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'comune' => 'required',
            'phone' => 'required',
            'rut_business' => 'required|cl_rut|unique:aquabe_business_meta,rut_business,' . $id,
        ];
    }
}
