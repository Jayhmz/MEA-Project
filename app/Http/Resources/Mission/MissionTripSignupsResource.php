<?php

namespace App\Http\Resources\Mission;

use Illuminate\Http\Resources\Json\JsonResource;

class MissionTripSignupsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
