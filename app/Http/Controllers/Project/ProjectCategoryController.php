<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Project\ProjectCategoryResource;
use App\Project\ProjectCategory;
use Illuminate\Http\Request;

class ProjectCategoryController extends BaseController
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
        return $this->sendResponse(ProjectCategoryResource::collection(ProjectCategory::where('status', true)->get()) ,"Success");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category = new ProjectCategory();
        $category->name = $request->name;
        if($category->save()) {
            return $this->sendResponse(new ProjectCategoryResource($category), "Category saved");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectCategory $projectCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category = ProjectCategory::findOrFail($id);
        $category->name = $request->name;
        // return $category;
        if($category->save()) {
            return $this->sendResponse(new ProjectCategoryResource($category), "Category updated");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projectCategory = ProjectCategory::findOrFail($id);
        if($projectCategory->status == false) {
            return $this->sendError("Data not found");
        }
        $projectCategory->status = false;
        if($projectCategory->save()) {
            return $this->sendResponse(new ProjectCategoryResource($projectCategory), "Data deleted");
        }
    }
}
