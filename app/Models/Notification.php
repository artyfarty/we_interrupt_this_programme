<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 *
 * @package App\Models
 * @property int $id
 * @property int|null $program_event_id
 * @property int|null $donation_id
 * @property string $caption
 * @property string $headline
 * @property string $text
 * @property array $lines
 * @property string $type
 * @property array $meta
 * @property int $priority
 * @property int $display_limit
 * @property string $display_from
 * @property string $display_till
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QueueElement[] $queued
 * @property-read int|null $queued_count
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereDisplayFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereDisplayLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereDisplayTill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereDonationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereHeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereLines($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereProgramEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 */
class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        "headline",
        "caption",
        "text",
        "lines",
        "meta",
        "type",
        "priority",
        "display_limit",
        "display_from",
        "display_till",
    ];

    protected $casts = [
        "lines" => "json",
        "meta"  => "json",
    ];

    protected $attributes = [
        "text" => "",
        "lines" => "",
        "meta" => "",
        "type" => "default",
        "priority" => 1,
        "display_limit" => 1,
    ];

    public function queued() {
        return $this->hasMany(QueueElement::class);
    }
}
