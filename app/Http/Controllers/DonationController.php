<?php

namespace App\Http\Controllers;

use App\Donation;
use App\Http\Requests\DonationRequest;
use App\Http\Resources\DonationResource;
use Illuminate\Http\Request;

class DonationController extends BaseController
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
        return $this->sendResponse(DonationResource::collection(Donation::where('status', true)->get()), 'Success');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonationRequest $request)
    {
        $donation = new Donation();
        $donation->fill($request->post());
        if($donation->save()) {
            return $this->sendResponse(new DonationResource($donation), 'Data saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        if($donation->status == false) {
        return $this->sendError("Data not found");
        }
        $donation->status = false;
        if ($donation->save()) {
        return $this->sendResponse($donation, 'Data deleted');
        }
    }
}
