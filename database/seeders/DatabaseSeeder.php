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
        Notification::factory()->count(80)->create();

        Notification::factory()->count(10)->isList()->create();

        $this->call([ConfigSeeder::class]);
    }
}
