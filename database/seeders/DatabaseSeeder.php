<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Notification::factory()->count(30)->create();

        Notification::factory()->count(5)->isList()->create();

        $this->call([ConfigSeeder::class]);
    }
}
