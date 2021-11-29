<?php

namespace App\Missions;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Missionary extends Model
{
  use Uuid;

  protected $fillable = [
    'title',
    'firstname',
    'othername',
    'surname',
    'phone',
    'email',
    'country',
    'region',
    'state',
    'field_name',
    'agency_id',
    'contact_address',
    'sex',
    'marital_status',
    'num_children',
    'bio',
    'about',
    'field_pics',
    'needs_project',
    'monthly_budget',
    'photo',
    'classified'
  ];

  protected $hidden = [
    'status', 'updated_at'
  ];

  protected $casts = [
    'field_pics' => 'array'
  ];

  public function user()
  {
    return $this->belongsTo('App\User', 'added_by');
  }

  public function agency()
  {
    return $this->belongsTo('App\Missions\Agency', 'agency_id');
  }
}
