<?php

namespace App\Http\Controllers\Mission;

use Illuminate\Http\Request;
use App\Missions\MissionTrip;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Mission\MissionTripRequest;
use App\Http\Resources\Mission\MissionTripResource;

class MissionTripController extends BaseController
{

  /* public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['index', 'show']]);
  } */
  public function __construct() {
    $this->middleware('utility:api', ['only' => ['store', 'update', 'destroy']]);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $trips = MissionTripResource::collection(MissionTrip::where('status', true)->get());
    $data = (object) [
      'trips' => $trips,
      'upcoming' => $this->upcoming(),
      'inprogress' => $this->inprogress(),
    ];
    return $this->sendResponse($data, "success");
  }

  private function inprogress()
  {
    $trips = MissionTrip::where('status', true)->get();
    $inprogress = [];
    $currentdate = strtotime('now');
    foreach ($trips as $trip) {
      if ($currentdate > strtotime($trip->departure_date)){
        $inprogress[] = $trip;
      }
      
    }

    // return MissionTripResource::collection($inprogress);
    return count($inprogress);
  }

  private function upcoming()
  {
    $trips = MissionTrip::where('status', true)->get();
    $upcoming = [];
    $currentdate = strtotime('now');
    foreach ($trips as $trip) {
      if (strtotime($trip['departure_date']) > $currentdate){
        $upcoming[] = $trip;
      }
      
    }

    // return MissionTripResource::collection($upcoming);
    return count($upcoming);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(MissionTripRequest $request)
  {
    $missionTrip = new MissionTrip;
    $missionTrip->fill($request->post());
    $missionTrip->added_by = auth()->user()->id;
    if ($missionTrip->save()) {
      $this->createNotification("created mission trip, $missionTrip->code_name", "/app/trip/$missionTrip->id");
      return $this->sendResponse(new MissionTripResource($missionTrip), "success");
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(MissionTrip $missionTrip)
  {
    if(!$missionTrip->status) {
      return $this->sendError("Mission trip does not exist");
    }
    return $this->sendResponse(new MissionTripResource($missionTrip), "success");
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(MissionTrip $missionTrip, MissionTripRequest $request)
  {
    if(!$missionTrip->status) {
      return $this->sendError("Mission trip does not exist");
    }
    $missionTrip->fill($request->post());
    if($missionTrip->save()) {
      $this->createNotification("updated mission trip, $missionTrip->code_name", "/app/trip/$missionTrip->id");
      return $this->sendResponse(new MissionTripResource($missionTrip), "success");
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(MissionTrip $missionTrip)
  {
    if(!$missionTrip->status) {
      return $this->sendError("Mission trip does not exist");
    }
    $missionTrip->status = false;
    if($missionTrip->save()) {
      $this->createNotification("deleted mission trip, $missionTrip->code_name", "/app/trip/$missionTrip->id");
      return $this->sendResponse(null, "Deleted");
    }
  }
}
