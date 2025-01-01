<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    //full_name, username, email, email_verified_at, password, photo, phone, address, role, status

    //admin
    User::create([
      "full_name" => "Admin",
      "username" => "admin",
      "email" => "admin@gmail.com",
      "email_verified_at" => now(),
      "password" => bcrypt("1234"),
      "photo" => "nothing",
      "phone" => "1234532434",
      "address" => "something address",
      "role" => "admin",
      "status" => "active"
    ]);

    //vendor
    User::create([
      "full_name" => "Vendor",
      "username" => "vendor",
      "email" => "vendor@gmail.com",
      "email_verified_at" => now(),
      "password" => bcrypt("1234"),
      "photo" => "nothing",
      "phone" => "1234532434",
      "address" => "something address",
      "role" => "vendor",
      "status" => "active"
    ]);

    //user
    User::create([
      "full_name" => "Customer",
      "username" => "customer",
      "email" => "customer@gmail.com",
      "email_verified_at" => now(),
      "password" => bcrypt("1234"),
      "photo" => "nothing",
      "phone" => "1234532434",
      "address" => "something address",
      "role" => "customer",
      "status" => "active"
    ]);
  }
}