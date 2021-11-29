<?php

namespace App\Http\Controllers;

use App\Partnership;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\PartnershipRequest;
use App\Http\Resources\PartnershipResource;
use App\Notifications\Partnership as NotificationsPartnership;

class PartnershipController extends BaseController
{
  public function __construct() {
    $this->middleware('utility:api', ['only' => ['update', 'destroy']]);
  }
  // public function __construct()
  // {
  //   $this->middleware('utility:api', ['only' => ['store', 'update', 'destroy']]);
  // public function __construct() {
  //   $this->middleware('utility:api', ['only' => ['update', 'destroy']]);
  // }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return $this->sendResponse(PartnershipResource::collection(Partnership::where('status', true)->get()), 'success');
  }

  public function store(PartnershipRequest $request)
  {
    $partnership = new Partnership();
    $partnership->fill($request->post());
    if ($partnership->save()) {
      $this->clientNotification("New Partnership request from $partnership->organization", "/app/partnership/$partnership->id");
      $partnership->notify(new NotificationsPartnership($partnership));
      return $this->sendResponse(new PartnershipResource($partnership), 'success');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Partnership  $partnership
   * @return \Illuminate\Http\Response
   */
  public function show(Partnership $partnership)
  {
    return $this->sendResponse(new PartnershipResource($partnership), 'success');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Partnership  $partnership
   * @return \Illuminate\Http\Response
   */
  public function update(Partnership $partnership, PartnershipRequest $request)
  {
    // $partnership->fill($request->post());
    $partnership->treated_by = auth()->user()->id;
    if ($partnership->save()) {
      return $this->sendResponse(new PartnershipResource($partnership), 'success');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Partnership  $partnership
   * @return \Illuminate\Http\Response
   */
  public function destroy(Partnership $partnership)
  {
    if ($partnership->delete()) {
      return $this->sendResponse(new PartnershipResource($partnership), 'success');
    }
  }
}
