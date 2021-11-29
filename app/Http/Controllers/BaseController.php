<?php

namespace App\Http\Controllers;

use App\User;
use App\Notification;
use Illuminate\Http\Request;

class BaseController extends Controller
{
  public function sendResponse($result, $message)
  {
    $response = [
      'success' => true,
      'data' => $result,
      'message' => $message
    ];
    return response()->json($response, 200);
  }

  public function sendError($error, $status = 201, $errorMessages = [])
  {
    $response = [
      'success' => false,
      'message' => $error
    ];

    if (!empty($errorMessages)) {
      $response['data'] = $errorMessages;
    }
    return response()->json($response, $status);
  }

  public function createNotification($description, $link)
  {
    $id = auth()->user()->id;
    $user = User::find($id);
    $str = "$user->firstname $user->surname ";
    $str = $str . $description;
    $notification = new Notification();
    $notification->user_uuid = $id;
    $notification->description = $str;
    $notification->link = $link;
    $notification->save();
  }

  public function clientNotification($description, $link)
  {
    $notification = new Notification();
    $notification->user_uuid = 'client';
    $notification->description = $description;
    $notification->link = $link;
    $notification->save();
  }
}
