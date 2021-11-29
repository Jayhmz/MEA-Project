<?php

namespace App\Http\Controllers\Mission;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\AgencyRequest;
use App\Http\Resources\Mission\AgencyResource;
use App\Missions\Agency;
use Illuminate\Http\Request;

class AgencyController extends BaseController
{
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
        return $this->sendResponse(AgencyResource::collection(Agency::where('status', true)->get()), "Success");
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(AgencyRequest $request)
  {
    $agency = new Agency();
    $agency->fill($request->post());
    $agency->added_by = auth()->user()->id;
    if ($agency->save()) {
      $this->createNotification("created an agency, $agency->name", "/app/agency/$agency->id");
      return $this->sendResponse(new AgencyResource($agency), "Data saved");
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Missions\Agency  $agency
   * @return \Illuminate\Http\Response
   */
  public function show(Agency $agency)
  {
    if ($agency->status == false) {
      return $this->sendError("Data not found");
    }
    return $this->sendResponse(new AgencyResource($agency), "Success");
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Missions\Agency  $agency
   * @return \Illuminate\Http\Response
   */
  public function update(AgencyRequest $request, Agency $agency)
  {
    if ($agency->status == false) {
      return $this->sendError("Data not found");
    }
    $agency->fill($request->post());
    if ($agency->save()) {
      $this->createNotification("updated an agency, $agency->name", "/app/agency/$agency->id");
      return $this->sendResponse(new AgencyResource($agency), "Data updated");
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Missions\Agency  $agency
   * @return \Illuminate\Http\Response
   */
  public function destroy(Agency $agency)
  {
    if ($agency->status == false) {
      return $this->sendError("Data not found");
    }
    $agency->status = false;
    if ($agency->save()) {
      $this->createNotification("deleted an agency, $agency->name", "/app/agency/$agency->id");
      return $this->sendResponse(new AgencyResource($agency), "Data deleted");
    }
  }
}
