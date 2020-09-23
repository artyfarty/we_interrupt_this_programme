<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert(["key" => "queue.interval_min", "value" => "30"]);
        DB::table('configs')->insert(["key" => "queue.interval", "value" => "120"]);
        DB::table('configs')->insert(["key" => "queue.horizon", "value" => "+2days"]);
    }
}
