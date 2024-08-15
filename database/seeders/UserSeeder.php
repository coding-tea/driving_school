<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'login' => "user@email.com",
                'password' => Hash::make('test'),
            ],
            [
                'login' => "admin@email.com",
                'password' => Hash::make('test'),
            ],
            [
                'login' => "test",
                'password' => Hash::make('test'),
            ],
        ]);
    }
}
