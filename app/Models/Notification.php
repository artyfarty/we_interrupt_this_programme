<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        "displayed_times" => 0,
        "display_limit" => 0,
    ];

    public function queued() {
        return $this->hasMany(QueueElement::class);
    }
}
