<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventRegistrationRequest extends FormRequest
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
      'event_uuid' => 'required',
      'first_name' => 'required',
      'surname' => 'required',
      'sex' => 'required',
      'phone' => 'required',
      'email' => 'required',
    ];
  }
}
