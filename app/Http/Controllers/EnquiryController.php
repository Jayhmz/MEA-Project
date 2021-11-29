<?php

namespace App\Http\Controllers;

use App\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\EnquiryRequest;
use App\Http\Resources\EnquiryResource;
use App\Notifications\Enquiry as NotificationsEnquiry;
use Illuminate\Notifications\Notification;

class EnquiryController extends BaseController
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
    return $this->sendResponse(EnquiryResource::collection(Enquiry::all()), 'success');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(EnquiryRequest $request)
  {
    $enquiry = new Enquiry();
    $enquiry->fill($request->post());
    if ($enquiry->save()) {
      $this->clientNotification("New Enquiry from $enquiry->name", "/app/enquiry/$enquiry->title");
      $enquiry->notify(new NotificationsEnquiry($enquiry));
      return $this->sendResponse(new EnquiryResource($enquiry), 'success');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Enquiry  $enquiry
   * @return \Illuminate\Http\Response
   */
  public function show(Enquiry $enquiry)
  {
    return $this->sendResponse(new EnquiryResource($enquiry), 'success');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Enquiry  $enquiry
   * @return \Illuminate\Http\Response
   */
  public function update(Enquiry $enquiry, EnquiryRequest $request)
  {
    $enquiry->fill($request->post());
    if ($enquiry->save()) {
      return $this->sendResponse(new EnquiryResource($enquiry), 'success');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Enquiry  $enquiry
   * @return \Illuminate\Http\Response
   */
  public function destroy(Enquiry $enquiry)
  {
    if ($enquiry->delete()) {
      return $this->sendResponse(null, 'success');
    }
  }
}
