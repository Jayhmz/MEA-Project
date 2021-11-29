<?php

namespace App\Http\Resources\Event;

use App\EventCategories;
use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Event\EventRegistrationResource;

class EventResource extends JsonResource
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
      "added_by" => new UserResource(User::find($this->added_by)),
      "created_at" => $this->created_at,
      "description" => $this->description,
      "end_date" => $this->end_date,
      "event_category" => EventCategories::find($this->event_category),
      "event_type" => $this->event_type,
      "external_reg_link" => $this->external_reg_link,
      "flyer_url" => $this->flyer_url,
      "id" => $this->id,
      'signups' => EventRegistrationResource::collection($this->signups),
      "requires_registration" => $this->requires_registration,
      "start_date" => $this->start_date,
      "status" => $this->status,
      "title" => $this->title,
      "event_status" => $this->eventstatus,
      "updated_at" => $this->updated_at,
    ];
  }
}
