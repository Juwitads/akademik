<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
  use HasFactory;
  protected $table = "raport";
  protected $guarded = ['id'];
  public $timestamps = false;
  protected $dates = ['created_at'];
  protected $with = ['student', 'course'];

  public function student()
  {
    return $this->belongsTo(User::class, 'siswa_id', 'id');
  }
  public function course()
  {
    return $this->belongsTo(Course::class, 'courses_id', 'id');
  }
}
