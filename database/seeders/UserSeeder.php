<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  public function run()
  {
    $data = array(
      [
        'name' => 'Administrator',
        'email' => 'admin@gmail.com',
        'email_verified_at' => date('Y-m-d H:i:s'),
        'password' => Hash::make('123456789'),
        'phone' => '0',
        'role' => 'a',
        'class_id' => NULL
      ],
      [
        'name' => 'Administrator 2',
        'email' => 'admin2@gmail.com',
        'email_verified_at' => date('Y-m-d H:i:s'),
        'password' => Hash::make('123456789'),
        'phone' => '089512345678',
        'role' => 'a',
        'class_id' => NULL
      ],
      [
        'name' => 'Guru',
        'email' => 'guru@gmail.com',
        'email_verified_at' => date('Y-m-d H:i:s'),
        'password' => Hash::make('123456789'),
        'phone' => '081234567890',
        'role' => 'g',
        'class_id' => NULL
      ],
      [
        'name' => 'juwita',
        'email' => 'juwita@gmail.com',
        'email_verified_at' => date('Y-m-d H:i:s'),
        'password' => Hash::make('123456789'),
        'phone' => '089876543210',
        'role' => 's',
        'class_id' => '3'
      ],
      [
        'name' => 'samto',
        'email' => 'samto@gmail.com',
        'email_verified_at' => date('Y-m-d H:i:s'),
        'password' => Hash::make('123456789'),
        'phone' => '089876543211',
        'role' => 's',
        'class_id' => '2'
      ],
      [
        'name' => 'dwi',
        'email' => 'dwi@gmail.com',
        'email_verified_at' => date('Y-m-d H:i:s'),
        'password' => Hash::make('123456789'),
        'phone' => '089876543212',
        'role' => 's',
        'class_id' => '3'
      ],
      [
        'name' => 'sofia',
        'email' => 'sofia@gmail.com',
        'email_verified_at' => date('Y-m-d H:i:s'),
        'password' => Hash::make('123456789'),
        'phone' => '089876543213',
        'role' => 's',
        'class_id' => '1'
      ],
      [
        'name' => 'Dwi',
        'email' => 'dora@gmail.com',
        'email_verified_at' => date('Y-m-d H:i:s'),
        'password' => Hash::make('123456789'),
        'phone' => '089876543214',
        'role' => 's',
        'class_id' => '1'
      ],
      [
        'name' => 'Abriel',
        'email' => 'yosua@gmail.com',
        'email_verified_at' => date('Y-m-d H:i:s'),
        'password' => Hash::make('123456789'),
        'phone' => '089876543215',
        'role' => 's',
        'class_id' => '1'
      ],

    );
    foreach ($data as $d) {
      User::create([
        'name' => $d['name'],
        'email' => $d['email'],
        'email_verified_at' => $d['email_verified_at'],
        'phone' => $d['phone'],
        'password' => $d['password'],
        'role' => $d['role'],
        'class_id' => $d['class_id']
      ]);
    }
  }
}
