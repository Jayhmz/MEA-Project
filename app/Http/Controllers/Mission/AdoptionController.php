<?php

namespace App\Http\Controllers\Mission;

use App\Http\Controllers\BaseController;
use App\Missions\Adoption;
use App\Http\Requests\Mission\AdoptionRequest;
use App\Http\Resources\Mission\AdoptionResource;
use App\Notifications\Adoption as NotificationsAdoption;
use Illuminate\Http\Request;

class AdoptionController extends BaseController
{
    public function __construct() {
        $this->middleware('utility:api', ['only' => ['update', 'destroy']]);
      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponse(AdoptionResource::collection(Adoption::where('status', 1)->get()), "Success");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdoptionRequest $request)
    {
        $adoption = new Adoption();
        $adoption->fill($request->post());
        if($adoption->save()) {
          $this->createNotification("new adoption from $adoption->donor_name", "/app/adoptions");
            $adoption->notify(new NotificationsAdoption($adoption));
            return $this->sendResponse(new AdoptionResource($adoption), "Data saved");
        }
    }

  /**
   * Display the specified resource.
   *
   * @param  \App\Adoption  $adoption
   * @return \Illuminate\Http\Response
   */
  public function show(Adoption $adoption)
  {
    if ($adoption->status == false) {
      return $this->sendError("Data not found");
    }
    return $this->sendResponse(new AdoptionResource($adoption), "Success");
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Adoption  $adoption
   * @return \Illuminate\Http\Response
   */
  public function update(AdoptionRequest $request, Adoption $adoption)
  {
    if ($adoption->status == false) {
      return $this->sendError("Data not found");
    }
    $adoption->fill($request->post());
    if ($adoption->save()) {
      return $this->sendResponse(new AdoptionResource($adoption), "Data updated");
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Adoption  $adoption
   * @return \Illuminate\Http\Response
   */
  public function destroy(Adoption $adoption)
  {
    if ($adoption->status == false) {
      return $this->sendError("Data not found");
    }
    $adoption->status = false;
    if ($adoption->save()) {
      return $this->sendResponse(new AdoptionResource($adoption), "Data deleted");
    }
  }
}
