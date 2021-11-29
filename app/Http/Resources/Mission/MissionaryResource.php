<?php

namespace App\Http\Resources\Mission;

use Illuminate\Http\Resources\Json\JsonResource;

class MissionaryResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'title' => $this->title,
      'firstname' => $this->firstname,
      'othername' => $this->othername,
      'surname' => $this->surname,
      'phone' => $this->phone,
      'email' => $this->email,
      'country' => $this->country,
      'region' => $this->region,
      'state' => $this->state,
      'field_name'  => $this->field_name,
      'agency' => $this->agency,
      'agency_id' => $this->agency_id,
      'contact_address' => $this->contact_address,
      'sex' => $this->sex,
      'marital_status' => $this->marital_status,
      'num_children' => $this->num_children,
      'bio' => $this->bio,
      'about' => $this->about,
      'field_pics' => $this->field_pics,
      'needs_projects' => $this->needs_projects,
      'monthly_budget' => $this->monthly_budget,
      'photo' => $this->photo,
      'added_by' => $this->user,
    ];
  }
}
