<?php

namespace App\Missions;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class MissionTripSignups extends Model
{
  use Uuid;

  protected $fillable = [
    // 'trip_uuid',
    'first_name',
    'surname',
    'sex',
    'phone',
    'email',
  ];

  private function trip() {
    return $this->belongsTo('App\Missions\MissionTrip', 'id', 'trip_uuid');
  }
}
