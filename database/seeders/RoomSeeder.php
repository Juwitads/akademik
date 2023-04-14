<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
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
        'tingkat_kelas' => 'X',
        'jurusan' => 'IPA',
        'no_kelas' => '1',
        'tahun_masuk'  => '2020',
        'nama_kelas'  => 'X IPA 1'
      ],
      [
        'id' => 2,
        'tingkat_kelas' => 'XI',
        'jurusan' => 'IPS',
        'no_kelas' => '2',
        'tahun_masuk'  => '2019',
        'nama_kelas'  => 'XI IPS 2'
      ],
      [
        'id' => 3,
        'tingkat_kelas' => 'XII',
        'jurusan' => 'IPA',
        'no_kelas' => '3',
        'tahun_masuk'  => '2018',
        'nama_kelas'  => 'XII IPA 3'
      ],
      
    ];

    foreach ($data as $d) {
      Room::create([
        'id' => $d['id'],
        'tingkat_kelas' => $d['tingkat_kelas'],
        'jurusan' => $d['jurusan'],
        'no_kelas' => $d['no_kelas'],
        'nama_kelas' => $d['nama_kelas'],
        'tahun_masuk'  => $d['tahun_masuk']
      ]);
    }
  }
}
