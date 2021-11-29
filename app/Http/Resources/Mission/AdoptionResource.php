<?php

namespace App\Http\Resources\Mission;

use Illuminate\Http\Resources\Json\JsonResource;

class AdoptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'missionary' => $this->missionary,
            'donor_name' => $this->donor_name,
            'donor_phone' => $this->donor_phone,
            'donor_email' => $this->donor_email,
            'donor_sex' => $this->donor_sex,
            'donation_frequency'  => $this->donor_frequency,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'date' => $this->date,
            'mode_of_payment' => $this->mode_of_payment,
            'online_payment_id' => $this->online_payment_id,
            'success' => $this->success,
        ];
    }
}
