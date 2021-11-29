<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
      'title', 
      'event_category', 
      'description', 
      'event_type',
      'start_date',
      'end_date',
      'flyer_url',
      'video_link',
      'external_reg_link',
      'requires_registration',
      'added_by',
      'status'

    ];

    
    public function posts()
  {
    return $this->hasMany(Post::class);
  }


  static function Boot()
  {
    Parent::boot();
    self::creating(function ($model) {
      $model->id = Str::uuid();
      $model->status = 1;
    });

    // self::deleting(function ($model){
    //   $model->status = 0;
    // });
  }
}
