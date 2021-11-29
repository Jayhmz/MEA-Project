<?php

namespace App\Http\Requests\Mission;

use Illuminate\Foundation\Http\FormRequest;

class MissionTripRequest extends FormRequest
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
          'code_name' => 'required',
          'country' => 'required',
          'location' => 'required',
          'departure_date' => 'required',
          'duration' => 'required',
          'description' => 'required',
          'contact_person' => 'required',
          'contact_phone' => 'required',
          'contact_email' => 'required',
          'individual_budget' => 'required',
        ];
    }
}
