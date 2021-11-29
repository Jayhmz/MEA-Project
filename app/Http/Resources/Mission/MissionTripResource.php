<?php

namespace App\Http\Resources\Mission;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class MissionTripResource extends JsonResource
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
      "id" => $this->id,
      "code_name" => $this->code_name,
      "country" => $this->country,
      "location" => $this->location,
      "departure_date" => $this->departure_date,
      "duration" => $this->duration,
      "description" => $this->description,
      "contact_person" => $this->contact_person,
      "contact_phone" => $this->contact_phone,
      "contact_email" => $this->contact_email,
      "individual_budget" => $this->individual_budget,
      "signups" => $this->signups,
      /* "inprogress" => $this->tripsinprogress,
      "upcoming" => $this->upcomingtrips, */
      "added_by" => new UserResource(User::find($this->added_by)),
    ];
  }
}
