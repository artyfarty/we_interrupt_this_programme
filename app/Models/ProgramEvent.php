<?php

namespace App\Models;

use App\Repositories\ConfigRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * Class ProgramEvent
 *
 * @property $id
 * @property $begin_at
 * @property $headline
 * @property $text
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProgramEvent extends Model
{

    static $rules = [
		'begin_at' => 'required',
		'headline' => 'required',
		'text' => 'required',
		'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['begin_at','headline','text','status'];

    public function notification() {
        return $this->hasOne(Notification::class);
    }

    protected static function booted()
    {
        $createOrUpdate = function (ProgramEvent $pe) {
            $now = date_create();

            $end_date = date_create($pe->begin_at);
            $begin_date = (clone $end_date)->modify(config_get("program.notify_for"));

            if ($begin_date < $now) {
                $begin_date = clone $now;
            }

            if ($pe->status == "enabled") {
                Notification::whereProgramEventId($pe->id)->delete();

                $pe->notification()->create([
                    "caption" => "Далее",
                    "text"      => $pe->text,
                    "headline"  => $pe->headline,
                    "display_limit" => config_get("program.notify_times"),
                    "type"  => "schedule",
                    "display_from" => $begin_date,
                    "display_till" => $end_date,
                ]);
            } else {
                Notification::whereProgramEventId($pe->id)->delete();
            }
        };


        $regenQueue = function () {
            \App\Jobs\RegenerateQueue::dispatchSync();
        };

        if (config_get("queue.rebuild")) {
            static::created($regenQueue);
            static::updated($regenQueue);
            static::deleted($regenQueue);
        }

        static::created($createOrUpdate);
        static::updating($createOrUpdate);
        static::deleting( function (ProgramEvent $pe) {
            Notification::whereProgramEventId($pe->id)->delete();
        });
    }

}
