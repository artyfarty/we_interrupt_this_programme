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
        DB::table('configs')->insert(["key" => "queue.enable", "value" => "1"]);
        DB::table('configs')->insert(["key" => "queue.rebuild", "value" => "1"]);
        
        DB::table('configs')->insert(["key" => "queue.interval_min", "value" => "60"]);
        DB::table('configs')->insert(["key" => "queue.interval", "value" => "300"]);
        DB::table('configs')->insert(["key" => "queue.horizon", "value" => "+2days"]);

        DB::table('configs')->insert(["key" => "program.notify_for", "value" => "-30min"]);
    }
}
