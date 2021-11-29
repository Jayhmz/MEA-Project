<?php

namespace App\Http\Requests\Mission;

use Illuminate\Foundation\Http\FormRequest;

class AgencyRequest extends FormRequest
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
            'name' => 'required',
            // 'acronym' => 'required',
            'primary_country' => 'required',
            'address' => 'required',
            'phone' => 'required',
            // 'email' => 'required',
            // 'logo' => 'required'
        ];
    }
}
