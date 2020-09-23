<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProgramEvent
 *
 * @property int $id
 * @property string $begin_at
 * @property string $headline
 * @property string $text
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramEvent whereBeginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramEvent whereHeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramEvent whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramEvent whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramEvent whereUpdatedAt($value)
 */
class ProgramEvent extends Model
{
    use HasFactory;
}
