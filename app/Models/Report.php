<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Report extends Model
{
  use HasFactory;
  protected $fillable = [
    'title', 'type', 'fileimage', 'file', 'year', 'slug', 'status'
  ];

  public function getRouteKeyName()
  {
    return 'slug';
  }

  static function boot()
  {
    Parent::boot();
    self::creating(function ($model) {
      $model->slug = Str::uuid();
      $model->status = 1;
    });

    self::deleting(function ($model) {

      if ($model->file && file_exists(public_path($model->file))) {
        $model->status = 0;
      }
    });
    
  }
}
