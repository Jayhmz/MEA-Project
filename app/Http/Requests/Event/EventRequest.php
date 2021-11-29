<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
      'description' => 'required',
      'event_category' => 'required',
      'event_type' => 'required',
      'start_date' => 'required',
      'end_date' => 'required',
      'flyer_url' => 'required',
      'requires_registration' => 'required',
      // 'external_reg_link' => 'required',
    ];
  }
}
