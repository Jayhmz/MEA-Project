<?php

namespace App\Http\Resources\Project;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
          'category' => $this->categoryR,
          'category_id' => $this->category,
          'description' => $this->description,
          'target_amount' => $this->target_amount,
          'agency_id' => $this->agency_id,
          'agency' => $this->agency,
          'picture' => $this->picture,
          'added_by' => $this->addedBy,
          'project_giving' => $this->giving,
          'created_at' => $this->created_at
        ];
    }
}
