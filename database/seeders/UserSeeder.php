<?php

namespace Database\Seeders;

use App\Models\RingSchedule;
use App\Models\Teacher;
use App\Models\User;
use Database\Factories\UserFactoryPrev;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Andrey',
            'email' => 'andrey.guralev00@gmail.com',
            'type' =>4,
            'email_verified_at' => now(),
            'password' => '$2y$10$o81ENcyZxXB11TrZiXMFwulzT..3rd4fI1neIk2jAikbd8/LeazTm', // password
            'remember_token' => Str::random(10),
        ]);
    }
}

