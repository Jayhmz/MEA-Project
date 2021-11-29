<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnershipResource extends JsonResource
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
      'organization' => $this->organization,
      'info' => $this->info,
      'partnership_type' => $this->partnership_type,
      'contact_person' => $this->contact_person,
      'contact_email' => $this->contact_email,
      'treated_by' => $this->user,
    ];
  }
}
