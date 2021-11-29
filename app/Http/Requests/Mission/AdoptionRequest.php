<?php

namespace App\Http\Requests\Mission;

use Illuminate\Foundation\Http\FormRequest;

class AdoptionRequest extends FormRequest
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
            'missionary_id' => 'required',
            'donor_name' => 'required',
            'donor_phone' => 'required',
            'donor_email' => 'required',
            'donor_sex' => 'required',
            // 'donation_frequency' => 'required',
            'amount' => 'required',
            'currency' => 'required',
            'date' => 'required',
            'mode_of_payment' => 'required',
            'online_payment_id' => 'required',
            'success' => 'required',
        ];
    }
}
