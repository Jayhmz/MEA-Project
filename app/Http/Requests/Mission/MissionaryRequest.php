<?php

namespace App\Http\Requests\Mission;

use Illuminate\Foundation\Http\FormRequest;

class MissionaryRequest extends FormRequest
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
            'firstname' => 'required',
            // 'othername' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            // 'email' => 'required',
            'country' => 'required',
            // 'region' => 'required',
            // 'state' => 'required',
            'field_name' => 'required',
            // 'agency_id' => 'required',
            'contact_address' => 'required',
            'sex' => 'required',
            'marital_status' => 'required',
            // 'num_children' => 'required',
            'bio' => 'required',
            'about' => 'required',
            // 'field_pics' => 'required',
            // 'needs_project' => 'required',
            // 'monthly_budget' => 'required',
            // 'photo' => 'required',
            // 'classified' => 'required'
        ];
    }
}
