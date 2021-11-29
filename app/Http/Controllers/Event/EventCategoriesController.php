<?php

namespace App\Http\Controllers\Event;

use App\EventCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Event\EventCategoriesRequest;
use App\Http\Resources\Event\EventCategoriesResource;

class EventCategoriesController extends BaseController
{
 /*  public function __construct()
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
    return $this->sendResponse(EventCategoriesResource::collection(EventCategories::where('status', true)->get()), 'success');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(EventCategoriesRequest $request)
  {
    $category = new EventCategories;
    $category->fill($request->post());
    if ($category->save()) {
      // $this->createNotification("updated an event, $event->title", "/app/event/$event->id");
      return $this->sendResponse(new EventCategoriesResource($category), 'success');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(EventCategories $category)
  {
    if(!$category->status) {
      return $this->sendError("Event category does not exist");
    }
    return $this->sendResponse(new EventCategoriesResource($category), 'success');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(EventCategories $category, EventCategoriesRequest $request)
  {
    if(!$category->status) {
      return $this->sendError("Event category does not exist");
    }
    $category->fill($request->post());
    if ($category->save()) {
      return $this->sendResponse(new EventCategoriesResource($category), 'success');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(EventCategories $category)
  {
    if(!$category->status) {
      return $this->sendError("Event category does not exist");
    }
    $category->status = false;
    if ($category->save()) {
      return $this->sendResponse(null, 'Deleted');
    }
  }
}
