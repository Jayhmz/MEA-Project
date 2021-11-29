<?php

namespace App\Http\Controllers;

use App\PrayerNeed;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\PrayerNeedRequest;
use App\Http\Resources\PrayerNeedResource;

class PrayerNeedController extends BaseController
{

  public function __construct() {
    $this->middleware('utility:api', ['only' => ['update', 'destroy']]);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if($request->all && $request->all ==  1) {
      return $this->sendResponse(PrayerNeedResource::collection(PrayerNeed::where('status', true)->get()), 'success');
    }
    return $this->sendResponse(PrayerNeedResource::collection(PrayerNeed::where('status', true)->where('treated', false)->get()), 'success');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(PrayerNeedRequest $request)
  {
    $prayerNeed = new PrayerNeed();
    $prayerNeed->fill($request->post());
    if ($prayerNeed->save()) {
      $this->clientNotification("New Prayer Request from $prayerNeed->name", "/app/prayerneeds");
      return $this->sendResponse(new PrayerNeedResource($prayerNeed), 'success');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\PrayerNeed  $prayerNeed
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $prayerNeed = PrayerNeed::findOrFail($id);
    if ($prayerNeed->status == false) {
      return $this->sendError("Data not found");
    }
    return $this->sendResponse(new PrayerNeedResource($prayerNeed), 'success');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\PrayerNeed  $prayerNeed
   * @return \Illuminate\Http\Response
   */
  public function update($id, PrayerNeedRequest $request)
  {
    $prayerNeed = PrayerNeed::findOrFail($id);
    if ($prayerNeed->status == false) {
      return $this->sendError("Data not found");
    }
    $prayerNeed->fill($request->post());
    if ($prayerNeed->save()) {
      return $this->sendResponse(new PrayerNeedResource($prayerNeed), 'success');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\PrayerNeed  $prayerNeed
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $prayerNeed = PrayerNeed::findOrFail($id);
    if ($prayerNeed->status == false) {
      return $this->sendError("Data not found");
    }
    $prayerNeed->status = false;
    if ($prayerNeed->save()) {
      return $this->sendResponse($prayerNeed, 'Data deleted');
    }
  }
}
