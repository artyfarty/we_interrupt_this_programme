<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Donation
 *
 * @property int $id
 * @property string $person
 * @property string $message
 * @property float $sum
 * @property int $approved
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Donation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Donation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Donation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Donation whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation wherePerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation whereUpdatedAt($value)
 */
class Donation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function notification() {
        return $this->hasOne(Notification::class);
    }

    protected static function booted()
    {
        $createOrUpdate = function (Donation $don) {
            $begin_date = date_create();
            $end_date = date_create(config_get("donate.timeframe"));

            if ($don->approved) {
                $don->notification()->delete();

                $don->notification()->create(
                    [
                        "caption" => "Нам пишут",
                        "text"      => $don->message,
                        "headline"  => "{$don->person}",
                        "display_limit" => 1,
                        "type"  => "donation",
                        "display_from" => $begin_date,
                        "display_till" => $end_date,
                        "priority" => +config_get("donate.priority"),
                    ]
                );
            } else {
                $don->notification()->delete();
            }
        };

        static::updating($createOrUpdate);

        static::deleting( function (Donation $don) {
            $don->notification()->delete();
        });
    }
}
