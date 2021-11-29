<?php

namespace App\Http\Requests\Mission;

use Illuminate\Foundation\Http\FormRequest;

class MissionTripSignupsRequest extends FormRequest
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
      // 'trip_uuid' => 'required',
      'first_name' => 'required',
      'surname' => 'required',
      'sex' => 'required',
      'phone' => 'required|numeric',
      'email' => 'required|email',
    ];
  }
}
