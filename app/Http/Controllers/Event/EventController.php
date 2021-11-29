<?php

namespace App\Http\Controllers\Event;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Event\EventRequest;
use App\Http\Resources\Event\EventResource;

class EventController extends BaseController
{
  /* public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['index', 'show']]);
  } */
  public function __construct() {
    $this->middleware('auth:admin', ['only' => ['store', 'update', 'destroy']]);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $events = EventResource::collection(Event::where('status', true)->get());
    $data = (object) [
      'events' => $events,
      'upcoming' => $this->upcoming(),
      'expired' => $this->expired(),
      'inprogress' => $this->inprogress(),
    ];
    return $this->sendResponse($data, "success");
  }

  private function inprogress()
  {
    $events = Event::where('status', true)->get();
    $inprogress = [];
    $currentdate = strtotime('now');
    foreach ($events as $event) {
      if ($currentdate > strtotime($event->start_date) && $currentdate < strtotime($event->end_date)) {
        $inprogress[] = $event;
      }
    }

    // return MissioneventResource::collection($inprogress);
    return count($inprogress);
  }

  private function expired()
  {
    $events = Event::where('status', true)->get();
    $inprogress = [];
    $currentdate = strtotime('now');
    foreach ($events as $event) {
      if ($currentdate > strtotime($event->start_date) && $currentdate > strtotime($event->end_date)) {
        $inprogress[] = $event;
      }
    }

    // return MissioneventResource::collection($inprogress);
    return count($inprogress);
  }

  private function upcoming()
  {
    $events = Event::where('status', true)->get();
    $upcoming = [];
    $currentdate = strtotime('now');
    foreach ($events as $event) {
      if ($currentdate < strtotime($event->start_date) && $currentdate < strtotime($event->end_date)) {
        $upcoming[] = $event;
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
  public function store(EventRequest $request)
  {
    $event = new Event;
    $event->fill($request->post());
    $event->added_by = auth()->user()->id;
    if ($event->save()) {
      $this->createNotification("created an event, $event->title", "/app/event/$event->id");
      return $this->sendResponse(new EventResource($event), "success");
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Event $event)
  {
    if (!$event->status) {
      return $this->sendError("Event does not exist");
    }
    return $this->sendResponse(new EventResource($event), "success");
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Event $event, EventRequest $request)
  {
    if (!$event->status) {
      return $this->sendError("Event does not exist");
    }
    $event->fill($request->post());
    if ($event->save()) {
      $this->createNotification("updated an event, $event->title", "/app/event/$event->id");
      return $this->sendResponse(new EventResource($event), "success");
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Event $event)
  {
    if (!$event->status) {
      return $this->sendError("Event does not exist");
    }
    $event->status = false;
    if ($event->save()) {
      $this->createNotification("deleted an event, $event->title", "/app/event/$event->id");
      return $this->sendResponse(null, "Deleted");
    }
  }
}
