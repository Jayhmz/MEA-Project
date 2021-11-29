<?php

namespace App\Missions;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Notifications\Notifiable;

class Adoption extends Model
{
    use Notifiable;
    use Uuid;

    protected $fillable = [
        'missionary_id',
        'donor_name',
        'donor_phone',
        'donor_email',
        'donor_sex',
        'donation_frequency',
        'amount',
        'currency',
        'date',
        'mode_of_payment',
        'online_payment_id',
        'success',
    ];

    protected $hidden = [
        'status', 'updated_at'
    ];

    public function missionary()
    {
        return $this->belongsTo('App\Missions\Missionary', 'missionary_id');
    }

    public function routeNotificationForMail($notification)
    {
        return 'shalomogunshola@gmail.com';
    }
}
