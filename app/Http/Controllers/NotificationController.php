<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class NotificationController extends BaseController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $notifications = Notification::where('read', false)->orderBy('created_at', 'DESC')->get();
    return $this->sendResponse($notifications, 'Success');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Notification  $notification
   * @return \Illuminate\Http\Response
   */
  public function show(Notification $notification)
  {
    $notification->read = true;
    if ($notification->save()) {
      return $this->sendResponse($notification, 'Success');
    }
  }
}
