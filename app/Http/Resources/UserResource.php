<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'firstname' => $this->firstname,
      'surname' => $this->surname,
      'email' => $this->email,
      'sex' => $this->sex,
      'job_title' => $this->job_title,
      'role' => (int)$this->role,
      // 'roleText' => $this->role == 0 ? 'Super Admin' : $this->role == 1 ? 'Administrator' : 'Report Viewer',
      'roleText' => $this->getRoleText($this->role),
      'created_by' => $this->user,
      'photo_url' => $this->photo_url,
    ];
  }

  public function getRoleText($role)
  {
    if ($role == 0) {
      return 'Super Admin';
    } else if ($role == 1) {
      return 'Administrator';
    } else if ($role == 2) {
      return 'Report Viewer';
    }
  }
}
