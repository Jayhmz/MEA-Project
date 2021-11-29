<?php

namespace App\Missions;

use App\Http\Resources\Mission\MissionaryResource;
use App\Http\Resources\Mission\MissionTripResource;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class MissionTrip extends Model
{
  use Uuid;

  protected $fillable = [
    'code_name',
    'country',
    'location',
    'departure_date',
    'duration',
    'description',
    'contact_person',
    'contact_phone',
    'contact_email',
    'individual_budget',
  ];

  public function signups()
  {
    return $this->hasMany('App\Missions\MissionTripSignups', 'trip_uuid', 'id');
  }

  /* public function getTripsInProgressAttribute()
  {
    $trips = MissionTrip::where('status', true)->get();
    $inprogress = [];
    $currentdate = strtotime('now');
    foreach ($trips as $trip) {
      if ($currentdate > strtotime($trip->departure_date));
      $inprogress[] = $trip;
    }

    // return MissionTripResource::collection($inprogress);
    return count($inprogress);
  } */

  /* public function getUpcomingTripsAttribute()
  {
    $trips = MissionTrip::where('status', true)->get();
    $upcoming = [];
    $currentdate = strtotime('now');
    foreach ($trips as $trip) {
      if ($currentdate < strtotime($trip->departure_date));
      $upcoming[] = $trip;
    }

    // return MissionTripResource::collection($upcoming);
    return count($upcoming);
  } */
}
