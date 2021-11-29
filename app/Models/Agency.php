<?php

namespace App\Missions;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;


class Agency extends Model
{
    use Uuid;

    protected $fillable = [
        'name',
        'acronym',
        'primary_country',
        'address',
        'phone',
        'email',
        'logo'
    ];

    protected $hidden = [
        'status', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'added_by');
    }
    
    public function missionaries()
    {
        return $this->hasMany('App\Missions\Missionary', 'agency_id', 'id');
    }

}
