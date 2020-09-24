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
        DB::table('configs')->insertOrIgnore(["key" => "queue.enable", "value" => "1", "desc" => "Очередь активна. Если выключить, API ничего не будет возвращать"]);
        DB::table('configs')->insertOrIgnore(["key" => "queue.rebuild", "value" => "1", "desc" => "Перестраивать очередь при изменениях расписания. Отклчить если в очереди все портится и надо делат что-то руками"]);

        DB::table('configs')->insertOrIgnore(["key" => "queue.interval_min", "value" => "60", "desc" => "Минимальный интервал между сообщениями в очереди"]);
        DB::table('configs')->insertOrIgnore(["key" => "queue.interval", "value" => "300", "desc" => "Оптимальный интервал между сообщениями в очереди"]);
        DB::table('configs')->insertOrIgnore(["key" => "queue.interval_priority", "value" => "1", "desc" => "Интервал между сообщениями для сообщений с приоритетом 0"]);

        DB::table('configs')->insertOrIgnore(["key" => "program.notify_for", "value" => "-30min", "desc" => "За сколько до начала события в расписании начать показывать уведомления"]);
        DB::table('configs')->insertOrIgnore(["key" => "program.notify_times", "value" => "5", "desc" => "Сколько уведомлений до начала события в раписании можно показать"]);

        DB::table('configs')->insertOrIgnore(["key" => "donate.key", "value" => "", "desc" => "widgetGroupExtId QIWI Donate"]);
        DB::table('configs')->insertOrIgnore(["key" => "donate.timeframe", "value" => "+1hour", "desc" => "В течение сколького времени после создания доната его можно показать"]);
        DB::table('configs')->insertOrIgnore(["key" => "donate.priority", "value" => "2", "desc" => "Приоритет донатов"]);
    }
}
