<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectGivingRequest;
use App\Http\Resources\Project\ProjectGivingResource;
use App\Project\ProjectGiving;
use Illuminate\Http\Request;

class ProjectGivingController extends BaseController
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
        return $this->sendResponse(ProjectGivingResource::collection(ProjectGiving::all()) ,"Success");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectGivingRequest $request)
    {
        $project = new ProjectGiving();
        $project->fill($request->post());
        $project->added_by = auth()->user()->id;
        if($project->save()) {
            return $this->sendResponse(new ProjectGivingResource($project), "Successful");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project\ProjectGiving  $projectGiving
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectGiving $projectGiving)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project\ProjectGiving  $projectGiving
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectGiving $projectGiving)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project\ProjectGiving  $projectGiving
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectGiving $projectGiving)
    {
        //
    }
}
