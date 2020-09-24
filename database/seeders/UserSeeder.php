<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->updateOrInsert(
            [
                "id" => 1
            ],
            [
                "id" => 1,
                "name" => env("WITP_USERNAME"),
                "email" => env("WITP_EMAIL"),
                "password" => password_hash(env("WITP_PASSWORD"), PASSWORD_DEFAULT),
            ]
        );
    }
}
