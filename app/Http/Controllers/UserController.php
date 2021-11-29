<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
  public function __construct() {
    $this->middleware('superadmin:api', ['only' => ['store', 'update', 'destroy']]);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return $this->sendResponse(UserResource::collection(User::where('status', true)->get()), "Success");
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(UserRequest $request)
  {
    $user = new User;
    $user->fill($request->post());
    $user->password = bcrypt($request->password);
    $user->created_by = auth()->user()->id;
    if ($user->save()) {
      return $this->sendResponse(new UserResource($user), "Data Created");
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function show(User $user)
  {
    if ($user->status == false) {
      return $this->sendError("Data not found");
    }
    return $this->sendResponse(new UserResource($user), "Success");
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user)
  {
    if ($user->status == false) {
      return $this->sendError("Data not found");
    }
    $user->fill($request->post());
    if ($user->save()) {
      return $this->sendResponse(new UserResource($user), "Data updated");
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    if ($user->status == false) {
      return $this->sendError("Data not found");
    }
    $user->status = false;
    if ($user->save()) {
      return $this->sendResponse(new UserResource($user), "Data deleted");
    }
  }
}
