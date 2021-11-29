<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class eventCategory extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    static function Boot()
  {
    Parent::boot();
    self::creating(function ($model) {
      $model->id = Str::uuid();
    });
  }
}
