<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnershipRequest extends FormRequest
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
      'contact_person' => 'required',
      'organization' => 'required',
      'partnership_type' => 'required',
      'info' => 'required',
      'contact_email' => 'required',
      'contact_phone' => 'required'
    ];
  }
}
