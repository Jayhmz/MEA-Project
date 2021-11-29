<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Project\Project;
use Illuminate\Http\Request;

class ProjectController extends BaseController
{
  public function __construct()
  {
    $this->middleware('utility:api', ['only' => ['store', 'update', 'destroy']]);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return $this->sendResponse(ProjectResource::collection(Project::where('status', true)->get()), "Success");
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ProjectRequest $request)
  {
    $project = new Project();
    $project->fill($request->post());
    $project->added_by = auth()->user()->id;
    if ($project->save()) {
      $this->createNotification("created project, $project->title", "/app/project/$project->id");
      return $this->sendResponse(new ProjectResource($project), "Project created");
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Project\Project  $project
   * @return \Illuminate\Http\Response
   */
  public function show(Project $project)
  {
    if ($project->status == false) {
      return $this->sendError("Data not found");
    }
    return $this->sendResponse(new ProjectResource($project), "Success");
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Project\Project  $project
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Project $project)
  {
    if ($project->status == false) {
      return $this->sendError("Data not found");
    }
    $project->fill($request->post());
    if ($project->save()) {
      $this->createNotification("updated project, $project->title", "/app/project/$project->id");
      return $this->sendResponse(new ProjectResource($project), "Project created");
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Project\Project  $project
   * @return \Illuminate\Http\Response
   */
  public function destroy(Project $project)
  {
    if ($project->status == false) {
      return $this->sendError("Data not found");
    }
    $project->status = false;
    if ($project->save()) {
      $this->createNotification("deleted project, $project->title", "/app/project/$project->id");
      return $this->sendResponse(new ProjectResource($project), "Data deleted");
    }
  }
}
