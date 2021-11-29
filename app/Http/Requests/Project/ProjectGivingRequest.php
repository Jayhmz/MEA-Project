<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectGivingRequest extends FormRequest
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
            'amount' => 'required',
            'project_id' => 'required',
            'date' => 'required',
            'donor_name' => 'required',
            'donor_contact' => 'required',
            'currency' => 'required',
            'transaction_id' => 'required'
        ];
    }
}
