<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QueueElement
 *
 * @property int $id
 * @property int $notification_id
 * @property string $display_at
 * @property mixed $was_displayed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Notification $notification
 * @method static \Illuminate\Database\Eloquent\Builder|QueueElement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QueueElement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QueueElement query()
 * @method static \Illuminate\Database\Eloquent\Builder|QueueElement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QueueElement whereDisplayAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QueueElement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QueueElement whereNotificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QueueElement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QueueElement whereWasDisplayed($value)
 */
class QueueElement extends Model
{
    use HasFactory;

    public function notification() {
        return $this->belongsTo(Notification::class);
    }


    protected $attributes = [
        "was_displayed" => false,
    ];

    protected $fillable = [
        "display_at"
    ];
}
