<?php

namespace App\Http\Controllers\Event;

use App\Event;
use App\EventRegistration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Event\EventRegistrationRequest;
use App\Http\Resources\Event\EventRegistrationResource;

class EventRegistrationController extends BaseController
{
  /* public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['index', 'show']]);
  } */
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
    return $this->sendResponse(EventRegistrationResource::collection(EventRegistration::where('status', true)->get()), 'success');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Event $event, EventRegistrationRequest $request)
  {
    $registration = new EventRegistration;
    $registration->fill($request->post());
    $registration->event_uuid = $event->id;
    if ($registration->save()) {
      return $this->sendResponse(new EventRegistrationResource($registration), 'success');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Event $event, EventRegistration $registration)
  {
    if(!$registration->status) {
      return $this->sendError("Event registration does not exist");
    }
    return $this->sendResponse(new EventRegistrationResource($registration), 'success');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Event $event, EventRegistration $registration, Request $request)
  {
    if(!$registration->status) {
      return $this->sendError("Event registration does not exist");
    }
    $registration->fill($request->post());
    if ($registration->save()) {
      return $this->sendResponse(new EventRegistrationResource($registration), 'success');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Event $event, EventRegistration $registration)
  {
    if(!$registration->status) {
      return $this->sendError("Event registration does not exist");
    }
    $registration->status = false;
    if ($registration->save()) {
      return $this->sendResponse(null, 'Deleted');
    }
  }
}
