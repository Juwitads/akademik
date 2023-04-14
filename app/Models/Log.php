<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
  use HasFactory;

  protected $guarded = ['id'];
  protected $with = ['user', 'room'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function room()
  {
    return $this->belongsTo(Room::class, 'class_id', 'id');
  }
}
