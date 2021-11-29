<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

use function PHPUnit\Framework\fileExists;

class Post extends Model
{
  use HasFactory;
  use SoftDeletes;
  
  protected $fillable = [
    'filepath', 'event_id', 'status'
  ];
  
  public function events()
  {
    return $this->belongsTo(Event::class);
  }

  static function Boot()
  {
    Parent::boot();
    self::creating(function ($model){
    
        $model->status = 1;
 
    });


    // self::updating(function ($model){
    //   if(file_exists($model->filepath)){
    //     $model->status = 0;
    //   }
    // });
  }


  
}
