<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'firstname',
    'surname',
    'email',
    'password',
    'sex',
    'job_title',
    'role',
  ];

  public $roles = [
    '0' => 'Super Admin',
    '1' => 'Administrator',
    '2' => 'Report Viewer',
  ];
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  protected $keyType = 'string';

  static function Boot()
  {
    Parent::boot();
    self::creating(function ($model) {
      $model->id = Str::uuid();
    });
  }
}
