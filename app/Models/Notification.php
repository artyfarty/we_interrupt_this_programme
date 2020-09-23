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
        "type",
        "priority",
        "display_limit",
        "display_from",
        "display_till",
    ];
}
