<?php

namespace App\Http\Controllers\Mission;

use Illuminate\Http\Request;
use App\Missions\MissionTrip;
use App\Http\Controllers\Controller;
use App\Missions\MissionTripSignups;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Mission\MissionTripSignupsRequest;
use App\Http\Resources\Mission\MissionTripSignupsResource;

class MissionTripSignupsController extends BaseController
{
  /* public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['index', 'show']]);
  } */
  public function __construct() {
    $this->middleware('admin:api', ['only' => ['update', 'destroy']]);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(MissionTrip $missionTrip)
  {
    return $this->sendResponse(MissionTripSignupsResource::collection(MissionTripSignups::where('status', true)->where('trip_uuid', $missionTrip->id)->get()), "success");
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(MissionTrip $missionTrip, MissionTripSignupsRequest $request)
  {
    $signups = new MissionTripSignups;
    $signups->fill($request->post());
    $signups->trip_uuid = $missionTrip->id;
    if ($signups->save()) {

      return  $this->sendResponse(new MissionTripSignupsResource($signups), "success");
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(MissionTrip $missionTrip, MissionTripSignups $signups)
  {
    if (!$signups->status) {
      return $this->sendError("Mission trip Sign up does not exist");
    }
    return $this->sendResponse(new MissionTripSignupsResource($signups), "success");
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(MissionTrip $missionTrip, MissionTripSignups $signups, MissionTripSignupsRequest $request)
  {
    if (!$signups->status) {
      return $this->sendError("Mission trip Sign up does not exist");
    }
    $signups->fill($request->post());
    if ($signups->save()) {
      return  $this->sendResponse(new MissionTripSignupsResource($signups), "success");
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(MissionTrip $missionTrip, MissionTripSignups $signups)
  {
    if (!$signups->status) {
      return $this->sendError("Mission trip Sign up does not exist");
    }
    $signups->status = false;
    if ($signups->save()) {
      return  $this->sendResponse(null, "Deleted");
    }
  }
}
