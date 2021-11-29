<?php

namespace App\Http\Controllers\Mission;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\Mission\MissionaryRequest;
use App\Http\Resources\Mission\MissionaryResource;
use App\Missions\Missionary;

class MissionaryController extends BaseController
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
        return $this->sendResponse(MissionaryResource::collection(Missionary::where('status', 1)->get()), "Success");
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(MissionaryRequest $request)
  {
    $missionary = new Missionary();
    $missionary->fill($request->post());
    $missionary->added_by = auth()->user()->id;
    if ($missionary->save()) {
      $this->createNotification("created missionary, $missionary->title. $missionary->firstname $missionary->surname", "/app/missionary/$missionary->id");
      return $this->sendResponse(new MissionaryResource($missionary), "Data saved");
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Missions\Missionary  $missionary
   * @return \Illuminate\Http\Response
   */
  public function show(Missionary $missionary)
  {
    if ($missionary->status == false) {
      return $this->sendError("Data not found");
    }
    return $this->sendResponse(new MissionaryResource($missionary), "Success");
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Missions\Missionary  $missionary
   * @return \Illuminate\Http\Response
   */
  public function update(MissionaryRequest $request, Missionary $missionary)
  {
    if ($missionary->status == false) {
      return $this->sendError("Data not found");
    }
    $missionary->fill($request->post());
    if ($missionary->save()) {
      $this->createNotification("updated missionary, $missionary->title. $missionary->firstname $missionary->surname", "/app/missionary/$missionary->id");
      return $this->sendResponse(new MissionaryResource($missionary), "Data updated");
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Missions\Missionary  $missionary
   * @return \Illuminate\Http\Response
   */
  public function destroy(Missionary $missionary)
  {
    if ($missionary->status == false) {
      return $this->sendError("Data not found");
    }
    $missionary->status = false;
    if ($missionary->save()) {
      $this->createNotification("deleted missionary, $missionary->title. $missionary->firstname $missionary->surname", "/app/missionary/$missionary->id");
      return $this->sendResponse(new MissionaryResource($missionary), "Data deleted");
    }
  }
}
