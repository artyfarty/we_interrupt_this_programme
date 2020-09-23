<?php


namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class ConfigRepository {
    public function get($key) {
        return DB::table("configs")->select(["value"])->where("key", $key)->value("value");
    }

    public function set($key, $value) {
        DB::table("configs")->where("key", $key)->updateOrInsert(["value" => $value, "key" => $key]);
    }
}
