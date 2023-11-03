<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'id' => Str::uuid(),
                    'name' => "Admin 1",
                    'email' => 'admin1@gmail.com',
                    'password' => Hash::make('11111111'),
                    'role' => "ADMIN",
                ],
                [
                    'id' => Str::uuid(),
                    'name' => "Staff 1",
                    'email' => 'staff1@gmail.com',
                    'password' => Hash::make('11111111'),
                    'role' => "STAFF",
                ],
                [
                    'id' => Str::uuid(),
                    'name' => "Staff 2",
                    'email' => 'staff2@gmail.com',
                    'password' => Hash::make('11111111'),
                    'role' => "STAFF",
                ],
            ]
        );
    }
}
