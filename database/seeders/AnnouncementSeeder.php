<?php

namespace Database\Seeders;

use App\Models\Announcements;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        Announcements::factory()->count(50)->create();
    }
}
