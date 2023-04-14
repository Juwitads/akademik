<?php

namespace Database\Seeders;

use App\Models\Log;
use Illuminate\Database\Seeder;

class LogSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $data = [
      [
        'id' => 1,
        'user_id' => 4,
        'class_id' => 1,
        'action'  => 'login'
      ],
      [
        'id' => 2,
        'user_id' => 5,
        'class_id' => 2,
        'action'  => 'login'
      ],
      [
        'id' => 3,
        'user_id' => 6,
        'class_id' => 3,
        'action'  => 'login'
      ],
      [
        'id' => 4,
        'user_id' => 7,
        'class_id' => 1,
        'action'  => 'login'
      ],
      [
        'id' => 5,
        'user_id' => 8,
        'class_id' => 7,
        'action'  => 'login'
      ],
      [
        'id' => 6,
        'user_id' => 9,
        'class_id' => 13,
        'action'  => 'login'
      ],
    ];

    foreach ($data as $d) {
      Log::create([
        'id' => $d['id'],
        'user_id' => $d['user_id'],
        'class_id' => $d['class_id'],
        'action'  => $d['action']
      ]);
    }
  }
}
