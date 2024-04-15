<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class superAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
        'name' => 'superAdmin',
        'email' => 'jayathilaka221b@gmail.com',
        'user_type' => 2,
        'password' => Hash::make('12121212'),
        'status' => 1
        ]);
    }
}
