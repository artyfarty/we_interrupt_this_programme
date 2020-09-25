<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 *
 * @property $id
 * @property $program_event_id
 * @property $donation_id
 * @property $caption
 * @property $headline
 * @property $text
 * @property $lines
 * @property $type
 * @property $meta
 * @property $priority
 * @property $display_limit
 * @property $display_from
 * @property $display_till
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Notification extends Model
{
    use HasFactory;

    const TYPES = [
        "default",
        "urgent",
        "schedule",
        "donation",
        "list"
    ];

    static $rules = [
		'caption' => 'required',
		'headline' => 'required',
		'text' => 'required',
		'type' => 'required',
		//'meta' => 'required',
		'priority' => 'required',
		'display_limit' => 'required',
		'display_from' => 'required',
		'display_till' => 'required',
    ];

    protected $perPage = 20;

    protected $casts = [
        "meta"  => "array",
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['program_event_id','donation_id','caption','headline','text','type','meta','priority','display_limit','display_from','display_till'];

    protected $attributes = [
        "text" => "",
        "meta" => "",
        "type" => "default",
        "priority" => 1,
        "display_limit" => 1,
    ];

    protected static function booted()
    {
        static::creating(function (Notification $n) {
            $n->meta = [];
        });

        $regenQueue = function () {
            \App\Jobs\RegenerateQueue::dispatchSync();
        };

        if (config_get("queue.rebuild")) {
            static::created($regenQueue);
            static::updated($regenQueue);
            static::deleting(function (Notification $n) use ($regenQueue) {
                QueueElement::whereNotificationId($n->id)->delete();
            });
            static::deleted($regenQueue);
        }
    }

    public function queued() {
        return $this->hasMany(QueueElement::class);
    }

    public function program() {
        return $this->belongsTo(ProgramEvent::class);
    }

    public function donation() {
        return $this->belongsTo(Donation::class);
    }
}
