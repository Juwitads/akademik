<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $data = array(
      [
        'title' => 'Tes Post',
        'description' => 'Tes bikin pengumuman',
        'image' => 'tes-pengumuman.jpg',
        'created_by' => '1',
      ],
      [
        'title' => 'Tes Post 2',
        'description' => 'Tes bikin pengumuman 2',
        'image' => 'tes-pengumuman.jpg',
        'created_by' => '1',
      ],
      [
        'title' => 'Tes Post 3',
        'description' => 'Tes bikin pengumuman 3',
        'image' => 'tes-pengumuman.jpg',
        'created_by' => '1',
      ],
    );

    foreach ($data as $d) {
      Announcement::create([
        'title' => $d['title'],
        'description' => $d['description'],
        'image' => $d['image'],
        'created_by' => $d['created_by'],
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
  }
}
