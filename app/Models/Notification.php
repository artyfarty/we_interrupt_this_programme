<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * @package App\Models
 *
 *
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
