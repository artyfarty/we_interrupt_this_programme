<?php


namespace Database\Factories;


use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NotificationFactory extends Factory {
    protected $model = Notification::class;

    /**
     * @inheritDoc
     */
    public function definition() {
        $date_from = $this->faker->dateTimeBetween("now", "now +1day");

        return [
            "headline" => $this->faker->text(50),
            "caption"  => $this->faker->text(30),
            "text"     => $this->faker->text(100),
            "lines"    => json_encode([]),
            "meta"     => json_encode([]),
            "type"     => $this->faker->randomElement(
                [
                    "default",
                    "urgent",
                    "schedule",
                    //"donation",
                    //"list"
                ]
            ),
            "priority" => $this->faker->numberBetween(0, 2),
            "display_limit" => $this->faker->numberBetween(1, 10),
            "display_from" => $this->faker->dateTimeBetween("now", "now +1day"),
            "display_till" => $this->faker->dateTimeBetween($date_from,"now +1day"),
        ];
    }

    /**
     * @return NotificationFactory
     */
    public function isList() {
        $lines = [];
        for ($i = 0; $i < $this->faker->numberBetween(2, 5); $i++) {
            $lines[] = $this->faker->text(100);
        }

        return $this->state(
            [
                "lines" => json_encode($lines),
                "type"  => "list",
            ]
        );
    }
}
