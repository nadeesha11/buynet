<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'admin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'super_admin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'user', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            // insert records
        ];
        
        DB::table('admin_types')->insert($data);
    }
}
