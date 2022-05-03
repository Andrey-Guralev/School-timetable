<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
//        \App\Models\User::factory(1)->create();
//
//        $this->call([
//            ClassesSeeder::class,
//            AnnouncementsSeeder::class,
//            TimetableSeeder::class
//        ]);
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
