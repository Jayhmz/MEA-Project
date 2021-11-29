<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrayerNeedResource extends JsonResource
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
            'details' => $this->details,
            'name' => $this->name,
            'email' => $this->email,
            'treated' => $this->treated,
            'created_at' => $this->created_at,
            // 'numOfTreated' => $this->treated(),
            // 'numOfNotTreated' => $this->nottreated()
        ];
    }
}
